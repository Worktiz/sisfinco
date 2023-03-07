<?php 
session_start();
include "../conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php include "includes/scripts.php"; ?>
	<?php include "includes/header.php"; ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Lista de Clientes | Sisfinco</title>
</head>
<body>
	
			<br>
			<br>
			<br>
			<br>
			<br>
	<section class="user_list">

		<h1>Lista de Clientes</h1>
		<a href="new_client.php" class="btn_new">Añadir Usuario</a>

		<form action="search_client.php" method="get" class="search ">
			<input type="text" name="busqueda" id="busqueda" placeholder="Ingrese Busqueda" class="link_search">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
			<th>ID</th>
			<th>Cedula</th>
			<th>Nombre</th>
			<th>Correo</th>
			<th>Telefono</th>
			<th>Dirección</th>
            <th>Acciones</th>
			</tr>

<?php 

//paginador
		$sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM cliente WHERE estatus = 1");
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
//Finpaginador
	$query = mysqli_query($conection,"SELECT * FROM cliente WHERE estatus = 1 ORDER BY idcliente ASC LIMIT $desde,$por_pagina");
	mysqli_close($conection);
	$result = mysqli_num_rows($query);
	if ($result > 0) {
		while ($data = mysqli_fetch_array($query)) {	
            if ($data['cedularif'] == 0) {
                $cedularif = 'N/P';
            }else{
                $cedularif = $data['cedularif'];
            }		
			?>
			<tr>
				<td><?php echo $data['idcliente']; ?></td>
				<td><?php echo $data['cedularif']; ?></td>
				<td><?php echo $data['nombre']; ?></td>
				<td><?php echo $data['correo']; ?></td>
				<td><?php echo $data['telefono']; ?></td>
                <td><?php echo $data['direccion']; ?></td>
				<td>
					<a class="edit" href="edit_client.php?id=<?php echo $data['idcliente'];?>"><img src="assets/edit.svg" class="edit"></a>
								
					<a class="delete" href="delete_client.php?id=<?php echo $data['idcliente'];?>"><img src="assets/delete.svg" class="delete"></a>
					<?php 
				}
					 ?>
				</td>
			</tr>
<?php 
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

	</section>