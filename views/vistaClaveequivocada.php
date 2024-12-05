<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link rel="icon" href="<?php echo get_UrlBase('img/icono-claveequivocada.svg')?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?php echo get_UrlBase('css/style-claveequivocada.css')?>">
</head>
<body>
    <div class="carga-contenedor" id="carga">
        <div class="carga">
            <div class="spinner"></div>
        </div>
    </div>
  
    <div class="contenedor-central">
    <h1>Clave Equivocada, <br> Vuelva a Ingresar</h1>
        <img src="<?php echo get_UrlBase('img/imagen-warning.svg')?>" alt="Error Icon" class="icono-error-decorativo">
        <a href="<?php echo get_UrlBase('index.php')?>">
            <button class="boton-intentar"><strong>Volver a intentar</strong></button>
        </a>
    </div>

    <script src="<?php echo get_js("modelo-carga.js")?>"></script>
</body>
</html>