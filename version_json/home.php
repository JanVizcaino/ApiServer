<?php
session_start(); //Empieza la sesion
if (!isset($_SESSION["usuario"])) { //Si no hay usuario
    header("Location: login.php"); //Redirige a la pagina de login
    exit; //Sale del script
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
    <script src="./script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body x-data="{ tab: 'home' }">
    <header class="text-white text-center ">
        <ul class="nav justify-content-center">
            <li class="nav-item" id="toggle-modal">
                <a><i class="fa-solid fa-chevron-down"></i></a>
            </li>
            <div id="modal-container">
                <div class="form-container">
                    <template x-if="tab === 'home'">
                        <div>
                            <h3>Bienvenido/a,
                                <?php echo $_SESSION["usuario"]; ?>
                            </h3>
                            <div class="text-start mt-4">
                                <p>Estás en la zona privada del sistema.</p>
                                <p><a href="logout.php">Cerrar sesión</a></p>
                            </div>
                        </div>
                    </template>
                    <template x-if="tab === 'register'">
                        <div>
                            <h5 class="text-left">Añade tus canciones favoritas.</h5>
                            <p class="text-start">Pulsa en check para validar la canción y add para añadirla a tu
                                bilioteca.
                            </p>

                            <form class="form d-flex flex-column gap-2 justify-content-center" id="register-form">
                                <div class="form-group mb-3 d-flex flex-column justify-content-center">
                                    <input type="text" id="titulo" name="titulo" class="form-control" required
                                        placeholder="Título">
                                </div>

                                <div class="form-group mb-3 d-flex flex-column justify-content-center">
                                    <input type="text" id="artista" name="artista" class="form-control" required
                                        placeholder="Artista">
                                </div>


                                <div class="form-group mb-3 d-flex flex-column justify-content-center">
                                    <div class="rating justify-content-end">
                                        <input type="radio" id="star5" name="puntuacion" value="5">
                                        <label for="star5">★</label>
                                        <input type="radio" id="star4" name="puntuacion" value="4">
                                        <label for="star4">★</label>
                                        <input type="radio" id="star3" name="puntuacion" value="3">
                                        <label for="star3">★</label>
                                        <input type="radio" id="star2" name="puntuacion" value="2">
                                        <label for="star2">★</label>
                                        <input type="radio" id="star1" name="puntuacion" value="1">
                                        <label for="star1">★</label>
                                    </div>
                                </div>

                                <div class="form-group justify-content-center" style="height: auto !important;">
                                    <input type="hidden" id="portada" data-remote="">
                                    <div id="preview-container" style="display: none;">
                                        <img id="preview-image" src="./media/default-cover.png"
                                            alt="Previsualización de portada" />
                                    </div>

                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-secondary w-50" id="check-song">
                                        <i class="fa-solid fa-circle-check me-2"></i>Check
                                    </button>

                                    </button>
                                    <button type="submit" class="btn btn-primary w-50" id="add-song">
                                        <i class="fas fa-plus-circle me-2"></i>Add
                                    </button>
                                </div>

                            </form>
                        </div>
                    </template>
                    <template x-if="tab === 'songslist'">
                        <div>
                            <p class="text-left">Busca y selecciona en los siguientes filtros.</p>

                            <form class="form d-flex flex-column gap-2 justify-content-center" id="filter-form">
                                <div
                                    class="form-group mb-2 d-flex flex-column align-items-center justify-content-center">
                                    <input type="text" id="titulo-filter" name="titulo-filter" class="form-control"
                                        required placeholder="Titulo">
                                </div>

                                <div
                                    class="form-group mb-2 d-flex flex-column align-items-center justify-content-center">
                                    <input type="text" id="artista-filter" name="artista-filter" class="form-control"
                                        required placeholder="Artista">
                                </div>

                                <div class="form-group  mb-2  d-flex flex-column justify-content-center">
                                    <div class="rating justify-content-end">
                                        <input type="radio" id="star-filter-5" name="puntuacion-filter" value="5">
                                        <label for="star-filter-5">★</label>
                                        <input type="radio" id="star-filter-4" name="puntuacion-filter" value="4">
                                        <label for="star-filter-4">★</label>
                                        <input type="radio" id="star-filter-3" name="puntuacion-filter" value="3">
                                        <label for="star-filter-3">★</label>
                                        <input type="radio" id="star-filter-2" name="puntuacion-filter" value="2">
                                        <label for="star-filter-2">★</label>
                                        <input type="radio" id="star-filter-1" name="puntuacion-filter" value="1">
                                        <label for="star-filter-1">★</label>
                                    </div>
                                </div>


                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-100" id="filter-song">
                                        <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                                    </button>
                                    <button type="reset" class="btn btn-secondary w-25" id="reset-filter">
                                        <i class="fa-solid fa-xmark me-2"></i></button>
                                    </button>
                                </div>

                            </form>

                        </div>
                    </template>
                </div>
            </div>
        </ul>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" @click="tab = 'home'; $nextTick(() => initEventListeners())"><i class="fa-solid fa-house"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" @click="tab = 'register'; $nextTick(() => initEventListeners())"><i class="fa-solid fa-music"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" @click="tab = 'songslist'; $nextTick(() => initEventListeners()); $nextTick(() => showSongs())"><i class="fa-solid fa-bookmark"></i></a>
            </li>
        </ul>
    </header>

    <main class="container-fluid pt-3 pb-3" id="main">
        <section x-show="tab === 'home'" x-transition x-cloak>
            <div class="row justify-content-center gap-5">
                <div class="col-12 col-md-6 mt-3 mt-md-0 rounded shadow p-4 text-white content-section"
                    style="max-width: 1000px;">
                    <h2>Bienvenido a tu biblioteca musical.</h2>
                    <p>
                        Navega por el menú de la izquierda para probar las características de esta biblioteca.
                    </p>

                    <div style="margin-top: 50px;">
                        <h4>Reflexión sobre la digitalización</h4>
                        <p>
                            Antes de digitalizar mi biblioteca musical, todo se organizaba de forma manual.
                            Era difícil encontrar canciones, no se podía acceder desde cualquier lugar,
                            y no había manera de automatizar las búsquedas o los filtros. Con esta web:
                        </p>
                        <ul>
                            <li>Las canciones se guardan automáticamente en la biblioteca.</li>
                            <li>Podemos buscar canciones reales a través de la API de Deezer.</li>
                            <li>Es posible filtrar por género u otros criterios y ver rápidamente la información.</li>
                        </ul>
                        <p>
                            Este es un ejemplo sencillo, pero representa lo que sucede en proyectos reales
                            cuando se digitalizan procesos: mejor organización, acceso eficiente a los datos
                            y automatización de tareas repetitivas.
                        </p>
                    </div>

                </div>
            </div>
        </section>
        <section x-show="tab === 'register'" x-transition x-cloak>
            <div class="row justify-content-center gap-5">
                <div class="col-12 col-md-6 mt-3 mt-md-0 rounded shadow p-4 content-section" style="max-width: 1000px;">
                    <h2 class="text-center mb-3 ">Resultados</h2>
                    <ul id="results-list" class="p-3 mb-0 flex-column list-unstyled" style="display: none;">

                    </ul>
                    <div class="flex-column align-items-center justify-content-center h-75" id="empty-msg"
                        style="color: gray; display: flex; justify-content: center;">
                        <h3>Sin resultados...</h3>
                        <h5>¡Busca algo para empezar!</h5>
                    </div>
                </div>
            </div>
        </section>
        <section x-show="tab === 'songslist'" x-transition x-cloak>
            <div class="row justify-content-center gap-5">
                <div class="col-12 col-md-6 mt-3 mt-md-0 rounded shadow p-4 content-section">
                    <h2 class="text-center mb-3 ">Tus canciones</h2>
                    <div id="songs-list" class="song-list p-3" style="display: none;">

                    </div>
                    <div class="flex-column align-items-center justify-content-center h-75" id="songslist-empty-msg"
                        style="color: gray; display: flex; justify-content: center;">
                        <h3>Tu biblioteca está vacía...</h3>
                        <h5>¡Comienza agregando canciones!</h5>
                        <a class="active" @click="tab = 'register'">Registra tu canción</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="msg" class="alert d-none position-fixed top-0 end-0 mt-3 me-3 text-start shadow" role="alert">
        <i id="alert-icon" class="me-2"></i>
        <p id="alert-msg" class="m-0"></p>
    </div>
</body>

</html>