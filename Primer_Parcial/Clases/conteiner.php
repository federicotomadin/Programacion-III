<?php
require("AccesoDatos.php");

class Conteiner
{
public $numero;
public $descripcion;
public $pais;
public $foto;




public function __construct()
{
    
}

public function GetNumero()
{
    return $this->numero;
}

public function GetDescripcion()
{
    return $this->descripcion;
}

public function GetPais()
{
    return $this->pais;
}

public function GetFoto()
{
    return $this->foto;
}


public function SetNumero($valor)
{
    $this->numero = $valor;
}
public function SetDescripcion($valor)
{
    $this->descripcion = $valor;
}
public function SetPais($valor)
{
    $this->pais = $valor;
}
public function SetFoto($valor)
{
    $this->foto = $valor;
}

public function ToString()
{
    return $this->numero." - ".$this->descripcion." - ".$this->pais." - ".$this->foto."\r\n";
}


public static function bd()
{
    $objAcceso = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objAcceso->RetornarConsulta("SELECT numero , descripcion , pais , foto FROM conteiner");
	 //UNA VEZ PUESTA LA CONSULTA HAY QUE EJECUTARLA
	$consulta->execute();
	 //$datos = $consulta->fetchAll();
	$datos = $consulta->setFetchMode(PDO::FETCH_INTO, new Conteiner);
	 return $consulta;
}

public static function InsertarElConteiner($cont)
{
 $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO conteiner (numero,descripcion, pais, foto)" . "VALUES('$cont->numero', '$cont->descripcion',
'$cont->pais','$cont->foto')");
$consulta->execute();		
//return $objetoAccesoDato->RetornarUltimoIdInsertado();
return $consulta;
}

public static function BorrarElConteiner($numero)
{
	$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM conteiner where numero = '$numero'");
	$consulta->execute();
   return $consulta;
}

}
?>