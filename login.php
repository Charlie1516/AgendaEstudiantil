<?php
// Incluye el controlador de autenticación
require_once "controller/AuthController.php";

// Intenta iniciar sesión
AuthController::login();
?>
<html>

<head>
	<title>LOGIN | POKEMON DYNAMAX</title>
	<!-- Enlace al archivo CSS de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
	<?php include "templates/navbar.php"; ?>
	<!-- Contenedor principal -->
	<div class="container">
		<div class="row my-5">
			<div class="card col-md-4 mx-auto p-4">
				<!-- Título de la página -->
				<h2 class="text-center mb-4">Login</h2>

				<!-- Formulario de inicio de sesión -->
				<form role="form" name="login" action="login.php" method="post">
					<!-- Campo de nombre de usuario o correo electrónico -->
					<div class="mb-3">
						<label for="username">Nombre de usuario o email</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
					</div>
					<?php
					// Muestra errores de validación si existen
					if (isset($errors['username'])) {
						echo '<p class="text-danger">' . $errors['username'] . '</p>';
					}
					?>
					<!-- Campo de contraseña -->
					<div class="mb-3">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
					</div>
					<?php
					// Muestra errores de validación si existen
					if (isset($errors['password'])) {
						echo '<p class="text-danger">' . $errors['password'] . '</p>';
					}
					?>

					<!-- Botón de enviar el formulario -->
					<button type="submit" class="btn btn-primary">Acceder</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Scripts de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
