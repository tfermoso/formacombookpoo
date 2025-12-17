<?php 


class Database {

    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../config.php';
        $this->host = DB_HOST;
        $this->db_name = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
    }   

    // Método para obtener la conexión
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );

            // Configuración recomendada
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception) {
            die("Error de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }
}

?>