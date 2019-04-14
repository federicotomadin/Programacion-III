<?php
require_once("Empleado.php");
require_once("Roles.php");
require_once("Pedidos.php");
include_once("../bd/AccesoDatos.php");
require_once("Operaciones.php");
include_once("../phpExcel/Classes/PHPExcel.php");
include_once('../fpdf/fpdf.php');
// include composer autoload
require 'autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class EmpleadoApi
{
public function IngresarEmpleado($request,$response,$args)
{
$data = $request->getParsedBody();

if(!Empleado::VerificarEmpleado($data["Usuario"],$data["Clave"]))
{

$empleado = new Empleado();
$resp["status"] = 200;
if($data["Nombre"]=="" || $data["Apellido"]=="" || $data["Usuario"]=="" || $data["Clave"]=="" || $data["Sueldo"]=="")
{
   $resp["status"] = 402;
   return $response->withJson($resp);
}
$empleado->SetNombre($data["Nombre"]);
$empleado->SetApellido($data["Apellido"]);
$empleado->SetUsuario($data["Usuario"]);
$empleado->SetClave($data["Clave"]);

if(!Roles::TraerIdRol($data["Rol"]))
{
$resp["status"]=400;  
}
$rol=Roles::TraerIdRol($data["Rol"]);
$empleado->SetId_rol($rol[0]["Id_rol"]);

$empleado->SetSueldo($data["Sueldo"]);
$empleado->SetHabilitado($data["Habilitado"]);

if(!Empleado::InsertarElEmpleado($empleado))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}
}

public function TraerCantidadOperacionesPorFecha($request, $response, $args)
{
    $data = $request->getParsedBody();
    
    $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
    $fechaActual = $dateTime->format("Y-m-d");
    
    $fecha =  new DateTime($data["Fecha"], new DateTimeZone('America/Argentina/Buenos_Aires'));
    $fechaIngresada = $fecha->format("Y-m-d");
    
    $resp["status"]=200;
    if(!$operaciones = Operaciones::TraerCantidadOperacionesPorFecha($data["IdEmpleado"],$fechaIngresada, $fechaActual))
    {
        $resp["status"] = 400;
    }

    $resp["cantidadOperaciones"]= $operaciones[0]["cantidadOperaciones"];  
    return $response->withJson($resp);
}

public function TraerEmpleados($request, $response, $args)
{
$arrayEmpleados = Empleado::TraerTodosLosEmpleados();
$resp["empleados"] = $arrayEmpleados;
return $response->withJson($resp);
}

public function TraerEmpleadosMenosSocios($request, $response, $args)
{
$arrayEmpleados = Empleado::TraerTodosLosEmpleadosMenosSocios();
$resp["empleados"] = $arrayEmpleados;
return $response->withJson($resp);
}

public function TraerMozos($request, $response, $args)
{
$arrayMozos = Empleado::TraerMozos();
$resp["mozos"] = $arrayMozos;
return $response->withJson($resp);
}

public function TraerElEmpleado($request, $response, $args)
{
$Usuario = $args['Usuario'];
$empleado = Empleado::TraerElEmpleadoPorUsuario($Usuario);
if($empleado == false)
{
    $resp["status"] = 400;
    $response = $response->withJson($resp);
}
else
{
$password = str_repeat("*", strlen($empleado->clave));
$empleado->clave = $password;
$response = $response->withJson($empleado);
}
return $response;
}


public function BorrarEmpleado($request, $response, $args)
{
$id = $args['id'];
$id = intval($id);
$resp["status"] = 200;
if(!Empleado::BorrarElEmpleado($id))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}

public function ModificarEmpleado($request,$response,$args)
{
$id = $args['id'];
$id = intval($id);
$resp["status"] = 200;
$data = $request->getParsedBody();
$empleado = Empleado::TraerElEmpleado($id);
$empleado->SetNombre($data["Nombre"]);
$empleado->SetApellido($data["Apellido"]);
$empleado->SetUsuario($data["Usuario"]);
$empleado->SetClave($data["Clave"]);
$empleado->SetId_rol($data["Id_rol"]);
$empleado->SetSueldo($data["Sueldo"]);
$empleado->SetHabilitado("si");


if(!Empleado::ModificarElEmpleado($empleado))
{
    $resp["status"] = 400;
}
return $response->withJson($resp);
}


public function SuspenderEmpleado($request,$response,$args)
{  
    $resp["status"] = 200;
    $id = $args['id'];
    $id = intval($id);
    $empleado = Empleado::TraerElEmpleado($id);
    if($empleado == false)
    {
        $resp["status"] = 400;
    }
    else
    {
    if(!Empleado::SuspenderEmpleado($empleado[0]["id_empleado"]))
    {
        $resp["status"] = 400;
    }
    }
    return $response->withJson($resp);
}

public function HabilitarEmpleado($request,$response,$args)
{
    $resp["status"] = 200;
    $id = $args['id'];
    $id = intval($id);
    $empleado = Empleado::TraerElEmpleado($id);

    if($empleado == false)
    {
        $resp["status"] = 400;
    }
    else
    {
    if(!Empleado::HabilitarEmpleado($empleado[0]["id_empleado"]))
    {
        $resp["status"] = 400;
    }
    }
    return $response->withJson($resp);
}


public function VerSesionesEmpleado($request, $response, $args)
{
$id = $args['id'];
$id = intval($id);
$empleado = Empleado::TraerElEmpleado($id);
if($empleado == false)
{
    $resp["status "] = 400;
}
else
{
    $sesiones = Empleado::TraerFechasDeSesionesPorIdEmpleado($empleado[0]["id_empleado"]);
    $password = str_repeat("*", strlen($empleado[0]["Clave"]));
    $empleado[0]["Clave"] = $password;
    $resp["empleado"] = $empleado;
    $resp["sesiones"] = $sesiones;
}
return $response->withJson($resp);
}


public function VerCantidadOperacionesEmpleado($request, $response, $args)
{
$id = $args['id'];
$resp["status"] = 200;
$id = intval($id);
$empleado = Empleado::TraerElEmpleado($id);
if($empleado == false)
{
    $resp["status "] = 400;
}
else
{
    $password = str_repeat("*", strlen($empleado[0]["Clave"]));
    $empleado[0]["Clave"] = $password;

    $operacionesEntrada = Empleado::TraerOperacionesEntradaPorIdEmpleado($empleado[0]["id_empleado"]); 
    $resp["empleado"] = $empleado[0];
    if(count($operacionesEntrada) == 0)
    {
        $operacionesEntrada = "EL EMPLEADO NO TIENE OPERACIONES DE ENTRADA";
    }
    $resp["empleado"] = $empleado;
    $resp["operacionesEntrada"] = count($operacionesEntrada);

}
return $response->withJson($resp);
}


public function TraerDatosParaExportarExcel($request, $response, $args)
{

$arrayEmpleados = Empleado::TraerDatosParaExportar();
//$fechaSesion = TraerFechasDeSesionesPorIdEmpleado($IdEmpleado);

if (count($arrayEmpleados) > 0) {
    $objPHPExcel = new PHPExcel();
    
    //Informacion del excel
    $objPHPExcel->
     getProperties()
         ->setCreator("Federico")
         ->setLastModifiedBy("Federico")
         ->setTitle("ListaEmpleados")
         ->setSubject("Ejemplo 1")
         ->setDescription("Documento generado con PHPExcel")
         ->setKeywords("Federico hizo un Excel")
         ->setCategory("Empleados");

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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("18");


$objPHPExcel->getActiveSheet()->getCell('A1')->setValue('USUARIO');
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('B1')->setValue('FECHA_LOGUEO');
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('C1')->setValue('CANTIDAD_OPERACIONES');
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('D1')->setValue('HABILITADO');
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($bordes);


for($i=0;$i<count($arrayEmpleados);$i++)
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

     
    $cantOperaciones=Empleado::TraerOperacionesEntradaPorIdEmpleado($arrayEmpleados[$i]["IdEmpleado"]);


      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+2), $arrayEmpleados[$i]["Usuario"])
            ->setCellValue('B'.($i+2),$arrayEmpleados[$i]["FechaIngreso"])
            ->setCellValue('C'.($i+2),count($cantOperaciones))
            ->setCellValue('D'.($i+2),$arrayEmpleados[$i]["habilitado"]);
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

$arrayEmpleados = Empleado::TraerDatosParaExportar();
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
$pdf->Cell(18, 8, 'USUARIO',1,0,'C',true);
$pdf->Cell(40, 8, 'FECHA_LOGUEO', 1,0,'C',true);
$pdf->Cell(30,8,'CANTIDAD DE OPERACIONES',1,0,'C',true);
$pdf->Cell(60, 8, 'HABILITADO', 1,0,'C',true);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);


for($i=0;$i<count($arrayEmpleados);$i++)
{
    $cantOperaciones=Operaciones::TraerOperacionesPorEmpleado($arrayEmpleados[$i]["IdEmpleado"]);
    $pdf->Cell(18,8,$arrayEmpleados[$i]["Usuario"],1,0,'C');
    $pdf->Cell(40,8,$arrayEmpleados[$i]["FechaIngreso"],1,0,'C');
    $pdf->Cell(30,8,$cantOperaciones[0]["CantidadOperaciones"],1,0,'C');
    $pdf->Cell(60,8,$arrayEmpleados[$i]["habilitado"],1,0,'C');
    $pdf->Ln(8);
}

ob_end_clean();
$pdf->Output();
return $pdf;
}


public function VerCantidadOperacionesListadaPorEmpleado($request, $response, $args)
{

$arrayEmpleados = Empleado::TraerTodosLosEmpleados();

if($arrayEmpleados == false)
{
    $resp["status "] = 400;
}
else
{
for($i = 0; $i < count($arrayEmpleados); $i++)
{
    $password = str_repeat("*", strlen($arrayEmpleados[$i]->Clave));
    $arrayEmpleados[$i]->Clave = $password;
    $operacionesEntrada = Empleado::TraerOperacionesEntradaPorIdEmpleado($arrayEmpleados[$i]->id_empleado);
    $cantidadOperacionesEntrada = count($operacionesEntrada);
    if($cantidadOperacionesEntrada == 0)
    {
        $operacionesEntrada = "EL EMPLEADO  NO TIENE OPERACIONES DE ENTRADA";
    }
    $resp["empleado"] += $empleado;
    $resp["operacionesEntrada"] += $operacionesEntrada;
    $resp["cantidadOperacionesEntrada"] += $cantidadOperacionesEntrada;
}

   
}
return $response->withJson($resp);
}


public function VerCantidadOperacionesListadaPorRoles($request, $response, $args)
{

$roles = Roles::TraerRoles();

if($roles == false)
{
    $resp["status "] = 400;
}
else
{
for($i = 0; $i < count($roles); $i++)
{

    $operaciones = Empleado::TraerOperacionesPorSector($roles[$i]->Id_rol);
    $cantidadOperaciones = count($operaciones);
    if($cantidadOperaciones == 0)
    {
        $operaciones = "EL ROL   NO TIENE OPERACIONES ";
    }
    $resp["rol"] += $roles[$i]->Descripcion;
    $resp["operaciones"] += $operaciones;
    $resp["cantidadOperaciones"] += $cantidadOperaciones;
}

   
}
return $response->withJson($resp);
}

public function VerEstadoPedidos($request, $response, $args)
{
    $data = $request->getParsedBody();
    $empleado=Empleado::TraerElEmpleadoPorUsuario($data["Usuario"]);
    $pedidos = Pedidos::VerPedidosPendientes($empleado->id_empleado);
    

   $resp["Pedidos Pendientes"]=$pedidos;
    
    
    return $response->withJson($resp);

}








}


?>