<?php
session_start();

include '../CRUD/conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../ingresar.php");
    exit;
}

if (isset($_GET['id'])) {
    $reserva_id = (int)$_GET['id'];
    $usuario_id = (int)$_SESSION['usuario_id'];

    // Obtener el rol del usuario (uniendo tablas usuarios y roles)
    $stmtRol = $conn->prepare("
        SELECT r.descripcion 
        FROM usuarios u 
        JOIN roles r ON u.rol_id = r.id 
        WHERE u.id = ?");
    $stmtRol->bind_param("i", $usuario_id);
    $stmtRol->execute();
    $resultRol = $stmtRol->get_result();

    $rol = '';
    if ($resultRol && $resultRol->num_rows > 0) {
        $rol = $resultRol->fetch_assoc()['descripcion'];
    }
    $stmtRol->close();

    // Obtener usuario dueño de la reserva
    $stmtCheck = $conn->prepare("SELECT usuario_id FROM reservas WHERE id = ?");
    $stmtCheck->bind_param("i", $reserva_id);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck && $resultCheck->num_rows > 0) {
        $row = $resultCheck->fetch_assoc();

        // Permitir eliminar si es dueño o administrador
        if ($row['usuario_id'] != $usuario_id && $rol !== 'administrador') {
            echo "No tienes permiso para eliminar esta reserva.";
            exit;
        }

        // Eliminar reserva
        $stmtDelete = $conn->prepare("DELETE FROM reservas WHERE id = ?");
        $stmtDelete->bind_param("i", $reserva_id);
        if ($stmtDelete->execute()) {
            $stmtDelete->close();
            $stmtCheck->close();
            header("Location: historial_reservas.php?mensaje=Reserva eliminada exitosamente");
            exit;
        } else {
            echo "Error al eliminar la reserva: " . $conn->error;
        }
    } else {
        echo "Reserva no encontrada.";
    }

    $stmtCheck->close();
} else {
    echo "No se ha proporcionado el ID de la reserva.";
}
?>
