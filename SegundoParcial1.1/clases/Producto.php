<?php

class Producto
{

public $id;
public $nombre;
public $precio;



public function __construct()
{
   
}

public static function TraerUnProducto($id) 
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();       
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM producto where id = '$id'");
        $consulta->execute();
        $heladoBuscado= $consulta->fetchObject('Producto');
        return $heladoBuscado;				
       
}


public function InsertarElProducto()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
         $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (nombre,precio)values('$this->nombre','$this->precio')");
         $consulta->execute();
         return $objetoAccesoDato->RetornarUltimoIdInsertado();
                       
}



public static function TraerTodosLosProductos()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from producto");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");		
}



public function ModificarProductoParametros($producto)
{
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE producto set nombre='$producto->nombre',precio='$producto->precio' where id='$producto->id'");                  
               return $consulta->execute();
}



public function BorrarProducto($id)
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from producto WHERE id='$id'");	
                       $consulta->execute();
                       return $consulta->rowCount();
}

}