<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaModificarUsuario.php';

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

$modeloUsuario = new modeloUsuario();
$mensaje = '';  
$user_data = null;

if (isset($_GET['edit_id'])) {
    $id_to_edit = filter_var($_GET['edit_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if ($id_to_edit !== false) {
        try {
            $user_data = $modeloUsuario->obtenerUsuarioPorId($id_to_edit);
            if (!$user_data) {
                $mensaje = 'El usuario con ese ID no existe.';
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = 'ID inválido.';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $perfil = $_POST['perfil'];

    try {
        $resultado = $modeloUsuario->modificarUsuario($id, $username, $password, $perfil);
        if ($resultado) {
            $_SESSION['mensaje'] = 'Usuario actualizado correctamente.';  
        } else {
            $_SESSION['mensaje'] = 'No se realizaron cambios.';
        }
    } catch (Exception $e) {
        $_SESSION['mensaje'] = 'Error: ' . $e->getMessage(); 
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();  
}

try {
    $usuarios = $modeloUsuario->listarUsuarios();
} catch (Exception $e) {
    $_SESSION['mensaje'] = 'Error: ' . $e->getMessage();
    $usuarios = [];
}

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']); 

mostrarFormularioEditar($user_data, $mensaje);
mostrarListaUsuarios($usuarios);
?>
