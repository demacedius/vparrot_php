<?php
class Database {
    private $db;

    public function __construct() {
        require_once __DIR__ . '/connect.php';
        $this->db = $db;
    }

    public function getConnection() {
        return $this->db;
    }
}
