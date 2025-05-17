<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: ingresar.php");
    exit;
}

include 'CRUD/conexion.php'; // Conexión a la base de datos

// Verificar si el tipo de usuario está en la sesión
if (!isset($_SESSION['tipo_usuario'])) {
    // Obtener el tipo de usuario desde la base de datos
    $correo = $conn->real_escape_string($_SESSION['correo']);
    $sql = "SELECT r.descripcion tipo_usuario FROM usuarios u JOIN roles r ON u.rol_id = r.id WHERE u.correo = '$correo'";
    $resultado = $conn->query($sql);
    if ($resultado->num_rows > 0) {
        $_SESSION['tipo_usuario'] = $resultado->fetch_assoc()['tipo_usuario'];
    } else {
        echo "Error: No se pudo obtener el rol del usuario.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestión de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Mejoras para móviles */
        @media (max-width: 767px) {
            /* Ajustar tamaño de texto y botones */
            table.table td, table.table th {
                white-space: normal !important;
                font-size: 0.85rem;
            }
            .btn-sm {
                font-size: 0.85rem;
                padding: 0.375rem 0.5rem;
            }
            /* Que el formulario ocupe toda la pantalla */
            form .row > div {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h1 class="mb-0">Gestión de Usuarios</h1>
        <a href="perfil.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver a mi Perfil</a>
    </div>

    <!-- Formulario de búsqueda y filtro -->
    <form method="GET" class="mb-3">
        <div class="row g-2">
            <div class="col-12 col-md-4">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o correo" value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
            </div>
            <div class="col-12 col-md-4">
                <select name="rol" class="form-select">
                    <option value="">Seleccionar rol</option>
                    <option value="administrador" <?= isset($_GET['rol']) && $_GET['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                    <option value="recepcionista" <?= isset($_GET['rol']) && $_GET['rol'] == 'recepcionista' ? 'selected' : '' ?>>Recepcionista</option>
                    <option value="cliente" <?= isset($_GET['rol']) && $_GET['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                </select>
            </div>
            <div class="col-12 col-md-4 d-grid">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <!-- Tabla de usuarios envuelta para scroll horizontal -->
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $buscar = isset($_GET['buscar']) ? $conn->real_escape_string($_GET['buscar']) : '';
                $rol = isset($_GET['rol']) ? $conn->real_escape_string($_GET['rol']) : '';

                $sql = "SELECT u.id, u.nombre, u.apellido, u.correo, r.descripcion AS tipo_usuario 
                        FROM usuarios u
                        INNER JOIN roles r ON u.rol_id = r.id
                        WHERE 1=1";

                if ($buscar) {
                    $sql .= " AND (u.nombre LIKE '%$buscar%' OR u.correo LIKE '%$buscar%')";
                }
                if ($rol) {
                    $sql .= " AND r.descripcion = '$rol'";
                }

                $resultado = $conn->query($sql);

                if ($resultado && $resultado->num_rows > 0):
                    while ($usuario = $resultado->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= htmlspecialchars($usuario['tipo_usuario']) ?></td>
                    <td>
                        <a href="CRUD/actualizar.php?id=<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">Actualizar</a>
                        <?php if ($_SESSION['tipo_usuario'] === 'administrador'): ?>
                        <a href="CRUD/eliminar.php?id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php
                    endwhile;
                else:
                ?>
                <tr>
                    <td colspan="5" class="text-center">No se encontraron usuarios.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
