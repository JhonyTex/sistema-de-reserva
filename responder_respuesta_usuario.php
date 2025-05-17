<?php
session_start();
include 'CRUD/conexion.php';

if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: ingresar.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("ID de respuesta no proporcionado.");
}

$id_respuesta_usuario = intval($_GET['id']);
$admin_id = intval($_SESSION['usuario_id']);

if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener respuesta del usuario y mensaje relacionado
$sql = "SELECT ru.*, c.nombre, c.correo, c.motivo_id FROM respuestas_usuario ru
        JOIN contactos c ON ru.contacto_id = c.id
        WHERE ru.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_respuesta_usuario);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows == 0) {
    die("Respuesta no encontrada.");
}
$respuesta_usuario = $result->fetch_assoc();

$error = '';
$success = '';

// Limpiar POST tras guardar para evitar mostrar texto viejo
$post_respuesta_admin = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_respuesta_admin = trim($_POST['respuesta_admin'] ?? '');

    if ($post_respuesta_admin === '') {
        $error = "La respuesta no puede estar vacía.";
    } else {
        $sql_insert = "INSERT INTO respuestas_usuario_admin (respuesta_usuario_id, admin_id, respuesta, fecha_respuesta) 
                       VALUES (?, ?, ?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);

        if (!$stmt_insert) {
            die("Error en prepare(): " . $conn->error);
        }

        $stmt_insert->bind_param("iis", $id_respuesta_usuario, $admin_id, $post_respuesta_admin);

        if ($stmt_insert->execute()) {
            $success = "Respuesta guardada correctamente.";
            $post_respuesta_admin = ''; // limpiar textarea
            // Redirigir tras éxito (opcional)
            echo "<script>alert('Respuesta guardada correctamente.'); window.location.href='ver_contactos.php';</script>";
            exit;
        } else {
            $error = "Error al guardar la respuesta: " . $stmt_insert->error;
        }
    }
}

// Opcional: obtener respuestas previas del admin a esta respuesta_usuario
$sql_historial = "SELECT rua.*, u.nombre, u.apellido FROM respuestas_usuario_admin rua
                  JOIN usuarios u ON rua.admin_id = u.id
                  WHERE rua.respuesta_usuario_id = ?
                  ORDER BY rua.fecha_respuesta ASC";
$stmt_hist = $conn->prepare($sql_historial);
$stmt_hist->bind_param("i", $id_respuesta_usuario);
$stmt_hist->execute();
$result_historial = $stmt_hist->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Responder a Respuesta del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Responder a Respuesta del Usuario</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <p><strong>Respuesta del Usuario:</strong></p>
    <div class="alert alert-secondary"><?= nl2br(htmlspecialchars($respuesta_usuario['respuesta'])) ?></div>

    <?php if ($result_historial->num_rows > 0): ?>
        <h5>Respuestas previas del administrador:</h5>
        <?php while ($respPrev = $result_historial->fetch_assoc()): ?>
            <div class="border rounded p-3 mb-2 bg-light">
                <small>
                    <strong><?= htmlspecialchars($respPrev['nombre'] . ' ' . $respPrev['apellido']) ?></strong> - 
                    <em><?= date("d/m/Y H:i", strtotime($respPrev['fecha_respuesta'])) ?></em>
                </small>
                <p><?= nl2br(htmlspecialchars($respPrev['respuesta'])) ?></p>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="respuesta_admin" class="form-label">Respuesta Administrador</label>
            <textarea name="respuesta_admin" id="respuesta_admin" rows="5" class="form-control" required><?= htmlspecialchars($post_respuesta_admin) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Respuesta</button>
        <a href="ver_contactos.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
