<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link rel="icon" href="<?php echo get_UrlBase('img/icono-sistema.svg')?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?php echo get_UrlBase('css/style-dashboard.css')?>">
</head>
<body>
    <div class="carga-contenedor" id="carga">
        <div class="carga">
            <div class="spinner"></div>
        </div>
    </div>
  
    <div class="menu">
    <h3>Menu</h3>
    <ul>
        <li>
            <a href="?opcion=Inicio" class="<?php echo isActive('Inicio', $opcion); ?>">
                <img class="menu-icon" 
                     data-default-src="<?php echo get_UrlBase('img/icono-inicio.svg'); ?>" 
                     data-alt-src="<?php echo get_UrlBase('img/icono-inicio-relleno.svg'); ?>" 
                     src="<?php echo isActive('Inicio', $opcion) ? get_UrlBase('img/icono-inicio-relleno.svg') : get_UrlBase('img/icono-inicio.svg'); ?>" 
                     alt="Inicio" 
                     width="30px"> Inicio </a></li>
        <li>
            <a href="?opcion=Ver" class="<?php echo isActive('Ver', $opcion); ?>">
                <img class="menu-icon" 
                     data-default-src="<?php echo get_UrlBase('img/icono-ver.svg'); ?>" 
                     data-alt-src="<?php echo get_UrlBase('img/icono-ver-relleno.svg'); ?>" 
                     src="<?php echo isActive('Ver', $opcion) ? get_UrlBase('img/icono-ver-relleno.svg') : get_UrlBase('img/icono-ver.svg'); ?>" 
                     alt="Ver" 
                     width="30px">Ver</a></li>
        <li>
            <a href="?opcion=Ingresar" class="<?php echo isActive('Ingresar', $opcion); ?>">
                <img class="menu-icon" 
                     data-default-src="<?php echo get_UrlBase('img/icono-ingresar.svg'); ?>" 
                     data-alt-src="<?php echo get_UrlBase('img/icono-ingresar-relleno.svg'); ?>" 
                     src="<?php echo isActive('Ingresar', $opcion) ? get_UrlBase('img/icono-ingresar-relleno.svg') : get_UrlBase('img/icono-ingresar.svg'); ?>" 
                     alt="Ingresar" 
                     width="30px">Ingresar</a> </li>
        <li>
            <a href="?opcion=Modificar" class="<?php echo isActive('Modificar', $opcion); ?>">
                <img class="menu-icon" 
                     data-default-src="<?php echo get_UrlBase('img/icono-modificar.svg'); ?>" 
                     data-alt-src="<?php echo get_UrlBase('img/icono-modificar-relleno.svg'); ?>" 
                     src="<?php echo isActive('Modificar', $opcion) ? get_UrlBase('img/icono-modificar-relleno.svg') : get_UrlBase('img/icono-modificar.svg'); ?>" 
                     alt="Modificar" 
                     width="30px">Modificar </a></li>
        <li>
            <a href="?opcion=Eliminar" class="<?php echo isActive('Eliminar', $opcion); ?>">
                <img class="menu-icon" 
                     data-default-src="<?php echo get_UrlBase('img/icono-eliminar.svg'); ?>" 
                     data-alt-src="<?php echo get_UrlBase('img/icono-eliminar-relleno.svg'); ?>" 
                     src="<?php echo isActive('Eliminar', $opcion) ? get_UrlBase('img/icono-eliminar-relleno.svg') : get_UrlBase('img/icono-eliminar.svg'); ?>" 
                     alt="Eliminar" 
                     width="30px">Eliminar</a></li>
        <li> <a class="salir" href="<?php echo get_controllers('logout.php');?>"> <img src="<?php echo get_UrlBase('img/icono-salir.svg')?>" alt="Salir" width="30px">Salir</a> </li>
    </ul>
</div>

    <div class="dashboard">
        <?php 
            if (isset($contenido)){
                echo $contenido;
            } else {
                echo "<h3>Bienvenido al Sistema</h3>";
            }
            ?>
    </div>
    
    <script src="<?php echo get_js("modelo-carga.js")?>"></script>
    <script src="<?php echo get_js("modelo-cambiar-svg.js")?>"></script>
</body>
</html>