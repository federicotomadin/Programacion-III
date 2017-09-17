<?php

include("Persona.php");
include("Empleado.php");

$irAMostrar = "<a href =\"mostrar.php\">Mostrar Empleado</a>";
$irAIndex = "<a href =\"index.html\">Ir a Index</a>";
$imagen;
if(isset($_POST["AgregarEmpleado"]))
{
$employee = new Empleado($_POST["nombre"],$_POST["apellido"],$_POST["dni"],$_POST["sexo"],$_POST["legajo"],$_POST["sueldo"]);

if($_FILES["archivo"]["type"] == "image/jpeg" || $_FILES["archivo"]["type"] == "image/gif")
{
    if($_FILES["archivo"]["size"] < 1000000)
    {   
    $extension = explode(".",$_FILES["archivo"]["name"]);
    $destino = "fotos/".$_POST["dni"]."_".$_POST["apellido"].".".$extension[1];
    move_uploaded_file($_FILES["archivo"]["tmp_name"],$destino);
    $PathFoto = "./".$destino;
    Empleado::Archivar($employee);

    $employee->setPathFoto($PathFoto);
    }
    else
    {
        echo "Usted ha seleccionado una imagen que supera 1 MB";
    }
}
else
{
    echo "El empleado posee un archivo que no es un imagen valida.";
}

$gestor = fopen("empleados.txt","a+");
$escribir = fwrite($gestor,$employee->ToString()."\r\n");

if($escribir == false)
{
    echo "El empleado no pudo ser agregado al archivo <br>";
    echo $irAMostrar;
}
else
{
    echo "El empleado fue correctamente archivado <br>";
    echo $irAMostrar."<br>";
    echo $irAIndex;
   
}

fclose($gestor);
echo "<br>";
}
echo "<br>";
//var_dump($_POST);

?>