<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/FavoriteController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!AuthController::isAuth()) {
        echo json_encode(["success" => "false", "message" => "No iniciaste session."]);
        return;
    }
    if (isset($_POST["item_id"])) {
        $user_id = $_SESSION['user_id'];
        $item_id = $_POST["item_id"];

        $favoriteController = new FavoriteController();

        $favoriteResult = $favoriteController->toggleItemFavorite($user_id, $item_id);
        if ($favoriteResult == FavoriteController::ITEM_FAVORITE_ADD) {
            echo json_encode(["success" => "true", 'mode' => FavoriteController::ITEM_FAVORITE_ADD, "message" => "Se guardo como favorito el item seleccionado"]);
        } elseif ($favoriteResult == FavoriteController::ITEM_FAVORITE_MAX) {
            echo json_encode(["success" => "false", 'mode' => FavoriteController::ITEM_FAVORITE_MAX, "message" => "Ya tienes el maximo permitido de " . FavoriteController::MAX_ITEMS . " items como favorito"]);
        } else {
            echo json_encode(["success" => "true", 'mode' => FavoriteController::ITEM_FAVORITE_DEL, "message" => "Se elimino de favorito el item seleccionado"]);
        }
    } else {
        echo json_encode(["success" => "false", "message" => "Se requieren los parámetros item_id"]);
    }
} else {
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes POST"]);
}
