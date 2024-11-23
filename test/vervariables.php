<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php

if (isset($_SESSION["favcolor"])){

  echo "Favorite color is " . $_SESSION["favcolor"] . ".<br>";
  echo "Favorite animal is " . $_SESSION["favanimal"] . ".";

} 
else {
  echo "No existen Variables";
  echo"<br>";
}

?>

<br>
Pagina de ver variables
<br>

<a href="http://127.0.0.1/MC_DaironHidalgo/test/vervariables.php"> actualizar la pagina</a>
<a href="http://127.0.0.1/MC_DaironHidalgo/test/borrarvariables.php"> limpia las variables</a>

</body>
</html>