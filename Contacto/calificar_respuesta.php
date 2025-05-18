<?php
session_start();
include('../CRUD/conexion.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../ingresar.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$usuario_correo = $_SESSION['correo'] ?? '';

$contacto_id = intval($_GET['id'] ?? 0);
if ($contacto_id <= 0) {
    echo "ID de mensaje no válido.";
    exit;
}

// Procesar calificación enviada por usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calificacion = intval($_POST['calificacion'] ?? 0);
    if ($calificacion < 1 || $calificacion > 5) {
        $error = "Calificación inválida.";
    } else {
        // Actualizar calificación en respuestas_contactos para este contacto
        $sql_update = "UPDATE respuestas_contactos SET calificacion_usuario = $calificacion WHERE contacto_id = $contacto_id";
        if (!$conn->query($sql_update)) {
            $error = "Error al guardar la calificación: " . $conn->error;
        } else {
            $success = "Calificación guardada correctamente.";
        }
    }
}

// Obtener mensaje y respuesta
$sql = "SELECT c.*, m.descripcion AS motivo, rc.respuesta, rc.calificacion_usuario,
        u.nombre AS admin_nombre, u.apellido AS admin_apellido
        FROM contactos c
        JOIN motivos m ON c.motivo_id = m.id
        LEFT JOIN respuestas_contactos rc ON c.id = rc.contacto_id
        LEFT JOIN usuarios u ON rc.admin_id = u.id
        WHERE c.id = $contacto_id AND c.correo = '" . $conn->real_escape_string($usuario_correo) . "'";

$result = $conn->query($sql);
if (!$result || $result->num_rows == 0) {
    echo "Mensaje no encontrado o no tienes permiso para verlo.";
    exit;
}
$fila = $result->fetch_assoc();
$calificacion_usuario = intval($fila['calificacion_usuario'] ?? 0);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../docs/iconito.php'; ?>
<meta charset="UTF-8" />
<title>Calificar Respuesta</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
.star-rating {
    font-size: 1.8rem;
    direction: rtl;
    display: inline-flex;
}
.star-rating input {
    display: none;
}
.star-rating label {
    color: #ccc;
    cursor: pointer;
}
.star-rating input:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #f5b301;
}
</style>
</head>
<body>
<div class="container mt-5">
    <h2>Calificar Respuesta del Administrador</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header">
            <strong>Mensaje de:</strong> <?= htmlspecialchars($fila['nombre']) ?> (<?= htmlspecialchars($fila['correo']) ?>)
        </div>
        <div class="card-body">
            <p><strong>Motivo:</strong> <?= htmlspecialchars($fila['motivo']) ?></p>
            <p><strong>Mensaje:</strong><br><?= nl2br(htmlspecialchars($fila['mensaje'])) ?></p>
            <p><strong>Respuesta del administrador (<?= htmlspecialchars($fila['admin_nombre'] . ' ' . $fila['admin_apellido']) ?>):</strong><br><?= nl2br(htmlspecialchars($fila['respuesta'])) ?></p>
        </div>
    </div>

    <form method="POST">
        <label class="form-label">Tu Calificación:</label>
        <div class="star-rating">
            <?php for ($i = 5; $i >= 1; $i--): ?>
                <input type="radio" id="star<?= $i ?>" name="calificacion" value="<?= $i ?>" <?= $calificacion_usuario === $i ? 'checked' : '' ?> required>
                <label for="star<?= $i ?>" title="<?= $i ?> estrellas">&#9733;</label>
            <?php endfor; ?>
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Guardar Calificación</button>
        <a href="ver_respuestas.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
                