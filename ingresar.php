<!-- Pagina de logueo -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/ingreso.css">
    
</head>
<body>

    <!-- Menu de nav -->
    <?php include 'docs.php/header2.php'; ?>

    <!-- Contenedor de inicio de sesión -->
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form action="procesar-login.php" method="POST">
    <select class="form-select" name="tipo_usuario" required>
        <option value="" disabled selected>Seleccione Tipo de Usuario</option>
        <option value="administrador">Administrador</option>
        <option value="recepcionista">Recepcionista</option>
        <option value="cliente">Cliente</option>
    </select>
    <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required>
    <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
    <button type="submit" class="login-button">Ingresar</button>
</form>
        <p><a href="Recovery/recuperar-cuenta.php" class="footer-link">¿Olvidaste tu contraseña?</a></p>
        <p>¿No tienes cuenta? <a href="registro.php" class="footer-link">Regístrate aquí</a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
