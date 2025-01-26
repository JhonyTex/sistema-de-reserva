<?php
include 'conexion.php';  // Asegúrate de usar el formato correcto

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $motivo = mysqli_real_escape_string($conn, $_POST['motivo']);
    $mensaje = mysqli_real_escape_string($conn, $_POST['message']);

    // Verificar si los campos están vacíos
    if (empty($nombre) || empty($email) || empty($motivo) || empty($mensaje)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Obtener el ID del motivo a partir de la tabla motivos
    $sql_motivo = "SELECT id FROM motivos WHERE descripcion = '$motivo'";
    $result_motivo = $conn->query($sql_motivo);

    if ($result_motivo->num_rows > 0) {
        $motivo_id = $result_motivo->fetch_assoc()['id'];
    } else {
        echo "Motivo no válido.";
        exit;
    }

    // Crear la consulta SQL para insertar el contacto
    $sql = "INSERT INTO contactos (nombre, correo, motivo_id, mensaje, fecha_envio) 
            VALUES ('$nombre', '$email', '$motivo_id', '$mensaje', NOW())";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        // Si la inserción fue exitosa, mostrar el mensaje de éxito
        echo '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Contacto Enviado</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        </head>
        <body>
            <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="successModalLabel">¡Mensaje Enviado!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Hemos recibido su mensaje con éxito. ¡Gracias por contactarnos!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="window.location.href=\'../contacto.php\';">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script>
                var myModal = new bootstrap.Modal(document.getElementById("successModal"), {keyboard: false});
                myModal.show();
            </script>
        </body>
        </html>';
    } else {
        // Si hubo un error al insertar, mostrar el error
        echo "Error al enviar el mensaje: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si el método no es POST
    echo "Acceso no válido.";
}
?>
