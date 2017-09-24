<?php

/*   
poseee dos atributos pirvados implemnete interface ivendible con el metodo precio mas iva
y tiene un metodo que se llama retornar array de productos qeu retorna un array con cinco productos


*/
class Producto  implements iVendible
{
    private $_nombre;

    private $_precio;

    private $_pathPhoto;

    public function __construct($nombre,$precio)
    {
        $this->_nombre = $nombre;
        $this->_precio = $precio;
       
    }

    #para foto

    public function setPathToPhoto($path)
    {
        $this->_pathPhoto = $path;
    }

    public function getPathPhoto()
    {
        return $this->_pathPhoto;
    }

    public function getNombre()
    {
        return $this->_nombre;
    }

    public static function BuscarProducto($nombre)
    {
        $archivo = fopen('Archivos/Productos.txt',"r");
        $bandera=false;
        while(!feof($archivo))
        {
           
            $aux = fgets($archivo);
            $cadena = explode(" - ",$aux);
            if($cadena[0] == $nombre)
            {
                $bandera= true;
            }
        }
        
        fclose($archivo);
        return $bandera;
         
    }

    public static function BorrarProducto($nombre)
    {
        $archivo = fopen('Archivos/Productos.txt',"a");
        $nuevo=array();

        while(!feof($archivo))
        {
            $aux = fgets($archivo);
            $cadena = explode(" - ",$aux);
            if($cadena[0] != $nombre)
            {
                array_push($nuevo,$cadena[0]);
            }
        }
        fclose($archivo);

        foreach($nuevo as $item)
        {
            Producto::Archivar($item);
        }
       
    }

   public static function Archivar($producto)
    {   
        $archivo = fopen('Archivos/Productos.txt',"a");
        fwrite($archivo,$producto->RetornarDetalles()."\r\n");         
        fclose($archivo);
    }

    public function RetornarDetalles()
    {
        return $this->getNombre().' - '.$this->getPathPhoto();
    }

    public function CreateHTML()
    { 
         $archivo = fopen('Archivos/Productos.txt',"r");
        echo '<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="stylesheet" href="CSS/estilo.css">
        </head><html><body><h3>Administración de cuadrilla en método</h3>';
        
        while(!feof($archivo))
        {
            $aux = fgets($archivo);
            $cadena = explode("Imagen: ",$aux);
            if($cadena[0] == "")continue; 
            echo '<div id = "central"><img src= '.$cadena[1].' alt="Smiley face" height="200" width="200"><br><h5>'.$cadena[0].'</h5><br></div>';
        }
        echo '</body></html>';
        fclose($archivo);  
    }


    #----Fin foto



    public function PrecioMasIva($producto)
    {
        return $producto->_precio * 0.21;
    }

    public function Cargar($producto)
    {
        array_push($this->_arrayProductos,$producto);
      
    }
    
    
    public static function RetornaListado()
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
    public function PrecioMasIva($producto);
}


?>