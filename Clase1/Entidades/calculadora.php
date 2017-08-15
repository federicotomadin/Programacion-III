<?php



class calculadora
{
  
  
 static function  multiplicar($numeroUno,$numeroDos)
 {
    echo $numeroUno * $numeroDos;
 }

 static function dividir($numeroUno,$numeroDos)
 {
      $obj=new validar();

     if(!$obj->EsCero($numeroDos))
     {
       echo $numeroUno/$numeroDos;
     }
 }
    
}


?>