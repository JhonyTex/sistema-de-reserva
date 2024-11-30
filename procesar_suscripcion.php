<?php
// Conexión a la base de datos
include 'CRUD/conexion.php'; // Ajusta la ruta según la ubicación real de tu archivo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar y validar el correo electrónico
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            alert('Por favor, ingresa un correo electrónico válido.');
            window.history.back();
        </script>";
        exit;
    }

    // Verificar si el correo ya existe en la base de datos
    $sql_check = "SELECT id FROM boletin WHERE correo = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
            alert('Este correo ya está suscrito a nuestro boletín.');
            window.history.back();
        </script>";
    } else {
        // Insertar el correo en la base de datos
        $sql_insert = "INSERT INTO boletin (correo) VALUES (?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param('s', $correo);

        if ($stmt->execute()) {
            // Redirección en caso de éxito
            header("Location: gracias.php");
            exit;
        } else {
            echo "<script>
                alert('Ocurrió un error. Inténtalo de nuevo más tarde.');
                window.history.back();
            </script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
