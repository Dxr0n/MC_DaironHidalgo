<?php
session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tmpdateuser = $_POST['dateusername']; 
    $tmpdatepassword = $_POST['datepassword'];
    $tmpdateperfil = $_POST['dateperfil']; 

    $conexion = new conexion($host, $namedb, $userdb, $passworddb);
    $pdo = $conexion->obtenerconexion();

    try {
        $sentencia = $pdo->prepare('INSERT INTO usuarios (username, password, perfil) VALUES (?, ?, ?)');
        
        $sentencia->execute([$tmpdateuser, $tmpdatepassword, $tmpdateperfil]);
    
        echo '<div class="alert success">Usuario registrado correctamente.</div>';
    } catch (PDOException $e) {
        echo '<div class="alert error">Error al registrar usuario: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
    
}
?>
<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-ingresardatos.css')?>">

<form action="" method="POST" autocomplete="off">
    <label for="dateusername">Usuario:</label>
    <input type="text" id="dateusername" name="dateusername" required>
    <br>
    <label for="datepassword">Password:</label>
    <input type="password" id="datepassword" name="datepassword" required>
    <br>
    <label for="dateperfil">Perfil:</label>
    <input type="text" id="dateperfil" name="dateperfil" required>
    <br>
    <button type="submit">Registrar</button>
</form>
