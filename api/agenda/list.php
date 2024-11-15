<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/AgendaController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $start = $_GET['start'] ?? null;
    $end = $_GET['end'] ?? null;

    $agendas = AgendaController::filterAllUser(AuthController::getUserId(), $start, $end);

    echo json_encode($agendas);
} else {
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes GET"]);
}
