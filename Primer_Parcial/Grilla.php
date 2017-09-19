<?php
	require_once("Clases/conteiner.php");
?>
<html>
<head>
	<title>LISTADO - con base de datos -</title>

	<meta charset="UTF-8">
		
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<a class="btn btn-info" href="index.html">Menu principal</a>

	<div class="container">
		<div class="page-header">
			<h1>Ejemplos de Grilla</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Listado de CONTEINERES</h1>

<?php 

//$ArrayDeProductos = Producto::TraerTodosLosProductos();
$ArrayDeConteineres = conteiner::bd();


echo "<table class='table'>
		<thead>
			<tr>
				<th>  NUMERO </th>
				<th>  DESCRIPCION     </th>
				<th>  PAIS       </th>
                <th>  FOTO       </th>
				<th>  BORRAR     </th>
			</tr> 
		</thead>";   	
	foreach ($ArrayDeConteineres as $cont){

	echo " 	<tr>
					<td>".$cont->GetNumero()."</td>
					<td>".$cont->GetDescripcion()."</td>
                    <td>".$cont->GetPais()."</td>
					<td><img src='archivos/".$cont->GetFoto()."' width='100px' height='100px'/></td>
					<td><a href='borrarConteiner.php?numero=".$cont->GetNumero()."'>Borrar</a></td>
					<td></td>
				</tr>";

	}
echo "</table>";		
?>
		</div>
	</div>
</body>
</html>