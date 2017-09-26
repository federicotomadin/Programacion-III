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
public $_listaUsuarios=array();
public $_listaComentarios=array();

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
    
    $cadena=$titulo.".".pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
    $destino = "imagenesDeComentario/$cadena";
  

    move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino);
     
   }


   public static function LeerArchivoUsuarios()
   {
       $archivo = fopen('Archivos/usuarios.txt',"r");
       $bandera=false;
       $numeroDeLinead;
       while(!feof($archivo))
       {
          
           $aux = fgets($archivo);
           if($aux == "") continue; 
           $cadena = explode("-",$aux);
          
          
           array_push(Producto::$_listaUsuarios,new Producto($cadena[0],$cadena[1],$cadena[2],$cadena[3],$cadena[4]));
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
       
       
        array_push(Producto::$_listaComentarios,new Producto($cadena[0],$cadena[1],$cadena[2]));
        //var_dump(Producto::$_lista);

}
fclose($archivo);

}

   public static function BuscarUsuario($usuario)
    {
        Usuario::LeerArchivoComentarios();
        Usuario::LeerArchivoUsuarios();
        
       for($i=0;$i<count(Usuario::$_listaUsuarios);$i++)
       {
           if(Producto::$_listaUsuarios[$i]->GetNombre()==$usuario)
           {
             return $i;
           }
 
         }
         return -1;
    }//cierra la funcion

    public static function BuscarTitulo($titulo)
    {
        for($i=0;$i<count(Usuario::$_listaComentarios);$i++)
        {
            if(Producto::$_listaComentarios[$i]->GetTitulo()==$titulo)
            {
              return $i;
            }
  
          }
          return -1;
    }//cierra la funcion
        
 public static function DevolverUsuario($usuario)
 {
     $itemUsuario=Usuario::BuscarUsuario($usuario);
     $itemComentario=Usuario::BuscarTitulo($usuario->GetTitulo());
     if($itemUsuario<>-1 && $itemComentario<>-1)
     {
        echo "<table class='table'>
		<thead>
			<tr>
				<th>  IMAGEN DEL COMENTARIO </th>
				<th>  TITULO    </th>
				<th>  USUARIO       </th>
                <th>  EDAD      </th>
			</tr> 
		</thead>";   	

         echo " 	<tr>
         <td>".$_listaUsuarios->GetNombre()."</td>
         <td>".$_listaUsuarios->GetEdad()."</td>
         <td>".$_listaComentarios->GetComentario()."</td>
         <td>".$_listaComentarios->GetFoto()."</td>
     </tr>";
         echo "</table>";		
     }

 }









}