<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/FavoriteController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!AuthController::isAuth()) {
        http_response_code(403);
        echo "Prohibido";
        echo json_encode(["success" => "false", "message" => "No iniciaste session."]);
        return;
    }
    $user_id = $_SESSION['user_id'];

    $favoriteController = new FavoriteController();
    $userFavorites = $favoriteController->getPokemonFavorites($user_id);

    echo json_encode($userFavorites);
} else {
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes GET"]);
}
