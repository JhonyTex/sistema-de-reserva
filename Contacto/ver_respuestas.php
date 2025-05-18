<?php
session_start();
include '../CRUD/conexion.php';

$motivoFiltro = $_POST['motivo_filtro'] ?? '';
$fechaFiltro = $_POST['fecha_filtro'] ?? '';
$usuario_correo = $_SESSION['correo'] ?? '';

// Consulta principal para obtener mensajes del usuario
$sql = "SELECT c.*, m.descripcion AS motivo, rc.respuesta, rc.calificacion_usuario,
        u.nombre AS admin_nombre, u.apellido AS admin_apellido
        FROM contactos c
        JOIN motivos m ON c.motivo_id = m.id
        LEFT JOIN respuestas_contactos rc ON c.id = rc.contacto_id
        LEFT JOIN usuarios u ON rc.admin_id = u.id
        WHERE c.correo = '" . $conn->real_escape_string($usuario_correo) . "'";

if ($motivoFiltro) {
    $sql .= " AND m.descripcion = '" . $conn->real_escape_string($motivoFiltro) . "'";
}

if ($fechaFiltro) {
    $sql .= " AND DATE(c.fecha_envio) = '" . $conn->real_escape_string($fechaFiltro) . "'";
}

$sql .= " ORDER BY c.fecha_envio DESC";

$resultado = $conn->query($sql);

if (!$resultado) {
    echo "Error en la consulta: " . $conn->error;
    exit;
}

// Buscar respuestas automáticas para cada mensaje del usuario
$respuestas_automaticas = [];
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $motivo = $conn->real_escape_string($fila['motivo']);
        $mensaje = strtolower($fila['mensaje']);

        // Buscar coincidencia en palabra_clave para el motivo correspondiente
        $sql_auto = "SELECT palabra_clave, respuesta FROM respuestas_automaticas WHERE motivo = '$motivo'";
        $res_auto = $conn->query($sql_auto);

        $respuesta_automatica = null;
        if ($res_auto && $res_auto->num_rows > 0) {
            while ($row_auto = $res_auto->fetch_assoc()) {
                if (strpos($mensaje, strtolower($row_auto['palabra_clave'])) !== false) {
                    $respuesta_automatica = $row_auto['respuesta'];
                    break;
                }
            }
        }
        $respuestas_automaticas[$fila['id']] = $respuesta_automatica;
    }
    // Reposicionar cursor para mostrar mensajes
    $resultado->data_seek(0);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Mis Mensajes y Respuestas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
    body {
        background: #f0f2f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }
    .container-accordion {
        max-width: 700px;
        margin: auto;
        background: white;
        padding: 15px 20px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    h1 {
        color: #2575fc;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }
    .chat-message {
        padding: 10px 15px;
        border-radius: 15px;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    .user-message {
        background-color: #dcf8c6;
        text-align: right;
        margin-bottom: 8px;
        border-bottom-right-radius: 0;
    }
    .admin-message {
        background-color: #e9efff;
        text-align: left;
        margin-bottom: 8px;
        border-bottom-left-radius: 0;
    }
    .chat-info {
        font-size: 0.75rem;
        color: #666;
        margin-top: 4px;
    }
    .response-thread {
        margin-left: 20px;
        border-left: 3px solid #ccc;
        padding-left: 15px;
    }
    .response-thread .admin-message {
        background-color: #cce0ff;
    }
    .btn-back {
        display: block;
        max-width: 700px;
        margin: 30px auto 0;
    }
</style>
</head>

<?php include '../docs/iconito.php'; ?>
<body>

<div class="container-accordion">

    <h1>Chats de Mis Mensajes y Respuestas</h1>

    <form method="POST" class="mb-4 d-flex gap-2 flex-wrap justify-content-center">
        <select name="motivo_filtro" class="form-select" style="max-width: 200px;">
            <option value="">Filtrar por motivo</option>
            <option value="queja" <?= $motivoFiltro === 'queja' ? 'selected' : '' ?>>Queja</option>
            <option value="reclamo" <?= $motivoFiltro === 'reclamo' ? 'selected' : '' ?>>Reclamo</option>
            <option value="felicitacion" <?= $motivoFiltro === 'felicitacion' ? 'selected' : '' ?>>Felicitación</option>
            <option value="consulta" <?= $motivoFiltro === 'consulta' ? 'selected' : '' ?>>Consulta</option>
        </select>
        <input type="date" name="fecha_filtro" class="form-control" value="<?= htmlspecialchars($fechaFiltro) ?>" style="max-width: 180px;" />
        <button type="submit" class="btn btn-primary">Aplicar filtros</button>
    </form>

    <div class="accordion" id="accordionChats">
        <?php if ($resultado->num_rows > 0): ?>
            <?php 
            $index = 0;
            while ($fila = $resultado->fetch_assoc()): 
                $index++;
                $contacto_id_actual = $fila['id'];
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?= $index ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                        <strong><?= htmlspecialchars($fila['motivo']) ?></strong> - 
                        <?= date("d/m/Y H:i", strtotime($fila['fecha_envio'])) ?> - 
                        <?= htmlspecialchars(substr($fila['mensaje'], 0, 50)) ?>...
                    </button>
                </h2>
                <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionChats">
                    <div class="accordion-body">

                        <!-- Mensaje original usuario -->
                        <div class="chat-message user-message">
                            <?= nl2br(htmlspecialchars($fila['mensaje'])) ?>
                            <div class="chat-info"><?= date("d/m/Y H:i", strtotime($fila['fecha_envio'])) ?></div>
                        </div>

                        <!-- Respuesta admin -->
                        <?php if (!empty($fila['respuesta'])): ?>
                            <div class="chat-message admin-message">
                                <?= nl2br(htmlspecialchars($fila['respuesta'])) ?>
                                <div class="chat-info">
                                    Respondido por: <?= htmlspecialchars($fila['admin_nombre'] . ' ' . $fila['admin_apellido']) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Mostrar respuesta automática si existe -->
                            <?php if (!empty($respuestas_automaticas[$fila['id']])): ?>
                                <div class="chat-message admin-message" style="font-style: italic; color: #007bff;">
                                    <?= nl2br(htmlspecialchars($respuestas_automaticas[$fila['id']])) ?>
                                    <div class="chat-info"><em>Respuesta automática</em></div>
                                </div>
                            <?php else: ?>
                                <div class="chat-message admin-message" style="font-style: italic; color: #777;">
                                    No hay respuesta aún.
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

                        <!-- Respuestas adicionales de usuario y respuestas del admin -->
                        <?php
                        $respuestas_usuario_sql = "SELECT ru.*, u.nombre, u.apellido FROM respuestas_usuario ru
                                                  JOIN usuarios u ON ru.usuario_id = u.id
                                                  WHERE ru.contacto_id = $contacto_id_actual
                                                  ORDER BY ru.fecha_respuesta ASC";
                        $respuestas_usuario_res = $conn->query($respuestas_usuario_sql);
                        ?>

                        <div class="response-thread">
                            <?php if ($respuestas_usuario_res && $respuestas_usuario_res->num_rows > 0): ?>
                                <?php while($respUser = $respuestas_usuario_res->fetch_assoc()): ?>
                                    <div class="chat-message user-message">
                                        <?= nl2br(htmlspecialchars($respUser['respuesta'])) ?>
                                        <div class="chat-info"><?= htmlspecialchars($respUser['nombre'] . ' ' . $respUser['apellido']) ?> - <?= date("d/m/Y H:i", strtotime($respUser['fecha_respuesta'])) ?></div>
                                    </div>

                                    <?php
                                    // Respuestas admin a esta respuesta usuario
                                    $respAdminSQL = "SELECT rua.*, u.nombre AS admin_nombre, u.apellido AS admin_apellido 
                                                     FROM respuestas_usuario_admin rua
                                                     JOIN usuarios u ON rua.admin_id = u.id
                                                     WHERE rua.respuesta_usuario_id = " . intval($respUser['id']) . "
                                                     ORDER BY rua.fecha_respuesta ASC";
                                    $respAdminRes = $conn->query($respAdminSQL);
                                    ?>

                                    <?php if ($respAdminRes && $respAdminRes->num_rows > 0): ?>
                                        <?php while ($respAdmin = $respAdminRes->fetch_assoc()): ?>
                                            <div class="chat-message admin-message" style="margin-left: 40px; background-color: #cce0ff;">
                                                <?= nl2br(htmlspecialchars($respAdmin['respuesta'])) ?>
                                                <div class="chat-info">
                                                    Respondido por: <?= htmlspecialchars($respAdmin['admin_nombre'] . ' ' . $respAdmin['admin_apellido']) ?> - <?= date("d/m/Y H:i", strtotime($respAdmin['fecha_respuesta'])) ?>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                <?php endwhile; ?>
                            <?php else: ?>
                                <div style="font-style: italic; color: #666;">No hay respuestas adicionales.</div>
                            <?php endif; ?>

                            <!-- Formulario para agregar respuesta o pregunta -->
                            <form action="guardar_respuesta_usuario.php" method="POST" class="response-form mt-3">
                                <input type="hidden" name="contacto_id" value="<?= $contacto_id_actual ?>">
                                <textarea name="respuesta" rows="3" class="form-control" placeholder="Escribe una respuesta o pregunta..." required></textarea>
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Enviar</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center; color:#555;">No hay mensajes para mostrar.</p>
        <?php endif; ?>
    </div>

</div>

<a href="../perfil.php" class="btn btn-secondary btn-back" style="max-width:700px; margin:20px auto; display:block;">← Volver al Perfil</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
