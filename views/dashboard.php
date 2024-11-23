<?php
    session_start();

    if (!isset($_SESSION["txtusername"])) {
        header("Location: ".get_UrlBase('index.php'));
        exit();
    }
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web</title>
    <link rel="icon" href="<?php echo get_UrlBase('img/icono-sistema.svg')?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?php echo get_UrlBase('css/styles-dashboard.css')?>">
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
            if (isset($_GET["opcion"])) {
                $opcion = $_GET["opcion"];

                switch ($opcion){
                    case 'Inicio':
                        echo "<h3>Bienvenido al Dashboard</h3>";
                        echo "<p>Selecciona una opción para comenzar.</p>";
                        break;
                    case 'Ver':
                        echo "<h3>Sección de Ver</h3>";
                        echo "<iframe src ='".get_controllers("controladorUsuario.php") ."'> </iframe>";
                        break;
                    case 'Ingresar':
                        echo "<h3>Sección de Ingresar</h3>";
                        echo "<iframe src ='".get_controllers("controladorIngresarUsuario.php") ."'> </iframe>";
                        break; 
                    case 'Modificar':
                        echo "<h3>Sección de Modificar</h3>";
                        echo "<iframe src ='".get_controllers("controladorModificarUsuario.php") ."'> </iframe>";
                        break;
                    case 'Eliminar':
                        echo "<h3>Sección de Eliminar</h3>";
                        echo "<iframe src ='".get_controllers("controladorEliminarUsuario.php") ."'> </iframe>";
                        break;
                }
            }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="<?php echo get_UrlBase("js/modelo-carga.js")?>"></script>
</body>
</html>
