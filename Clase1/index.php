<?php


include_once "funciones.php";
require_once "funciones2.php";
require_once "Validador/validar.php";
require_once "Entidades/calculadora.php";


sumar(100,100);
echo "<br>";
echo "<br>";
restar(100,50);

echo "<br>";
echo "<br>";
$obj=new calculadora();
$obj->MultiplIcar(5,5);
echo "<br>";
echo "<br>";
calculadora::Multiplicar(5,5);


echo "<br>";
echo "Estoy dividiendo";
echo"<br>";
calculadora::dividir(25,5);




?>