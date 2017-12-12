<?php
include_once "AccesoDatos.php";

class Bicicleta
{
  public $id;
  public $color;
  public $rodado;
  public $marca;
  public $foto;




  public function __construct()
  {

  }

  public static function TraerTodasLasBicicletas()
	{
     $objAcceso = AccesoDatos::DameUnObjetoAcceso();
	 $consulta = $objAcceso->RetornarConsulta("SELECT * from bicicleta");
     $consulta->execute();	
	 return $consulta->fetchAll(PDO::FETCH_CLASS,'Bicicleta');
	}

   public static function InsertarLaBicicleta($bike)
	{
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO bicicleta (color,rodado,marca,foto)" . "VALUES('$bike->color', '$bike->rodado','$bike->marca','$bike->foto')");
        $consulta->execute();		
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

    public static function TraerLaBicicletaPorId($id)
    {
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM bicicleta where id = '$id'");
	$consulta->execute();
	$biciRetorno = $consulta->fetchObject('Bicicleta');
	return $biciRetorno;
    }

    public static function TraerTodasLasBicicletasPorColor($color)
    {
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("SELECT * FROM bicicleta where color = '$color'");
	$consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_CLASS,'Bicicleta');
    }


    public static function BorrarLaBicicleta($id)
    {
    $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();
	$consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM Bicicleta where id = '$id'");
    $consulta->execute();
    return $consulta->rowCount();
    }

    public static function ModificarBicicletaParametros($bicicleta)
    {
            $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
                   $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE Bicicleta SET 
                   color='$bicicleta->color',marca='$bicicleta->marca',
                   rodado='$bicicleta->rodado',foto='$bicicleta->foto'
                   where id='$empleado->id'");
                   return $consulta->execute();
    }


    public static function UltimoInsertado()
    {
        $objetoAccesoDato = AccesoDatos::DameUnObjetoAcceso();	
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    


    public static function VerificarId($foto)
    {
    $retorno = false;
	$arrayBicicletas = Bicicleta::TraerTodasLasBicicletas();
	foreach($arrayBicicletas as $item)
	{
		if($item->foto== $foto)
        {
            $retorno = true;
        }
	}
	return $retorno;
    }




}
?>