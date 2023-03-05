<?php 

session_start();
	if (empty($_SESSION)) {
		header('location: ../');
	}

?>

<?php include "includes/scripts.php"; ?>
<header class="header">
		<div><span class="user"><?php echo $_SESSION['nombre']; ?></span>
		<img class="photouser" src="img/user.png" alt="Usuario"></div>
		<span class="user"> | </span>
		<div class="logo">Menu</div>
		<input type="checkbox" id="toggle">
		<label for="toggle"><img class="menu" src="assets/menu.svg" alt="menu">
		</label>
		<div>
		<?php include "includes/nav.php"; ?>
	</header>