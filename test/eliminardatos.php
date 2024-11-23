<?php
session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = filter_var($_POST['delete_id'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

    if ($delete_id === false) {
        echo 'Error: El ID debe ser un número positivo.<br>';
    } else {
        $conexion = new conexion($host, $namedb, $userdb, $passworddb);
        $pdo = $conexion->obtenerconexion();

        try {
            $sentencia = $pdo->prepare('DELETE FROM usuarios WHERE id = ?');
            $sentencia->execute([$delete_id]);
        
            echo '<div class="alert success">Usuario eliminado correctamente.</div>';
            header('Location: '.get_views('verdatos.php'));
        } catch (PDOException $e) {
            echo '<div class="alert error">Error al eliminar usuario: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }        
    }
}
?>

<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-eliminardatos.css')?>">

<h2>Eliminar Usuario</h2>
<form action="" method="POST" autocomplete="off">
    <label for="delete_id">ID del usuario a eliminar:</label>
    <input type="number" id="delete_id" name="delete_id" min="1" required>
    <br>
    <button type="submit">Eliminar</button>
</form>

