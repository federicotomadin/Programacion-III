<?php
$operador="*";
$op1=10;
$op2=2;


switch($operador)
{
    case "+":
    echo "La suma es ".($op1 + $op2);
    break;
    case "-":
    echo "La resta es ".($op1 - $op2);
    break;
    case "*":
    echo "La multiplicacion es ".($op1 * $op2);
    break;
    case "/":
    echo "La division es ".($op1 / $op2);
    break;

}



?>