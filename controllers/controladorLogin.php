<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/modeloUsuario.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_username = $_POST["txtusername"] ?? '';
    $v_password = $_POST["txtpassword"] ?? '';

    $modelousuario = new modeloUsuario();
    $user = $modelousuario->validarUsuarios($v_username, $v_password);

    if ($user && $v_password === $user['password']) {
        $_SESSION["txtusername"] = $v_username;
        
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode([
                'success' => true,
                'redirect' => get_controllers('controladorDashboard.php')
            ]);
        } else {
            header('Location: ' . get_controllers('controladorDashboard.php'));
        }
    } else {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            echo json_encode([
                'success' => false,
                'redirect' => get_views('vistaClaveequivocada.php'),
                'message' => 'Credenciales incorrectas.'
            ]);
        } else {
            header('Location: ' . get_views('vistaClaveequivocada.php'));
        }
    }
    exit;
} else {
    include get_views_disk('vistaLogin.php');
}

?>