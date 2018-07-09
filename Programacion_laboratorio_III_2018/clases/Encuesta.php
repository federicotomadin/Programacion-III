<?php
include_once("../bd/AccesoDatos.php");


class Encuesta
{
public $IdEncuesta;
public $Mesa;
public $Restaurante;
public $Mozo;
public $Cocinero;

public static function TraerEncuesta()
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT * from encuesta");
    $consulta->execute();
    return $consulta->etchAll(PDO::FETCH_CLASS,"encuesta");
}




?>