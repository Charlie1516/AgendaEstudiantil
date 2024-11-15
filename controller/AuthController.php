<?php

require_once __DIR__ . "/../dao/UserDao.php";
require_once __DIR__ . "/../utils/Utils.php";

@session_start();

class AuthController
{
    public static function login()
    {
        if (AuthController::isAuth()) {
            header("location: profile.php");
            return;
        }

        if (!empty($_POST)) {
            global $errors;

            $errors = Utils::validate($_POST, [
                'username' => 'El campo usuario es obligatorio',
                'password' => 'El campo contraseña es obligatorio'
            ]);

            if (count($errors) == 0) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $userDao = new UserDao();
                $user = $userDao->login($username, $password);
                if ($user != false) {
                    $_SESSION["user_id"] = $user['id'];
                    $_SESSION["fullname"] = $user['fullname'];
                    header("location: profile.php");
                }else{
                    $errors['username'] = "Usuario o contraseña no validos";
                }
            }
        }
    }

    public static function register()
    {
        if (AuthController::isAuth()) {
            header("location: profile.php");
            return;
        }

        if (!empty($_POST)) {
            global $errors;

            $errors = Utils::validate($_POST, [
                'fullname' => 'El campo nombre completo es obligatorio',
                'username' => 'El campo nombre de usuario es obligatorio',
                'role' => 'El campo genero es obligatorio',
                'gender' => 'El campo genero es obligatorio',
                'email' => 'El campo email es obligatorio',
                'password' => 'El campo contraseña es obligatorio'
            ]);

            if (count($errors) == 0) {
                if ($_POST['password'] != $_POST['confirm_password']) {
                    $errors['password'] = "Las contraseñas no coinciden";
                }
                if (!ctype_alnum($_POST['username'])) {
                    $errors['username'] = "Solo se permiten numeros y caracteres sin espacios";
                }
            }

            if (count($errors) == 0) {
                $fullname = $_POST['fullname'];
                $role = $_POST['role'];
                $username = $_POST['username'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                try {
                    $userDao = new UserDao();
                    if ($userDao->register($fullname, $role, $username, $gender, $email, $password) !== false) {
                        header("location: login.php");
                    } else {
                        $errors['username'] = "Usuario o email ya existen";
                    }
                } catch (Exception $th) {
                }
            }
        }
    }

    public static function isAuth()
    {
        return isset($_SESSION['user_id']);
    }

    public static function checkAuth()
    {
        if (!AuthController::isAuth()) {
            header("location: ./login.php");
        }
    }

    public static function getUserId()
    {
        return $_SESSION['user_id'] ?? null;
    }
    
    public static function getName()
    {
        return $_SESSION['fullname'] ?? null;
    }

    public  static function logout()
    {
        session_destroy();

        header("location: login.php");
    }
}
