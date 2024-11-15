<?php

require_once __DIR__ . "/../database/conexion.php";

class UserDao {
    private $conn;

    public function __construct() {
        $this->conn = create_conexion();
    }

    public function getAll() {
        $query = "SELECT * FROM users";
        $result = $this->conn->query($query);
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function create($fullname, $role, $username, $gender, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (fullname, role, username, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssiss", $fullname, $role, $username, $gender, $email, $hash);
        return $stmt->execute();
    }

    public function remove($id) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function find($id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            return false; // No se encontró el usuario con el correo electrónico dado
        }
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            return $row;
        } else {
            return false;
        }
    }

    public function findUser($username, $email) {
        $query = "SELECT * FROM users WHERE username = ? or email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function register($fullname, $role, $username, $gender, $email, $password) {

        $result = $this->findUser($username, $email);
        if (!empty($result)) {
            return false;
        }
        return $this->create($fullname, $role, $username, $gender, $email, $password);
    }
}
