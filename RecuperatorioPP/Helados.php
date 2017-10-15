<?php

class Helado
{

public $sabor;
public $tipo;
public $precio;
public $cantidad;


public function Helado($sabor,$tipo,$precio,$cantidad)
{
    $this->sabor=$sabor;
    $this->tipo=$tipo;
    $this->precio=$precio;
    $this->cantidad=$cantidad;
}

public static function AltaHelado($helado)
{
    $heladoJson= json_encode($helado);
    $pFile= fopen("Archivos/helados.txt","a");
    fwrite($pFile,$heladoJson."\n");
    fclose($pFile);
}


public static function TraerHelados()
{
  $helados=array();
  $pFile = fopen("Archivos/helados.txt","r");
  while(!feof($pFile))
  {
      $aux=json_decode(fgets($pFile),true);
      array_push($helados,new Helado($aux["sabor"],$aux["tipo"],$aux["precio"],$aux["cantidad"]));
  }
  fclose($pFile);
  return $helados;

}

public static function GuardarEnArchivo($array)
{
    Helado::LimpiarArchivo();
  foreach($array as $item)
  {
      if($item->sabor<>null)
      {
      Helado::AltaHelado($item);
      }
  }
}

public static function QuitarHelado($sabor,$tipo,$cantidad)
{
  
 $helados=Helado::TraerHelados();
 $aux=array();
     
       foreach($helados as $item)
       {
           if($item->sabor<>$sabor || $item->tipo<>$tipo || $item->cantidad<>$cantidad)
           {
              array_push($aux,new Helado($item->sabor,$item->tipo,$item->precio,$item->cantidad));
           }
           
       }
   return $aux;    

}

public static function LimpiarArchivo()
{
    $pFile= fopen("Archivos/helados.txt","w");
    fwrite($pFile,''."\n");
    fclose($pFile);

}


public static function BuscarHelado($sabor,$tipo)
{
    $helados=Helado::TraerHelados();
    $varAux=false;
    $varAux2=false;

    foreach($helados as $item)
    {
        if($item->sabor==$sabor)
        {
            $varAux=true;
        }
        if($item->tipo==$tipo)
        {
            $varAux2=true;
        }

    }

    if($varAux==true && $varAux2==true)
    {
        echo "SI HAY";
    }

    if(!$varAux2 && !$varAux)
    {
        echo "No existe  el sabor ni el tipo ";
        exit;
    }

    if(!$varAux)
    {
        echo "No existe el sabor ";
    }

    if(!$varAux2)
    {
        echo "No existe el tipo ";
    }
    
}

public static function AltaVenta($email,$sabor,$tipo,$cantidad)
{
    $helados=Helado::TraerHelados();
    $resultado2=array();
    $todoOK=false;
    foreach($helados as $item)
    {
        if($item->sabor==$sabor && $item->tipo==$tipo && $item->cantidad>=$cantidad)
        {
            $resultado=array("email"=>$email,"sabor"=>$sabor,"tipo"=>$tipo,"precio"=>$item->precio,"cantidad"=>$cantidad);
            $pFile=fopen("Archivos/Venta.txt","a");
            fwrite($pFile,json_encode($resultado)."\n");
            fclose($pFile);
            $item->cantidad=$item->cantidad - $cantidad;          
            $resultado2=array("sabor"=>$item->sabor,"tipo"=>$item->tipo,"precio"=>$item->precio,"cantidad"=>$item->cantidad); 
            Helado::AltaHelado($item);                
            Helado::GuardarEnArchivo(Helado::QuitarHelado($sabor,$tipo,$item->cantidad + $cantidad));
            
            $todoOK=true;
          
        }
    }

    if($todoOK)
    {
        echo "Se realizo la venta con exito";
        return true;
       
    }
        else {
            echo "No se pudo realizar la venta";
            return false;
        }

    }


    public static function AltaConImagen($email,$sabor,$tipo,$cantidad)
    {
     
          if(Helado::AltaVenta($email,$sabor,$tipo,$cantidad))
          {
              $extension=pathinfo($_FILES['archivo']['name'],PATHINFO_EXTENSION);
              $ahora=date("Ymd");
              $destino=("ImagenesDeLaVenta/".$sabor.$ahora.".".$extension);
              move_uploaded_file($_FILES['archivo']['tmp_name'],$destino);
          }

    }

    public static function ArmarGrilla($email=NULL,$sabor=NULL)
    {
        $resultados=Helado::Resultados($email,$sabor);
        $grilla.="<table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Sabor</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Imagen</th>
            </tr>
        </thead>";

        if(count($resultados>0))
        {
            foreach($resultados as $item)
            {
                $grilla.="<tbody>
                <td>".$item['email']."</td>
                <td>".$item['sabor']."</td>
                <td>".$item['tipo']."</td>
                <td>".$item['precio']."</td>
                <td>".$item['cantidad']."</td>
                <td><img src='ImagenesDeLaVenta/".$item['sabor']."20171014.jpg' width='100px' height='100px'></td>
                </tbody>";
            }
        }
        else 
        {
            $grilla.="<h1> No se encontraron resultados</h1>";
        }
        $grilla.="<table>";
        echo $grilla;
    }


    public static function TraerVentas()
    {
        $ventas=array();
        $pFile=fopen("Archivos/ventas.txt",r);
        while(!feof($pFile))
        {
            $aux=json_encode(fgets($pFile),true);
            foreach($aux as $item)
            {
                array_push($ventas,$item['email'],$item['sabor'],$item['tipo'],$item['precio'],$item['cantidad']);

            }
           

        }


    }

   public static function Resultados($email=NULL,$sabor=NULL)
   {
      if($email<>NULL && $sabor<>NULL)
      {
      
      $ventas=Helado::TraerVentas();
      $resultados=array();
      foreach($ventas as $item)
      {
          if($item['email']==$email && $item['sabor']==$sabor)
          {
              array_push($resultados,$item);
          }
      }

      if(count($resultado)<>0)
      {
          return $resultados;
      }
      else 
      {
          echo "No se encontraron resultados";
      }
      }

      if($email<>NULL && $sabor==NULL)
      {
        $resultados = array();
        $ventas = Helado::TraerVentas();
        foreach ($ventas as $item) {
            if ($item['email'] == $email) {
                
                array_push($resultados,$item);
            }
        }
        if(count($resultados) != 0)
        {
            return $resultados;
        }
        else{
            echo "No se encontraron resultados";
        }
      }

      if($email==NULL && $sabor<>NULL)
      {
        $resultados = array();
        $ventas = Helado::TraerVentas();
        foreach ($ventas as $item) {
            if ($item['sabor'] == $email) {
                
                array_push($resultados,$item);
            }
        }
        if(count($resultados) != 0)
        {
            return $resultados;
        }
        else{
            echo "No se encontraron resultados";
        }
      }
      
   }






}




?>