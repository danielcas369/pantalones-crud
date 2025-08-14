<?php
$servername = "localhost";
$username   = "root";
$password   = ""; // en XAMPP por defecto está vacío
$dbname     = "tienda_pantalones";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
