<?php

include_once "AccesoDatos.php";

class Usuario
{
 public $id;
 public $mail;
 public $nombre;
 public $clave;
 public $perfil;
 


 	public static function TraerTodosLosUsuarios()
	{
	 $objAcceso = AccesoDatos::DameUnObjetoAcceso();
	 $consulta = $objAcceso->RetornarConsulta("SELECT * FROM usuarios");
	 //UNA VEZ PUESTA LA CONSULTA HAY QUE EJECUTARLA
	 $consulta->execute();
	 //$datos = $consulta->fetchAll();
	 
	 return $consulta->fetchAll(PDO::FETCH_CLASS,'Usuario');
	}

public static function InsertarElUsuarioParametros($user)
	{
$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO usuarios (id, mail,nombre,clave)" . "VALUES('$user->id', '$user->mail','$user->nombre', '$user->clave')");
$consulta->execute();		
//return $objetoAccesoDato->RetornarUltimoIdInsertado();
return $consulta;
	}

public static function BorrarElUsuario($id)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM usuarios where id = '$id'");
	$consulta->execute();
	//return $consulta->rowCount();
   return $consulta;
}

public static function TraerElUsuario($id)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios where id = '$id'");
	$consulta->execute();
	$usuarioRetorno = $consulta->fetchObject('Usuario');
	return $usuarioRetorno;
}

public static function ModificarElUsuario($user)
{
	       $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 		
		   $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE usuario SET mail = '$user->mail', nombre = '$user->nombre', clave = '$user->clave'
		   WHERE id = '$user->id'");
		   return $consulta->execute();
}

public static function VerificarElUsuario($mail,$nombre,$clave)
{

	$retorno = false;
	$arrayUsuarios = Usuario::TraerTodosLosUsuarios();

	foreach($arrayUsuarios as $item)
	{
	
		if($item->mail == $mail && $item->nombre == $nombre && $item->clave == $clave)
	    {
			$retorno = true;
		}
	}
	return $retorno;
}

public static function TraerElUsuarioPorNombre($nombre)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios where nombre = '$nombre'");
	$consulta->execute();
	$usuarioRetorno = $consulta->fetchObject('Usuario');
	return $usuarioRetorno;
}


}
?>