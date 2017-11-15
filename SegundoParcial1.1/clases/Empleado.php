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

public function ModificarEmpleadoParametros()
{
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("
                       update empleado
                       set 
                       nombre=:nombre,
                       apellido=:apellido,                                            
                       legajo=:legajo,
                       email=:email,
                       clave=:clave,
                       perfil=:perfil,
                       foto=:foto,
                       WHERE id=:id");
               $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
               $consulta->bindValue(':nombre',$this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':apellido', $this->tipo, PDO::PARAM_STR);             
               $consulta->bindValue(':legajo', $this->tipo, PDO::PARAM_INT);
               $consulta->bindValue(':email', $this->tipo, PDO::PARAM_STR);
               $consulta->bindValue(':clave', $this->precio, PDO::PARAM_STR);
               $consulta->bindValue(':perfil', $this->cantidad, PDO::PARAM_STR);
               $consulta->bindValue(':foto', $this->tipo, PDO::PARAM_STR);
               return $consulta->execute();
}

public function InsertarElEmpleado()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
         $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,apellido,legajo,email,clave,perfil,foto)values('$this->nombre','$this->apellido','$this->legajo','$this->email','$this->clave','$this->perfil','$this->foto')");
         $consulta->execute();
         return $objetoAccesoDato->RetornarUltimoIdInsertado();
                       
}

/*
public function BorrarEmpleado()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from empleado WHERE id=:id");	
                       $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
                       $consulta->execute();
                       return $consulta->rowCount();
}






public function InsertarElEmpleadoParametros()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into empleado (nombre,apellido,legajo,email,clave,perfil,foto)values('$this->nombre','$this->apellido','$this->legajo','$this->email','$this->clave','$this->perfil','$this->foto')");      
        $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':legajo', $this->legajo, PDO::PARAM_INT);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':perfil', $this->perfil, PDO::PARAM_STR);
        $consulta->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        return $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
}*/




}


