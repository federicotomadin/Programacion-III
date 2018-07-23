<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'autoload.php';
//include_once('../clases/operacion_entradaApi.php');
include_once('../clases/EmpleadoApi.php');
include_once('../clases/PedidosApi.php');
include_once('../clases/ListaPedidosApi.php');
//include_once('../clases/autoApi.php');
include_once('../clases/Login.php');
//include_once('../clases/operacion_salidaApi.php');
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
  $this->get('/TraerTodasLasSesiones',\Sesion::class .':TraerSesiones');//->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/Pedidos',function(){
  $this->get('/TraerTodasLasSesiones',\PedidosApi::class .':TraerSesiones')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosExcel',\PedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosPedidosPdf',\PedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesExcel',\ListaPedidosApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodosLosImportesPdf',\ListaPedidosApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


//API DE EMPLEADOS - ABM DE EMPLEADOS

$app->group('/Empleado', function(){
   $this->post('/IngresarEmpleado', \EmpleadoApi::class .':IngresarEmpleado');
   $this->get('/TraerTodosLosEmpleados',\EmpleadoApi::class .':TraerEmpleados')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/TraerElEmpleado/{id}',\EmpleadoApi::class .':TraerElEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosExcel',\EmpleadoApi::class .':TraerDatosParaExportarExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarEmpleadosPdf',\EmpleadoApi::class .':TraerDatosParaExportarPdf')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

   $this->delete('/BorrarElEmpleado/{id}',\EmpleadoApi::class .':BorrarEmpleado');
   $this->put('/ModificarElEmpleado/{id}',\EmpleadoApi::class .':ModificarEmpleado');
   $this->put('/SuspenderElEmpleado/{id}',\EmpleadoApi::class .':SuspenderEmpleado');
   $this->put('/HabilitarElEmpleado/{id}',\EmpleadoApi::class .':HabilitarEmpleado');
   $this->post('/PonerMarcaDeAguaElEmpleado/{id}',\EmpleadoApi::class .':PonerMarcaDeAgua');
   $this->get('/VerSesionesDelEmpleado/{id}',\EmpleadoApi::class .':VerSesionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/VerOperacionesDelEmpleado/{id}',\EmpleadoApi::class .':VerCantidadOperacionesEmpleado')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   //ARCHIVOS IMAGENES
   $this->get('/MostrarFotosMarcadas',\empleadoApi::class .':MostrarFotosMarcadas')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/CambiarTamanio/{id}',\empleadoApi::class .':CambiarTamanio')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/MostrarFotosCambiadas',\empleadoApi::class .':MostrarFotosCambiadas')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   //ARCHIVOS PDF Y EXCEL
   $this->get('/DescargarExcel',\empleadoApi::class .':DescargarListaEmpleadosExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->get('/DescargarPDF',\empleadoApi::class .':DescargarListaEmpleadosPDF')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   // GET PARA LA VISTA ESTACIONAR DE EMPLEADOS
   $this->get('/TraerLosEmpleadosCocherasAutos',\empleadoApi::class .':TraerEmpleadosCocherasAutos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');

$app->group('/ListaPedidos', function(){
  $this->get('/ListadoImporte/{id}', \ListaPedidosApi::class .':TraerImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/Pedidos', function(){
  $this->get('/TraerPedidos', \PedidosApi::class .':TraerTodosLosPedidos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerImporte', \ListaPedidosApi::class .':TraerImporte')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodasLasCocherasLibres', \cocheraApi::class .':TraerLibres')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerTodasLasCocherasConPrioridad', \cocheraApi::class .':TraerDiscapacitadas')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->get('/TraerLaCochera/{id}',\cocheraApi::class .':TraerCochera')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  $this->post('/TraerCocheraMasUtilizada',\cocheraApi::class .':TraerMasUtilizada');
  $this->post('/TraerCocheraMenosUtilizada',\cocheraApi::class .':TraerMenosUtilizada');
  $this->post('/TraerCocheraSinUso',\cocheraApi::class .':TraerSinUso');
  $this->post('/VerUsoDeCocherasSinPrioridad',\cocheraApi::class .':VerUsoDeCocherasSinPrioridad');
  $this->post('/VerUsoDeCocherasParaDiscapacitados',\cocheraApi::class .':VerUsoDeCocherasParaDiscapacitados');
})->add(\MWparaCORS::class . ':HabilitarCORS8080');


$app->group('/Auto', function(){
   $this->get('/TraerTodosLosAutos',\autoApi::class .':TraerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->post('/InsertarAuto',\autoApi::class .':InsertarAuto');
   $this->delete('/BorrarElAuto/{id}',\autoApi::class .':BorrarAuto');
   $this->get('/TraerElAuto/{id}',\autoApi::class .':TraerUnAuto')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
   $this->put('/ModificarElAuto/{id}',\autoApi::class .':ModificarAuto');
   //ARCHIVOS PDF Y EXCEL
   $this->get('/DescargarExcel',\autoApi::class .':DescargarListaAutosExcel')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
    $this->get('/DescargarPDF',\autoApi::class .':DescargarListaAutosPDF')->add(\MWparaCORS::class . ':HabilitarCORSTodos');
  })->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarCORS8080');


  $app->group('/Token',function(){
   $this->post('/DesencriptarToken',\loginApi::class .':DesencriptarToken');
  });


$app->run();
?>