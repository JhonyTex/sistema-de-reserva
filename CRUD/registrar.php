<?php
include 'conexion.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $tipo_usuario = $_POST['tipo_usuario']; // Esta es la descripción del tipo de usuario (no el ID)
    $correo = $_POST['correo'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Hashear la contraseña

    // Obtener el ID del rol a partir de la descripción del tipo de usuario
    $sql_rol = "SELECT id FROM roles WHERE descripcion = '$tipo_usuario'";
    $result_rol = $conn->query($sql_rol);

    if ($result_rol->num_rows > 0) {
        $rol_id = $result_rol->fetch_assoc()['id']; // Obtener el rol_id

        // Crear la consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO usuarios (rol_id, correo, cedula, nombre, apellido, contrasena) 
                VALUES ('$rol_id', '$correo', '$cedula', '$nombre', '$apellido', '$contrasena')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado correctamente.";
            header("Location: ../ingresar.php"); // Redirigir al formulario de ingreso
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Tipo de usuario no válido.";
    }

    $conn->close();
}
?>
