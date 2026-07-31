<?php
class Conexion {
    private $host = "localhost";
    private $db_name = "sistema_login";
    private $username = "root";
    private $password = "";
    protected $conn;

    public function conectar() {
        if ($this->conn === null) {
            // Instancia del objeto mysqli (POO)
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            // Verificar errores de conexión
            if ($this->conn->connect_error) {
                die("Error de conexión: " . $this->conn->connect_error);
            }

            // Establecer el juego de caracteres
            $this->conn->set_charset("utf8");
        }
        return $this->conn;
    }
}
?>
