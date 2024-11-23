<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    session_start();

    session_unset();
    
    session_destroy();
    header("Location: ".get_UrlBase('index.php'));
    exit;
?>