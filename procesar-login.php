<?php
session_start();
include 'CRUD/conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Validar credenciales
    $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // Iniciar sesión y guardar datos en la sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['correo'] = $usuario['correo'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            // Redirigir según el rol
            if ($usuario['tipo_usuario'] === 'administrador') {
                header("Location: usuarios.php");
            } else {
                header("Location: perfil.php");
            }
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo no encontrado.";
    }
}
?>
