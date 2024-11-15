<?php

require_once __DIR__ . "/../dao/AgendaDao.php";

class AgendaController {
    public static function getAll() {
        $agendaDao = new AgendaDao();
        return $agendaDao->getAll();
    }
    
    public static function find(int $id) {
        $agendaDao = new AgendaDao();
        return $agendaDao->find($id);
    }

    public static function filterAllUser(?int $userId, ?string $start, ?string $end) {
        $agendaDao = new AgendaDao();
        return $agendaDao->filterAllUser($userId, $start, $end);
    }

    public static function findAllRole(string $role) {
        $agendaDao = new AgendaDao();
        return $agendaDao->findAllRole($role);
    }

    public static function findAllUser(int $userId) {
        $agendaDao = new AgendaDao();
        return $agendaDao->findAllUser($userId);
    }

    public static function create(int $userId, string $date, string $type, string $title, string $description) {
        $agendaDao = new AgendaDao();
        return $agendaDao->create($userId, $date, $type, $title, $description);
    }

    public static function remove($id) {
        $agendaDao = new AgendaDao();
        return $agendaDao->remove($id);
    }
}
