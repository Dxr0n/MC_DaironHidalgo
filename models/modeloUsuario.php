<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

class modeloUsuario{
    private $conexion;

    public function __construct(){
        $this->conexion = Conexion::obtenerconexion();
    }

    public function validarUsuarios($username, $password) {
        $query = "SELECT username, password FROM usuarios WHERE BINARY username = :username AND password = :password LIMIT 1";
        $stmt = $this->conexion->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function obtenerUsuarios(){
        $query = $this->conexion->query('SELECT id, username, password, perfil FROM usuarios');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarUsuario($username, $password, $perfil) {
        try {
            $query = $this->conexion->prepare('INSERT INTO usuarios (username, password, perfil) VALUES (?, ?, ?)');
            $query->execute([$username, $password, $perfil]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error al registrar usuario: ' . $e->getMessage());
        }
    }

    public function eliminarUsuario($id) {
        try {
            $query = $this->conexion->prepare('DELETE FROM usuarios WHERE id = ?');
            $query->execute([$id]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar usuario: ' . $e->getMessage());
        }
    }

    public function obtenerUsuarioPorId($id) {
        try {
            $query = $this->conexion->prepare('SELECT id, username, password, perfil FROM usuarios WHERE id = ?');
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al obtener el usuario: ' . $e->getMessage());
        }
    }

    public function modificarUsuario($id, $username, $password, $perfil) {
        try {
            $query = $this->conexion->prepare('UPDATE usuarios SET username = ?, password = ?, perfil = ? WHERE id = ?');
            $query->execute([$username, $password, $perfil, $id]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    public function listarUsuarios() {
        try {
            $query = $this->conexion->query('SELECT id, username, perfil FROM usuarios');
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar usuarios: ' . $e->getMessage());
        }
    }

}
?>