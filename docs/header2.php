<?php
session_start();
include __DIR__ . '/../CRUD/conexion.php';

// Define la base del proyecto para usar rutas absolutas
$base_url = '/sistema-de-reserva';
?>

<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://a.mktgcdn.com/p/idwTYzb3nsUlCqldod3VdNSRWbbDfEOHIc0MsmvJJew/250x250.png" alt="Logo del Motel" class="logo" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/quienessomos.php"><i class="fas fa-users"></i> Quiénes Somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/Reserva/servicios.php"><i class="fas fa-concierge-bell"></i> Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/contacto.php"><i class="fas fa-envelope"></i> Contacto</a></li>

                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/ingresar.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= $base_url ?>/registro.php"><i class="fas fa-user-plus"></i> Crear Cuenta</a></li>
                    <?php else: ?>
                        <?php
                            $usuario_id = $_SESSION['usuario_id'];
                            $sql = "SELECT nombre, apellido, imagen_perfil FROM usuarios WHERE id = '$usuario_id'";
                            $resultado = $conn->query($sql);
                            $usuario = $resultado->fetch_assoc();
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?= $base_url ?>/uploads/<?php echo $usuario['imagen_perfil'] ?? 'default-avatar.png'; ?>" alt="Perfil" class="rounded-circle" width="30" height="30"> <?php echo $usuario['nombre']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= $base_url ?>/perfil.php">Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="<?= $base_url ?>/logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
