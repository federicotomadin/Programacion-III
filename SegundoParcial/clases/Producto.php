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


public function InsertarElProductoParametros()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into producto (nombre,precio)values('$this->nombre','$this->precio)");      
        $consulta->bindValue(':nombre',$this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->tipo, PDO::PARAM_INT);
        return $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
}



public static function TraerTodosLosProductos()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from producto");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");		
}



public function ModificarProductoParametros()
{
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("
                       update empleado
                       set 
                       nombre=:nombre,
                       precio=:precio,                 
                       WHERE id=:id");
               $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
               $consulta->bindValue(':nombre',$this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':precio',$this->sabor, PDO::PARAM_INT);
               return $consulta->execute();
}



public function BorrarProducto()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from producto WHERE id=:id");	
                       $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
                       $consulta->execute();
                       return $consulta->rowCount();
}

}