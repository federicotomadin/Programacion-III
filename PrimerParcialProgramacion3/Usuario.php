<?php
class Usuario
{
private $_nombre;
private $_mail;
private $_edad;
private $_clave;
private $_perfil;
private $_comentario;
private $_titulo;
private $_pathFoto;
public static $_listaUsuarios=array();
public static $_listaComentarios=array();

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

public function GetComentario()
{
    return $this->_comentario;
}

public function GetTitulo()
{
    return $this->_titulo;
}

public function GetPathFoto()
{
    return $this->_pathFoto;
}


public function SetPerfil()
{
    return $this->_perfil;
}
public function SetNombre($nombre)
{
    $this->_nombre = $nombre;
}
public function SetMail($mail)
{
    $this->_mail = $mail;
}
public function SetEdad($edad)
{
    $this->_edad = $edad;
}
public function SetClave($clave)
{
    $this->_clave = $clave;
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

    if($acumuladorCorreo==0 && $acumuladorClave==0)
    {
        echo "Ingreso mal el mail y la clave";
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
            $miarray = explode("-",$lector);
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
    $ar = fopen("Archivos/comentarios.txt", "w");
    
    //ESCRIBO EN EL ARCHIVO
    fwrite($ar,$mail."-".$titulo."-".$comentario);

    //CIERRO EL ARCHIVO
    fclose($ar);
    
}

else {
         echo "El mail no esta ingresado en el archivo";
 }

   }

   public static function AltaComentarioConFoto($mail,$titulo,$comentario,$foto)
   {
    
    $cadena=$titulo.".".pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
    $destino = "imagenesDeComentario/$cadena";
  

    move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
     
   }


   public static function LeerArchivoUsuarios()
   {
       $archivo = fopen('Archivos/usuarios.txt',"r");
       $bandera=false;
     
       while(!feof($archivo))
       {
          
           $aux = fgets($archivo);
           if($aux == "") continue; 
           $cadena = explode("-",$aux);
          
          
           array_push(Usuario::$_listaUsuarios,new Usuario($cadena[0],$cadena[1],$cadena[2],$cadena[3],$cadena[4]));
           //var_dump(Producto::$_lista);

   }
   fclose($archivo);
   
}


public static function LeerArchivoComentarios()
{
    $archivo = fopen('Archivos/comentarios.txt',"r");
    $bandera=false;
    $numeroDeLinead;
    while(!feof($archivo))
    {
       
        $aux = fgets($archivo);
        if($aux == "") continue; 
        $cadena = explode("-",$aux);
       
       
        array_push(Usuario::$_listaComentarios,$cadena[0]);
        array_push(Usuario::$_listaComentarios,$cadena[1]);
        array_push(Usuario::$_listaComentarios,$cadena[2]);
        //var_dump(Producto::$_lista);

}
fclose($archivo);

}

   public static function BuscarUsuario($usuario)
    {
        
    Usuario::LeerArchivoUsuarios(); 
       for($i=0;$i<count(Usuario::$_listaUsuarios);$i++)
       {
           if(Usuario::$_listaUsuarios[$i]->GetNombre()==$usuario)
           {
             return $i;
           }       
         }
  
         return -1;
    }//cierra la funcion

    public static function BuscarTitulo($titulo)
    {
        Usuario::LeerArchivoComentarios();

        for($i=0;$i<count(Usuario::$_listaComentarios);$i++)
        {
            if(Usuario::$_listaComentarios[$i]==$titulo)
            {
              return $i;
            }
           
  
          }
          return -1;
    }//cierra la funcion
        

    public static function BorrarUsuario($nombre)
    {
     
        if(Producto::BuscarUsuario($nombre)==-1)
        {
         
           return false;
        }
       unset(Usuario::$_lista[Usuario::BuscarUsuario($nombre)]);//paso el array con el indice.
       return true;
    
    }

    public static function ModificarUsuario($nombre,$mail,$edad,$perfil,$clave)
    {
        $indice=Usuario::BuscarUsuario($nombre);

    

        if($indice<>-1)
        {
        Usuario::$_listaUsuarios[$indice]->SetNombre($nombre);
        Usuario::$_listaUsuarios[$indice]->SetMail($mail);
        Usuario::$_listaUsuarios[$indice]->SetEdad($edad); 
        Usuario::$_listaUsuarios[$indice]->SetPerfil($perfil);
        Usuario::$_listaUsuarios[$indice]->SetClave($clave);
    
    
        Usuario::ArchivarLista();


    }

    else 
    {
        echo "El usuario ya esta cargado";
    }
}

    public static function ArchivarLista()
    {
      
        $archivo = fopen('Archivos/usuarios.txt',"w");
        $str="";
        foreach(Usuario::$_listaUsuarios as $item)
        {
            
            $str.=$item->ToString(); 
        }
        fwrite($archivo,$str);         
        fclose($archivo);  
    
    }








}