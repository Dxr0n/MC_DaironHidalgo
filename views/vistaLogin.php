<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/etc/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Login</title>
    <link rel="icon" href="<?php echo get_UrlBase('img/icono-user.svg')?>" type="image/svg+xml">
</head>
<link rel="stylesheet" href="<?php echo get_UrlBase('css/style-vistaLogin.css')?>">
<body>
    <div class="carga-contenedor" id="carga">
        <div class="carga">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="imagenes">
    <div class="pelota-futbol">
      <img src="<?php echo get_UrlBase('img/icono-pelota-futbol.svg')?>" alt="Pelota de futbol" height="120" width="120">
    </div>
    <div class="pelota-basquet">
      <img src="<?php echo get_UrlBase('img/icono-pelota-basquet.svg')?>" alt="Pelota de basquetball" height="130" width="130">
    </div>
    <div class="pelota-basquet-1">
      <img src="<?php echo get_UrlBase('img/icono-pelota-basquet.svg')?>" alt="Pelota de basquetball" height="60" width="60">
    </div>
    <div class="pelotas">
      <img src="<?php echo get_UrlBase('img/icono-pelotas.svg')?>" alt="Pelotas" height="90" width="90">
    </div>
    <div class="pelota-tenis">
      <img src="<?php echo get_UrlBase('img/icono-pelota-tenis.svg')?>" alt="Pelota de tenis" height="70" width="70">
    </div>
    <div class="pelota-tenis-1">
      <img src="<?php echo get_UrlBase('img/icono-pelota-tenis.svg')?>" alt="Pelota de tenis" height="80" width="80">
    </div>
    <div class="pelota-voley">
      <img src="<?php echo get_UrlBase('img/icono-pelota-voley.svg')?>" alt="Pelota de voley" height="70" width="70">
    </div>
    <div class="pelota-voley-1">
      <img src="<?php echo get_UrlBase('img/icono-pelota-voley-2.svg')?>" alt="Pelota de voley" height="130" width="130">
    </div>
    <div class="pelota-voley-2">
      <img src="<?php echo get_UrlBase('img/icono-pelota-voley-2.svg')?>" alt="Pelota de voley" height="60" width="60">
    </div>
    <div class="pelota-pesas">
      <img src="<?php echo get_UrlBase('img/icono-pelota-pesas.svg')?>" alt="Pelota con pesas" height="90" width="90">
    </div>
    <div class="medalla">
      <img src="<?php echo get_UrlBase('img/icono-medalla.svg')?>" alt="Medalla" height="90" width="90">
    </div>
    <div class="bandera">
      <img src="<?php echo get_UrlBase('img/icono-bandera.svg')?>" alt="Bandera" height="70" width="70">
    </div>
    <div class="circulo">
      <img src="<?php echo get_UrlBase('img/icono-circulo-lineas.svg')?>" alt="Cirulo de lineas" height="40" width="40">
    </div>
    <div class="circulo-1">
      <img src="<?php echo get_UrlBase('img/icono-circulo-lineas.svg')?>" alt="Cirulo de lineas" height="50" width="50">
    </div>
    <div class="espiral">
      <img src="<?php echo get_UrlBase('img/icono-espiral.svg')?>" alt="Espiral" height="90" width="90">
    </div>
    <div class="espiral-1">
      <img src="<?php echo get_UrlBase('img/icono-espiral.svg')?>" alt="Espiral" height="70" width="70">
    </div>
    <div class="flecha">
      <img src="<?php echo get_UrlBase('img/icono-flecha.svg')?>" alt="Flecha" height="70" width="70">
    </div>
    <div class="flecha-1">
      <img src="<?php echo get_UrlBase('img/icono-flecha.svg')?>" alt="Flecha" height="70" width="70">
    </div>
    <div class="estrella">
      <img src="<?php echo get_UrlBase('img/icono-estrella.svg')?>" alt="Estrella" height="70" width="70">
    </div>
    <div class="estrella-1">
      <img src="<?php echo get_UrlBase('img/icono-estrella.svg')?>" alt="Estrella" height="70" width="70">
    </div>
    <div class="estrella-2">
      <img src="<?php echo get_UrlBase('img/icono-estrella.svg')?>" alt="Estrella" height="60" width="60">
    </div>
    <div class="estrella-3">
      <img src="<?php echo get_UrlBase('img/icono-estrella.svg')?>" alt="Estrella" height="60" width="60">
    </div>
    <div class="estrella-4">
      <img src="<?php echo get_UrlBase('img/icono-estrella.svg')?>" alt="Estrella" height="50" width="50">
    </div>
  </div>

    <div id="form-ui">
        <form action="<?php echo get_controllers('controladorLogin.php'); ?>" method="post" id="form" autocomplete="off">
            <div id="form-body">
                <div id="welcome-lines">
                    <div id="welcome-line-1">Login</div>
                    <div id="welcome-line-2">Sistema de registro de usuario</div>
                </div>
                <div id="input-area">
                    <div class="form-inp">
                        <input type="text" name="txtusername" id="txtusername" placeholder="Username" required>
                    </div>
                    <div class="form-inp">
                        <input type="password" name="txtpassword" id="txtpassword" placeholder="Password" required>
                        <span id="toggle-clave" class="toggle-clave">
                        <img data-src="<?php echo get_UrlBase('img/icono-ojo-abierto-clave.svg'); ?>"
                        data-closed=" <?php echo get_UrlBase('img/icono-ojo-cerrado-clave.svg'); ?>" alt="Mostrar clave" id="icono-Ojo">
                        </span>
                    </div>
                </div>
                <div id="submit-button-cvr">
                    <button id="submit-button" type="submit">Login</button>
                </div>
                <div id="bar"></div>
            </div>
        </form>
    </div>

    <script src="<?php echo get_js("modelo-verificacion-credenciales.js")?>"></script>
    <script src="<?php echo get_js("modelo-carga.js")?>"></script>
    <script src="<?php echo get_js("modelo-mostrar-clave.js")?>"></script>
</body>
</html>