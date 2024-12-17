<?php
session_start();
if (!isset($_SESSION["txtusername"])) {
    header('Location: ' . get_urlBase('index.php'));
    exit();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/models/connect/conexion.php';

$id_to_edit = null;
$user_data = null;

$conexion = new conexion($host, $namedb, $userdb, $passworddb);
$pdo = $conexion->obtenerconexion();

if (isset($_GET['edit_id'])) {
    $id_to_edit = $_GET['edit_id'];

    try {
        $query = $pdo->prepare('SELECT id, username, password, perfil FROM usuarios WHERE id = ?');
        $query->execute([$id_to_edit]);
        $user_data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$user_data) {
            echo 'El usuario con ese ID no existe.';
            exit();
        }
    } catch (PDOException $e) {
        echo '<div class="alert error">Error al obtener los datos del usuario: ' . htmlspecialchars($e->getMessage()) . '</div>';
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $perfil = $_POST['perfil'];

    try {
        $sentencia = $pdo->prepare('UPDATE usuarios SET username = ?, password = ?, perfil = ? WHERE id = ?');
        $sentencia->execute([$username, $password, $perfil, $id]);

        echo '<div class="alert success">Usuario actualizado correctamente.</div>';
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    } catch (PDOException $e) {
        echo '<div class="alert error">Error al actualizar el usuario: ' . htmlspecialchars($e->getMessage()) . '</div>';
    }
}
?>

<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-modificardatos.css')?>">

<h2>Modificar Usuario</h2>

<?php if ($user_data): ?>
    <form action="" method="POST" autocomplete="off">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_data['id']); ?>">
        
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
        <br>
        
        <label for="password">Contraseña:</label>
        <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($user_data['password']); ?>" required>
        <br>
        
        <label for="perfil">Perfil:</label>
        <input type="text" id="perfil" name="perfil" value="<?php echo htmlspecialchars($user_data['perfil']); ?>" required>
        <br>
        
        <button type="submit">Guardar Cambios</button>
    </form>
<?php else: ?>
    <p>Selecciona un usuario para editar.</p>
<?php endif; ?>

<h2>Lista de Usuarios</h2>
<?php
try {
    $query = $pdo->query('SELECT id, username, perfil FROM usuarios');
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Username</th><th>Perfil</th><th>Acciones</th></tr>';
    while ($fila = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($fila['id']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['username']) . '</td>';
        echo '<td>' . htmlspecialchars($fila['perfil']) . '</td>';
        echo '<td><a href="?edit_id=' . htmlspecialchars($fila['id']) . '">Editar</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} catch (PDOException $e) {
    echo 'Error al obtener la lista de usuarios: ' . $e->getMessage();
}
?>
