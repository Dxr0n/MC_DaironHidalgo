<?php
function mostrarDashboard($argumento) {
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
            <li> <a href="?opcion=Inicio"> <img src="<?php echo get_UrlBase('img/icono-inicio.svg')?>" alt="Inicio" width="40px">Inicio</a> </li>
            <li> <a href="?opcion=Ver"> <img src="<?php echo get_UrlBase('img/icono-ver.svg')?>" alt="Ver" width="30px">Ver</a> </li>
            <li> <a href="?opcion=Ingresar"> <img src="<?php echo get_UrlBase('img/icono-ingresar.svg')?>" alt="Ingresar" width="30px">Ingresar</a> </li>
            <li> <a href="?opcion=Modificar"> <img src="<?php echo get_UrlBase('img/icono-modificar.svg')?>" alt="Modificar" width="30px">Modificar</a> </li>
            <li> <a href="?opcion=Eliminar"> <img src="<?php echo get_UrlBase('img/icono-eliminar.svg')?>" alt="Eliminar" width="30px">Eliminar</a> </li>
            <li> <a class="salir" href="<?php echo get_controllers('logout.php')?>"> <img src="<?php echo get_UrlBase('img/icono-salir.svg')?>" alt="Salir" width="30px">Salir</a> </li>
        </ul>
    </div>
    <div class="contenido">
        <?php 
            echo $argumento; 
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo get_UrlBase("js/modelo-carga.js")?>"></script>
</body>
</html>

<?php
}
?>