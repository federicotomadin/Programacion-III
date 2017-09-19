<html>
<head>
	<title>ALTA de CONTEINERES</title>
	  
		<meta charset="UTF-8">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>
	<a class="btn btn-info" href="index.html">Menu principal</a>
<?php     
	require_once("Clases\conteiner.php");
?>
	<div class="container">
	
		<div class="page-header">
			<h1>CONTEINERES</h1>      
		</div>
		<div class="CajaInicio animated bounceInRight">
			<h1>Ingrese un conteiner</h1>

			<form method="post" enctype="multipart/form-data" action="administracion.php" >
				<input type="text" name="numero" placeholder="Ingrese numero"  />
				<input type="text" name="descripcion" placeholder="Ingrese descripcion"  />
                <input type="text" name="pais" placeholder="Ingrese pais"  />
				<input type="file" name="archivo" /> 
				<input type="submit" class="MiBotonUTN" name="agregarConteiner" value="Agregar Conteiner" />
			</form>
		
		</div>
	</div>
</body>
</html>