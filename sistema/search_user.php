<?php 
	include "../conexion.php";
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include "includes/scripts.php"; ?>
	<?php include "includes/header.php"; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lista de Usuarios | Sisfinco</title>
</head>
<body>
	
			<br>
			<br>
			<br>
			<br>
			<br>
	<section class="user_list">

			<?php 

					$busqueda = strtolower($_REQUEST['busqueda']);

					if (empty($busqueda)) {
						header("Location: user_list.php");
					}

 				?>

		<h1>Lista de Usuarios</h1>
		<a href="new_user.php" class="btn_new">Añadir Usuario</a>

		<form action="search_user.php" method="get" class="search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Ingrese Busqueda" class="link_search" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
			<th>ID</th>
			<th>NOMBRE</th>
			<th>Correo</th>
			<th>Usuario</th>
			<th>Rol</th>
			<th>Acciones</th>
			</tr>

<?php 

//paginador

$rol = '';
		if ($busqueda == 'administrador') {
			$rol = "OR rol LIKE '%1%'";
		}else if ($busqueda == 'supervisor') {
			$rol = "OR rol LIKE '%2%'";
		}else if ($busqueda == 'archivista') {
			$rol = "OR rol LIKE '%3%'";}

$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro 										 FROM usuario 
		WHERE (
   		idusuario LIKE '%$busqueda%' OR
   		nombre    LIKE '%$busqueda%' OR
   		correo    LIKE '%$busqueda%' OR
   		usuario   LIKE '%$busqueda%' 
   		$rol )
   		AND estatus = 1");

		$result_register = mysqli_fetch_array($sql_registe);

		$total_registro = $result_register['total_registro'];

		$por_pagina = 5;

		if (empty($_GET['pagina'])) {
			$pagina = 1;
		}else{
			$pagina = $_GET['pagina'];
		}

		

		$desde = ($pagina-1) * $por_pagina;
		$total_paginas = ceil($total_registro / $por_pagina);
//paginador

$query = mysqli_query($conection,"SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
WHERE (
		u.idusuario LIKE '%$busqueda%' OR
		u.nombre    LIKE '%$busqueda%' OR
		u.correo    LIKE '%$busqueda%' OR
		u.usuario   LIKE '%$busqueda%' OR
		r.rol LIKE '%$busqueda%')
		AND estatus = 1 ORDER BY u.idusuario ASC LIMIT $desde,$por_pagina");
		
	$result = mysqli_num_rows($query);
	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {
			
			?>
			<tr>
				<td><?php echo $data['idusuario']; ?></td>
				<td><?php echo $data['nombre']; ?></td>
				<td><?php echo $data['correo']; ?></td>
				<td><?php echo $data['usuario']; ?></td>
				<td><?php echo $data['rol']; ?></td>
				<td>
					<a class="edit" href="edit_user.php?id=<?php echo $data['idusuario'];?>"><img src="assets/edit.svg" class="edit"></a>
					<?php 
						if ($data['idusuario'] != 1) {
				
					 ?>
					
					<a class="delete" href="delete_user.php?id=<?php echo $data['idusuario'];?>"><img src="assets/delete.svg" class="delete"></a>

					<?php 
				

					 ?>


				</td>
			</tr>

<?php 

		}
	}





?>

		</table>
		<div class="select">
			<ul>

				<?php 
					if ($pagina != 1) {
						
					
				 ?>
				<li class="selector"><a href="?pagina=<?php echo 1; ?>"><img src="assets/arrow_ini.svg"></a></li>
				<li class="selector"><a href="?pagina=<?php echo $pagina-1; ?>"><img src="assets/arrow_left.svg"></a></li>
				<?php   
				}
				for ($i=1; $i <= $total_paginas; $i++) { 

				if ($i == $pagina) {
					echo '<li class="selectPage">'.$i.'</li>';
				}else{
					echo '<li class="page"><a href="?pagina='.$i.'">'.$i.'</a></li>';
				}
					
						
					}

					if ($pagina != $total_paginas) {
						
					

				 ?>
				<li><a class="selector" href="?pagina=<?php echo $pagina+1; ?>"><img src="assets/arrow_rigth.svg"></a></li>
				<li><a class="selector" href="?pagina=<?php echo $total_paginas; ?>"><img src="assets/arrow_final.svg"></a></li>

			<?php } ?>
			</ul>

		</div>

		<?php
					}else{
			echo '<h2 class="notresult">No hay resultados</h2>';
		}
		
		?>

	</section>
	</body>
</html>