
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $archivo = "users.json";

    if (file_exists($archivo)) {
        $usuarios = json_decode(file_get_contents($archivo), true);
        foreach ($usuarios as $usuario) {
            if ($usuario["email"] === $email && $usuario["password"] === $password) {
                $_SESSION["usuario"] = $email;
                $_SESSION["rol"] = "admin";
                $_SESSION["fecha"] = date("Y-m-d H:i:s");
                $_SESSION["ip"] = $_SERVER['REMOTE_ADDR'];
                header("Location: home.php");
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Biblioteca Musical</title>
    <script src="./script.js" defer></script>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/spark-md5@3.0.2/spark-md5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body>
    <main>
        <section class="container-fluid pt-3 pb-3">
                <div class="row justify-content-center gap-5">
                    <div class="col-12 col-md-6 mt-3 mt-md-0 rounded shadow p-4 text-white content-section" style="max-width: 900px;">
                    <h1>Inicio de sesión</h1>
                        <form method="POST" action="login.php">
                        <label>Email:</label>
                        <input type="email" name="email" required><br><br>
                        <label>Contraseña:</label>
                        <input type="password" name="password" required><br><br>
                        <button type="submit">Entrar</button>
                    </form>
                    </div>
                </div>
        </section>
    </main>
</body>

</html>