<?php
require_once __DIR__ . "/controller/AuthController.php";
require_once __DIR__ . "/controller/UserController.php";

AuthController::checkAuth();

UserController::removeUser(AuthController::getUserId());
AuthController::logout();
