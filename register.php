<?php
// Incluye el controlador de autenticación
require_once "controller/AuthController.php";

// Llama a la función de registro del controlador de autenticación
AuthController::register();
?>
<html>

<head>
	<title>REGISTRO | POKEMON DYNAMAX</title>
	<!-- Enlace al archivo CSS de Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
	<?php include "templates/navbar.php"; ?>
	<div class="container">
		<div class="row my-5">
			<div class="card col-md-6 mx-auto p-4">
				<h2 class="text-center">Registro</h2>

				<!-- Formulario de registro -->
				<form role="form" action="register.php" method="post">
					<div class="mb-3">
						<label for="username">Nombre de usuario</label>
						<input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario" required>
					</div>
					<?php
					// Muestra mensajes de error para el nombre de usuario si existen
					if (isset($errors['username'])) {
						echo '<p class="text-danger">' . $errors['username'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="fullname">Nombre Completo</label>
						<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nombre Completo" required>
					</div>
					<?php
					// Muestra mensajes de error para el nombre completo si existen
					if (isset($errors['fullname'])) {
						echo '<p class="text-danger">' . $errors['fullname'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="role">Rol</label>
						<!-- Selección del género -->
						<select class="form-control" name="role" id="role" required>
							<option value="alumno">Alumno</option>
							<option value="maestro">Maestro</option>
							<option value="coordinador">Coordinador</option>
						</select>
					</div>
					<?php
					// Muestra mensajes de error para el género si existen
					if (isset($errors['role'])) {
						echo '<p class="text-danger">' . $errors['role'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="gender">Genero</label>
						<!-- Selección del género -->
						<select class="form-control" name="gender" id="gender" required>
							<option value="1" selected>Masculino</option>
							<option value="2">Femenino</option>
						</select>
					</div>
					<?php
					// Muestra mensajes de error para el género si existen
					if (isset($errors['gender'])) {
						echo '<p class="text-danger">' . $errors['gender'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="email">Correo Electrónico</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
					</div>
					<?php
					// Muestra mensajes de error para el correo electrónico si existen
					if (isset($errors['email'])) {
						echo '<p class="text-danger">' . $errors['email'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
					</div>
					<?php
					// Muestra mensajes de error para la contraseña si existen
					if (isset($errors['password'])) {
						echo '<p class="text-danger">' . $errors['password'] . '</p>';
					}
					?>
					<div class="mb-3">
						<label for="confirm_password">Confirmar Contraseña</label>
						<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña" required>
					</div>
					<?php
					// Muestra mensajes de error para la confirmación de contraseña si existen
					if (isset($errors['confirm_password'])) {
						echo '<p class="text-danger">' . $errors['confirm_password'] . '</p>';
					}
					?>
					<button type="submit" class="btn btn-success">Registrar</button>
				</form>
			</div>
		</div>
	</div>
	<!-- Script de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
