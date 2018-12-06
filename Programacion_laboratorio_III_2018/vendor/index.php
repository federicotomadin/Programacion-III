<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'autoload.php';
include_once('../clases/EmpleadoApi.php');
include_once('../clases/PedidosApi.php');
include_once('../clases/SesionApi.php');
include_once('../clases/ProductosApi.php');
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
   $this->get('/TraerSesiones',\Login::class .':TraerSesiones')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/Pedidos',function(){
  $this->post('/ConfirmarPedido',\PedidosApi::class .':ConfirmarPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/CerrarMesa/{CodigoMesa}',\PedidosApi::class .':CerrarMesa')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->put('/ModificarElPedido/{id}',\PedidosApi::class .':ModificarElPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLosQueSeEntregaron',\PedidosApi::class .':PedidosQueSeEntregaronEnTiempo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/TraerTiempoFaltante',\PedidosApi::class .':TraerTiempoFaltante')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLosQueSeCancelaron',\PedidosApi::class .':PedidosCancelados')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaMasUsada',\PedidosApi::class .':TraerMesaMasUsada')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaMenosUsada',\PedidosApi::class .':TraerMesaMenosUsada')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaQueMasFacturo',\PedidosApi::class .':TraerMesaQueMasFacturo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerMesaQueMenosFacturo',\PedidosApi::class .':TraerMesaQueMenosFacturo')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerFacturaMayorImporte',\PedidosApi::class .':TraerFacturaMayorImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerFacturaMenorImporte',\PedidosApi::class .':TraerFacturaMenorImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidos',\PedidosApi::class .':TraerTodosLosPedidos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosExcel',\PedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosPdf',\PedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/ListaPedidos', function(){
  $this->post('/InsertarPedido',\ListaPedidosApi::class .':InsertarPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosProductos',\ListaPedidosApi::class .':TraerTodosLosProductos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodasLasMesas',\ListaPedidosApi::class .':TraerTodasLasMesas')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/VerPedidos',\ListaPedidosApi::class .':VerPedidos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/CambiarEstadoPedido',\ListaPedidosApi::class .':CambiarEstadoPedido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/ListadoImporte/{id}', \ListaPedidosApi::class .':TraerImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLoMenosVendido',\ListaPedidosApi::class .':TraerProductoMenosVendido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLoMasVendido',\ListaPedidosApi::class .':TraerProductoMasVendido')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesExcel',\ListaPedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesPdf',\ListaPedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');

//API DE EMPLEADOS - ABM DE EMPLEADOS

$app->group('/Empleado', function(){
   $this->post('/IngresarEmpleado', \EmpleadoApi::class .':IngresarEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/TraerTodosLosEmpleados',\EmpleadoApi::class .':TraerEmpleados')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosExcel',\EmpleadoApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosPdf',\EmpleadoApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->delete('/BorrarElEmpleado/{id}',\EmpleadoApi::class .':BorrarEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->put('/ModificarElEmpleado/{id}',\EmpleadoApi::class .':ModificarEmpleado');
   $this->post('/SuspenderElEmpleado/{id}',\EmpleadoApi::class .':SuspenderEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->post('/HabilitarElEmpleado/{id}',\EmpleadoApi::class .':HabilitarEmpleado');
   $this->get('/VerSesionesDelEmpleado/{id}',\EmpleadoApi::class .':VerSesionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/VerOperacionesDelEmpleado/{id}',\EmpleadoApi::class .':VerCantidadOperacionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/Productos', function(){
  $this->get('/TraerTodosLosProductos', \ProductosApi::class .':TraerTodosLosProductos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/ModificarProducto/{id}', \ProductosApi::class .':ModificarProducto')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerProducto/{id}', \ProductosApi::class .':TraerProducto')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->delete('/BorrarProducto/{id}', \ProductosApi::class .':BorrarProducto')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/InsertarProducto', \ProductosApi::class .':InsertarProducto')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->run();
?>