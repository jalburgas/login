-- 1. Crear e indicar el uso de la base de datos
CREATE DATABASE IF NOT EXISTS sistema_login;
USE sistema_login;

-- 2. Crear la tabla de usuarios
-- Nota: 'password' usa VARCHAR(255) para almacenar hashes seguros de PHP (password_hash)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. Crear el procedimiento almacenado para obtener los datos del usuario en el Login
DELIMITER //

CREATE PROCEDURE sp_obtener_usuario_login(
    IN p_usuario VARCHAR(50)
)
BEGIN
    SELECT id, usuario, password 
    FROM usuarios 
    WHERE usuario = p_usuario;
END //

DELIMITER ;

-- 4. Insertar un usuario de prueba
-- Usuario: admin
-- Contraseña plana: 123456 (encriptada con BCRYPT/password_hash)
INSERT INTO usuarios (usuario, password, email) 
VALUES (
    'admin', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'admin@correo.com'
);
