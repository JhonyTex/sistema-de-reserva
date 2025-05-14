<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ingresar.php");
    exit;
}

include 'CRUD/conexion.php';

$usuario_id = (int)$_SESSION['usuario_id'];

$sqlUser = "SELECT r.descripcion AS tipo_usuario FROM usuarios u 
            JOIN roles r ON u.rol_id = r.id
            WHERE u.id = $usuario_id";
$resultUser = $conn->query($sqlUser);
if (!$resultUser || $resultUser->num_rows === 0) {
    die("No se pudo validar el usuario.");
}
$userData = $resultUser->fetch_assoc();
$tipo_usuario = $userData['tipo_usuario'];

if (!isset($_GET['id'])) {
    die("ID de reserva no proporcionado.");
}

$reserva_id = (int)$_GET['id'];

// Verificar si la reserva pertenece al usuario o si es admin
$sqlCheck = "SELECT usuario_id, estado FROM reservas WHERE id = $reserva_id";
$resultCheck = $conn->query($sqlCheck);
if (!$resultCheck || $resultCheck->num_rows === 0) {
    die("Reserva no encontrada.");
}
$reserva = $resultCheck->fetch_assoc();

if ($tipo_usuario !== 'administrador' && $reserva['usuario_id'] !== $usuario_id) {
    die("No tienes permiso para cancelar esta reserva.");
}

if ($reserva['estado'] !== 'confirmada' && $reserva['estado'] !== 'pendiente') {
    die("Solo se pueden cancelar reservas en estado 'confirmada' o 'pendiente'.");
}

// Cambiar estado a cancelada
$sql = "UPDATE reservas SET estado = 'cancelada' WHERE id = $reserva_id";

if ($conn->query($sql) === TRUE) {
    header("Location: historial_reservas.php?mensaje=Reserva cancelada exitosamente");
    exit;
} else {
    echo "Error al cancelar la reserva: " . $conn->error;
}
?>
