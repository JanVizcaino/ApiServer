<?php
session_start(); //Empezamos la sesion 
session_unset(); 
session_destroy(); //Eliminamos la sesion 
header("Location: login.php"); //Redirigimos al login
exit;
