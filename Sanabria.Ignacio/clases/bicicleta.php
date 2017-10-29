<?php
include_once("../bd/AccesoDatos.php");

class Bicicleta
{
  public $id;
  public $color;
  public $rodado;
  public $marca;

  public function GetId()
  {
  return $this->id;
  }

  public function SetId($valor)
  {
   $this->id = $valor;
  }

  public function GetColor()
  {
      return $this->color;
  }

  public function SetColor($valor)
  {
      $this->color = $valor;
  }

  public function GetRodado()
  {
      return $this->rodado;
  }

  public function SetRodado($valor)
  {
      $this->rodado = $valor;
  }

  public function GetMarca()
  {
      return $this->marca;
  }

  public function SetMarca($valor)
  {
      $this->marca = $valor;
  }


  public function __construct()
  {

  }


  public static function TraerTodasLasBicicletas()
	{
	 $objAcceso = AccesoDatos::DameUnObjetoAcceso();
	 $consulta = $objAcceso->RetornarConsulta("SELECT id AS id, color AS color, rodado AS rodado , marca AS marca FROM bicicleta");
	 $consulta->execute();	 
	 return $consulta->fetchAll(PDO::FETCH_CLASS,'bicicleta');
	}

   public static function InsertarLaBicicletaParametros($bike)
	{
$objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
$consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO bicicleta (color,rodado,marca)" . "VALUES('$bike->color', '$bike->rodado','$bike->marca')");
$consulta->execute();		
return $consulta;
	}

    public static function TraerLaBicicletaPorId($id)
    {
     $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM bicicleta where id = '$id'");
	$consulta->execute();
	$biciRetorno = $consulta->fetchObject('bicicleta');
	return $biciRetorno;
    }

    public static function TraerTodasLasBicicletasPorColor($color)
    {
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM bicicleta where color = '$color'");
	$consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'bicicleta');
    }


    public static function BorrarLaBicicleta($id)
    {
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM bicicleta where id = '$id'");
	return $consulta->execute();
    }


    public static function VerificarId($id)
    {
    $retorno = false;
	$arrayBicicletas = Bicicleta::TraerTodasLasBicicletas();
	foreach($arrayBicicletas as $bike)
	{
		if($bike->GetId() == $id)
        {
            $retorno = true;
        }
	}
	return $retorno;
    }




}
?>