
<?php

/*
borrar productos: si recibo un nombre por get, retorna si el producto esta en la lista
si lo recibe por post con el parámetro "que debo hacer"=="borrar" se debe borrar
al producto y mover la foto al sub directorio produtos borrados 
con el nombre formado por el producto y la fecha de borrado 


otro archivo
modificar producto, recibe nombre, mail, clave, y sexo, de un cliente, busca por mail
 y si existen los datos se guardan los nuevos datos ingresados y la foto se guarda con el nuevo nombre

  */


include_once "Producto.php";

$borrarProducto= isset($_GET['nombre']) ? TRUE : FALSE;
if($borrarProducto)
{  
 $nombre=$_GET['nombre'];


    if(Producto::BuscarProducto($nombre))
    {
        
        Producto::BorrarProducto($_GET['nombre']);
      
        echo "Producto borrado exitosamente";
    }
    echo "El producto no esta en el listado";


}

?>