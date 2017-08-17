<?php

include "Practico_Uno";

echo "la concha";

$numero = 0;
$contador = 0;
while($contador <= 1000)
{
  if($contador <= 999)
  {
      $numero++;
      $contador += $numero;
  }
  else
  {
      $contador -= $numero;
  }
}
echo $numero." es el ultimo numero usado<br>";
echo $contador." es el acumulado de toda la suma";
?>