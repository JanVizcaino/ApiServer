<?php
$servername = "localhost"; 
$database = "apiserver";
$username = "root";
$password = ""; //Configuro los parametros par la conexion a la base de datos

$conn = mysqli_connect($servername, $username, $password, $database); //Conecto a la base de datos

if (!$conn) { //Si no se conecta a la base de datos
    die("Connection failed: " . mysqli_connect_error()); //Muestra el error
}
?>
