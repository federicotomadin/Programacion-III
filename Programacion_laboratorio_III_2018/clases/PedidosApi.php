<?php

require_once("Pedidos.php");
require_once("ListaPedidos.php");
require_once("AutentificadorJWT.php");
require_once("Mesas.php");
require_once("Roles.php");
require_once("Operaciones.php");
require_once("EstadoCuentaPedidos.php");
require_once("Empleado.php");
require_once("EstadoPedidos.php");
include_once("../bd/AccesoDatos.php");
include_once("../phpExcel/Classes/PHPExcel.php");
include_once('../fpdf/fpdf.php');
// include composer autoload
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class PedidosApi
{

public function ConfirmarPedido($request,$response,$args)
{
    $datos=$request->getParsedBody();

    $pedido=new Pedidos();

    $resp["status"] = 200;
    $arrayConToken = $request->getHeader('token');
    $token=$arrayConToken[0];
    $payload=AutentificadorJWT::ObtenerData($token); 
    $empleado=Empleado::TraerElEmpleadoPorUsuario($payload->Usuario);

    if($payload->perfil!="Mozo")
    {
        $resp["status"]="Operacion valida solo para Mozos";
        return $response->withJson($resp);
    }
    $pedido->SetUsuario($empleado->Usuario);
    $pedido->SetCodigoMesa($datos["CodigoMesa"]);
    $pedido->SetEstadoCuenta("En Preparacion");
    $pedido->SetImporte(Null);

    if(ListaPedidos::BuscarPedidoCocina($datos["CodigoMesa"]))
    {
    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $pedido->SetTiempo_ingreso($dateTime->format("Y/m/d H:i:s"));
    $dateTime->add(new DateInterval('PT' . intval($datos["AgregarMinutos"]) . 'M'));
    $fecha_estimada = $dateTime->format("Y/m/d H:i:s");
    $pedido->SetTiempo_estimado($fecha_estimada);
    }

    $idPedidoFoto = Pedidos::TraerElUltimoAgregado();
    $idPedidoFoto+=1;
    $destino = "../fotosPedidos/";

    $urlImagen = $destino.$idPedidoFoto.$datos["CodigoMesa"]."."."png";
    file_put_contents($urlImagen, base64_decode($datos["foto"]));
    
    PedidosApi::redimensionarImagen($urlImagen
    ,"../fotosPedidosCambiadas/".$idPedidoFoto.$datos["CodigoMesa"]."."."png"
    ,100,40,$jpgQuality=100);
    $pedido->SetFoto("../fotosPedidosCambiadas/".$idPedidoFoto.$datos["CodigoMesa"]."."."png");

    if(!Pedidos::InsertarElPedido($pedido))
    {
       $resp["status"] = 400;
    }

    if($resp["status"]==200)
    {
        $IdPedido=Pedidos::TraerElUltimoAgregado();
        ListaPedidos::IntertarIdPedido($datos["CodigoMesa"],$IdPedido);
    }

    return $response->withJson($resp);  
}

public function CerrarMesa($request,$response,$args)
{
    $codigoMesa=$args["CodigoMesa"];

    $resp["status"] = 200;
    $arrayConToken = $request->getHeader('token');
    $token=$arrayConToken[0];
    $payload=AutentificadorJWT::ObtenerData($token); 
    $empleado=Empleado::TraerElEmpleadoPorUsuario($payload->Usuario);
    
    if($payload->perfil!="Socio")
    {
        $resp["status"]="Operacion valida solo para Socios";
        return $response->withJson($resp);
    }

    $resp["status"]=200;
    $pedido=Pedidos::TraerElPedidoPorCodigoMesa($codigoMesa);

   /* if($pedido->Tiempo_ingreso!="0000-00-00 00:00:00")
    {     
    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires')); 
    $pedido->SetTiempo_llegadaMesa($dateTime->format("Y/m/d H:i:s"));
    Pedidos::ActualizarTiempoLLegadaMesa($pedido->Tiempo_llegadaMesa,$codigoMesa["CodigoMesa"]);
    }*/
    
    $importe=ListaPedidos::TraerImportePedido($pedido->Id_pedido,$codigoMesa);

    if(!Pedidos::CerrarMesa($codigoMesa,$importe[0]["Importe"]))
    {
        $resp["status"]=400;
    }

    return $response->withJson($resp);   
}


public function ModificarElPedido($request,$response,$args)
{
$idPedido = $args['id'];
$resp["status"] = 200;
$datos = $request->getParsedBody();
$pedido = Pedidos::TraerElPedido($idPedido);
$pedido->SetTiempo_ingreso($datos['Tiempo_ingreso']);
$pedido->SetTiempo_estimado($datos['Tiempo_estimado']);
$pedido->SetTiempo_llegadaMesa($datos['Tiempo_llegadaMesa']);
$pedido->SetId_mesa($datos['Id_mesa']);
$pedido->SetId_estadoCuenta($datos['Id_estadoCuenta']);
$pedido->SetId_empleado($datos['Id_empleado']);
$pedido->SetCodigo($datos['Codigo']);
$pedido->SetId_estadoPedido($datos['Id_estadoPedido']);
$pedido->SetImporte($datos['Importe']);

if(!Pedidos::ModificarPedido($pedido))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);

}

public function TraerTodosLosPedidos($request,$response,$args)
{
$pedidos = Pedidos::TraerTodosPedidos();
$resp["pedidos"] = $pedidos;
return  $response->withJson($resp);
}


public function ListadoConImporte($request,$response,$args)
{
    $pedidos = Pedidos::TraerTodosPedidos();
    $resp["Hora_inicio"] = $pedidos;
}

public function TraerDatosParaExportarExcel()
{

$arrayPedidos = Pedidos::TraerTodosPedidos();

if (count($arrayPedidos) > 0) {
    $objPHPExcel = new PHPExcel();
    
    //Informacion del excel
    $objPHPExcel->
     getProperties()
         ->setCreator("Federico")
         ->setLastModifiedBy("Federico")
         ->setTitle("ListaPedidos")
         ->setSubject("Ejemplo 1")
         ->setDescription("Documento generado con PHPExcel")
         ->setKeywords("Federico hizo un Excel")
         ->setCategory("Pedidos");

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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("26");
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("26");
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("32");   
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("26");
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("25");
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("30");   
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth("26");


$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('TIEMPO INGRESO');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('B1')->setValue('TIEMPO ESTIMADO');
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('C1')->setValue('TIEMPO LLEGADA');
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('D1')->setValue('ESTADO DE CUENTA');
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('E1')->setValue('EMPLEADO');
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('F1')->setValue('CODIGOMESA');
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('G1')->setValue('IMPORTE');
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($bordes);


for($i=0;$i<count($arrayPedidos);$i++)
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
      ->getStyle('D'.($i+2))
      ->applyFromArray($bordes);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('E'.($i+2))
      ->applyFromArray($bordes);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('F'.($i+2))
      ->applyFromArray($bordes);
       $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('G'.($i+2))
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
      $objPHPExcel->setActiveSheetIndex(0)
     ->getStyle('D'.($i+2))
      ->applyFromArray($styleTextCenter);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('E'.($i+2))
      ->applyFromArray($styleTextCenter);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('F'.($i+2))
      ->applyFromArray($styleTextCenter);
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('G'.($i+2))
      ->applyFromArray($styleTextCenter);

    $empleado=Empleado::TraerElEmpleado($arrayPedidos[$i] -> Id_empleado);    
    $estadoCuenta= EstadoCuentaPedidos::TraerCuentaPedidos($arrayPedidos[$i] -> Id_estadoCuenta);

      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+2),$arrayPedidos[$i]-> Tiempo_ingreso)
            ->setCellValue('B'.($i+2),$arrayPedidos[$i]-> Tiempo_estimado)
            ->setCellValue('C'.($i+2),$arrayPedidos[$i]-> Tiempo_llegadaMesa)
            ->setCellValue('D'.($i+2),$estadoCuenta[0]["Descripcion"])
            ->setCellValue('E'.($i+2),$empleado[0]["Usuario"])
            ->setCellValue('F'.($i+2),$arrayPedidos[$i]-> CodigoMesa)
            ->setCellValue('G'.($i+2),$arrayPedidos[$i]-> Importe);                 
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
$arrayPedidos = Pedidos::TraerTodosPedidos();

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 18);
$pdf->SetLeftMargin(0);
$pdf->SetRightMargin(0);
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
$pdf->Cell(40, 8,'Tiempo_ingreso',1,0,'C',true);
$pdf->Cell(40, 8,'Tiempo_estimado', 1,0,'C',true);
$pdf->Cell(40,8,'Tiempo_llegadaMesa',1,0,'C',true);
$pdf->Cell(30, 8,'estadoCuenta',1,0,'C',true);
$pdf->Cell(20, 8,'Id_empleado', 1,0,'C',true);
$pdf->Cell(13,8,'CodigoMesa',1,0,'C',true);
$pdf->Cell(25, 8,'Importe', 1,0,'C',true);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);



for($i=0;$i<count($arrayPedidos);$i++)
{
    $empleado=Empleado::TraerElEmpleado($arrayPedidos[$i]-> Id_empleado);    
    $estadoCuenta= EstadoCuentaPedidos::TraerCuentaPedidos($arrayPedidos[$i]-> Id_estadoCuenta);

    $pdf->Cell(40,8,$arrayPedidos[$i]-> Tiempo_ingreso,1,0,'C');
    $pdf->Cell(40,8,$arrayPedidos[$i]-> Tiempo_esttimado,1,0,'C');
    $pdf->Cell(40,8,$arrayPedidos[$i]-> Tiempo_llegadaMesa,1,0,'C');
    $pdf->Cell(30,8,$estadoCuenta[0]["Descripcion"],1,0,'C');
    $pdf->Cell(20,8,$empleado[0]["Usuario"],1,0,'C');
    $pdf->Cell(13,8,$arrayPedidos[$i]-> CodigoMesa,1,0,'C');
    $pdf->Cell(25,8,$arrayPedidos[$i]-> Importe,1,0,'C');
    $pdf->Ln(8);
}

ob_end_clean();
$pdf->Output();
return $pdf;
}


public function PedidosQueSeEntregaronEnTiempo($request, $response, $args)
{
    $array= Pedidos::TraerTodosPedidosQueSeEntregaron();

    for($i=0; $i<count($array);$i++)
    {
        $tiempoInicio= strtotime($array[$i]->GetTiempo_ingreso());
        $tiempoEstimado= strtotime($array[$i]->GetTiempo_estimado());
        $tiempoLlegada= strtotime($array[$i]->GetTiempo_llegadaMesa());

        $tiempoFinal = $tiempoLlegada - $tiempoEstimado;

        if($tiempoFinal < 0 )
        {
            $arrayFinal[$i] = $array[$i];
        }
    }

    if($arrayFinal == null)
    {
        $resp["Pedidos"] = "No hay pedidos fuera de termino";
        return $response->withJson($resp);
    }
    else
    {
        return $response->withJson($arrayFinal);
    }

}

public function PedidosCancelados($request, $response, $args)
{
    $array= ListaPedidos::TraerTodosLosPedidos();

    for($i=0; $i<count($array);$i++)
    {
        if($array[$i]["Id_estadoPedido"]==3)
        {
            $arrayFinal[$i]=$array[$i];
        }
    }
    if($arrayFinal==null)
    {
        return $response->withJson($resp);
    }
    else
    {
        return $response->withJson($arrayFinal);
    }
}

public function TraerMesaMasUsada($request, $response, $args)
{
   $arrayMesas= Mesas::TraerMesas();
   $mayor=0;
 
   for($i=0; $i<count($arrayMesas);$i++)
   {
       $cantidad = Pedidos::TraerCantidadMesas($arrayMesas[$i]["CodigoMesa"]);
       if($cantidad >= $mayor)
       {               
          $CodigoMesa = $arrayMesas[$i]["CodigoMesa"];   
          $mayor=$cantidad;  
       }   
   
   }  
    $resp["IdMesa"] =  $CodigoMesa;
    $resp["Cantidad"] = $mayor[0]["Cantidad"];

    return $response->withJson($resp);
}

public function TraerMesaMenosUsada($request, $response, $args)
{
   $arrayMesas= Mesas::TraerMesas();
   $menor=1;

   for($i=0; $i<count($arrayMesas);$i++)
   {
       $cantidad = Pedidos::TraerCantidadMesas($arrayMesas[$i]["CodigoMesa"]);
       $variable=$cantidad[$i]["Cantidad"];
   
       if($variable < $menor)
       {         
          $CodigoMesa = $arrayMesas[$i]["CodigoMesa"];  
          $menor=$cantidad[$i]["Cantidad"];  
       }   
   
   }
  
    $resp["CodigoMesa"] =  $CodigoMesa;
    $resp["Cantidad"] = $menor;

    return $response->withJson($resp);
}


public function TraerMesaQueMasFacturo($request, $response, $args)
{
    $arrayMesas= Mesas::TraerMesas();
    $importeMayor=0;

    for($i=0; $i<count($arrayMesas);$i++)
    {
        $aux = Pedidos::TraerTotalFacturado($arrayMesas[$i]["CodigoMesa"]);

        if($aux[0]["Importe"] >= $importeMayor)
       {
          $importeMayor = $aux[0]["Importe"];       
          $CodigoMesa = $arrayMesas[$i]["CodigoMesa"];   
       }   
   
    }

    $resp["Mesa"] =  $importeMayor;
    $resp["Importe"] =  $CodigoMesa;

    return $response->withJson($resp);
   
}


public function TraerMesaQueMenosFacturo($request, $response, $args)
{
    $arrayMesas= Mesas::TraerMesas();
    $importeMayor=50000;

    for($i=0; $i<count($arrayMesas);$i++)
    {    
        $aux = Pedidos::TraerTotalFacturado($arrayMesas[$i]["CodigoMesa"]);    

            if($aux[0]["Importe"] < $importeMayor)
            {       
                $importeMayor=$aux[0]["Importe"];  
                $CodigoMesa = $arrayMesas[$i]["CodigoMesa"];      
            }          
          
    }  
    $resp["Mesa"] = $CodigoMesa;
    $resp["Importe"] =   $importeMayor;

    return $response->withJson($resp);   
}


public function TraerFacturaMayorImporte($request, $response, $args)
{
    $pedidos=Pedidos::TraerTodosPedidos();
    $arrayMesas= Mesas::TraerMesas();
    $pedidoMayor=0;
    $importeMayor=0;

    for($i=0; $i<count($pedidos);$i++)
    {
     if($pedidos[$i]-> GetImporte()>= $importeMayor)
     {
         $importeMayor=$pedidos[$i]->GetImporte();
         $CodigoMesa=$pedidos[$i]->GetCodigoMesa();
     }
    }

    $resp["Importe"] = $importeMayor;
    $resp["Mesa"]= $CodigoMesa;

    return $response->withJson($resp);
}


public function TraerFacturaMenorImporte($request, $response, $args)
{
    $pedidos=Pedidos::TraerTodosPedidos();
    $arrayMesas= Mesas::TraerMesas();
   
    $importeMenor=50000;

    for($i=0; $i<count($pedidos);$i++)
    {       
        if($pedidos[$i]->GetImporte()<= $importeMenor)
        {
            $importeMenor=$pedidos[$i]->GetImporte();
            $resp["factura Menor"]=$pedidos[$i]->GetImporte();
            $resp["mesa"] = $pedidos[$i]->GetCodigoMesa();        
        }        
    }
   
    return $response->withJson($resp);
}


public function TraerTiempoFaltante($request, $response, $args)
{
    $data = $request->getParsedBody();
   
    $arrayTiempo=Pedidos::TraerTiempoFaltante($data["CodigoMesa"]);

    if($arrayTiempo == null)
    {
        $resp["Tiempo Faltante"] =  "El pedido fue entregado porque la mesa ya esta cerrada";
        return $response->withJson($resp);
    }
    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $fecha_ingreso = $dateTime->format("Y/m/d H:i:s");
    $tiempoActual= strtotime($fecha_ingreso);
    $tiempoEstimado=strtotime($arrayTiempo[0]["Tiempo_estimado"]);
    $tiempoFaltante =  $tiempoEstimado - $tiempoActual; 

    $time = date("i:s",$tiempoFaltante);
    $resp["Tiempo Faltante"] =  $time;
    
    return $response->withJson($resp);
}

public function CambiarTamanio($id)
{
    $empleado = Empleado::TraerElEmpleado($id);
        if($empleado == false)
            {
            $resp["status"] = 400;
            }
        else
        {
        $fotosPedidos = '../fotosPedidos/';
    if(file_exists($fotosPedidos.$empleado->GetFoto()))
    {
    $infoFoto = pathinfo("../fotosPedidos/".$empleado->GetFoto());
    // open an image file
    $img = Image::make($fotosPedidos.$empleado->GetFoto());

    // now you are able to resize the instance
    $img->resize(3000 , 2000);

    //finally we save the image as a new file
    $img->save($fotosPedidos.'FotosCambiadasDeTamanio/'.$infoFoto["basename"]);
    $resp["status"] = 200;
    }
    else
    {
        $resp["status"] = 400;
    }
}
return $response->withJson($resp);
}

function redimensionarImagen($origin,$destino,$newWidth,$newHeight,$jpgQuality=100)
{
    // getimagesize devuelve un array con: anchura,altura,tipo,cadena de 
    // texto con el valor correcto height="yyy" width="xxx"
    $datos=getimagesize($origin);
 
    // comprobamos que la imagen sea superior a los tamaños de la nueva imagen
    if($datos[0]>$newWidth || $datos[1]>$newHeight)
    {
 
        // creamos una nueva imagen desde el original dependiendo del tipo
        if($datos[2]==1)
            $img=imagecreatefromgif($origin);
        if($datos[2]==2)
            $img=imagecreatefromjpeg($origin);
        if($datos[2]==3)
            $img=imagecreatefrompng($origin);
 
        // Redimensionamos proporcionalmente
        if(rad2deg(atan($datos[0]/$datos[1]))>rad2deg(atan($newWidth/$newHeight)))
        {
            $anchura=$newWidth;
            $altura=round(($datos[1]*$newWidth)/$datos[0]);
        }else{
            $altura=$newHeight;
            $anchura=round(($datos[0]*$newHeight)/$datos[1]);
        }
 
        // creamos la imagen nueva
        $newImage = imagecreatetruecolor($anchura,$altura);
 
        // redimensiona la imagen original copiandola en la imagen
        imagecopyresampled($newImage, $img, 0, 0, 0, 0, $anchura, $altura, $datos[0], $datos[1]);
 
        // guardar la nueva imagen redimensionada donde indicia $destino
        if($datos[2]==1)
            imagegif($newImage,$destino);
        if($datos[2]==2)
            imagejpeg($newImage,$destino,$jpgQuality);
        if($datos[2]==3)
            imagepng($newImage,$destino);
 
        // eliminamos la imagen temporal
        imagedestroy($newImage);
 
        return true;
    }
    return false;
}


}

?>