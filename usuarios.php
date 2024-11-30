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
    $correo = $_SESSION['correo'];
    $sql = 
    "SELECT r.descripcion tipo_usuario from usuarios u, roles r where u.rol_id = r.id and u.correo = '$correo'" 

    
    ;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Gestión de Usuarios</h1>
            <a href="perfil.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver a mi Perfil</a>
        </div>

        <!-- Formulario de búsqueda y filtro -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o correo" value="<?= isset($_GET['buscar']) ? $_GET['buscar'] : '' ?>">
                </div>
                <div class="col-md-3">
                    <select name="rol" class="form-control">
                        <option value="">Seleccionar rol</option>
                        <option value="administrador" <?= isset($_GET['rol']) && $_GET['rol'] == 'administrador' ? 'selected' : '' ?>>Administrador</option>
                        <option value="recepcionista" <?= isset($_GET['rol']) && $_GET['rol'] == 'recepcionista' ? 'selected' : '' ?>>Recepcionista</option>
                        <option value="cliente" <?= isset($_GET['rol']) && $_GET['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                </div>
            </div>
        </form>

        <!-- Tabla de usuarios -->
        <table class="table table-striped">
            <thead>
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
                // Filtrar la consulta si hay un término de búsqueda o filtro
                $buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
                $rol = isset($_GET['rol']) ? $_GET['rol'] : '';

                // Consulta para obtener usuarios con su rol desde la tabla 'roles'
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

                // Ejecutar la consulta
                $resultado = $conn->query($sql);

                // Mostrar los resultados
                while ($usuario = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?></td>
                    <td><?= $usuario['correo'] ?></td>
                    <td><?= $usuario['tipo_usuario'] ?></td>
                    <td>
                        <!-- Botón para actualizar -->
                        <a href="CRUD/actualizar.php?id=<?= $usuario['id'] ?>" class="btn btn-warning btn-sm">Actualizar</a>
                        
                        <?php if ($_SESSION['tipo_usuario'] === 'administrador'): ?>
                        <!-- Botón para eliminar -->
                        <a href="CRUD/eliminar.php?id=<?= $usuario['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
