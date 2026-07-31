<?php
require_once 'Conexion.php';

class Usuario {
    private $id;
    private $usuario;
    private $password;
    private $db;

    public function __construct() {
        $conexionObj = new Conexion();
        $this->db = $conexionObj->conectar();
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * Autentica un usuario mediante un procedimiento almacenado
     */
    public function autenticar($usuarioInput, $passwordInput) {
        try {
            // Invocación del procedimiento almacenado
            $stmt = $this->db->prepare("CALL sp_obtener_usuario_login(:usuario)");
            $stmt->bindParam(':usuario', $usuarioInput, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            // Verificar credenciales si se encontró el registro
            if ($data && password_verify($passwordInput, $data['password'])) {
                $this->id = $data['id'];
                $this->usuario = $data['usuario'];
                return true;
            }

            return false;
        } catch (PDOException $e) {
            error_log("Error en autenticación: " . $e->getMessage());
            return false;
        }
    }
}
?>
