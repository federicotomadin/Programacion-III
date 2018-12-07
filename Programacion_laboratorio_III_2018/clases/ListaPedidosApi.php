<?php
require_once("ListaPedidos.php");
require_once("Pedidos.php");
require_once("Empleado.php");
require_once("Productos.php");
require_once("Operaciones.php");
require_once("Roles.php");
include_once("../bd/AccesoDatos.php");
//include_once("../phpExcel/Classes/PHPExcel.php");
//include_once('../fpdf/fpdf.php');
// include composer autoload
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;


class ListaPedidosApi
{

public function InsertarPedido($request,$response,$args)
{
    $arrayConToken = $request->getHeader('token');
    $token=$arrayConToken[0];
    $payload=AutentificadorJWT::ObtenerData($token); 
    $empleado = Empleado::TraerElEmpleadoPorUsuario($payload->Usuario);

    if($payload->perfil!="Mozo")
    {
       $resp["status"]="401";
       return $response->withJson($resp);
    }  

    $datos=$request->getParsedBody();
    $resp["status"]=200;
    $listaPedido= new ListaPedidos();
    $precio= Productos::TraerPrecio($datos["IdProducto"]);
    $idRol= Productos::TraerIdRol($datos["IdProducto"]);

    $listaPedido->SetId_pedido(Null);
    $listaPedido->SetId_producto($datos["IdProducto"]);
   
    $listaPedido->SetId_rol($idRol[0]["id_rol"]);
    $listaPedido->SetId_estadoPedido(1);
    $listaPedido->SetCodigoMesa($datos["CodigoMesa"]);
    $listaPedido->SetPrecio($precio[0]["Precio"]);

    if(!ListaPedidos::InsertarListaPedido($listaPedido))
    {
    return $resp["status"]=400;
    }

    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $operacion = new Operaciones();
    $operacion -> SetFechaOperacion($dateTime ->format("Y/m/d H:i:s"));
    $operacion -> SetId_rol($idRol[0]["id_rol"]);
    $operacion -> SetId_empleado($empleado->Getid_empleado());  
    Operaciones::InsertarOperacion($operacion);


    return $response->withJson($resp);
}

public function VerPedidos($request,$response,$args)
{
    $arrayConToken = $request->getHeader('token');
    $token=$arrayConToken[0];
    $payload=AutentificadorJWT::ObtenerData($token); 
    $IdRol=Roles::TraerIdRol($payload->perfil);
    $arrayPedidos=ListaPedidos::VerPedidosPendientes($IdRol[0]["Id_rol"]);
    $mesas=array();
    $productos["productos"]=array();
    $productos["mesas"]=array();
    for($i=0;$i<count($arrayPedidos);$i++)
    {
     array_push($productos["productos"],Productos::TraerProducto($arrayPedidos[$i]["Id_producto"]));
     array_push($productos["mesas"],$arrayPedidos[$i]["CodigoMesa"]);
    }
    $respuesta["Pedido"]=array();
  //  $respuesta["Mesa"]=array();

    if($productos["productos"][0][0]["Nombre"]=="")
    {
      array_push($respuesta,"No hay ningun pedido  pendiente");
    }
    else
    {
        for($i=0;$i<count($productos["productos"]);$i++)
        {
          array_push($respuesta["Pedido"],$productos["productos"][$i][0]["Nombre"]);
          array_push($respuesta["Pedido"],$productos["mesas"][$i]);    
        }     
    }

    return $response->withJson($respuesta);
}

public function CambiarEstadoPedido($request,$response,$args)
{
    $datos=$request->getParsedBody();
    $arrayConToken = $request->getHeader('token');
    $token=$arrayConToken[0];
    $payload=AutentificadorJWT::ObtenerData($token); 
    $empleado = Empleado::TraerElEmpleadoPorUsuario($payload->Usuario);

    $IdRol=Roles::TraerIdRol($payload->perfil);
    $pedido= Pedidos::TraerElPedidoPorCodigoMesa($datos["CodigoMesa"]);

    if($IdRol[0]["Id_rol"]==3)
    {
     if($pedido->Tiempo_llegadaMesa=="0000-00-00 00:00:00")
     {     
        $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires')); 
        $pedido->SetTiempo_llegadaMesa($dateTime->format("Y/m/d H:i:s")); 
        Pedidos::ActualizarTiempoLLegadaMesa($pedido->Tiempo_llegadaMesa,$datos["CodigoMesa"]);
     } 
  
    }    

    $resp["status"]=200;
    if(!ListaPedidos::CambiarEstadoPedido($datos["estadoPedido"],$IdRol[0]["Id_rol"],$datos["CodigoMesa"]))
    {
        $resp["status"]=400;
    }

    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $operacion = new Operaciones();
    $operacion -> SetFechaOperacion($dateTime ->format("Y/m/d H:i:s"));
    $operacion -> SetId_rol($IdRol[0]["Id_rol"]);
    $operacion -> SetId_empleado($empleado->Getid_empleado());  
    Operaciones::InsertarOperacion($operacion);

    return $response->withJson($resp);
}

public function TraerImporte($request,$response,$args)
{
$idPedido = $args['id'];
$importe = ListaPedidos::TraerImporte($idPedido);
$hora_ini="";
$hora_fin="";
$Total=0;

for($i = 0; $i < count($importe); $i++)
{

    if($importe[$i]["importe"]== null)
    {
     $resp["status "] = 400;     
     return $response->withJson($resp);
    }
    else
    {
        $Total = $importe[$i]["importe"];
        $hora_ini =$importe[$i]["TiempoInicio"];
        $hora_fin =$importe[$i]["TiempoFin"];
    } 
}

if($Total == 0)
{
    $resp["estadoCuenta"] = "El importe a pagar es 0";   
}
else 
{
    $resp["HoraPedido"]= $hora_ini;
    $resp["HoraLlegada"]= $hora_fin; 
    $resp["Importe"] = $Total;
}

return $response->withJson($resp);

}

public function TraerDatosParaExportarExcel($request, $response, $args)
{

$Pedidos = Pedidos::TraerTodosPedidos(); 


if (count($Pedidos) > 0) {
    $objPHPExcel = new PHPExcel();
    
    //Informacion del excel
    $objPHPExcel->
     getProperties()
         ->setCreator("Federico")
         ->setLastModifiedBy("Federico")
         ->setTitle("ListadoMesas")
         ->setSubject("Ejemplo 1")
         ->setDescription("Documento generado con PHPExcel")
         ->setKeywords("Federico hizo un Excel")
         ->setCategory("Listado de Mesas");

//ESTILOS 

$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 12,
        'name'  => 'Verdana'
    ));

$styleColor = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FF0000')
        )
);

   $styleTextCenter = array(
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );

    $bordes = array(
    'borders' => array(
        'allborders' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
          'color' => array('argb' => 'FF000000'),
        )
    ),
);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("18");
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("25");
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("38");   


$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('HORA INICIO');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('B1')->setValue('HORA FIN');
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('C1')->setValue('IMPORTE');
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($bordes);



for($i=0;$i<count($Pedidos);$i++)
    {
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('A'.($i+2))
      ->applyFromArray($bordes);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('B'.($i+2))
      ->applyFromArray($bordes);
       $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('C'.($i+2))
      ->applyFromArray($bordes);

      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('A'.($i+2))
      ->applyFromArray($styleTextCenter);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('B'.($i+2))
      ->applyFromArray($styleTextCenter);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('C'.($i+2))
      ->applyFromArray($styleTextCenter);

      $arrayFinal[$i] = ListaPedidos::TraerImporte($Pedidos[$i]["Id_pedido"]);
     
      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+2),$arrayFinal[$i][0]["TiempoInicio"])
            ->setCellValue('B'.($i+2),$arrayFinal[$i][0]["TiempoFin"])
            ->setCellValue('C'.($i+2),$arrayFinal[$i][0]["importe"]);       
           
}

$styleArrayFecha = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '008000'),
        'size'  => 10,
        'name'  => 'Verdana'
    ));

$dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
$fecha_creacion = $dateTime->format("Y/m/d h:i A");
$objPHPExcel->getActiveSheet()->getCell('I1')->setValue("Fecha de creación:");
$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArrayFecha);
$objPHPExcel->getActiveSheet()->getCell('I2')->setValue($fecha_creacion);
$objPHPExcel->getActiveSheet()->getStyle('I2')->applyFromArray($styleArrayFecha);

 }
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="listadoEmpleados.xlsx"');
header('Cache-Control: max-age=0');
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');

return $objWriter;
}



public function TraerDatosParaExportarPdf($request, $response, $args)
{

    $Pedidos = Pedidos::TraerTodosPedidos(); 
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 18);
    $pdf->Cell(130, 10, 'Restaurante', 0);
    $pdf->SetFont('Arial', '', 9);
    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $fecha_creacion = $dateTime->format("Y/m/d h:i A");
    $textoFecha = utf8_decode('Fecha de creación: ');
    $pdf->Cell(40, 10, $textoFecha.$fecha_creacion.'', 0);
    $pdf->Ln(15);
    $pdf->SetFont('Times','BIU', 15);
    $pdf->Cell(70, 8, '', 0);
    $pdf->Cell(100, 8, 'LISTADO DE EMPLEADOS', 0);
    $pdf->Ln(23);
    $pdf->SetFont('Arial','B', 6);
    $pdf->SetTextColor(0,0,255);
    $pdf->setFillColor('BLACK'); 
    $pdf->Cell(40, 8, 'FECHA INICIO',1,0,'C',true);
    $pdf->Cell(40, 8, 'FECHA FIN', 1,0,'C',true);
    $pdf->Cell(20,8,'IMPORTE',1,0,'C',true);
    $pdf->Ln(8);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0,0,0);
    
    
    for($i=0;$i<count($Pedidos);$i++)
    {
        $arrayFinal[$i] = ListaPedidos::TraerImporte($Pedidos[$i]["Id_pedido"]);
        $pdf->Cell(40,8,$arrayFinal[$i][0]["TiempoInicio"],1,0,'C');
        $pdf->Cell(40,8,$arrayFinal[$i][0]["TiempoFin"],1,0,'C');
        $pdf->Cell(20,8,$arrayFinal[$i][0]["importe"],1,0,'C');
        $pdf->Ln(8);
    }
    
    ob_end_clean();
    $pdf->Output();
    return $pdf;
}


public function TraerProductoMasVendido($request, $response, $args)
{

    $productos=Productos::TraerTodosLosProductos();
    $mayor=0;
    for($i=0; $i<count($productos);$i++)
    {
      $cantidad= ListaPedidos::TraerCantidadProducto($productos[$i]["id_producto"]);
      if($cantidad>$mayor)
      {
          $resp["Nombre_Producto_mas_vendido"]= $productos[$i]["Nombre"];
          $mayor=$cantidad;
      }    
    }

    return $response->withJson($resp);

}

public function TraerTodosLosProductos($request, $response, $args)
{

    $productos=Productos::TraerTodosLosProductos();
    $resp["productos"] = $productos;

    return $response->withJson($resp);

}

public function TraerTodasLasMesas($request, $response, $args)
{

    $productos=Mesas::TraerTodasLasMesas();
    $resp["mesas"] = $productos;

    return $response->withJson($resp);

}

public function TraerProductoMenosVendido($request, $response, $args)
{

    $productos=Productos::TraerTodosLosProductos();
    $menor=ListaPedidos::TraerCantidadProducto($productos[0]["id_producto"]);

    for($i=0; $i<count($productos);$i++)
    {
      $cantidad= ListaPedidos::TraerCantidadProducto($productos[$i]["id_producto"]);
      if($cantidad<=$menor)
      {
          $resp["Nombre_Producto_Menos_Vendido"]= $productos[$i]["Nombre"];
          $menor=$cantidad;
      }    
    }

    return $response->withJson($resp);

}






}



?>