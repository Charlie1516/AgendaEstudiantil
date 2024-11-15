<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/AgendaController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!AuthController::isAuth()) {
        http_response_code(401);
        echo json_encode(["success" => "false", "message" => "No iniciaste session."]);
    } elseif (!isset($_POST['id'])) {
        http_response_code(422);
        echo json_encode(["success" => "false", "message" => "Completa todos los parametros requeridos"]);
    } else {
        $id = $_POST['id'];
        $agenda = AgendaController::find($id);
        if ($agenda && $agenda['user_id'] == AuthController::getUserId()) {
            AgendaController::remove($id);
            echo json_encode(["success" => "true", "message" => "La agenda fue eliminado"]);
        } elseif ($agenda) {
            http_response_code(422);
            echo json_encode(["success" => "false", "message" => "No puedes eliminar la agenda de otro"]);
        } else {
            http_response_code(422);
            echo json_encode(["success" => "false", "message" => "La agenda ya no existe"]);
        }
    }
} else {
    http_response_code(422);
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes POST"]);
}
