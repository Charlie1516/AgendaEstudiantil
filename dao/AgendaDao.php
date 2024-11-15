<?php

require_once __DIR__ . "/../database/conexion.php";

class AgendaDao {
    private $conn;

    public function __construct() {
        $this->conn = create_conexion();
    }

    public function find(int $id) {
        $query = "SELECT * FROM agenda WHERE id=" . $id;
        $result = $this->conn->query($query);
        $agenda = [];
        while ($row = $result->fetch_assoc()) {
            $agenda[] = $row;
        }
        return array_shift($agenda);
    }

    public function getAll() {
        $query = "SELECT * FROM agenda";
        $result = $this->conn->query($query);
        $agenda = [];
        while ($row = $result->fetch_assoc()) {
            $agenda[] = $row;
        }
        return $agenda;
    }

    public function findAllRole(string $role) {
        $query = "SELECT * FROM agenda JOIN users ON agenda.user_id=users.id WHERE users.role='" . $role . "'";
        $result = $this->conn->query($query);
        $agenda = [];
        while ($row = $result->fetch_assoc()) {
            $agenda[] = $row;
        }
        return $agenda;
    }

    public function findAllUser(int $userId) {
        $query = "SELECT * FROM agenda WHERE user_id=" . $userId;
        $result = $this->conn->query($query);
        $agenda = [];
        while ($row = $result->fetch_assoc()) {
            $agenda[] = $row;
        }
        return $agenda;
    }

    public function filterAllUser(?int $userId, ?string $start, ?string $end) {
        $query = "SELECT a.id, a.date as start, a.type, a.title, a.description, u.fullname FROM agenda as a JOIN users as u ON a.user_id=u.id WHERE u.role='maestro' OR u.role='coordinador'";
        if ($userId) {
            $query .= " OR user_id=" . $userId;
        }
        if ($start && $end) {
            $query .= " AND a.date>='" . $start . "' AND a.date<='" . $end . "'";
        }
        $result = $this->conn->query($query);
        $agenda = [];
        while ($row = $result->fetch_assoc()) {
            $agenda[] = $row;
        }
        return $agenda;
    }

    public function create(int $userId, string $date, $type, string $title, string $description) {
        $query = "INSERT INTO agenda (user_id, date, type, title, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issss", $userId, $date, $type, $title, $description);
        return $stmt->execute();
    }

    public function remove($id) {
        $query = "DELETE FROM agenda WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
