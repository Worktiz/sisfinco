






<nav class="navigation">
			<ul>
				<li><a href="index.php">Inicio</a></li>
				
				<li><a href="">Clientes</a>
					<ul>
						<li><a href="new_client.php">Nuevo Cliente</a></li>
						<li><a href="client_list.php">Lista Clientes</a></li>
					</ul>
				</li>
				
				<li><a href="">Credito</a>
					<ul>
					<li><a href="">Nuevo Credito</a></li>
					<li><a href="">Editar Editar</a></li>
					</ul>
					
				</li>
				<li><a href="">Cobranza</a>
					<ul>
					<li><a href="">Estado de Credito</a></li>
					<li><a href="">Añadir Pago</a></li>
					<li><a href="">Editar Credito</a></li>
					<li><a href="search_exp.php">Expedientes</a></li>
					</ul>
				</li>
				<?php
				if ($_SESSION['rol'] == 1) {
				?>
				<li><a href="">Usuarios</a>
					<ul>
					<li><a href="new_user.php">Nuevo Usuario</a></li>
					<li><a href="user_list.php">Lista de Usuarios</a></li>
					</ul>
				</li>
				<?php
					}
				?>
				<li><a href="">Contactos</a></li>
				
				<li><a href="../close_sesion.php"><img src="assets/loguot.svg" alt="Salir" class="exit"></a></li>
			</ul>


		</nav>