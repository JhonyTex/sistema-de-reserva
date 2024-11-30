<?php
session_start();
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="quienessomos.php"><i class="fas fa-users"></i> Quiénes Somos</a></li>
                    <li class="nav-item"><a class="nav-link" href="servicios.php"><i class="fas fa-concierge-bell"></i> Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacto.php"><i class="fas fa-envelope"></i> Contacto</a></li>

                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                        <!-- Si no está logueado, mostrar botones de iniciar sesión y registrarse -->
                        <li class="nav-item"><a class="nav-link" href="ingresar.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="registro.php"><i class="fas fa-user-plus"></i> Crear Cuenta</a></li>
                    <?php else: ?>
                        <!-- Si está logueado, mostrar nombre y foto de perfil -->
                        <?php
                            // Obtener los datos del usuario
                            include 'CRUD/conexion.php';
                            $usuario_id = $_SESSION['usuario_id'];
                            $sql = "SELECT nombre, apellido, imagen_perfil FROM usuarios WHERE id = '$usuario_id'";
                            $resultado = $conn->query($sql);
                            $usuario = $resultado->fetch_assoc();
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="uploads/<?php echo $usuario['imagen_perfil'] ?? 'default-avatar.png'; ?>" alt="Perfil" class="rounded-circle" width="30" height="30"> <?php echo $usuario['nombre']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="perfil.php">Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="logout.php">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
</header>
