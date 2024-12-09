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
                'SELECT 
                    nombre_comercial,
                    razon_social,
                    ruc,
                    tipo_documento,
                    direccion,
                    codigo_ubigeo,
                    distrito,
                    provincia,
                    departamento,
                    pais,
                    telefono,
                    correo_electronico,
                    pagina_web,
                    codigo_postal,
                    zona_tributaria,
                    regimen_tributario,
                    tipo_contribuyente,
                    estado_empresa,
                    representante_legal,
                    documento_representante,
                    tipo_documento_representante,
                    fecha_inicio_actividades,
                    fecha_creacion,
                    fecha_actualizacion,
                    igv_empresa
                 FROM Empresa'
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al listar Empresas: ' . $e->getMessage());
        }
    }

    public function obtenerEmpresaPorId($id) {
        try {
            $query = $this->conexion->prepare(
                'SELECT 
                    nombre_comercial,
                    razon_social,
                    ruc,
                    tipo_documento,
                    direccion,
                    codigo_ubigeo,
                    distrito,
                    provincia,
                    departamento,
                    pais,
                    telefono,
                    correo_electronico,
                    pagina_web,
                    codigo_postal,
                    zona_tributaria,
                    regimen_tributario,
                    tipo_contribuyente,
                    estado_empresa,
                    representante_legal,
                    documento_representante,
                    tipo_documento_representante,
                    fecha_inicio_actividades,
                    fecha_creacion,
                    fecha_actualizacion,
                    igv_empresa
                 FROM Empresa WHERE nombre_comercial = ?'
            );
            $query->execute([$id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error al obtener Empresa: ' . $e->getMessage());
        }
    }

    public function insertarEmpresa($datos) {
        try {
            $query = $this->conexion->prepare(
                'INSERT INTO Empresa (
                    razon_social,
                    ruc,
                    tipo_documento,
                    direccion,
                    codigo_ubigeo,
                    distrito,
                    provincia,
                    departamento,
                    pais,
                    telefono,
                    correo_electronico,
                    pagina_web,
                    codigo_postal,
                    zona_tributaria,
                    regimen_tributario,
                    tipo_contribuyente,
                    estado_empresa,
                    representante_legal,
                    documento_representante,
                    tipo_documento_representante,
                    fecha_inicio_actividades,
                    fecha_creacion,
                    fecha_actualizacion,
                    igv_empresa
                ) VALUES (
                    :razon_social,
                    :ruc,
                    :tipo_documento,
                    :direccion,
                    :codigo_ubigeo,
                    :distrito,
                    :provincia,
                    :departamento,
                    :pais,
                    :telefono,
                    :correo_electronico,
                    :pagina_web,
                    :codigo_postal,
                    :zona_tributaria,
                    :regimen_tributario,
                    :tipo_contribuyente,
                    :estado_empresa,
                    :representante_legal,
                    :documento_representante,
                    :tipo_documento_representante,
                    :fecha_inicio_actividades,
                    :fecha_creacion,
                    :fecha_actualizacion,
                    :igv_empresa
                )'
            );
            $query->bindParam(':razon_social', $datos['razon_social']);
            $query->bindParam(':ruc', $datos['ruc']);
            $query->bindParam(':tipo_documento', $datos['tipo_documento']);
            $query->bindParam(':direccion', $datos['direccion']);
            $query->bindParam(':codigo_ubigeo', $datos['codigo_ubigeo']);
            $query->bindParam(':distrito', $datos['distrito']);
            $query->bindParam(':provincia', $datos['provincia']);
            $query->bindParam(':departamento', $datos['departamento']);
            $query->bindParam(':pais', $datos['pais']);
            $query->bindParam(':telefono', $datos['telefono']);
            $query->bindParam(':correo_electronico', $datos['correo_electronico']);
            $query->bindParam(':pagina_web', $datos['pagina_web']);
            $query->bindParam(':codigo_postal', $datos['codigo_postal']);
            $query->bindParam(':zona_tributaria', $datos['zona_tributaria']);
            $query->bindParam(':regimen_tributario', $datos['regimen_tributario']);
            $query->bindParam(':tipo_contribuyente', $datos['tipo_contribuyente']);
            $query->bindParam(':estado_empresa', $datos['estado_empresa']);
            $query->bindParam(':representante_legal', $datos['representante_legal']);
            $query->bindParam(':documento_representante', $datos['documento_representante']);
            $query->bindParam(':tipo_documento_representante', $datos['tipo_documento_representante']);
            $query->bindParam(':fecha_inicio_actividades', $datos['fecha_inicio_actividades']);
            $query->bindParam(':fecha_creacion', $datos['fecha_creacion']);
            $query->bindParam(':fecha_actualizacion', $datos['fecha_actualizacion']);
            $query->bindParam(':igv_empresa', $datos['igv_empresa']);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al insertar Empresa: ' . $e->getMessage());
        }
    }

    public function modificarEmpresa($id, $datos) {
        try {
            $query = $this->conexion->prepare(
                'UPDATE Empresa SET 
                    razon_social = :razon_social,
                    ruc = :ruc,
                    tipo_documento = :tipo_documento,
                    direccion = :direccion,
                    codigo_ubigeo = :codigo_ubigeo,
                    distrito = :distrito,
                    provincia = :provincia,
                    departamento = :departamento,
                    pais = :pais,
                    telefono = :telefono,
                    correo_electronico = :correo_electronico,
                    pagina_web = :pagina_web,
                    codigo_postal = :codigo_postal,
                    zona_tributaria = :zona_tributaria,
                    regimen_tributario = :regimen_tributario,
                    tipo_contribuyente = :tipo_contribuyente,
                    estado_empresa = :estado_empresa,
                    representante_legal = :representante_legal,
                    documento_representante = :documento_representante,
                    tipo_documento_representante = :tipo_documento_representante,
                    fecha_inicio_actividades = :fecha_inicio_actividades,
                    fecha_creacion = :fecha_creacion,
                    fecha_actualizacion = :fecha_actualizacion,
                    igv_empresa = :igv_empresa
                WHERE nombre_comercial = :id'
            );
            $query->bindParam(':razon_social', $datos['razon_social']);
            $query->bindParam(':ruc', $datos['ruc']);
            $query->bindParam(':tipo_documento', $datos['tipo_documento']);
            $query->bindParam(':direccion', $datos['direccion']);
            $query->bindParam(':codigo_ubigeo', $datos['codigo_ubigeo']);
            $query->bindParam(':distrito', $datos['distrito']);
            $query->bindParam(':provincia', $datos['provincia']);
            $query->bindParam(':departamento', $datos['departamento']);
            $query->bindParam(':pais', $datos['pais']);
            $query->bindParam(':telefono', $datos['telefono']);
            $query->bindParam(':correo_electronico', $datos['correo_electronico']);
            $query->bindParam(':pagina_web', $datos['pagina_web']);
            $query->bindParam(':codigo_postal', $datos['codigo_postal']);
            $query->bindParam(':zona_tributaria', $datos['zona_tributaria']);
            $query->bindParam(':regimen_tributario', $datos['regimen_tributario']);
            $query->bindParam(':tipo_contribuyente', $datos['tipo_contribuyente']);
            $query->bindParam(':estado_empresa', $datos['estado_empresa']);
            $query->bindParam(':representante_legal', $datos['representante_legal']);
            $query->bindParam(':documento_representante', $datos['documento_representante']);
            $query->bindParam(':tipo_documento_representante', $datos['tipo_documento_representante']);
            $query->bindParam(':fecha_inicio_actividades', $datos['fecha_inicio_actividades']);
            $query->bindParam(':fecha_creacion', $datos['fecha_creacion']);
            $query->bindParam(':fecha_actualizacion', $datos['fecha_actualizacion']);
            $query->bindParam(':igv_empresa', $datos['igv_empresa']);
            $query->bindParam(':id', $id);
            return $query->execute();
        } catch (PDOException $e) {
            throw new Exception('Error al modificar Empresa: ' . $e->getMessage());
        }
    }

    public function eliminarEmpresa($id) {
        try {
            $query = $this->conexion->prepare('DELETE FROM Empresa WHERE nombre_comercial = ?');
            $query->execute([$id]);
            return $query->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception('Error al eliminar Empresa: ' . $e->getMessage());
        }
    }
}
?>
