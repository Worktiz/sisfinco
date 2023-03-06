<?php 	
	session_start();
	$alert = '';
	
	
	if (!empty($_SESSION)) {
		header('location: sistema/');
	}else{

	if (!empty($_POST)) {
		if (empty($_POST['usuario']) || empty($_POST['clave'])) {
			$alert = "Inserte su Usuario y Contraseña";
		}else{
			require_once "conexion.php";

			$user = mysqli_real_escape_string($conection,$_POST['usuario']);
			$pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if ($result > 0 ) {
				$data = mysqli_fetch_array($query);

				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['email'] = $data['email'];
				$_SESSION['rol'] = $data['rol'];

				header('location: sistema/');
			}else{
				$alert = "El usuario o la clave son incorrectos";
				session_destroy();
			}
		}
		}
	}



?>


<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="css/neonlogin.css">
	<title>Login | Sisfinco</title>
</head>
<body>
	<section>
		<div class="form-box">
			<div class="form-value">
				<form action="" method="post">
					<h2>Iniciar Sesión</h2>
					<div class="inputbox">
						<ion-icon name="person-circle-outline"></ion-icon>
						<input type="text" name="usuario" autocomplete="off">
						<label>Usuario</label>
					</div>
					<div class="inputbox">
						<ion-icon name="lock-closed-outline"></ion-icon>
						<input type="password" name="clave">
						<label>Contraseña</label>
					</div>
					<div class="alert"><?php echo isset($alert)? $alert : ''; ?></div>

					<div><input type="submit" value="Login" class="button"></div>
				</form>
			</div>
		</div>
	</section>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>