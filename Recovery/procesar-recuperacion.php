<!-- Procesar recuperacion -->
<?php
// Incluir conexión a la base de datos
include '../CRUD/conexion.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el correo electrónico ingresado
    $correo = $_POST['correo'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Obtener el ID del usuario
        $usuario = $resultado->fetch_assoc();
        $usuario_id = $usuario['id'];

        // Generar un token único para la recuperación
        $token = bin2hex(random_bytes(16));
        $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Insertar o actualizar el token en la tabla `recuperacion_password`
        $sql = "INSERT INTO recuperacion_password (usuario_id, token, expira) 
                VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE token = VALUES(token), expira = VALUES(expira)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $usuario_id, $token, $expira);
        $stmt->execute();

        // Crear el mensaje de simulación
        $mensaje = "Recupera tu contraseña haciendo clic en el siguiente enlace: \n";
        $mensaje .= "http://localhost/sistema-de-reserva/Recovery/restablecer.php?token=" . $token;

        // Guardar el mensaje en un archivo de texto
        file_put_contents('correo_prueba.txt', "Para: $correo\nMensaje:\n$mensaje\n\n", FILE_APPEND);

        // Confirmar al usuario
        echo "Se ha simulado el envío del correo. Revisa el archivo 'correo_prueba.txt'.";
    } else {
        echo "El correo electrónico no está registrado.";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
