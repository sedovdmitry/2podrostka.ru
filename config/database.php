<?php
require_once 'constants.php';

class Database {
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("SET CLIENT_ENCODING TO 'UTF8'");
        } catch(PDOException $e) {
            if (DEBUG_MODE) {
                error_log("Database connection error: " . $e->getMessage());
            }
        }

        return $this->conn;
    }
}
?>