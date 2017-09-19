<html>
   <head>
   <title>Ingresar un usuario</title>
   </head>

   <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="estilo.css">
   <body>
    <form method="post" enctype="multipart/form-data" action="administracion.php" >
				<input type="text" name="correo" placeholder="Ingrese correo"  />
                <br>
				<input type="text" name="clave" placeholder="Ingrese clave"  />
				<input type="submit" class="MiBotonUTN" name="verificar" value="Verificar"/>
			</form>
   </body>

<?php

echo "<table class='table'>
<thead>
    <tr>
        <th>  NOMBRE </th>
        <th>  CORREO     </th>
        <th>  EDAD       </th>
        <th>  CLAVE      </th>
    </tr> 
</thead>";   

?>

</html>