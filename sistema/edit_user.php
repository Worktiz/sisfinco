<?php 
	
	include "../conexion.php";

	if (!empty($_POST)) {
		$alert= '';
		if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol'])) {
			$alert= '<p class=""msg_error">Todos Los Campos Son Obligatorios</p>';
		}else{
			
			$idUsuario = $_POST['idUsuario'];
			$nombre = $_POST['nombre'];
			$email = $_POST['correo'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];

}


			$query = mysqli_query($conection,"SELECT * FROM usuario  
               WHERE (usuario = '$user' AND idUsuario != $idUsuario) 
				OR  (correo = '$email'  AND idUsuario != $idUsuario) ");



			$result = mysqli_fetch_array($query);

			if ($result > 0) {
				$alert = '<p class="msg_error">El Correo o El Usuario Ya existe</p>';
			} else {

				if (empty($_POST['clave'])) {

					$sql_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo = '$email', usuario = '$user', rol = '$rol' 
															WHERE idusuario = $idUsuario");
					
				}else{

					$sql_update = mysqli_query($conection,"UPDATE usuario
															SET nombre = '$nombre', correo = '$email', usuario = '$user', clave = '$clave', rol = '$rol' 
															WHERE idusuario = $idUsuario");
					
				}

				if ($sql_update) {
					$alert = '<p class="msg_save">Usuario Actualizado Correctamente</p>';
				}else{
					$alert = '<p class="msg_error">Error al Actualizar el Usuario</p>';
				}
			}
		
	}





//Mostrar

if (empty($_GET['id'])) {
	header('Location: lista_usuarios.php');
}

$iduser = $_GET['id'];

$sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) AS idrol, (r.rol) AS rol
FROM usuario u
INNER JOIN rol r
ON u.rol = r.idrol
WHERE idusuario = $iduser");

$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: lista_usuarios.php');
}else{

	$option = '';

	while ($data = mysqli_fetch_array($sql)) {
		$iduser = $data['idusuario'];
		$nombre = $data['nombre'];
		$correo = $data['correo'];
		$usuario = $data['usuario'];
		$idrol = $data['idrol'];
		$rol = $data['rol'];


		if ($idrol = 1) {
			$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
		}else if ($idrol = 2) {
			$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
		}else if ($idrol = 3) {
			$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
		}
	}
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Editar Usuario | Sisfinco</title>
</head>
<body>
		<?php include "includes/header.php"; ?>
	
	<section class="form-register">
		
		<h4>Editar Usuario</h4>
		<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
		<form action="" method="POST">
        <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
		<label for="nombre">Nombre y Apellido</label>
		<input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido" value="<?php echo $nombre; ?>">
		<label for="correo">Correo</label>
		<input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese Correo" value="<?php echo $correo; ?>">
		<label for="usuario">Usuario</label>
		<input class="controls" type="text" name="usuario" id="usuario" placeholder="Ingrese Usuario" value="<?php echo $usuario; ?>">
		<label for="clave">Contraseña</label>
		<input class="controls" type="password" name="clave" id="clave" placeholder="Ingrese Contraseña">
		<h2 class="type_user">Tipo de Usuario</h2>


		<?php
			$query_rol = mysqli_query($conection,"SELECT * FROM rol");
			$result_rol = mysqli_num_rows($query_rol);
		?>

		<select name="rol" id="rol" class="noItemOne">
			
        <?php  

                echo $option;

                if ($result_rol > 0) {

                while ($rol = mysqli_fetch_array($query_rol)){
                ?>
                <option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"]; ?> </option>
                <?php
                }


                }
                ?>
		</select>
		<input class="botons" type="submit" value="Actualizar Datos">
		</form>
	</section>
	
</body>
</html>