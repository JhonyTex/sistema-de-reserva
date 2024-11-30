<?php
include include '../CRUD/conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $conn->real_escape_string($_POST['usuario_id']);
    $nueva_contrasena = password_hash($_POST['nueva_contrasena'], PASSWORD_BCRYPT);

    $sql = "UPDATE usuarios SET contrasena = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nueva_contrasena, $usuario_id);

    if ($stmt->execute()) {
        // Eliminar token usado
        $sql_eliminar_token = "DELETE FROM recuperacion_password WHERE usuario_id = ?";
        $stmt_eliminar = $conn->prepare($sql_eliminar_token);
        $stmt_eliminar->bind_param("i", $usuario_id);
        $stmt_eliminar->execute();

        echo "Contraseña actualizada exitosamente.";
    } else {
        echo "Error al actualizar la contraseña.";
    }
}
?>
