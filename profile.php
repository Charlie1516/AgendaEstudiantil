<?php
// Incluye los controladores necesarios
require_once __DIR__ . "/controller/AuthController.php";
require_once __DIR__ . "/controller/UserController.php";

// Verifica si el usuario está autenticado
AuthController::checkAuth();

// Obtiene información del usuario autenticado
$userInfo = UserController::getUser(AuthController::getUserId());
?>
<html>

<head>
    <title>PERFIL - AGENDA ESTUDIANTIL</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Enlace al archivo CSS personalizado -->
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <?php include "templates/navbar.php"; ?>
    <!-- Contenedor principal -->
    <div class="container my-5">
        <!-- Sección de perfil del entrenador -->
        <div class="card col-md-10 mx-auto mb-5">
            <div class="card-header">
                PERFIL DEL ESTUDIANTIL
            </div>
            <ul class="list-group list-group-flush p-3">
                <div class="d-flex">
                    <!-- Información y avatar del usuario -->
                    <div class="d-flex align-items-center flex-column gap-2">
                    <?php
                        // Muestra el avatar dependiendo del género del usuario
                        if ($userInfo['gender'] === 1) {
                        ?>
                            <img src='./images/hombre.png' width='96' />
                            <span class="badge text-bg-light">Masculino</span>
                        <?php
                        } else if ($userInfo['gender'] === 2) {
                        ?>
                            <img src='./images/mujer.png' width='96' />
                            <span class="badge text-bg-light">Femenino</span>
                        <?php
                        }
                        ?>
                        <h6>
                        </h6>
                    </div>
                    <!-- Información personal del usuario -->
                    <div class="d-flex flex-column justify-content-center ms-4">
                        <h5>ESTUDIANTE:</h5>
                        <p class="mt-0 mb-2"><?= $userInfo['fullname'] ?></p>
                        <h5>Usuario:</h5>
                        <p class="mt-0 mb-2"><?= $userInfo['username'] ?></p>
                        <h5>Rol:</h5>
                        <p class="mt-0 mb-2"><?= $userInfo['role'] ?></p>
                        <h5>CORREO INSTITUCIONAL:</h5>
                        <p class="mt-0 mb-2"><?= $userInfo['email'] ?></p>
                    </div>
                    <!-- Botón para eliminar cuenta -->
                    <div class="d-flex flex-column justify-content-end ms-auto">
                        <form action="./remove-account.php" method="post">
                            <button class="btn btn-danger">
                                Eliminar cuenta
                            </button>
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>
