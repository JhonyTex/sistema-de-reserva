<!-- Esta pagina es para eliminar usuarios -->
<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario es administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] != 'administrador') {
    echo "No tienes permisos para realizar esta acción.";
    exit;
}

// Obtener el ID del usuario a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "DELETE FROM usuarios WHERE id = $id";

if ($conn->query($sql)) {
    echo "Usuario eliminado con éxito.";
    header("Location: ../usuarios.php");
    exit;
} else {
    echo "Error al eliminar el usuario: " . $conn->error;
}
?>
