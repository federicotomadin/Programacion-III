<?php

/*   
poseee dos atributos pirvados implemnete interface ivendible con el metodo precio mas iva
y tiene un metodo que se llama retornar array de productos qeu retorna un array con cinco productos


*/


class Producto  implements iVendible
{
    private $_nombre;

    private $_precio;

    private $_arrayProductos=array();


    public function __construct($nombre,$precio)
    {
    
       $this->_nombre=$nombre;
       $this->_precio=$precio;
    }

    public static function PrecioMasIva($producto)
    {
        return $producto->_precio * 0.21;
    
    }

    public function Cargar($producto)
    {
        array_push($this->_arrayProductos,$producto);
      
    }
    
    
    public static function RetornaListado($productos)
    {       
      foreach($productos->_arrayProductos as $item)
      {
        echo "<br>";
         echo "nombre ".$item->_nombre."<br>";
         echo "Precio ".Producto::PrecioMasIva($item)."<br>";

      }

    }

}

 interface iVendible
{
   static function PrecioMasIva($producto);
}


?>