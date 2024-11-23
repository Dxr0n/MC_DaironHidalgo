<?php
function mostrarFormularioEliminar($mensaje = '', $usuario = null) {
?>
    <div class="body">
        <h2>Eliminar Usuario</h2>

        <?php if (!$usuario) { ?>
            <form action="" method="POST" autocomplete="off">
                <label for="delete_id">ID del usuario a eliminar:</label>
                <input type="number" id="delete_id" name="delete_id" min="1" required>
                <br>
                <button type="submit">Buscar Usuario</button>
            </form>
        <?php } else { ?>
            <div class="mensaje-confirmacion">
                <p><strong>¿Está seguro de que desea eliminar al siguiente usuario?</strong></p>
                <table class="tabla-detalle-usuario">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Perfil</th>
                    </tr>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['username']; ?></td>
                        <td><?php echo $usuario['perfil']; ?></td>
                    </tr>
                </table>
                <form action="" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $usuario['id']; ?>">
                    <button type="submit" name="confirmar_eliminacion">Confirmar Eliminación</button>
                </form>
            </div>
        <?php } ?>

        <?php if (!empty($mensaje)) { ?>
            <div class="mensaje-emergente" id="mensaje-emergente">
                <?php echo $mensaje; ?>
            </div>
        <?php } ?>
    </div>

    <link rel="stylesheet" href="<?php echo get_UrlBase('css/style-eliminardatos.css'); ?>">
    <link rel="stylesheet" href="<?php echo get_UrlBase('css/style-mensaje-emergente.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
    <script src="<?php echo get_UrlBase('js/modelo-mensaje-emergente.js'); ?>"></script>
<?php
}
?>
