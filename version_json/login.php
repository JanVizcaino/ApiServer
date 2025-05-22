
<?php
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); //Para borrar la cache del navegador (debug)
session_start(); //Iniciamos la sesión
if ($_SERVER["REQUEST_METHOD"] === "POST") { //comprueba si el formulario se envia con el metodo POST
    $email = $_POST["email"];
    $password = $_POST["password"];
    $archivo = "users.json"; //Asignamos los distintos campos que usaremos para gestionar la sesion y el usuario.

    if (file_exists($archivo)) { //Si el archivo existe
        $usuarios = json_decode(file_get_contents($archivo), true); //Transformamos el archivo en un array de usuarios
        foreach ($usuarios as $usuario) { //Para cada usuario
            if ($usuario["email"] === $email && $usuario["password"] === $password) { //Comprueba si los datos estan bien
                $_SESSION["usuario"] = $email;
                $_SESSION["rol"] = "admin";
                $_SESSION["fecha"] = date("Y-m-d H:i:s");
                $_SESSION["ip"] = $_SERVER['REMOTE_ADDR']; //asigna la información de la sesion
                header("Location: home.php"); //Cambia la página
                exit; //Sale
            }
        }
    }
}
?>
<!--Resto del HTML-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Biblioteca Musical</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/spark-md5@3.0.2/spark-md5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-blue">
    <main>
        <section class="container-fluid pt-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-6 col-lg-4 rounded shadow p-5 text-white content-section">
                    <h1 class="mb-4 text-center">Inicio de sesión</h1>
                    <form method="POST" action="login.php" class="d-flex flex-column gap-4"> <!--Se activa el metodo post con la acción login.php para el formulario-->
                        <div class="form-group">
                            <label for="email" class="mb-2">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>    
                        <div class="form-group mt-3">
                            <label for="password" class="mb-2">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Entrar</button>
                    </form>
                    <p class="mt-4 text-center">¿No tienes cuenta? <a href="register.php">Regístrate</a></p> <!--Se llama a register.php si el usuario se quiere egistrar-->
                </div>
            </div>
        </section>
    </main>
</body>

</html>