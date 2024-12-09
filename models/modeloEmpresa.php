<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

class modeloEmpresa {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::obtenerconexion();
    }

    public function listarEmpresas() {
        try {
            $query = $this->conexion->query(
                'SELECT id_empresa, nombre_comercial, razon_social, ruc, direccion, telefono, correo_electronico 
                 FROM EMPRESA'
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar empresas: ' . $e->getMessage());
        }
    }

    public function obtenerEmpresaPorId($id_empresa) {
        try {
            $query = $this->conexion->prepare(
                'SELECT id_empresa, nombre_comercial, razon_social, ruc, direccion, telefono, correo_electronico, 
                        pagina_web, codigo_postal, zona_tributaria, regimen_tributario, representante_legal 
                 FROM EMPRESA WHERE id_empresa = ?'
            );
            $query->execute([$id_empresa]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al obtener la empresa: ' . $e->getMessage());
        }
    }

    public function insertarEmpresa($datos) {
        try {
            $query = $this->conexion->prepare(
                'INSERT INTO EMPRESA (
                    nombre_comercial, razon_social, ruc, direccion, codigo_ubigeo, distrito, provincia, 
                    departamento, telefono, correo_electronico, pagina_web, codigo_postal, zona_tributaria, 
                    regimen_tributario, representante_legal, documento_representante, 
                    tipo_documento_representante, fecha_inicio_actividades, igv_empresa
                ) VALUES (
                    :nombre_comercial, :razon_social, :ruc, :direccion, :codigo_ubigeo, :distrito, :provincia, 
                    :departamento, :telefono, :correo_electronico, :pagina_web, :codigo_postal, :zona_tributaria, 
                    :regimen_tributario, :representante_legal, :documento_representante, 
                    :tipo_documento_representante, :fecha_inicio_actividades, :igv_empresa
                )'
            );

            $query->execute($datos);
            return true;
        } catch (PDOException $e) {
            throw new Exception('Error al registrar empresa: ' . $e->getMessage());
        }
    }

    public function modificarEmpresa($id_empresa, $datos) {
        try {
            $query = $this->conexion->prepare(
                'UPDATE EMPRESA SET 
                    nombre_comercial = :nombre_comercial, razon_social = :razon_social, ruc = :ruc, 
                    direccion = :direccion, codigo_ubigeo = :codigo_ubigeo, distrito = :distrito, 
                    provincia = :provincia, departamento = :departamento, telefono = :telefono, 
                    correo_electronico = :correo_electronico, pagina_web = :pagina_web, 
                    codigo_postal = :codigo_postal, zona_tributaria = :zona_tributaria, 
                    regimen_tributario = :regimen_tributario, representante_legal = :representante_legal, 
                    documento_representante = :documento_representante, 
                    tipo_documento_representante = :tipo_documento_representante, 
                    fecha_inicio_actividades = :fecha_inicio_actividades, igv_empresa = :igv_empresa 
                WHERE id_empresa = :id_empresa'
            );

            $datos['id_empresa'] = $id_empresa;
            $query->execute($datos);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al actualizar empresa: ' . $e->getMessage());
        }
    }

    public function eliminarEmpresa($id_empresa) {
        try {
            $query = $this->conexion->prepare('DELETE FROM EMPRESA WHERE id_empresa = ?');
            $query->execute([$id_empresa]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar empresa: ' . $e->getMessage());
        }
    }
}
?>
