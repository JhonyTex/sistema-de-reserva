<!-- Esta pagina funciona pra procesar la actualizacion de la imagen -->
<?php
session_start();
include 'CRUD/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ingresar.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen_perfil'])) {
    $imagen = $_FILES['imagen_perfil'];
    $nombre_imagen = $usuario_id . '_' . basename($imagen['name']);
    $ruta_destino = "uploads/" . $nombre_imagen;

    // Validar y mover la imagen
    if (move_uploaded_file($imagen['tmp_name'], $ruta_destino)) {
        $sql = "UPDATE usuarios SET imagen_perfil = '$nombre_imagen' WHERE id = '$usuario_id'";
        if ($conn->query($sql)) {
            header("Location: perfil.php");
        } else {
            echo "Error al actualizar la imagen: " . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
?>
