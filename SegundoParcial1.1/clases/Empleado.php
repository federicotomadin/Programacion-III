<?php

class Empleado
{

public $id;
public $nombre;
public $apellido;
public $email;
public $legajo;
public $clave;
public $perfil;
public $foto;


public function __construct()
{
   
}


public static function TraerUnEmpleado($id) 
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();       
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM empleado where id = '$id'");
        $consulta->execute();
        $heladoBuscado= $consulta->fetchObject('Empleado');
        return $heladoBuscado;				
       
}

public static function TraerTodosLosEmpleados()
{
      
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from empleado");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "Empleado");		
}

public static function ModificarElEmpleado($empleado)
{
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE empleado set  nombre = '$empleado->nombre' ,apellido = '$empleado->apellido' ,email = '$empleado->email' , legajo = '$empleado->legajo', clave = '$empleado->clave', perfil = '$empleado->perfil',foto ='$empleado->foto' where id = '$empleado->id'");
    return $consulta->execute();
}



public function InsertarElEmpleado()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
         $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,apellido,legajo,email,clave,perfil,foto)values('$this->nombre','$this->apellido','$this->legajo','$this->email','$this->clave','$this->perfil','$this->foto')");
         $consulta->execute();
         return $objetoAccesoDato->RetornarUltimoIdInsertado();
                       
}


public function BorrarEmpleado($id)
{
         $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
         $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from empleado WHERE '$id'=id");	
        $consulta->execute();
        return $consulta->rowCount();
}





}


