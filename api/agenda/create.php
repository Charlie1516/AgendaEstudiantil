<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/AgendaController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!AuthController::isAuth()) {
        http_response_code(401);
        echo json_encode(["success" => "false", "message" => "No iniciaste session."]);
        return;
    }
    if (isset($_POST["title"], $_POST["date"], $_POST["description"], $_POST["type"])) {
        $user_id = AuthController::getUserId();
        $title = $_POST['title'];
        $date = $_POST["date"];
        $description = $_POST["description"];
        $type = $_POST["type"];
        if (AgendaController::create($user_id, $date, $type, $title, $description)) {
            echo json_encode(["success" => "true", "message" => "Se guardo el evento en la agenda"]);
        } else {
            http_response_code(422);
            echo json_encode(["success" => "false", "message" => "No se pudo guardar el evento en la agenda"]);
        }
    } else {
        http_response_code(422);
        echo json_encode(["success" => "false", "message" => "Completa todos los parametros requeridos"]);
    }
} else {
    http_response_code(422);
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes POST"]);
}
