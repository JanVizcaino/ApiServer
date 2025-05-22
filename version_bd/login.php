<?php
require_once 'conexion.php'; //Asigno la conexión a una variable
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); 
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); //Esto es para evitar el cache de los navegadores
session_start(); //Inicia la sesión

if ($_SERVER["REQUEST_METHOD"] === "POST") { //Si se ha enviado el formulario
    try { //Intento realizar la acción
        $email = $_POST["email"]; //Obtengo el email del formulario
        $password = $_POST["password"]; //Obtengo la contraseña del formulario

        $sql = "SELECT * FROM users WHERE email = ?"; //Consulta para obtener el usuario
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $email); //Preparo la query
        $result = mysqli_stmt_get_result($stmt); //Ejecutamos la consulta

        if ($row = mysqli_fetch_assoc($result)) { //Si hay un usuario con ese email
            if (password_verify($password, $row['password'])) { //Verificamos la contraseña
                $_SESSION["usuario"] = $row['email']; //Si es correcto, guardamos el email en la sesión
                header("Location: home.php"); //Redirigimos a la página de inicio
                exit;
            } else { //Si la contraseña es incorrecta
                echo "<script>alert('Contraseña incorrecta.')</script>"; //Notificamos de que es así
            }
        } else { //Si no existe, se notifica de que es así.
            echo "<script>alert('Correo no encontrado.')</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "')</script>"; //Si hay alguna excepción, se muestra
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
                    <form method="POST" action="login.php" class="d-flex flex-column gap-4">
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
                    <p class="mt-4 text-center">¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
                </div>
            </div>
        </section>
    </main>

</body>

</html>