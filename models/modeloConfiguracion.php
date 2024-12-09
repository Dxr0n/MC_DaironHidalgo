<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

class modeloConfiguracion {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerconexion();
    }

    public function listarConfiguraciones() {
        try {
            $query = $this->conexion->query(
                'SELECT PARAMETRO, VALOR, CATEGORIA FROM CONFIGURACION'
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar configuraciones: ' . $e->getMessage());
        }
    }

    public function obtenerConfiguracionPorParametro($parametro) {
        try {
            $query = $this->conexion->prepare(
                'SELECT PARAMETRO, VALOR, CATEGORIA FROM CONFIGURACION WHERE PARAMETRO = ?'
            );
            $query->execute([$parametro]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al obtener la configuración: ' . $e->getMessage());
        }
    }

    public function insertarConfiguracion($datos) {
        try {
            $query = $this->conexion->prepare(
                'INSERT INTO CONFIGURACION (PARAMETRO, VALOR, CATEGORIA) 
                 VALUES (:parametro, :valor, :categoria)'
            );

            $query->execute([
                ':parametro' => $datos['parametro'],
                ':valor' => $datos['valor'],
                ':categoria' => $datos['categoria']
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error al insertar la configuración: ' . $e->getMessage());
        }
    }

    public function modificarConfiguracion($parametro, $datos) {
        try {
            $query = $this->conexion->prepare(
                'UPDATE CONFIGURACION SET 
                    VALOR = :valor, 
                    CATEGORIA = :categoria 
                 WHERE PARAMETRO = :parametro'
            );

            $query->execute([
                ':parametro' => $parametro,
                ':valor' => $datos['valor'],
                ':categoria' => $datos['categoria']
            ]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al modificar la configuración: ' . $e->getMessage());
        }
    }
    
    public function eliminarConfiguracion($parametro) {
        try {
            $query = $this->conexion->prepare('DELETE FROM CONFIGURACION WHERE PARAMETRO = ?');
            $query->execute([$parametro]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar la configuración: ' . $e->getMessage());
        }
    }
}
?>
