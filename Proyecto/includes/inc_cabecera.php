<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">Películas</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<?php if ($logeado) {
						echo "<li><a class='nav-link' href='crud.php'>Listado de películas</a></li>";
						echo "<li><a class='nav-link' href='formulario.php'>Añadir nueva película</a></li>";
					}else {
						echo "<li><a class='nav-link' href='acercade.php'>Acerca</a></li>";
						echo "<li><a class='nav-link' href='contacto.php'>Contáctanos</a></li>";
					}?>
				</ul>
				<!-- <form class="d-flex mt-3">
					<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form> -->
				<ul class="navbar-nav col-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<?php if ($logeado) {
							echo "<a class='nav-link' href='login.php'>Logout</a>";
						} else {
							echo "<a class='nav-link' href='login.php'>Área Administrador</a>";
						}?>
					</li>
				</ul>
			</div>
		</div>
	</nav>