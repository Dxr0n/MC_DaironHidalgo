<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }

    session_unset();
    
    session_destroy();
    header("Location: ".get_UrlBase('index.php'));
    exit();
?>