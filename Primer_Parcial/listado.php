<?php
	require_once('usuario.php');
?>
<html>
<head>
	<title>LISTADO DE USUARIO</title>

	<meta charset="UTF-8">
		
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<a class="btn btn-info" href="index.html">Menu principal</a>

	<div class="container">
		<div class="page-header">
			<h1>Usuarios</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Listado de Usuarios</h1>

<?php 

//$ArrayDeProductos = Producto::TraerTodosLosProductos();
$ArrayDeUsuarios = Usuario::TraerTodosLosUsuarios();


echo "<table class='table'>
		<thead>
			<tr>
				<th>  NOMBRE </th>
				<th>  CORREO     </th>
				<th>  EDAD       </th>
                <th>  CLAVE      </th>
			</tr> 
		</thead>";   	
  /*
	foreach ($ArrayDeProductos as $prod){

	echo " 	<tr>
					<td>".$prod->GetCodBarra()."</td>
					<td>".$prod->GetNombre()."</td>
					<td><img src='archivos/".$prod->GetPathFoto()."' width='100px' height='100px'/></td>
				</tr>";

	}
	*/
	foreach ($ArrayDeUsuarios as $user){

	echo " 	<tr>
					<td>".$user->GetNombre()."</td>
					<td>".$user->GetCorreo()."</td>
	                <td>".$user->GetEdad()."</td>
	                <td>".$user->GetClave()."</td>
				</tr>";

	}
echo "</table>";		
?>
		</div>
	</div>
</body>
</html>