<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/etc/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Login</title>
  <link rel="icon" href="<?php echo get_UrlBase('img/icono-user.svg')?>" type="image/svg+xml">
  <link rel="stylesheet" href="<?php echo get_UrlBase('css/style-index.css')?>">
</head>

<body>
  <div class="carga-contenedor" id="carga">
    <div class="carga">
        <div class="spinner"></div>
    </div>
  </div>
  
  <?php
    function get_connection() {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "dbsistema";

      $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
  }

  function get_user_credentials($username) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/models/connect/conexion.php';
    $conn = get_connection();
    $stmt = $conn->prepare("SELECT username, password FROM usuarios WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $user;
}

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $v_username = $_POST["txtusername"] ?? '';
    $v_password = $_POST["txtpassword"] ?? '';

    $user = get_user_credentials($v_username);

    if ($user && $v_password === $user['password']) {
      $_SESSION["txtusername"] = $v_username;
      header('Location: '.get_views('dashboard.php?opcion=Inicio'));
      exit();
    } 
    else {
      header('Location: '.get_views('claveequivocada.php'));
      exit();
    }
  }
?>

  <div class="imagenes">
    <div class="pelota-futbol">
      <img src="img/icono-pelota-futbol.svg" alt="Pelota de futbol" height="120" width="120">
    </div>
    <div class="pelota-basquet">
      <img src="img/icono-pelota-basquet.svg" alt="Pelota de basquetball" height="130" width="130">
    </div>
    <div class="pelota-basquet-1">
      <img src="img/icono-pelota-basquet.svg" alt="Pelota de basquetball" height="60" width="60">
    </div>
    <div class="pelotas">
      <img src="img/icono-pelotas.svg" alt="Pelotas" height="90" width="90">
    </div>
    <div class="pelota-tenis">
      <img src="img/icono-pelota-tenis.svg" alt="Pelota de tenis" height="70" width="70">
    </div>
    <div class="pelota-tenis-1">
      <img src="img/icono-pelota-tenis.svg" alt="Pelota de tenis" height="80" width="80">
    </div>
    <div class="pelota-voley">
      <img src="img/icono-pelota-voley.svg" alt="Pelota de voley" height="70" width="70">
    </div>
    <div class="pelota-voley-1">
      <img src="img/icono-pelota-voley-2.svg" alt="Pelota de voley" height="130" width="130">
    </div>
    <div class="pelota-voley-2">
      <img src="img/icono-pelota-voley-2.svg" alt="Pelota de voley" height="60" width="60">
    </div>
    <div class="pelota-pesas">
      <img src="img/icono-pelota-pesas.svg" alt="Pelota con pesas" height="90" width="90">
    </div>
    <div class="medalla">
      <img src="img/icono-medalla.svg" alt="Medalla" height="90" width="90">
    </div>
    <div class="bandera">
      <img src="img/icono-bandera.svg" alt="Bandera" height="70" width="70">
    </div>
    <div class="circulo">
      <img src="img/icono-circulo-lineas.svg" alt="Cirulo de lineas" height="40" width="40">
    </div>
    <div class="circulo-1">
      <img src="img/icono-circulo-lineas.svg" alt="Cirulo de lineas" height="50" width="50">
    </div>
    <div class="espiral">
      <img src="img/icono-espiral.svg" alt="Espiral" height="90" width="90">
    </div>
    <div class="espiral-1">
      <img src="img/icono-espiral.svg" alt="Espiral" height="70" width="70">
    </div>
    <div class="flecha">
      <img src="img/icono-flecha.svg" alt="Flecha" height="70" width="70">
    </div>
    <div class="flecha-1">
      <img src="img/icono-flecha.svg" alt="Flecha" height="70" width="70">
    </div>
    <div class="estrella">
      <img src="img/icono-estrella.svg" alt="Estrella" height="70" width="70">
    </div>
    <div class="estrella-1">
      <img src="img/icono-estrella.svg" alt="Estrella" height="70" width="70">
    </div>
    <div class="estrella-2">
      <img src="img/icono-estrella.svg" alt="Estrella" height="60" width="60">
    </div>
    <div class="estrella-3">
      <img src="img/icono-estrella.svg" alt="Estrella" height="60" width="60">
    </div>
    <div class="estrella-4">
      <img src="img/icono-estrella.svg" alt="Estrella" height="50" width="50">
    </div>

  </div>


  <div id="form-ui">
    <form action="" method="post" id="form" autocomplete="off">
      <div id="form-body">
        <div id="welcome-lines">
          <div id="welcome-line-1">Login</div>
          <div id="welcome-line-2">Sistema de registro de usuario</div>
        </div>
        <div id="input-area">
          <div class="form-inp">
            <input type="text" name="txtusername" id="txtusername" placeholder="Username"  required>
          </div>
          <div class="form-inp">
            <input type="password" name="txtpassword"  id="txtpassword" placeholder="Password" required>
            <span id="toggle-clave" class="toggle-clave">
            <img src="" id="icono-Ojo" alt="icono-Ojo" data-src="img/icono-ojo-abierto.svg">
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

  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="<?php echo get_UrlBase("js/modelo-carga.js")?>"></script>
  <script src="<?php echo get_UrlBase("js/modelo-mostrar-clave.js")?>"></script>

</body>
</html>