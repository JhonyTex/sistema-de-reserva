<?php
session_start();
include 'conexion.php'; // Conexión a la base de datos

// Verificar si el usuario está autenticado
if (!isset($_SESSION['correo'])) {
    header("Location: ../ingresar.php");
    exit;
}

// Obtener el ID del usuario a actualizar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consultar los datos del usuario
$sql = "SELECT u.*, r.descripcion AS tipo_usuario FROM usuarios u 
        JOIN roles r ON u.rol_id = r.id 
        WHERE u.id = $id";
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    echo "Usuario no encontrado.";
    exit;
}

$usuario = $resultado->fetch_assoc();

// Actualizar datos si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $rol_id = $_POST['tipo_usuario'];  
    $descripcion = $_POST['descripcion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];

    // La columna 'tipo_usuario' se cambia a 'rol_id' en la consulta de actualización
    $sql_update = "UPDATE usuarios SET 
        nombre = '$nombre', 
        apellido = '$apellido', 
        correo = '$correo', 
        rol_id = '$rol_id',  
        descripcion = '$descripcion',
        fecha_nacimiento = '$fecha_nacimiento' 
        WHERE id = $id";

    if ($conn->query($sql_update)) {
        echo "<script>
                alert('Usuario actualizado con éxito.');
                window.location.href = '../perfil.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Error al actualizar: {$conn->error}');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <style>
        .update-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .btn-back {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn-update {
            margin-top: 15px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="update-container">
            <!-- Botón de regreso al perfil -->
            <a href="../perfil.php" class="btn btn-secondary btn-sm btn-back">Volver a mi perfil</a>

            <h1 class="text-center">Actualizar Usuario</h1>
            <form method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" value="<?= htmlspecialchars($usuario['apellido']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" class="form-control" name="correo" id="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tipo_usuario" class="form-label">Tipo de Usuario:</label>
                    <select class="form-select" name="tipo_usuario" id="tipo_usuario" required>
                        <?php
                        // Consultar los roles disponibles
                        $sql_roles = "SELECT * FROM roles";
                        $roles_resultado = $conn->query($sql_roles);

                        // Mostrar los roles como opciones
                        while ($rol = $roles_resultado->fetch_assoc()): ?>
                            <option value="<?= $rol['id'] ?>" <?= $usuario['rol_id'] == $rol['id'] ? 'selected' : '' ?>>
                                <?= $rol['descripcion'] ?>  <!-- Muestra el nombre del rol -->
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="4"><?= htmlspecialchars($usuario['descripcion']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" value="<?= $usuario['fecha_nacimiento'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary btn-update w-100">Actualizar</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
