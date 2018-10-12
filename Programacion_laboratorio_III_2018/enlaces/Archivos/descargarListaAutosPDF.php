<?php

include_once('../../bd/AccesoDatos.php');
include_once('../../clases/Pedidos.php');
include_once('../../clases/ListaPedidos.php');

include_once('../../clases/Mesas.php');
include_once('../../clases/Roles.php');
include_once('../../clases/Operaciones.php');
include_once('../../clases/EstadoCuentaPedidos.php');
include_once('../../clases/Empleado.php');
include_once('../../clases/EstadoPedidos.php');
include_once('../../fpdf/fpdf.php');



    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from pedidos");
    $consulta->execute();
    $arrayPedidos = $consulta->fetchAll(PDO::FETCH_CLASS,"pedidos");


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

?>