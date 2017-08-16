<?php

$array=array
(
    0=>rand(),
    1=>rand(),
    2=>rand(),
    3=>rand(),
    4=>rand(),  
)
$promedio=0;
for(i=0;i<5;i++)
{
    $promedio+=$array[i];
}
if($promedio/5==6)
echo "El promeido es igual a 6";
else if($promedio/5 > 6)
echo "El promeido es mayor a 6";
 else if($promedio/5 < 6)
 echo "El promeido es menor a 6";

?>

