<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'autoload.php';
include_once('../clases/EmpleadoApi.php');
include_once('../clases/PedidosApi.php');
include_once('../clases/SesionApi.php');
include_once('../clases/ListaPedidosApi.php');
include_once('../clases/Login.php');
include_once('../clases/AutentificadorJWT.php');
include_once('../clases/MWparaCORS.php');
include_once('../clases/MWparaAutentificar.php');

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

//PUEDE INGRESAR EMPLEADO O ADMINISTRADOR-Administrador

$app->group('/Login', function(){
   $this->post('/ValidarUsuario', \Login::class . ':ValidarUsuario');
   $this->get('/TraerEmpleado/{Usuario}',\Login::class .':TraerEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->post('/CerrarSesion',\Login::class .':CerrarSesion');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/Sesion',function(){
  $this->get('/TraerTodasLasSesiones',\SesionApi::class .':TraerTodasLasSesiones')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/Pedidos',function(){
  $this->post('/ConfirmarPedido',\PedidosApi::class .':ConfirmarPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/CerrarMesa',\PedidosApi::class .':CerrarMesa')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->put('/ModificarElPedido/{id}',\PedidosApi::class .':ModificarElPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodasLasSesiones',\PedidosApi::class .':TraerSesiones')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLosQueSeEntregaron',\PedidosApi::class .':PedidosQueSeEntregaronEnTiempo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/TraerTiempoFaltante',\PedidosApi::class .':TraerTiempoFaltante')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/CambiarEstadoMesa',\PedidosApi::class .':CambiarEstadoMesa')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLosQueSeCancelaron',\PedidosApi::class .':PedidosCancelados')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaMasUsada',\PedidosApi::class .':TraerMesaMasUsada')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaMenosUsada',\PedidosApi::class .':TraerMesaMenosUsada')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaQueMasFacturo',\PedidosApi::class .':TraerMesaQueMasFacturo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaQueMenosFacturo',\PedidosApi::class .':TraerMesaQueMenosFacturo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerFacturaMayorImporte',\PedidosApi::class .':TraerFacturaMayorImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerFacturaMenorImporte',\PedidosApi::class .':TraerFacturaMenorImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosExcel',\PedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosPdf',\PedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/ListaPedidos', function(){
  $this->post('/InsertarPedido',\ListaPedidosApi::class .':InsertarPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/VerPedidos',\ListaPedidosApi::class .':VerPedidos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/CambiarEstadoPedido',\ListaPedidosApi::class .':CambiarEstadoPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/ListadoImporte', \ListaPedidosApi::class .':TraerImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLoMenosVendido',\ListaPedidosApi::class .':TraerProductoMenosVendido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLoMasVendido',\ListaPedidosApi::class .':TraerProductoMasVendido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesExcel',\ListaPedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesPdf',\ListaPedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

//API DE EMPLEADOS - ABM DE EMPLEADOS

$app->group('/Empleado', function(){
   $this->post('/IngresarEmpleado', \EmpleadoApi::class .':IngresarEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/TraerTodosLosEmpleados',\EmpleadoApi::class .':TraerEmpleados')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/TraerElEmpleado/{id}',\EmpleadoApi::class .':TraerElEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->post('/VerEstadoPedidos',\EmpleadoApi::class .':VerEstadoPedidos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosExcel',\EmpleadoApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosPdf',\EmpleadoApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->delete('/BorrarElEmpleado/{id}',\EmpleadoApi::class .':BorrarEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->put('/ModificarElEmpleado/{id}',\EmpleadoApi::class .':ModificarEmpleado');
   $this->put('/SuspenderElEmpleado/{id}',\EmpleadoApi::class .':SuspenderEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->put('/HabilitarElEmpleado/{id}',\EmpleadoApi::class .':HabilitarEmpleado');
   $this->get('/VerSesionesDelEmpleado/{id}',\EmpleadoApi::class .':VerSesionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/VerOperacionesDelEmpleado/{id}',\EmpleadoApi::class .':VerCantidadOperacionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');


  $app->group('/Token',function(){
   $this->post('/DesencriptarToken',\loginApi::class .':DesencriptarToken');
  });


$app->run();
?>