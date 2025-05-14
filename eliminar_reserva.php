<?php
session_start();

include 'CRUD/conexion.php'; // incluye conexión y crea $conn

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ingresar.php");
    exit;
}

if (isset($_GET['id'])) {
    $reserva_id = (int)$_GET['id'];
    $usuario_id = (int)$_SESSION['usuario_id'];

    // Verificar que la reserva pertenece al usuario (seguridad)
    $check_sql = "SELECT usuario_id FROM reservas WHERE id = $reserva_id";
    $result = $conn->query($check_sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['usuario_id'] != $usuario_id) {
            // Intento de borrar reserva de otro usuario: prohibido
            echo "No tienes permiso para eliminar esta reserva.";
            exit;
        }

        // Ejecutar eliminación
        $delete_sql = "DELETE FROM reservas WHERE id = $reserva_id";

        if ($conn->query($delete_sql) === TRUE) {
            header("Location: historial_reservas.php?mensaje=Reserva eliminada exitosamente");
            exit;
        } else {
            echo "Error al eliminar la reserva: " . $conn->error;
        }
    } else {
        echo "Reserva no encontrada.";
    }

} else {
    echo "No se ha proporcionado el ID de la reserva.";
}
?>
