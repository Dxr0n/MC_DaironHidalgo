<?php
    session_start();
    if (!isset($_SESSION["txtusername"])) {
            header('location:' . get_urlBase('index.php'));
            exit();
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/views/dashboard.php'; 

    $opcion = isset($_GET['opcion']) ? $_GET['opcion'] : 'Inicio';


    switch ($opcion) {
        case 'Inicio':
            $argumento = '<h3>Bienvenido al Dashboard</h3><p>Selecciona una opción para comenzar.</p>';
            break;

        case 'Ver':
            $argumento = '<h3>Bienvenido a la Sección de Ver</h3>
            <iframe src="' . get_controllers('controladorUsuario.php') . '"></iframe>';
            break;

        case 'Ingresar':
            $argumento = '<h3>Bienvenido a la Sección de Ingresar datos</h3>
            <iframe src="' . get_controllers('controladorIngresarUsuario.php') . '" ></iframe>';
            break;

        case 'Modificar':
            $argumento = '<h3>Bienvenido a la Sección de Modificar</h3>
            <iframe src="' . get_controllers('controladorModificarUsuario.php') . '" "></iframe>';
            break;

        case 'Eliminar':
            $argumento = '<h3>Bienvenido a la Sección de Eliminar</h3>
            <iframe src="' . get_controllers('ControladorEliminarUsuario.php') . '" ></iframe>';
            break;

        default:
            $argumento = '<h3>Opción no válida</h3><p>Por favor selecciona una opción válida en el menú.</p>';
            break;
    }

mostrarDashboard($argumento);
?>