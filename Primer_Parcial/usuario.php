<?php
class Usuario
{
private $nombre;
private $correo;
private $edad;
private $clave;

function __construct($nombre,$correo,$edad,$clave)
{
    $this->nombre = $nombre;
    $this->correo = $correo;
    $this->edad = $edad;
    $this->clave = $clave;
}

public function GetNombre()
{
    return $this->nombre;
}

public function GetCorreo()
{
    return $this->correo;
}

public function GetEdad()
{
    return $this->edad;
}

public function Getclave()
{
    return $this->clave;
}


public function SetNombre($valor)
{
    $this->nombre = $valor;
}
public function SetCorreo($valor)
{
    $this->correo = $valor;
}
public function SetEdad($valor)
{
    $this->edad = $valor;
}
public function SetClave($valor)
{
    $this->clave = $valor;
}

public function ToString()
{
    return $this->nombre." - ".$this->correo." - ".$this->edad." - ".$this->clave."\r\n";
}

    public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/usuario.txt", "a");
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}

public static function VerificarUsuario($correo, $clave)
{
        $archivo=fopen("archivos/usuario.txt", "r");
		$retorno = FALSE;
        $miarray = array();
        $acumulador = 0;

		while(!feof($archivo))
		{
            if(($lector = fgets($archivo)) != false)
             {
            $miarray = explode("-",$lector);
            for($i=0;$i<count($miarray);$i++)
            {
              if($miarray[$i] == $correo || $miarray[$i] == $clave)
              {
               $acumulador++;
              }
            }
			
		   }
        }
		fclose($archivo);
       if($acumulador == 2)
        {
            $retorno = TRUE;
        }
        
        return $retorno;
}

public static function TraerTodosLosUsuarios()
	{

		$ListaDeUsuariosLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("archivos/usuario.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$usuarios = explode(" - ", $archAux);
			//http://www.w3schools.com/php/func_string_explode.asp
			$usuarios[0] = trim($usuarios[0]);
			if($usuarios[0] != ""){
				$ListaDeUsuariosLeidos[] = new Usuario($usuarios[0], $usuarios[1],$usuarios[2],$usuarios[3]);
			}
		}
		fclose($archivo);
		
		return $ListaDeUsuariosLeidos;
		
    }
}
?>