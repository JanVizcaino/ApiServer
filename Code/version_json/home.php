<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>

<body>
    <h1>Bienvenido/a, <?php echo $_SESSION["usuario"]; ?></h1>
    <p>Estás en la zona privada del sistema.</p>
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>

</html>