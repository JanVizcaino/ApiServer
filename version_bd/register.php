<?php

require_once("conexion.php"); // Llamamos a la clase de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Verificamos si se ha enviado un formulario
    try { // Intentamos realizar la operación
        $email = $_POST["email"]; // Obtenemos el email del formulario
        $password = $_POST["password"]; // Obtenemos la contraseña del formulario

        $sql = "SELECT * FROM users WHERE email = ?"; // Preparamos la consulta SQL
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $email); //Preparamos la query
        $result = mysqli_stmt_get_result($stmt); //Lanzamos la consulta

        if ($row = mysqli_fetch_assoc($result)) { // Verificamos si hay un usuario con ese email
            if (password_verify($password, $row['password'])) { // Verificamos si la contraseña es correcta
                $_SESSION["usuario"] = $row['email']; //Guardamos el email del usuario en la sesión
                header("Location: home.php"); //Redigirimos a la página de inicio
                exit;
            } else {
                echo "<script>alert('Contraseña incorrecta.')</script>"; //Si la contraseña esta mal, notificamos
            }
        } else {
            echo "<script>alert('Correo no encontrado.')</script>"; //Si el correo no existe, notificamos
        }
    } catch (Exception $e) { //Si hay una excepción, la mostramos
        echo "<script>alert('Error: " . $e->getMessage() . "')</script>";
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
                    <h1 class="mb-4 text-center">Registro de usuario</h1>
                    <form method="POST" class="d-flex flex-column gap-4">
                        <div class="form-group">
                            <label for="email" class="mb-2">Email:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="password" class="mb-2">Contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Registrarse</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script>
        function showMessage(type, text) {
            const msg = document.getElementById("msg");
            const alertIcon = document.getElementById("alert-icon");
            const alertMsg = document.getElementById("alert-msg");

            alertIcon.className = type === 'success'
                ? "fas fa-check-circle text-success"
                : "fas fa-exclamation-circle text-danger";
            alertMsg.textContent = text;
            msg.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed top-0 end-0 mt-3 me-3 text-start shadow`;
            msg.classList.remove("d-none");

            setTimeout(() => msg.classList.add("d-none"), 3000);
        }
    </script>
</body>

</html>