<!-- Perfil de usuario -->

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

// Verificar si hoy es el cumpleaños del usuario
$hoy = date("m-d");
$fecha_nacimiento = date("m-d", strtotime($usuario['fecha_nacimiento']));
$es_cumpleaños = ($hoy === $fecha_nacimiento);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .profile-container {
            margin: 50px auto;
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative; /* Necesario para posicionar el botón */
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #6c757d;
            margin-bottom: 20px;
        }

        /* Estilo del botón de actualizar imagen */
        .btn-update-img {
            position: center;
            top: 10px;
            right: -10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-update-img:hover {
            background-color: #0056b3;
        }

        .btn-update-img .tooltip-text {
            display: none;
            position: absolute;
            top: 0;
            left: 100%;
            margin-left: 10px;
            background-color: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-update-img:hover .tooltip-text {
            display: block;
        }

        /* Estilos de animación y otros elementos de la página */
        .balloons {
            font-size: 3rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        /* Estilos para la lluvia de globos */
        .balloon {
            position: absolute;
            width: 40px;
            height: 40px;
            background-color: #ff5733;
            border-radius: 50%;
            animation: fall 4s ease-in infinite;
            z-index: 1000;
        }

        @keyframes fall {
            0% { top: -50px; opacity: 1; }
            100% { top: 100vh; opacity: 0; }
        }

        /* Estrellas */
        .star {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #ffd700;
            border-radius: 50%;
            animation: star-fall 5s linear infinite;
            z-index: 500;
        }

        @keyframes star-fall {
            0% { top: -10px; opacity: 1; }
            100% { top: 100vh; opacity: 0; }
        }

        /* Mensajes de cumpleaños y motivacionales */
        .message {
            position: absolute;
            font-size: 1.5rem;
            color: #ff6347;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: float-message 5s ease-in-out infinite;
            z-index: 900;
            white-space: nowrap;
        }

        @keyframes float-message {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

        /* Estilos para la barra de navegación */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #343a40;
            z-index: 1000;
            padding: 10px;
        }

        nav .btn-info {
            position: absolute;
            left: 20px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><i class="fas fa-home"></i> Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
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
                    <a class="nav-link" href="CRUD/actualizar.php?id=<?php echo $usuario['id']; ?>"><i class="fas fa-edit"></i> Editar Mi Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
        
    <div class="container" style="margin-top: 70px;">
        <div class="profile-container">
            <!-- Imagen de perfil -->
            <img src="uploads/<?php echo $usuario['imagen_perfil'] ?? 'default-avatar.png'; ?>" alt="Imagen de Perfil" class="profile-image">

            <!-- Botón para actualizar imagen -->
            <button class="btn-update-img" data-bs-toggle="modal" data-bs-target="#modalActualizarImagen">
                <i class="fas fa-image"></i>
                <span class="tooltip-text">Cambiar Imagen</span>
            </button>   
                
            <!-- Modal para cargar nueva imagen -->
            <div class="modal fade" id="modalActualizarImagen" tabindex="-1" aria-labelledby="modalActualizarImagenLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalActualizarImagenLabel">Actualizar Imagen de Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="actualizar-imagen.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="imagen_perfil" class="form-label">Seleccionar nueva imagen</label>
                                    <input type="file" class="form-control" name="imagen_perfil" id="imagen_perfil" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                                 <!-- Mostrar el botón solo para administradores -->
                                <?php if ($usuario['tipo_usuario'] === 'administrador'): ?>
                                    <!-- <a href="ver_contactos.php" class="btn btn-primary mt-3">Ver Mensajes de Contacto</a> -->
                                <?php endif; ?>
                                                        
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bienvenida y datos del perfil -->
            <h2>Bienvenido, <?php echo $usuario['nombre'] . ' ' . $usuario['apellido']; ?>!</h2>
            <div class="profile-details">
                <p><strong>Tipo de usuario:</strong> <?php echo ucfirst($usuario['tipo_usuario']); ?></p>
                <p><strong>Correo:</strong> <?php echo $usuario['correo']; ?></p>
                <p><strong>Descripción:</strong> <?php echo nl2br(htmlspecialchars($usuario['descripcion'])); ?></p>
                <p><strong>Fecha de nacimiento:</strong> 
                    <?php
                    if (!empty($usuario['fecha_nacimiento'])) {
                        echo date("d/m/Y", strtotime($usuario['fecha_nacimiento']));
                    } else {
                        echo "No especificada";
                    }
                    ?>
                </p>
            </div>

            <!-- Botones de acción -->

           


            <!-- Mostrar mensaje de cumpleaños con globos si es el cumpleaños -->
            <?php if ($es_cumpleaños): ?>
                <div class="alert alert-success mt-3" role="alert">
                    <div class="balloons">🎈🎉 ¡Feliz Cumpleaños, <?php echo $usuario['nombre']; ?>! 🎉🎈</div>
                </div>
                <script>
                    function crearElemento(clase, animacion, cantidad, elemento) {
                        for (let i = 0; i < cantidad; i++) {
                            let nuevoElemento = document.createElement('div');
                            nuevoElemento.classList.add(clase);
                            document.body.appendChild(nuevoElemento);

                            if (clase === 'balloon') {
                                nuevoElemento.style.left = Math.random() * 100 + 'vw';
                            }
                            if (clase === 'star') {
                                nuevoElemento.style.left = Math.random() * 100 + 'vw';
                                nuevoElemento.style.animationDuration = Math.random() * 5 + 3 + 's';
                            }
                            if (clase === 'message') {
                                nuevoElemento.textContent = '¡Feliz Cumpleaños!';
                                nuevoElemento.style.left = Math.random() * 100 + 'vw';
                                nuevoElemento.style.animationDuration = Math.random() * 5 + 3 + 's';
                            }
                        }
                    }
                    crearElemento('balloon', 'fall', 15);
                    crearElemento('star', 'star-fall', 20);
                    crearElemento('message', 'float-message', 1);
                </script>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
