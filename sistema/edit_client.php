<?php 
	session_start();
	include "../conexion.php";

	if (!empty($_POST)) {
		$alert= '';
		if (empty($_POST['cedularif']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
			$alert= '<p class=""msg_error">Todos Los Campos Son Obligatorios</p>';
		}else{
			
			$idClient = $_POST['id'];
            $cedularif = $_POST['cedularif'];
			$nombre = $_POST['nombre'];
			$correo = $_POST['correo'];
			$telefono = $_POST['telefono'];
			$direccion = $_POST['direccion'];

					$sql_update = mysqli_query($conection,"UPDATE cliente
															SET cedularif = '$cedularif', nombre = '$nombre', correo = '$correo', telefono = '$telefono', direccion = '$direccion' 
															WHERE idcliente = $idClient");
					

				if ($sql_update) {
					$alert = '<p class="msg_save">Cliente Actualizado Correctamente</p>';
				}else{
					$alert = '<p class="msg_error">Error al Actualizar Cliente</p>';
				}
			}
		 	
	}

    
//Mostrar

if (empty($_REQUEST['id'])) {
	header('Location: client_list.php');
	mysqli_close($conection);
}

$idclient = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente = $idclient");

mysqli_close($conection);

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: client_list.php');
}else{
	while ($data = mysqli_fetch_array($sql)) {
		$idclient  = $data['idcliente'];
		$cedularif = $data['cedularif'];
		$nombre    = $data['nombre'];
		$correo    = $data['correo'];
		$telefono  = $data['telefono'];
		$direccion = $data['direccion'];
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Editar Cliente | Sisfinco</title>
</head>
<body>
		<?php include "includes/header.php"; ?>
	
	<section class="form-register">
		
		<h4>Editar Cliente</h4>
		<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
		<form action="" method="POST">
        <input type="hidden" name="id" value="<?php echo $idclient;  ?>">
        <label for="cedularif">Ingrese Cedula O RIF</label>
		<input class="controls" type="number" name="cedularif" id="cedularif" placeholder="Ingrese Cedula o RIF" value="<?php echo $cedularif;  ?>">
		<label for="nombre">Nombre y Apellido</label>
		<input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido" value="<?php echo $nombre;  ?>">
		<label for="correo">Correo</label>
		<input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese Correo" value="<?php echo $correo;  ?>">
		<label for="telefono">Telefono</label>
		<input class="controls" type="number" name="telefono" id="telefono" placeholder="Ingrese Telefono" value="<?php echo $telefono;  ?>">
		<label for="direccion">Dirección</label>
		<input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese Dirección" value="<?php echo $direccion;  ?>">
		<input class="botons" type="submit" value="Actualizar Cliente">
		</form>
	</section>
	
</body>
</html>