<?php
session_start();
include 'CRUD/conexion.php';

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ingresar.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID de mensaje no proporcionado.";
    exit;
}

$contacto_id = intval($_GET['id']);
$admin_id = $_SESSION['usuario_id'] ?? 0;

// Obtener datos del mensaje original y respuesta
$stmt = $conn->prepare("SELECT c.*, m.descripcion AS motivo, rc.respuesta
                        FROM contactos c 
                        JOIN motivos m ON c.motivo_id = m.id
                        LEFT JOIN respuestas_contactos rc ON c.id = rc.contacto_id
                        WHERE c.id = ?");
$stmt->bind_param("i", $contacto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Mensaje no encontrado.";
    exit;
}

$mensaje = $result->fetch_assoc();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $respuesta = trim($_POST['respuesta'] ?? '');

    if (empty($respuesta)) {
        $error = "La respuesta no puede estar vacía.";
    } else {
        $checkStmt = $conn->prepare("SELECT id FROM respuestas_contactos WHERE contacto_id = ?");
        $checkStmt->bind_param("i", $contacto_id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            // UPDATE
            $updateStmt = $conn->prepare("UPDATE respuestas_contactos 
                                          SET respuesta = ?, fecha_respuesta = NOW(), admin_id = ? 
                                          WHERE contacto_id = ?");
            $updateStmt->bind_param("sii", $respuesta, $admin_id, $contacto_id);
            $success = $updateStmt->execute();
        } else {
            // INSERT
            $insertStmt = $conn->prepare("INSERT INTO respuestas_contactos (contacto_id, admin_id, respuesta) 
                                          VALUES (?, ?, ?)");
            $insertStmt->bind_param("iis", $contacto_id, $admin_id, $respuesta);
            $success = $insertStmt->execute();
        }

        if ($success) {
            echo "<script>alert('Respuesta guardada correctamente.'); window.location.href='ver_contactos.php';</script>";
            exit;
        } else {
            $error = "Error al guardar la respuesta: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Responder Mensaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Responder Mensaje de Contacto</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header">
            <strong>Mensaje de:</strong> <?= htmlspecialchars($mensaje['nombre']) ?> (<?= htmlspecialchars($mensaje['correo']) ?>)
        </div>
        <div class="card-body">
            <p><strong>Motivo:</strong> <?= htmlspecialchars($mensaje['motivo']) ?></p>
            <p><strong>Mensaje:</strong><br><?= nl2br(htmlspecialchars($mensaje['mensaje'])) ?></p>
            <p><strong>Fecha de envío:</strong> <?= date("d/m/Y H:i", strtotime($mensaje['fecha_envio'])) ?></p>
        </div>
    </div>

    <form method="POST">
        <div class="mb-3">
            <label for="respuesta" class="form-label">Respuesta</label>
            <textarea name="respuesta" id="respuesta" rows="5" class="form-control" required><?= htmlspecialchars($mensaje['respuesta'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Respuesta</button>
        <a href="ver_contactos.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
