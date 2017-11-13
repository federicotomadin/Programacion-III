<?php

class Helado
{

public $id;
public $sabor;
public $tipo;
public $precio;
public $cantidad;
public $pathFoto;


public function __construct()
{
   
}

public static function TraerUnHelado($id) 
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();       
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM helado where id = '$id'");
        $consulta->execute();
        $heladoBuscado= $consulta->fetchObject('Helado');
        return $heladoBuscado;				
       
}

public static function TraerTodosLosHelados()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from helado");
                $consulta->execute();			
                return $consulta->fetchAll(PDO::FETCH_CLASS, "Helado");		
}


public function BorrarHelado()
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("DELETE from helado WHERE id=:id");	
                       $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
                       $consulta->execute();
                       return $consulta->rowCount();
}


public static function BorrarHeladoPorTipo($tipo)
{

               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("
                       delete 
                       from helado				
                       WHERE tipo=:tipo");	
                       $consulta->bindValue(':tipo',$tipo, PDO::PARAM_STR);		
                       $consulta->execute();
                       return $consulta->rowCount();

}




public function InsertarElHelado()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
         $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into helado (sabor,tipo,precio,cantidad,pathFoto)values('$this->sabor','$this->tipo','$this->precio','$this->cantidad','$this->pathFoto)");
         $consulta->execute();
         return $objetoAccesoDato->RetornarUltimoIdInsertado();
                       

}

public function ModificarHeladoParametros()
{
               $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
               $consulta =$objetoAccesoDato->RetornarConsulta("
                       update helado
                       set 
                       sabor=:sabor,
                       tipo=:tipo,                     
                       precio=:precio,
                       cantidad=:cantidad
                       WHERE id=:id");
               $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
               $consulta->bindValue(':sabor',$this->sabor, PDO::PARAM_STR);
               $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
               $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
               $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
               return $consulta->execute();
}

public function InsertarElHeladoParametros()
{
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT into helado (sabor,tipo,precio,cantidad,pathFoto)values('$this->sabor','$this->tipo','$this->precio','$this->cantidad','$this->pathFoto')");
        $consulta->bindValue(':sabor',$this->sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':precio', $this->precio, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad', $this->cantidad, PDO::PARAM_INT);
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
}



public static function TraerUnHeladoTipo($id,$tipo) 
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM helado where id = '$id' AND tipo = '$tipo'");
                $consulta->execute(array($id, $tipo));
                $heladoBuscado= $consulta->fetchObject('Helado');
              return $heladoBuscado;				

                
}


public static function TraerUnHeladoAnioParamTipo($id,$tipo) 
{
                $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta("SELECT  * from helado  WHERE id=:id AND tipo=:tipo");
                $consulta->bindValue(':id', $id, PDO::PARAM_INT);
                $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
                $consulta->execute();
                $heladoBuscado= $consulta->fetchObject('helado');
              return $heladoBuscado;				

                
}





}
?>