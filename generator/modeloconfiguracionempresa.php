<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

class modeloConfiguracionEmpresa {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerconexion();
    }

    public function listarConfiguracionEmpresa() {
        try {
            $query = $this->conexion->query(
                'SELECT 
                    PARAMETRO,
                    VALOR,
                    CATEGORIA
                 FROM CONFIGURACION'
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar configuraciones: ' . $e->getMessage());
        }
    }

    public function insertarConfiguracionEmpresa($datos) {
        try {
            $query = $this->conexion->prepare(
                'INSERT INTO CONFIGURACION (
                    PARAMETRO,
                    VALOR,
                    CATEGORIA
                ) VALUES (
                    :PARAMETRO,
                    :VALOR,
                    :CATEGORIA
                )'
            );
            $query->bindParam(':PARAMETRO', $datos['PARAMETRO']);
            $query->bindParam(':VALOR', $datos['VALOR']);
            $query->bindParam(':CATEGORIA', $datos['CATEGORIA']);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al insertar configuracion: ' . $e->getMessage());
        }
    }

    public function modificarConfiguracionEmpresa($parametro, $datos) {
        try {
            $query = $this->conexion->prepare(
                'UPDATE CONFIGURACION SET 
                    VALOR = :VALOR,
                    CATEGORIA = :CATEGORIA
                WHERE PARAMETRO = :parametro'
            );
            $query->bindParam(':VALOR', $datos['VALOR']);
            $query->bindParam(':CATEGORIA', $datos['CATEGORIA']);
            $query->bindParam(':parametro', $parametro);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al modificar configuracion: ' . $e->getMessage());
        }
    }
    public function eliminarConfiguracionEmpresa($parametro) {
        try {
            $query = $this->conexion->prepare('DELETE FROM CONFIGURACION WHERE PARAMETRO = ?');
            $query->execute([$parametro]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar configuracion: ' . $e->getMessage());
        }
    }
}
?>
