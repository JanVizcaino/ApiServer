<?php
session_start(); //Empiezo la sesión
session_unset(); //Borro todas las variables de la sesión
session_destroy(); //Destruyo la sesión
header("Location: login.php"); //Redirigimos al login
exit;
