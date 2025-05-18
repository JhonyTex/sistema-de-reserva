<?php
session_start();
include '../CRUD/conexion.php';

// Cargar tipo_usuario en sesión si no está definido
if (!isset($_SESSION['tipo_usuario']) && isset($_SESSION['usuario_id'])) {
    $uid = intval($_SESSION['usuario_id']);
    $sqlRol = "SELECT r.descripcion AS tipo_usuario FROM usuarios u JOIN roles r ON u.rol_id = r.id WHERE u.id = $uid LIMIT 1";
    $resRol = $conn->query($sqlRol);
    if ($resRol && $resRol->num_rows > 0) {
        $_SESSION['tipo_usuario'] = $resRol->fetch_assoc()['tipo_usuario'];
    }
}

// Variables de filtro
$motivoFiltro = $_POST['motivo_filtro'] ?? '';
$fechaFiltro = $_POST['fecha_filtro'] ?? '';

// Eliminar mensajes seleccionados
if (isset($_POST['delete_ids']) && is_array($_POST['delete_ids'])) {
    $delete_ids = implode(',', array_map('intval', $_POST['delete_ids']));
    $delete_sql = "DELETE FROM contactos WHERE id IN ($delete_ids)";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>alert('Mensajes eliminados exitosamente.'); window.location.href='';</script>";
        exit;
    } else {
        echo "Error al eliminar los mensajes: " . $conn->error;
    }
}

// Consulta principal con LEFT JOIN para traer respuesta del admin y datos del admin
$sql = "SELECT c.*, m.descripcion AS motivo, rc.respuesta AS respuesta_admin, u.nombre AS admin_nombre, u.apellido AS admin_apellido
        FROM contactos c
        JOIN motivos m ON c.motivo_id = m.id
        LEFT JOIN respuestas_contactos rc ON c.id = rc.contacto_id
        LEFT JOIN usuarios u ON rc.admin_id = u.id
        WHERE 1";

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../docs/iconito.php'; ?>
    <meta charset="UTF-8" />
    <title>Chats de Mensajes - Vista Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        .container-accordion {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px 25px 30px;
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
            max-width: 900px;
            margin: 30px auto 0;
        }
        /* Ajustes para móviles */
        @media (max-width: 767px) {
            .container-accordion {
                padding: 15px 10px 20px;
            }
        }
        .delete-checkbox {
            margin-right: 10px;
            transform: scale(1.2);
            vertical-align: middle;
        }
        .accordion-button > .form-check {
            margin-left: auto;
        }
    </style>
</head>
<body>

<div class="container-accordion">

    <h1>Chats de Mensajes - Vista Administrador</h1>

    <form method="POST" class="mb-4 d-flex gap-2 flex-wrap justify-content-center">
        <select name="motivo_filtro" class="form-select" style="max-width: 200px;">
            <option value="">Filtrar por motivo</option>
            <option value="queja" <?= $motivoFiltro === 'queja' ? 'selected' : '' ?>>Queja</option>
            <option value="reclamo" <?= $motivoFiltro === 'reclamo' ? 'selected' : '' ?>>Reclamo</option>
            <option value="felicitacion" <?= $motivoFiltro === 'felicitacion' ? 'selected' : '' ?>>Felicitación</option>
            <option value="consulta" <?= $motivoFiltro === 'consulta' ? 'selected' : '' ?>>Consulta</option>
        </select>
        <input type="date" name="fecha_filtro" class="form-control" value="<?= htmlspecialchars($fechaFiltro) ?>" style="max-width: 180px;" />
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>

    <form method="POST" id="deleteForm" onsubmit="return confirm('¿Estás seguro de eliminar los mensajes seleccionados?');">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3 gap-2">
            <button type="submit" class="btn btn-danger">Eliminar Mensajes Seleccionados</button>
            <input type="text" id="searchInput" class="form-control w-100 w-md-50" placeholder="Buscar mensajes..." onkeyup="filterChats()">
        </div>

        <div class="accordion" id="accordionChats">
            <?php if ($resultado->num_rows > 0): ?>
                <?php 
                $index = 0;
                while ($fila = $resultado->fetch_assoc()):
                    $index++;
                    $contacto_id_actual = $fila['id'];
                ?>
                <div class="accordion-item" data-chat-text="<?= htmlspecialchars($fila['mensaje'] . ' ' . $fila['respuesta_admin']) ?>">
                    <h2 class="accordion-header d-flex align-items-center" id="heading<?= $index ?>">
                        <button class="accordion-button collapsed flex-grow-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                            <strong><?= htmlspecialchars($fila['motivo']) ?></strong> - 
                            <?= date("d/m/Y H:i", strtotime($fila['fecha_envio'])) ?> - 
                            <?= htmlspecialchars(substr($fila['mensaje'], 0, 50)) ?>...
                        </button>
                        <input type="checkbox" name="delete_ids[]" class="delete-checkbox" value="<?= $contacto_id_actual ?>">
                    </h2>
                    <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#accordionChats">
                        <div class="accordion-body">

                            <!-- Mensaje original usuario -->
                            <div class="chat-message user-message">
                                <?= nl2br(htmlspecialchars($fila['mensaje'])) ?>
                                <div class="chat-info"><?= htmlspecialchars($fila['nombre'] ) ?> - <?= date("d/m/Y H:i", strtotime($fila['fecha_envio'])) ?></div>
                            </div>

                            <!-- Respuesta admin -->
                            <?php if (!empty($fila['respuesta_admin'])): ?>
                                <div class="chat-message admin-message">
                                    <?= nl2br(htmlspecialchars($fila['respuesta_admin'])) ?>
                                    <div class="chat-info">
                                        Respondido por: <?= htmlspecialchars($fila['admin_nombre'] . ' ' . $fila['admin_apellido']) ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="chat-message admin-message" style="font-style: italic; color: #777;">
                                    No hay respuesta aún.
                                </div>
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

                                        <a href="responder_respuesta_usuario.php?id=<?= $respUser['id']; ?>" class="btn btn-sm btn-outline-primary mb-3">Responder a esta respuesta</a>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <div style="font-style: italic; color: #666;">No hay respuestas adicionales de usuarios.</div>
                                <?php endif; ?>

                                <a href="responder_contacto.php?id=<?= $fila['id']; ?>" class="btn btn-sm btn-primary mt-3">Responder Mensaje</a>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center" style="color:#555;">No hay mensajes de contacto disponibles.</p>
            <?php endif; ?>
        </div>
    </form>

    <a href="../perfil.php" class="btn btn-secondary btn-back mt-3" style="max-width:900px; margin:20px auto; display:block;">← Volver al Perfil</a>
</div>

<script>
    function filterChats() {
        let input = document.getElementById('searchInput');
        let filter = input.value.toLowerCase();
        let chats = document.querySelectorAll('#accordionChats .accordion-item');

        chats.forEach(chat => {
            let text = chat.getAttribute('data-chat-text').toLowerCase();
            if(text.includes(filter)) {
                chat.style.display = '';
            } else {
                chat.style.display = 'none';
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
