<?php

require_once __DIR__ . "/../../controller/AuthController.php";
require_once __DIR__ . "/../../controller/FavoriteController.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!AuthController::isAuth()) {
        echo json_encode(["success" => "false", "message" => "No iniciaste session."]);
        return;
    }
    if (isset($_POST["pokemon_id"])) {
        $user_id = $_SESSION['user_id'];
        $pokemon_id = $_POST["pokemon_id"];

        $favoriteController = new FavoriteController();

        $favoriteResult = $favoriteController->togglePokemonFavorite($user_id, $pokemon_id);
        if ($favoriteResult == FavoriteController::POKEMON_FAVORITE_ADD) {
            echo json_encode(["success" => "true", 'mode' => FavoriteController::POKEMON_FAVORITE_ADD, "message" => "Se guardo como favorito el pokemon seleccionado"]);
        } elseif ($favoriteResult == FavoriteController::POKEMON_FAVORITE_MAX) {
            echo json_encode(["success" => "false", 'mode' => FavoriteController::POKEMON_FAVORITE_MAX, "message" => "Ya tienes el maximo permitido de " . FavoriteController::MAX_POKEMONS . " pokemons como favorito"]);
        } else {
            echo json_encode(["success" => "true", 'mode' => FavoriteController::POKEMON_FAVORITE_DEL, "message" => "Se elimino de favorito el pokemon seleccionado"]);
        }
    } else {
        echo json_encode(["success" => "false", "message" => "Se requieren los parámetros pokemon_id"]);
    }
} else {
    echo json_encode(["success" => "false", "message" => "Este endpoint solo acepta solicitudes POST"]);
}
