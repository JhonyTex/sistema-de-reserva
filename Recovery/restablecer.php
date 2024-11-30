<?php
include include '../CRUD/conexion.php'; // Conexión a la base de datos

$token = $_GET['token'] ?? null;

if ($token) {
    // Validar el token y verificar si ha expirado
    $sql = "SELECT usuario_id, expira FROM recuperacion_password WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $recuperacion = $resultado->fetch_assoc();
        if (strtotime($recuperacion['expira']) > time()) {
            // Mostrar formulario para restablecer contraseña
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Restablecer Contraseña</title>
            </head>
            <body>
                <h2>Restablecer Contraseña</h2>
                <form action="actualizar-contrasena.php" method="POST">
                    <input type="hidden" name="usuario_id" value="<?php echo $recuperacion['usuario_id']; ?>">
                    <label for="nueva_contrasena">Nueva Contraseña</label>
                    <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
                    <button type="submit">Actualizar Contraseña</button>
                </form>
            </body>
            </html>
            <?php
        } else {
            echo "El enlace ha expirado. Solicita uno nuevo.";
        }
    } else {
        echo "El token proporcionado no es válido.";
    }
} else {
    echo "No se proporcionó un token.";
}
?>
