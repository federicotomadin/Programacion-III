<?php

/*   
poseee dos atributos pirvados implemnete interface ivendible con el metodo precio mas iva
y tiene un metodo que se llama retornar array de productos qeu retorna un array con cinco productos


*/
class Producto  implements iVendible
{
    private $_nombre;

    public $_precio;


    public static $_lista=array();

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

    public static function LeerArchivo()
    {
        $archivo = fopen('Archivos/Productos.txt',"r");
        $bandera=false;
        $numeroDeLinead;
        while(!feof($archivo))
        {
           
            $aux = fgets($archivo);
            if($aux == "") continue; 
            $cadena = explode(" - ",$aux);
           
           
            array_push(Producto::$_lista,new Producto($cadena[0],$cadena[1]));
            //var_dump(Producto::$_lista);

    }
    fclose($archivo);
    
}

    public function GuardarArchivo()
    {

    }

    public static function BuscarProducto($nombre)
    {
       
  
        $numeroDeLinead;
      for($i=0;$i<count(Producto::$_lista);$i++)
      {
          if(Producto::$_lista[$i]->getNombre()==$nombre)
          {
            return $i;
          }

        }
        return -1;
      }//cierra la funcion
          

    

    public static function BorrarProducto($nombre)
    {
     
        if(Producto::BuscarProducto($nombre)==-1)
        {
            return false;
        }
       unset(Producto::$_lista[Producto::BuscarProducto($nombre)]);//paso el array con el indice.
       return true;
    
    }

    



    public static function ArchivarLista($array)
    {
        $archivo = fopen('Archivos/Productos.txt',"w");
        $str="";
        foreach(Producto::$_lista as $item)
        {
            
            $str.=$item->RetornarDetalles(); 
        }
        fwrite($archivo,$str);         
        fclose($archivo);  
    }

   public static function Archivar($producto)
    {   
        $archivo = fopen('Archivos/Productos.txt',"a");
        fwrite($archivo,$producto->RetornarDetalles()."\r\n");         
        fclose($archivo);
    }

    public function RetornarDetalles()
    {
        return $this->getNombre().' - '.$this->_precio;
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