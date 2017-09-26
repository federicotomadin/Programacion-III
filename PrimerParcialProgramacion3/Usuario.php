<?php
class Usuario
{
private $_nombre;
private $_mail;
private $_edad;
private $_clave;
private $_perfil;

function __construct($nombre,$mail,$edad,$perfil,$clave)
{
    $this->_nombre = $nombre;
    $this->_mail = $mail;
    $this->_edad = $edad;
    $this->_perfil=$perfil;
    $this->_clave = $clave;
 
}

public function GetNombre()
{
    return $this->_nombre;
}
public function GetMail()
{
    return $this->_mail;
}
public function GetEdad()
{
    return $this->_edad;
}
public function GetClave()
{
    return $this->_clave;
}

public function GetPerfil()
{
    return $this->_perfil;
}


public function SetPerfil()
{
    return $this->_perfil;
}
public function SetNombre($nombre)
{
    $this->_nombre = $nombre;
}
public function SetEmail($email)
{
    $this->correo = $email;
}
public function SetEdad($edad)
{
    $this->edad = $edad;
}
public function SetClave($clave)
{
    $this->clave = $clave;
}

public function ToString()
{
    return $this->GetNombre()."-".$this->GetMail()."-".$this->GetEdad()."-".$this->GetPerfil()."-".$this->GetClave()."\r\n";
}


    public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("Archivos/usuarios.txt", "a");
		
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
    
public static function VerificarUsuario($correo,$clave)
{
        $acumuladorCorreo=0;
        $acumuladorClave=0;
        $archivo=fopen("Archivos/usuarios.txt", "r");
		$retorno = FALSE;
        $miarray = array();
		while(!feof($archivo))
		{
            if(($lector = fgets($archivo)) != false)
             {
            $miarray = explode("-",$lector);
            for($i=0;$i<count($miarray);$i++)
            {
              
              if($miarray[$i] == $correo)
              {
              $acumuladorCorreo+=1;
              }
              if($miarray[$i] == $clave)
              {             
              $acumuladorClave+=1;
              }          
             
            }
        }

            
    if($acumuladorCorreo==1 && $acumuladorClave==1)
    {
        echo "BIENVENIDO";
    }
    if($acumuladorCorreo==1 && $acumuladorClave==0)
    {
        echo "Esta ingresando mal la clave";
    }
    if($acumuladorCorreo==0 && $acumuladorClave==1)
    {
        echo "Esta ingresando mal el email";
    }
}
    fclose($archivo);   

}


public static function VerificarMail($correo)
{
        $archivo=fopen("Archivos/usuarios.txt", "r");
		$retorno = FALSE;
        $miarray = array();
        $acumulador = 0;
		while(!feof($archivo))
		{
            if(($lector = fgets($archivo)) != false)
             {
            $miarray = explode(" - ",$lector);
            for($i=0;$i<count($miarray);$i++)
            {
              if($miarray[$i] == $correo)
              {
               $acumulador++;
              }
            }
			
		   }
        }
		fclose($archivo);
       if($acumulador == 1)
        {
            $retorno = TRUE;
        }
        
        return $retorno;

}


public static function AltaComent($mail,$titulo,$comentario)
{
   if(Usuario::VerificarMail($mail))
   {
    $ar = fopen("Archivos/comentarios.txt", "a");
    
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar,$mail." - ".$titulo." - ".$comentario);

    //CIERRO EL ARCHIVO
    fclose($ar);
    
}

else {
         echo "El mail no esta ingresado en el archivo";
 }

   }

   public static function AltaComentarioConFoto($mail,$titulo,$comentario,$foto)
   {
    
    $destino = "imagenesDeComentario/$titulo";
    $extension=pathinfo($destino, PATHINFO_EXTENSION);
    

    $destino = "imagenesDeComentario/$titulo".$extension;

    move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
     
    

   }







}