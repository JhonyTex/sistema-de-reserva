<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ingresar.php");
    exit;
}

include 'CRUD/conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT u.*, r.descripcion AS tipo_usuario FROM usuarios u
        JOIN roles r ON u.rol_id = r.id
        WHERE u.id = '$usuario_id'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuario no encontrado.";
    exit;
}

$hoy = date("m-d");
$fecha_nacimiento = date("m-d", strtotime($usuario['fecha_nacimiento']));
$es_cumpleaños = ($hoy === $fecha_nacimiento);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Perfil de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            padding-top: 80px;
            color: #333;
        }
        .profile-card {
            max-width: 700px;
            margin: auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2rem;
            position: relative;
        }
        .profile-image {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #2575fc;
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.5);
            margin-bottom: 1rem;
        }
        .profile-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .profile-header h2 {
            font-weight: 600;
            font-size: 2.25rem;
            margin-bottom: 0.25rem;
            color: #2575fc;
        }
        .badge-role {
            background-color: #6a11cb;
            color: white;
            font-size: 0.9rem;
            padding: 0.4em 0.8em;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .profile-info {
            margin-top: 1rem;
            font-size: 1.1rem;
        }
        .profile-info p {
            margin-bottom: 0.8rem;
        }
        .profile-info i {
            color: #2575fc;
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }
        .btn-update-img {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #2575fc;
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(37,117,252,0.4);
            transition: background-color 0.3s ease;
        }
        .btn-update-img:hover {
            background-color: #1a4dc8;
        }
        /* Modal custom */
        .modal-header {
            background-color: #2575fc;
            color: white;
            border-bottom: none;
            border-radius: 15px 15px 0 0;
        }
        .modal-footer {
            border-top: none;
        }
        .alert-birthday {
            background-color: #ffecb3;
            color: #b37e00;
            font-weight: 600;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1.5rem;
            box-shadow: 0 3px 10px rgba(255, 236, 179, 0.7);
        }
        /* Estilo para el botón del nav para que no se desborde */
        .nav-link.btn {
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="historial_reservas.php"><i class="fas fa-history"></i> Historial de Reservas</a>
        </li>
        <?php if ($usuario['tipo_usuario'] === 'administrador'): ?>
        <li class="nav-item">
          <a class="nav-link" href="usuarios.php"><i class="fas fa-users-cog"></i> Administrar Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ver_contactos.php"><i class="fas fa-envelope"></i> Ver Mensajes</a>
        </li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="ver_respuestas.php" class="nav-link btn btn-info text-white px-3 me-3" style="border-radius: 5px;">
            <i class="fas fa-envelope-open-text"></i> Ver Mis Mensajes y Respuestas
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="CRUD/actualizar.php?id=<?php echo $usuario['id']; ?>"><i class="fas fa-edit"></i> Editar Mi Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="profile-card">
    <button class="btn-update-img" data-bs-toggle="modal" data-bs-target="#modalActualizarImagen" title="Cambiar Imagen">
        <i class="fas fa-camera"></i>
    </button>
    <div class="profile-header">
        <img src="uploads/<?php echo htmlspecialchars($usuario['imagen_perfil'] ?? 'default-avatar.png'); ?>" alt="Imagen de Perfil" class="profile-image" />
        <h2><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido']); ?></h2>
        <span class="badge-role"><?php echo ucfirst(htmlspecialchars($usuario['tipo_usuario'])); ?></span>
    </div>
    <div class="profile-info">
        <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($usuario['correo']); ?></p>
        <p><i class="fas fa-info-circle"></i> <?php echo nl2br(htmlspecialchars($usuario['descripcion'])); ?></p>
        <p><i class="fas fa-birthday-cake"></i> 
            <?php 
            echo !empty($usuario['fecha_nacimiento']) 
                ? date("d/m/Y", strtotime($usuario['fecha_nacimiento'])) 
                : "No especificada"; 
            ?>
        </p>
    </div>

    <?php if ($es_cumpleaños): ?>
        <div class="alert-birthday text-center">
            🎉 ¡Feliz Cumpleaños, <?php echo htmlspecialchars($usuario['nombre']); ?>! 🎉
        </div>
    <?php endif; ?>
</div>

<!-- Modal para actualizar imagen -->
<div class="modal fade" id="modalActualizarImagen" tabindex="-1" aria-labelledby="modalActualizarImagenLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalActualizarImagenLabel">Actualizar Imagen de Perfil</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form action="actualizar-imagen.php" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="imagen_perfil" class="form-label">Seleccionar nueva imagen</label>
            <input type="file" class="form-control" name="imagen_perfil" id="imagen_perfil" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
