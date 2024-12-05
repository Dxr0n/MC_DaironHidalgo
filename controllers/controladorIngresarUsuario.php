<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/models/modeloUsuario.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/views/vistaIngresarUsuario.php';

if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tmpdateuser = $_POST['dateusername']; 
    $tmpdatepassword = $_POST['datepassword'];
    $tmpdateperfil = $_POST['dateperfil']; 

    $modeloUsuario = new modeloUsuario();

    try {
        $modeloUsuario->insertarUsuario($tmpdateuser, $tmpdatepassword, $tmpdateperfil);
        $mensaje =  'Usuario registrado correctamente. <br>'; 
    } catch (PDOException $e) {
        $mensaje =  'Error al registrar usuario: '.$e->getMessage(); 
    }
}

mostrarFormularioIngreso($mensaje); 
?>
