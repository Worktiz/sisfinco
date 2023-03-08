<?php 
session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="peticion.js"></script>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sisfinco</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
    <section>
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar..." class="search">
		</section>

		<section id="tabla_resultado">
		<!-- AQUI SE DESPLEGARA NUESTRA TABLA DE CONSULTA -->
		</section
</body>
</html>