<?php
require_once __DIR__ . "/controller/AuthController.php";
require_once __DIR__ . "/controller/AgendaController.php";

if (AuthController::isAuth()) {
    $agendas = AgendaController::findAllUser(AuthController::getUserId());
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include "templates/navbar.php"; ?>
    <header class="container">
        <div class="row">
            <div class="p-3 text-bg-dark col-md-10 my-5 mx-auto">

                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="./" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <img src="./images/logo.jpeg" width="200" alt="Logo">
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="./" class="nav-link px-2 text-white fw-bold fs-4">AGENDA ESTUDIANTIL</a></li>
                    </ul>
                    <div class="btn-group rounded-0">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container p-3">
        <div class="row">
            <div id='calendar'></div>
        </div>

    </div>
    <div class="modal fade" id="createEvent" tabindex="-1" aria-labelledby="createEventLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-3" id="createEventLabel">Crear evento</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createEventForm" class="needs-validation" novalidate>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="title" class="form-label">NOMBRE DE LA TAREA</label>
                                <input type="text" class="form-control rounded-0" id="title" placeholder="" name="title" required>
                                <div class="invalid-feedback">
                                    PON EL NOMBRE DE LA TAREA
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="date" class="form-label">Tipo de evento</label>
                                <select class="form-select rounded-0" name="type" id="type" required>
                                    <option value="Tarea" selected>Tarea</option>
                                    <option value="Actividad">Actividad</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="date" class="form-label">FECHA DE ENTREGA</label>
                                <input type="datetime-local" class="form-control rounded-0" id="date" placeholder="" name="date" required>
                                <div class="invalid-feedback">
                                    PON LA FECHA DE LA TAREA
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">DESCRIPCION</label>
                                <textarea class="form-control rounded-0" name="description" id="description" required></textarea>
                                <div class="invalid-feedback">
                                    PON LA DESCRIPCION DE LA TAREA
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end gap-3">
                            <button type="button" class="btn btn-secondary rounded-0 btn-lg " data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary rounded-0 btn-lg ">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showEventModal" tabindex="-1" aria-labelledby="showEventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-3" id="event-title"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-2">
                        <div class="card-body mb-3">
                            <h6 class="card-subtitle mb-2 text-body-secondary badge text-bg-light" id="event-type"></h6>
                            <p class="card-text" id="event-description"></p>
                        </div>
                        <div class="border-top pt-4 p-0 m-0">
                            <small class="list-group-item px-2">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>Fecha: <span id="event-date"></span>
                            </small>
                            <small class="list-group-item px-2">
                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512">
                                    <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                </svg>Publicado por: <span id="event-fullname"></span>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" event-id="" id="delete-event">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script src="./js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

        });
    </script>
</body>

</html>