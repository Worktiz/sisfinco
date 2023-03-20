<?php 
	session_start();
	include "../conexion.php";

	if (!empty($_POST)) {
		$alert= '';
		if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['direccion'])) {
			$alert= '<p class="msg_error">Todos Los Campos Son Obligatorios.</p>';
		}else{
			
            $cedula  = $_POST['cedula'];
			$nombre     = $_POST['nombre'];
			$email      = $_POST['correo'];
			$telefono   = $_POST['telefono'];
			$direccion  = $_POST['direccion'];
            $id_usuario  = $_SESSION['idUser'];
            
            $result = 0;


            if (is_numeric($cedula)) {
                $query = mysqli_query($conection,"SELECT * FROM cliente WHERE cedula = '$cedula'");
                $result = mysqli_fetch_array($query);
            }

            if ($result > 0) {
                $alert = '<p class="msg_error">El Numero de Cedula o RIF Ya existe</p>';
            }else{
                $query_insert = mysqli_query($conection,"INSERT INTO cliente(cedula,nombre,correo,telefono,direccion,id_usuario) 
                                                            VALUES('$cedula',  '$nombre', '$email', '$telefono',  '$direccion', '$id_usuario')");

                    if ($query_insert) {
                        $alert = '<p class="msg_save">Cliente Guardado Correctamente</p>';
                    }else{
                        $alert = '<p class="msg_error">Error al Guardar el Cliente</p>';
                    } 

                }
				
			}
            mysqli_close($conection);
		
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Nuevo Cliente | Sisfinco</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	
	<section class="form-register">
		<h4>Registro de Cliente</h4>
		<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
		<form action="" method="POST">
        <label for="cedula">Ingrese Cedula</label>
		<input class="controls" type="number" name="cedula" id="cedula" placeholder="Ingrese Cedula">
		<label for="nombre">Nombre y Apellido</label>
		<input class="controls" type="text" name="nombre" id="nombre" placeholder="Ingrese Nombre y Apellido">
		<label for="correo">Correo</label>
		<input class="controls" type="email" name="correo" id="correo" placeholder="Ingrese Correo">
		<label for="telefono">Telefono</label>
		<input class="controls" type="number" name="telefono" id="telefono" placeholder="Ingrese Telefono">
		<label for="direccion">Dirección</label>
		<input class="controls" type="text" name="direccion" id="direccion" placeholder="Ingrese Dirección">
		<input class="botons" type="submit" value="Registrar Cliente">
		</form>
	</section>
	
</body>
</html>