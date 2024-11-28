<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaEliminarUsuario.php';

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

$usuario = null; 
$mensaje = '';  

if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']);  
}

$delete_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $delete_id = filter_var($_GET['delete_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if ($delete_id === false) {
        $_SESSION['mensaje'] = 'Error: El ID debe ser un número positivo.';
        header('Location: ' . get_urlBase('controllers/controladorEliminarUsuario.php'));
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmar_eliminacion'])) {
        $delete_id = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if ($delete_id === false) {
            $_SESSION['mensaje'] = 'Error: El ID debe ser un número positivo.';
            header('Location: ' . $_SERVER['PHP_SELF']); 
            exit();
        } else {
            try {
                $modeloUsuario = new modeloUsuario();
                $resultado = $modeloUsuario->eliminarUsuario($delete_id);

                if ($resultado) {
                    $_SESSION['mensaje'] = 'Usuario eliminado correctamente.';
                } else {
                    $_SESSION['mensaje'] = 'No se pudo eliminar al usuario.';
                }
            } catch (Exception $e) {
                $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
            }
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    } elseif (isset($_POST['delete_id'])) {
        $delete_id = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        if ($delete_id === false) {
            $_SESSION['mensaje'] = 'Error: El ID debe ser un número positivo.';
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

if ($delete_id !== null) {
    try {
        $modeloUsuario = new modeloUsuario();
        $usuario = $modeloUsuario->obtenerUsuarioPorID($delete_id);

        if (!$usuario) {
            $_SESSION['mensaje'] = 'No se encontró un usuario con el ID especificado.';
            header('Location: ' . $_SERVER['PHP_SELF']); 
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
        header('Location: ' . $_SERVER['PHP_SELF']); 
        exit();
    }
}

mostrarFormularioEliminar($mensaje, $usuario);
?>
