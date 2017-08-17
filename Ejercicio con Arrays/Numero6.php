<?php

$array=array
(
    0=>rand(),
    1=>rand(),
    2=>rand(),
    3=>rand(),
    4=>rand(),  
);

for($i=0;$i<5;$i++)
{
    if($array[$i]/5==6)
    {
    echo "El promedio es igual a 6"."<br/>";
    }

else 
{
      if($array[$i]/5>6)

       echo "El promedio es mayor a 6"."<br>";

 else
 {
      if($array[$i]/5 < 6)
 echo "El promedio es menor a 6"."<br>";
 }
}
}
var_dump($array);

?>

