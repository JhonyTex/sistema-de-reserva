<!-- recuperar-cuenta.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <form action="procesar-recuperacion.php" method="POST">
            <label for="correo">Ingresa tu correo electrónico</label>
            <input type="email" id="correo" name="correo" required placeholder="ejemplo@correo.com">
            <button type="submit">Enviar Enlace de Recuperación</button>
        </form>
    </div>
</body>
</html>
