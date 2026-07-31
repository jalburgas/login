<?php
class Conexion {
    private $host = "localhost";
    private $db_name = "sistema_login";
    private $username = "root";
    private $password = "";
    protected $pdo;

    public function conectar() {
        if ($this->pdo === null) {
            try {
                $dns = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
                $this->pdo = new PDO($dns, $this->username, $this->password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
?>
