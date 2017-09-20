<?php
   require_once ("Clases/usuario.php");
   require_once ("Clases/conteiner.php");
 
 //INGRESAR EL USUARIO

    $alta = isset($_POST["guardar"]) ? TRUE : FALSE;
    if($alta)
    {
       $user = new Usuario($_POST['nombre'],$_POST['correo'],$_POST['edad'],$_POST['clave']);
       if(!Usuario::Guardar($user))
       {
				$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
				include("mensaje.php");
			}
			else{
				$mensaje = "El archivo fue escrito correctamente. USUARIO agregado CORRECTAMENTE!!!";
				include("mensaje.php");
			}
    }
 
 //VERIFICAR USUARIO

    $verificar = isset($_POST['verificar']) ? TRUE : FALSE;
    if($verificar)
      {
          $correo = $_POST['correo'];
          $clave = $_POST['clave'];
          if(!Usuario::VerificarUsuario($correo,$clave))
          {
            echo "ERROR. EL CORREO Y/O CLAVE NO ESTAN INGRESADOS EN EL ARCHIVO";
          }
          else
          {
              echo "CORERO = OK, CLAVE = OK";
              header("location:Listado.php");
          }
      }
        

   //INSERTAR CONTEINER

      $insertarConteiner = isset($_POST['agregarConteiner']) ? TRUE : FALSE;
      if($insertarConteiner)
{
          //INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
	$destino = "archivos/" . $_FILES["archivo"]["name"];

	$uploadOk = TRUE;

	$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);

	//VERIFICO QUE EL ARCHIVO NO EXISTA
	if (file_exists($destino)) {
		$uploadOk = FALSE;
		$mensaje = "El archivo ya existe. Verifique!!!";
		include("mensaje.php");
	}


	//VERIFICO EL TAMA�O MAXIMO QUE PERMITO SUBIR
	if ($_FILES["archivo"]["size"] > 1000000) {
		$uploadOk = FALSE;
		$mensaje = "El archivo es demasiado grande. Verifique!!!";
		include("mensaje.php");
	}


	//OBTIENE EL TAMA�O DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
	//IMAGEN, RETORNA FALSE
	$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
  
	
	if($esImagen === FALSE) {//NO ES UNA IMAGEN
		$uploadOk = FALSE;
		$mensaje = "S&oacute;lo son permitidas IMAGENES.";
		include("mensaje.php");
	}
	else {// ES UNA IMAGEN

		//SOLO PERMITO CIERTAS EXTENSIONES
		if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
			&& $tipoArchivo != "png") {
			$uploadOk = FALSE;
			$mensaje = "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
			include("mensaje.php");
		}
	}

	
	//VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
	if ($uploadOk === FALSE) 
	{

		echo "<br/><br/>NO SE PUDO SUBIR EL ARCHIVO.";

	}
	 else 
{
        $cont = new Conteiner();
        $cont->SetNumero($_POST['numero']);
        $cont->SetDescripcion($_POST['descripcion']);
        $cont->SetPais($_POST['pais']);
        $cont->SetFoto(basename($_FILES["archivo"]["name"]));
		//MUEVO EL ARCHIVO DEL TEMPORAL AL DESTINO FINAL

		if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $destino))
         {
                Conteiner:: InsertarElConteiner($cont);
				$mensaje = "La base de datos fue escrita correctamente. CONTEINER agregado CORRECTAMENTE!!!";
				include("mensaje.php");
			}
            else {
			$mensaje = "Lamentablemente ocurri&oacute; un error y no se pudo agregar el conteiner.";
			include("mensaje.php");
	}
} 
}

   ?>