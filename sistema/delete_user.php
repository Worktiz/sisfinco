<?php 

include "../conexion.php";
	if (!empty($_POST)) {

		if ($_POST['idusuario'] == 1) {
			header ("Location: user_list.php");
			mysqli_close($conection);
			exit;
		}
		$idusuario = $_POST['idusuario'];

		//$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = '$idusuario'" );
		$query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario");
		mysqli_close($conection);

		if ($query_delete) {
			header ("Location: user_list.php");
		}else{
			echo "Error al Eliminar";
		}

	}
	
	if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
		header ("Location: user_list.php");
		mysqli_close($conection);
	}else{

		

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT u.nombre,u.usuario, r.rol
											FROM usuario u
											INNER JOIN
											rol r
											ON u.rol = r.idrol
											WHERE 
											u.idusuario = $idusuario" );
		mysqli_close($conection);


		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)){
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];
			}
			}else{
				header ("Location: user_list.php");
			}
			}
		
	

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Sisfinco</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<div class="cuadre">
    <section class="user_list">
		<div class="data_delete">
			 <h2>¿Esta Seguro de Eliminar el Siguiente Usuario</h2>
			 <p>Nombre: <span><?php echo $nombre; ?></span></p>
			 <p>Usuario: <span><?php echo $usuario; ?></span></p>
			 <p>Tipo de Usuario: <span><?php echo $rol; ?></span></p>

			 <form method="post" action="">
			 	<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
			 	<a href="user_list.php" class="btn_cancel">Cancelar</a>
			 	<input type="submit" value="Aceptar" class="btn_ok">
			 </form>
		</div>
	</section>
	</div>
</body>
</html>