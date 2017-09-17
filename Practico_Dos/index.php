<html>
       <head>
       <meta charset="utf-8" />
       <title>Agregar Empleado</title>
     </head>
     <body>
    <form action = "Administracion.php" method="POST" enctype="multipart/form-data">
    <input type = "text" name = "nombre" placeholder="Nombre">
    <br>
    <input type = "text" name = "apellido" placeholder="Apellido">
    <br>
    <input type = "text" name = "dni" placeholder="Dni">
    <br>
    <input type = "text" name = "sexo" placeholder="Sexo">
    <br>
    <input type = "text" name = "legajo" placeholder="Legajo">
    <br>
    <input type = "text" name = "sueldo" placeholder="Sueldo">
    <br>
    <input type = "file" name = "archivo">
    <br>
    <br>
    <input type = "submit" value ="AgregarEmpleado" name = "AgregarEmpleado"> 
    </form>
     </body>
</html>