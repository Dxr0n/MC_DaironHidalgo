<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
session_unset();

session_destroy();
?>

Se borraron todas las variables
<br>

<a href="http://127.0.0.1/MC_DaironHidalgo/vervariables.php"> Ver Variables</a>
<a href="http://127.0.0.1/MC_DaironHidalgo/test.php"> Volver a grabar Variables</a>

</body>
</html>