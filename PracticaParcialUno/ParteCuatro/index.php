<?php



include_once "Producto.php";


Producto::LeerArchivo();



if(isset($_POST["queDeboHacer"]))
{




    if($_POST["queDeboHacer"]=="borrar")
    {

    Producto::BorrarProducto($_GET["nombre"]);


    Producto::ArchivarLista(Producto::$_lista);

    }
}





?>