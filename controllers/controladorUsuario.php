<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaUsuario.php';

    if (!isset($_SESSION["txtusername"])) {
        header('Location: ' . get_urlBase('index.php'));
        exit();
    }

    $modeloUsuario = new modeloUsuario();
    $usuarios = $modeloUsuario->obtenerUsuarios();
    mostrarUsuarios($usuarios);
?>

