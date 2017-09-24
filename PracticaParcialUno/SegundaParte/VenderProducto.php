<?php

include_once 'Producto.php';



/*   
recibe por get nombre de producto y cantidad hace llamada a mètodos y retorna el precio total a pagar


*/

$producto1=new Producto($_GET['nombre'],$_GET['precio']);
$producto2=new Producto($_GET['nombre'],$_GET['precio']);

$producto1->Cargar($producto1);
$producto1->Cargar($producto2);

echo Producto::PrecioMasIva($producto1);



Producto::RetornaListado($producto1);




?>