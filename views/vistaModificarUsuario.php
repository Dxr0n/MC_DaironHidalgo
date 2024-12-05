<?php
function mostrarFormularioEditar($user_data = null, $mensaje = '') {
?>
    <h2>Modificar Usuario</h2>

    <?php
    if ($mensaje) {
        echo '<div class="mensaje-emergente" id="mensaje-emergente">' . $mensaje . '</div>';
    }
    ?>

    <?php 
    if ($user_data){ 
    ?>
        <form action="<?php echo get_controllers('controladorModificarUsuario.php'); ?>" method="POST" autocomplete="off">
            <input type="hidden" name="id" value="<?php echo $user_data['id']; ?>">

            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>" required>
            <br>

            <label for="password">Contraseña:</label>
            <input type="text" id="password" name="password" value="<?php echo $user_data['password']; ?>" required>
            <br>

            <label for="perfil">Perfil:</label>
            <input type="text" id="perfil" name="perfil" value="<?php echo $user_data['perfil']; ?>" required>
            <br>

            <button type="submit">Guardar Cambios</button>
        </form>

    <?php 
    } 
    ?>

<?php 
function mostrarListaUsuarios($usuarios) {
?>
    <h2>Lista de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Perfil</th>
            <th>Acciones</th>
        </tr>
        <?php
        foreach ($usuarios as $usuario) {
        ?>
            <tr>
                <td><?php echo $usuario['id'] ?></td>
                <td><?php echo $usuario['username'] ?></td>
                <td><?php echo $usuario['perfil'] ?></td>
                <td><a href="?edit_id=<?php echo $usuario['id']; ?>">Editar</a></td>
            </tr>
        <?php 
        }
        ?>
    </table>
<?php
}
?>

<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-modificarUsuario.css'); ?>">
<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-mensaje-emergente.css'); ?>">
<script src="<?php echo get_js('modelo-mensaje-emergente.js'); ?>"></script>
<?php
}
?>
