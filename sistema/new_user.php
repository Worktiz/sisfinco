<?php 
	
	include "../conexion.php";

	if (!empty($_POST)) {
		$alert= '';
		if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol'])) {
			$alert= '<p class="msg_error">Todos Los Campos Son Obligatorios</p>';
		}else{
			

			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];



			$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");
			mysqli_close($conection);
			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">El Correo o El Usuario Ya existe</p>';

			} else {
				$query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre',  '$email', '$user', '$clave',  '$rol')");

				if ($query_insert) {
					$alert = '<p class="msg_save">Usuario Creado Correctamente</p>';
				}else{
					$alert = '<p class="msg_error">Error al Crear el Usuario</p>';
				}
			}
		
	}

}
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<?php include "includes/scripts.php"; ?>
	<title>Nuevo Usuario | Sisfinco</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	
	<section class="form-register">
		
		<h4>Registro de Usuario</h4>
		<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
		<form action="" method="POST">
		<label for="nombre">Nombre y Apellido</label>
		<input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido">
		<label for="correo">Correo</label>
		<input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese Correo">
		<label for="usuario">Usuario</label>
		<input class="controls" type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario">
		<label for="clave">Contraseña</label>
		<input class="controls" type="password" name="clave" id="clave" placeholder="Ingrese Contraseña">
		<h2 class="type_user">Tipo de Usuario</h2>


		<?php
			$query_rol = mysqli_query($conection,"SELECT * FROM rol");
			mysqli_close($conection);
			$result_rol = mysqli_num_rows($query_rol);
		?>

		<select name="rol" id="rol" class="noitemone">
			
			<?php
				if ($result_rol > 0) {

					while ($rol = mysqli_fetch_array($query_rol)) {

						?>

						<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?></option>
						<?php 
					}
				}

			?>
		</select>
		<input class="botons" type="submit" value="Registrar">
		</form>
	</section>
	
</body>
</html>