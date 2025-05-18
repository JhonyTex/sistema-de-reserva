<?php
session_start();
include '../CRUD/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../ingresar.php");
    exit;
}

$usuario_id = intval($_SESSION['usuario_id']);
$contacto_id = intval($_POST['contacto_id'] ?? 0);
$respuesta = trim($_POST['respuesta'] ?? '');

if ($contacto_id <= 0 || empty($respuesta)) {
    echo "Datos inválidos.";
    exit;
}

// Verificar que el contacto pertenezca al usuario actual
$sql_check = "SELECT correo FROM contactos WHERE id = $contacto_id";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows == 0) {
    echo "Mensaje no encontrado.";
    exit;
}

$correo_contacto = $result_check->fetch_assoc()['correo'];
if ($correo_contacto !== $_SESSION['correo']) {
    echo "No tienes permiso para responder a este mensaje.";
    exit;
}

// Insertar respuesta adicional
$sql_insert = "INSERT INTO respuestas_usuario (contacto_id, usuario_id, respuesta) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("iis", $contacto_id, $usuario_id, $respuesta);

if ($stmt->execute()) {
    header("Location: ver_respuestas.php");
    exit;
} else {
    echo "Error al guardar la respuesta: " . $conn->error;
}
