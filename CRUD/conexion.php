<!-- Conexion con la base de datos -->

<?php
$host = 'localhost';
$usuario = 'root';
$password = ''; 
$base_datos = 'suitestar2';

$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>


