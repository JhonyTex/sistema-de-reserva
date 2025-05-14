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

    // Verificar si el correo ya existe en la base de datos
    $sql_check_email = "SELECT id FROM usuarios WHERE correo = '$correo'";
    $result_email = $conn->query($sql_check_email);

    // Si ya existe el correo, redirigir con un mensaje de error
    if ($result_email->num_rows > 0) {
        header("Location: ../registro.php?error=correo_existente");
        exit;
    }

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
            // Redirigir a la página de registro con un parámetro de éxito
            header("Location: ../registro.php?registro=exitoso");
            exit;
        } else {
            // Si ocurre un error, mostrarlo en la consola
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Tipo de usuario no válido.";
    }

    $conn->close();
}
?>
