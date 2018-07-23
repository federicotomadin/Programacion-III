<?php
require_once("Pedidos.php");
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

public function TraerTodosLosPedidos($request,$response,$args)
{
$pedidos = Pedidos::TraerTodosPedidos();
var_dump($pedidos);
die();

$resp["pedidos"] = $pedidos;
$response = $response->withJson($resp);
return $response;
}


public function ListadoConImporte($request,$response,$args)
{
    $pedidos = Pedidos::TraerTodosPedidos();
    $resp["Hora_inicio"] = $pedidos;

}

public function TraerDatosParaExportarExcel($request, $response, $args)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth("18");
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("26");
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("25");
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth("30");   
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth("26");


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

$objPHPExcel->getActiveSheet()->getCell('D1')->setValue('MESA');
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('E1')->setValue('ESTADO DE CUENTA');
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('F1')->setValue('EMPLEADO');
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('G1')->setValue('CODIGO');
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($bordes);

$objPHPExcel->getActiveSheet()->getCell('H1')->setValue('ESTADO PEDIDO');
$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleColor);
$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleTextCenter);
$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($bordes);


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
      ->getStyle('H'.($i+2))
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
      $objPHPExcel->setActiveSheetIndex(0)
      ->getStyle('H'.($i+2))
      ->applyFromArray($styleTextCenter);

    $empleado=Empleado::TraerElEmpleado($arrayPedidos[$i]["Id_empleado"]);    
    $estadoCuenta= EstadoCuentaPedidos::TraerCuentaPedidos($arrayPedidos[$i]["Id_estadoCuenta"]);
    $estadoPedido= EstadoPedidos::TraerEstadoPedidos($arrayPedidos[$i]["Id_estadoPedido"]);

      $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.($i+2), $arrayPedidos[$i]["Tiempo_ingreso"])
            ->setCellValue('B'.($i+2),$arrayPedidos[$i]["Tiempo_estimado"])
            ->setCellValue('C'.($i+2),$arrayPedidos[$i]["Tiempo_llegadaMesa"])
            ->setCellValue('D'.($i+2),$arrayPedidos[$i]["Id_mesa"])
            ->setCellValue('E'.($i+2),$estadoCuenta[0]["Descripcion"])
            ->setCellValue('F'.($i+2),$empleado[0]["Usuario"])
            ->setCellValue('G'.($i+2),$arrayPedidos[$i]["codigo"])
            ->setCellValue('H'.($i+2),$estadoPedido[0]["Descripcion"]);                
         
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
$pdf->Cell(10, 8,'Id_mesa',1,0,'C',true);
$pdf->Cell(25, 8,'EstadoCuenta', 1,0,'C',true);
$pdf->Cell(20,8,'Usuario',1,0,'C',true);
$pdf->Cell(13, 8,'Codigo', 1,0,'C',true);
$pdf->Cell(25, 8,'EstadoPedido', 1,0,'C',true);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0,0,0);



for($i=0;$i<count($arrayPedidos);$i++)
{
    $empleado=Empleado::TraerElEmpleado($arrayPedidos[$i]["Id_empleado"]);    
    $estadoCuenta= EstadoCuentaPedidos::TraerCuentaPedidos($arrayPedidos[$i]["Id_estadoCuenta"]);
    $estadoPedido= EstadoPedidos::TraerEstadoPedidos($arrayPedidos[$i]["Id_estadoPedido"]);
    $pdf->Cell(40,8,$arrayPedidos[$i]["Tiempo_ingreso"],1,0,'C');
    $pdf->Cell(40,8,$arrayPedidos[$i]["Tiempo_estimado"],1,0,'C');
    $pdf->Cell(40,8,$arrayPedidos[$i]["Tiempo_llegadaMesa"],1,0,'C');
    $pdf->Cell(10,8,$arrayPedidos[$i]["Id_mesa"],1,0,'C');
    $pdf->Cell(30,8,$estadoCuenta[0]["Descripcion"],1,0,'C');
    $pdf->Cell(20,8,$empleado[0]["Usuario"],1,0,'C');
    $pdf->Cell(13,8,$arrayPedidos[$i]["codigo"],1,0,'C');
    $pdf->Cell(25,8,$estadoPedido[0]["Descripcion"],1,0,'C');
    $pdf->Ln(8);
}

ob_end_clean();
$pdf->Output();
return $pdf;
}


}

?>