<?php 
function mostrarFormularioIngreso($mensaje){
?>
    <form action="/controllers/controladorIngresarUsuario.php" method="POST" autocomplete="off">
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

    <?php 
    if (!empty($mensaje)) { 
    ?>
        <div class="mensaje-emergente" id="mensaje-emergente">
            <?php echo $mensaje; ?>
        </div>
    <?php 
    } 
    ?>
<?php
}
?>
<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-ingresarUsuario.css'); ?>"> 
<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-mensaje-emergente.css'); ?>">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script> 
<script src="<?php echo get_js('modelo-mensaje-emergente.js'); ?>"></script>
