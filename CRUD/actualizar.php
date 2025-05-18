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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Actualizar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f7f9fc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .update-container {
            background: #fff;
            padding: 40px 35px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            max-width: 600px;
            width: 100%;
            position: relative;
        }
        .btn-back {
            position: absolute;
            top: 20px;
            right: 20px;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background-color: #6c757d;
            color: white;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #495057;
            text-decoration: none;
            color: white;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 30px;
            color: #343a40;
            text-align: center;
            letter-spacing: 1px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
        }
        .input-group-text {
            background-color: #e9ecef;
            border: none;
            color: #495057;
        }
        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 8px rgba(111, 66, 193, 0.4);
        }
        .btn-update {
            background-color: #6f42c1;
            border: none;
            font-weight: 600;
            padding: 12px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }
        .btn-update:hover {
            background-color: #5a3491;
        }
    </style>
</head>
<body>
    <div class="update-container shadow-sm">
        <a href="../perfil.php" class="btn-back" title="Volver al perfil">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h1>Actualizar Usuario</h1>
        <form method="POST" novalidate>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input
                        type="text"
                        class="form-control"
                        id="nombre"
                        name="nombre"
                        value="<?= htmlspecialchars($usuario['nombre']) ?>"
                        required
                    />
                </div>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                    <input
                        type="text"
                        class="form-control"
                        id="apellido"
                        name="apellido"
                        value="<?= htmlspecialchars($usuario['apellido']) ?>"
                        required
                    />
                </div>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input
                        type="email"
                        class="form-control"
                        id="correo"
                        name="correo"
                        value="<?= htmlspecialchars($usuario['correo']) ?>"
                        required
                    />
                </div>
            </div>
            <div class="mb-3">
                <label for="tipo_usuario" class="form-label">Tipo de Usuario</label>
                <select class="form-select" id="tipo_usuario" name="tipo_usuario" required>
                    <?php
                    $sql_roles = "SELECT * FROM roles";
                    $roles_resultado = $conn->query($sql_roles);
                    while ($rol = $roles_resultado->fetch_assoc()): ?>
                        <option value="<?= $rol['id'] ?>" <?= $usuario['rol_id'] == $rol['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($rol['descripcion']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea
                    class="form-control"
                    id="descripcion"
                    name="descripcion"
                    rows="4"
                    placeholder="Agrega una breve descripción..."
                ><?= htmlspecialchars($usuario['descripcion']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    <input
                        type="date"
                        class="form-control"
                        id="fecha_nacimiento"
                        name="fecha_nacimiento"
                        value="<?= htmlspecialchars($usuario['fecha_nacimiento']) ?>"
                        required
                    />
                </div>
            </div>
            <button type="submit" class="btn btn-update w-100">Actualizar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
