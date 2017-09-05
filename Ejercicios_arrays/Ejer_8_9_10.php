<?php


 $v=array();

$v[1]=90;
$v[30]=7;
$v['e']=99;
$v['hola']='mundo';

var_dump($v);

echo "<br>";
echo "<br>";


$lapicera=array();
$lapicera["color"]="azul";
$lapicera["marca"]="pen";
$lapicera["trazo"]="grueso";
$lapicera["precio"]=50;

$lapicera2=array();
$lapicera2["color"]="azul";
$lapicera2["marca"]="pen";
$lapicera2["trazo"]="grueso";
$lapicera2["precio"]=50;

$lapicera3=array();
$lapicera3["color"]="azul";
$lapicera3["marca"]="pen";
$lapicera3["trazo"]="grueso";
$lapicera3["precio"]=50;


echo "<br>";
echo "<br>";

var_dump($lapicera);

$Lapiceras=array();

//$Lapiceras["uno"]=$lapicera;
//$Lapiceras["dos"]=$lapicera2;
//$Lapiceras["tres"]=$lapicera3;

array_push($Lapiceras,$lapicera,$lapicera2);


echo "<br>";
echo "<br>";

var_dump($Lapiceras);

?>