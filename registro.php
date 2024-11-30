<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    
<!-- Menu de nav -->
<?php include 'docs.php/header2.php'; ?> 

<!-- Contenedor de registro de usuario -->
<div class="register-container">
    <h2>Registro de Usuario</h2>
    <form action="CRUD/registrar.php" method="POST"> 
        <select class="form-select" name="tipo_usuario" required>
            <option value="" disabled selected>Seleccione Tipo de Usuario</option>
            <option value="administrador">Administrador</option>
            <option value="recepcionista">Recepcionista</option>
            <option value="cliente">Cliente</option>
        </select>
        <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required>
        <input type="text" class="form-control" name="cedula" placeholder="Cédula" required>
        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
        <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
        <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required>
        <button type="submit" class="register-button">Registrar</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="ingresar.php" class="footer-link">Inicia sesión aquí</a></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
