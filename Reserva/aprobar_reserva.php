<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../ingresar.php");
    exit;
}

include '../CRUD/conexion.php';

$usuario_id = (int)$_SESSION['usuario_id'];

// Validar rol de usuario
$sqlUser = "SELECT r.descripcion AS tipo_usuario FROM usuarios u 
            JOIN roles r ON u.rol_id = r.id
            WHERE u.id = $usuario_id";
$resultUser = $conn->query($sqlUser);
if (!$resultUser || $resultUser->num_rows === 0) {
    die("No se pudo validar el usuario.");
}
$userData = $resultUser->fetch_assoc();
if ($userData['tipo_usuario'] !== 'administrador') {
    die("No tienes permiso para aprobar reservas.");
}

if (!isset($_GET['id'])) {
    die("ID de reserva no proporcionado.");
}

$reserva_id = (int)$_GET['id'];

// Actualizar estado a confirmada solo si está pendiente
$sql = "UPDATE reservas SET estado = 'confirmada' WHERE id = $reserva_id AND estado = 'pendiente'";

if ($conn->query($sql) === TRUE) {
    header("Location: historial_reservas.php?mensaje=Reserva aprobada exitosamente");
    exit;
} else {
    echo "Error al aprobar la reserva: " . $conn->error;
}
?>
