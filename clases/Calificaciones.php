<?php
include_once("../bd/AccesoDatos.php");





class Calificaciones
{

    public $Calificacion;


    public function GetCalificacion()
    {
       return $this->Calificacion;
    }
    
    public function SetCalificacion($valor)
    {
        $this->Calificacion=$valor;
    }


public static function TraerPromedioCalificacion($IdEmpleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT avg(calificacion) as calificacion from calificaciones
    where id_empleado = '$IdEmpleado'");
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,"calificaciones");
}
}



?>