 <?php
 
 include_once "Producto.php";
 
 $insertarProducto = isset($_POST['cargarProducto']) ? TRUE : FALSE;
if($insertarProducto)
{
          //INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
	$destino = "Archivos/".$_FILES["archivo"]["name"];

	$uploadOk = TRUE;

	$tipoArchivo = pathinfo($destino, PATHINFO_EXTENSION);

	//VERIFICO QUE EL ARCHIVO NO EXISTA
	if (file_exists($destino)) {
		$uploadOk = FALSE;
		echo "El archivo ya existe. Verifique!!!";
	
	}


	//VERIFICO EL TAMA�O MAXIMO QUE PERMITO SUBIR
	if ($_FILES["archivo"]["size"] > 1000000) {
		$uploadOk = FALSE;
		echo  "El archivo es demasiado grande. Verifique!!!";
	
	}


	//OBTIENE EL TAMA�O DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
	//IMAGEN, RETORNA FALSE
	$esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
  
	
	if($esImagen === FALSE) {//NO ES UNA IMAGEN
		$uploadOk = FALSE;
		echo  "S&oacute;lo son permitidas IMAGENES.";
	
	}
	else {// ES UNA IMAGEN

		//SOLO PERMITO CIERTAS EXTENSIONES
		if($tipoArchivo != "jpg" && $tipoArchivo != "jpeg" && $tipoArchivo != "gif"
			&& $tipoArchivo != "png") {
			$uploadOk = FALSE;
			echo  "S&oacute;lo son permitidas imagenes con extensi&oacute;n JPG, JPEG, PNG o GIF.";
			
		}
	}

	
	//VERIFICO SI HUBO ALGUN ERROR, CHEQUEANDO $uploadOk
	if ($uploadOk === FALSE) 
	{

		echo "<br/><br/>NO SE PUDO SUBIR EL ARCHIVO.";

	}
	 else 
{
        $producto = new Producto($_POST['nombre'],$_POST['precio']);
     //var_dump($_SERVER);
        $destino = "./Nueva/".$_POST['nombre'].".".$tipoArchivo; 
        if(!file_exists($destino))
        {
            move_uploaded_file($_FILES['archivo']['tmp_name'], $destino);
            echo 'Se guardó la imagen: '.$_FILES['archivo']['name'];
            $producto->setPathToPhoto($destino);
            Producto::Archivar($producto);
        }
             
}

}

?>