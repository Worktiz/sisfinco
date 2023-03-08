<?php 

session_start();
	if ($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {
		header ("Location: ./");
	}
include "../conexion.php";
	if (!empty($_POST)) {

		if (empty($_POST['idclient'])) {
            header ("Location: client_list.php");
            mysqli_close($conection);
        }
		$idclient = $_POST['idclient'];

		//$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = '$idusuario'" );
		$query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $idclient");
		mysqli_close($conection);

		if ($query_delete) {
			header ("Location: client_list.php");
		}else{
			echo "Error al Eliminar";
		}

	}
	
	if (empty($_REQUEST['id'])) {
		header ("Location: client_list.php");
		mysqli_close($conection);
	}else{

		$idclient = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente = $idclient" );
		mysqli_close($conection);


		$result = mysqli_num_rows($query);

		if ($result > 0) {
			while ($data = mysqli_fetch_array($query)){

                $cedularif = $data['cedularif'];    
				$nombre = $data['nombre'];
			}
			}else{
				header ("Location: client_list.php");
			}
			}
		
	

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Eliminar Cliente | Sisfinco</title>
	<link rel="stylesheet" href="css/index.css">
</head>
<body>
	<?php include "includes/header.php"; ?>
	<div class="cuadre">
    <section class="user_list">
		<div class="data_delete">
			 <h2>¿Esta Seguro de Eliminar el CLiente</h2>
			 <div>
			 <p>Cedula: <span><?php echo $cedularif; ?></span></p>
			 </div>	
			 <div>
			 <p>Nombre: <span><?php echo $nombre; ?></span></p>
			 </div>
			 <form method="post" action="">
			 	<input type="hidden" name="idclient" value="<?php echo $idclient; ?>">
			 	<a href="client_list.php" class="btn_cancel">Cancelar</a>
			 	<input type="submit" value="Eliminar" class="btn_ok">
			 </form>
		</div>
	</section>
	</div>
</body>
</html>