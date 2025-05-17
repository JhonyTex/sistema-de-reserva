<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ingresar.php");
    exit;
}

include 'CRUD/conexion.php';

$usuario_id = (int)$_SESSION['usuario_id'];

// Obtener tipo de usuario para permisos
$sqlUser = "SELECT r.descripcion AS tipo_usuario FROM usuarios u 
            JOIN roles r ON u.rol_id = r.id
            WHERE u.id = $usuario_id";
$resultUser = $conn->query($sqlUser);

if ($resultUser && $resultUser->num_rows > 0) {
    $userData = $resultUser->fetch_assoc();
    $tipo_usuario = $userData['tipo_usuario'];
} else {
    echo "Error al obtener tipo de usuario.";
    exit;
}

// Variable para filtro por usuario (solo admins pueden filtrar)
$filtro_usuario = null;
if ($tipo_usuario === 'administrador' && isset($_GET['usuario_id'])) {
    $filtro_usuario = (int)$_GET['usuario_id'];
}

// Construir consulta para reservas
if ($tipo_usuario === 'administrador') {
    // Admin puede ver todas o filtrar por usuario
    if ($filtro_usuario) {
        $sql = "SELECT r.*, u.nombre, u.apellido FROM reservas r 
                JOIN usuarios u ON r.usuario_id = u.id 
                WHERE r.usuario_id = $filtro_usuario
                ORDER BY r.fecha_reserva DESC";
    } else {
        $sql = "SELECT r.*, u.nombre, u.apellido FROM reservas r
                JOIN usuarios u ON r.usuario_id = u.id
                ORDER BY r.fecha_reserva DESC";
    }
} else {
    // Usuarios normales solo sus reservas
    $sql = "SELECT * FROM reservas WHERE usuario_id = $usuario_id ORDER BY fecha_reserva DESC";
}

$resultado = $conn->query($sql);

// Obtener lista de usuarios para filtro (solo admins)
$usuarios = [];
if ($tipo_usuario === 'administrador') {
    $resUsers = $conn->query("SELECT id, nombre, apellido FROM usuarios ORDER BY nombre");
    if ($resUsers) {
        while ($row = $resUsers->fetch_assoc()) {
            $usuarios[] = $row;
        }
    }
}

// Mensaje opcional
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Historial de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-4">
        <h1>Historial de Reservas</h1>

        <a href="perfil.php" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Volver a mi Perfil
        </a>

        <?php if ($mensaje): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($mensaje) ?>
            </div>
        <?php endif; ?>

        <?php if ($tipo_usuario === 'administrador'): ?>
            <!-- Filtro para administrador -->
            <form method="GET" class="mb-3">
                <label for="usuario_id" class="form-label">Filtrar por usuario:</label>
                <select name="usuario_id" id="usuario_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Todos los usuarios --</option>
                    <?php foreach ($usuarios as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= ($filtro_usuario == $user['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($user['nombre'] . ' ' . $user['apellido']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        <?php endif; ?>

        <?php if ($resultado && $resultado->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <?php if ($tipo_usuario === 'administrador'): ?>
                                <th>Usuario</th>
                            <?php endif; ?>
                            <th>Fecha de Reserva</th>
                            <th>Fecha de Ingreso</th>
                            <th>Fecha de Salida</th>
                            <th>Cantidad de Personas</th>
                            <th>Tipo de Habitación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($reserva = $resultado->fetch_assoc()): ?>
                            <tr>
                                <?php if ($tipo_usuario === 'administrador'): ?>
                                    <td><?= htmlspecialchars($reserva['nombre'] . ' ' . $reserva['apellido']) ?></td>
                                <?php endif; ?>
                                <td><?= htmlspecialchars($reserva['fecha_reserva']) ?></td>
                                <td><?= htmlspecialchars($reserva['fecha_ingreso']) ?></td>
                                <td><?= htmlspecialchars($reserva['fecha_salida']) ?></td>
                                <td><?= (int)$reserva['cantidad_personas'] ?></td>
                                <td><?= htmlspecialchars(ucfirst($reserva['tipo_habitacion'])) ?></td>
                                <td><?= htmlspecialchars(ucfirst($reserva['estado'])) ?></td>
                                <td>
                                    <?php if ($reserva['estado'] === 'confirmada'): ?>
                                        <a href="cancelar_reserva.php?id=<?= (int)$reserva['id'] ?>" class="btn btn-warning btn-sm">Cancelar</a>
                                    <?php elseif ($reserva['estado'] === 'pendiente' && $tipo_usuario === 'administrador'): ?>
                                        <a href="aprobar_reserva.php?id=<?= (int)$reserva['id'] ?>" class="btn btn-success btn-sm">Aprobar</a>
                                        <a href="cancelar_reserva.php?id=<?= (int)$reserva['id'] ?>" class="btn btn-warning btn-sm">Cancelar</a>
                                    <?php endif; ?>
                                    <?php if ($reserva['estado'] !== 'eliminada'): ?>
                                        <a href="eliminar_reserva.php?id=<?= (int)$reserva['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">Eliminar</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No hay reservas para mostrar.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
