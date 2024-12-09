<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

class modeloCertificadoDigital {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerconexion();
    }

    public function listarCertificados() {
        try {
            $query = $this->conexion->query(
                'SELECT NOMBRE, CLAVE, VIGENCIAINICIO, VIGENCIAFIN, ACTIVO FROM CERTIFICADODIGITAL'
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar certificados: ' . $e->getMessage());
        }
    }

    public function obtenerCertificadoPorNombre($nombre) {
        try {
            $query = $this->conexion->prepare(
                'SELECT NOMBRE, CLAVE, VIGENCIAINICIO, VIGENCIAFIN, ACTIVO 
                 FROM CERTIFICADODIGITAL WHERE NOMBRE = ?'
            );
            $query->execute([$nombre]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al obtener el certificado: ' . $e->getMessage());
        }
    }

    public function insertarCertificado($datos) {
        try {
            $query = $this->conexion->prepare(
                'INSERT INTO CERTIFICADODIGITAL (
                    NOMBRE, CLAVE, VIGENCIAINICIO, VIGENCIAFIN, ARCHIVO, ACTIVO
                 ) VALUES (
                    :nombre, :clave, :vigenciainicio, :vigenciafin, :archivo, :activo
                 )'
            );

            $query->execute([
                ':nombre' => $datos['nombre'],
                ':clave' => $datos['clave'],
                ':vigenciainicio' => $datos['vigenciainicio'],
                ':vigenciafin' => $datos['vigenciafin'],
                ':archivo' => $datos['archivo'],
                ':activo' => $datos['activo']
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error al insertar el certificado: ' . $e->getMessage());
        }
    }

    public function modificarCertificado($nombre, $datos) {
        try {
            $query = $this->conexion->prepare(
                'UPDATE CERTIFICADODIGITAL SET 
                    CLAVE = :clave, 
                    VIGENCIAINICIO = :vigenciainicio, 
                    VIGENCIAFIN = :vigenciafin, 
                    ARCHIVO = :archivo, 
                    ACTIVO = :activo 
                 WHERE NOMBRE = :nombre'
            );

            $query->execute([
                ':nombre' => $nombre,
                ':clave' => $datos['clave'],
                ':vigenciainicio' => $datos['vigenciainicio'],
                ':vigenciafin' => $datos['vigenciafin'],
                ':archivo' => $datos['archivo'],
                ':activo' => $datos['activo']
            ]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al modificar el certificado: ' . $e->getMessage());
        }
    }

    public function eliminarCertificado($nombre) {
        try {
            $query = $this->conexion->prepare('DELETE FROM CERTIFICADODIGITAL WHERE NOMBRE = ?');
            $query->execute([$nombre]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar el certificado: ' . $e->getMessage());
        }
    }
}
?>
