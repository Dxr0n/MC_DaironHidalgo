<?php
    // include carga el recurso y si hay fallas no dice nada
    // require carga el recurso pero si hay fallas emite un mensaje

    // include_once cargar solo una vez
    // require_once
    
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';

    echo $_urlBase;   
    echo get_UrlBase('pagina.php')
?>