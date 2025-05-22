<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") { //Si se ejecuta el formulario con el  metodo POST
    $email = $_POST["email"];
    $password = $_POST["password"]; //Obtenemos los datos del formulario

    $archivo = "users.json"; //Nombre del archivo JSON donde se guardan los datos de los usuarios

    if (file_exists($archivo)) { //Si el archivo existe
        $usuarios = json_decode(file_get_contents($archivo), true); //Cargamos los datos del archivo JSON en un array
    } else {
        $usuarios = []; //Si el archivo no existe, creamos un array vacío
    }

    foreach ($usuarios as $usuario) { //Recorremos el array de usuarios
        if ($usuario["email"] === $email) { //Si ya existe un usuario con el mismo email
            echo "<p>Este correo ya está registrado.</p>";
            exit; //Salimos
        }
    }

    $nuevoUsuario = ["email" => $email, "password" => $password]; //Creamos un nuevo usuario con los datos del formulario
    $usuarios[] = $nuevoUsuario; //Lo agregamos al array de usuarios
    file_put_contents($archivo, json_encode($usuarios, JSON_PRETTY_PRINT)); //Guardamos los datos en el archivo JSON
    header("Location: login.php"); //Volvemos a la página de login
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
</body>

</html>