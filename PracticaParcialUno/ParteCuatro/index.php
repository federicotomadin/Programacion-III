<?php

include_once "Producto.php";


Producto::LeerArchivo();



if(isset($_GET["nombre"])){

    if(isset($_POST["queDeboHacer"]))
{




    
    {if($_POST["queDeboHacer"]=="borrar")

    Producto::BorrarProducto($_GET["nombre"]);
    

    Producto::ArchivarLista(Producto::$_lista);

    }

}

}

if(Producto::ModificarProducto("yogur59","yogur1"))
{
    echo "el archivo fue modificado exitosamente";
}

else {
    
    echo "El archivo no pudo modificarse";

}



?>