<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Usuario no logueado, redirigir a la página de login
    header("Location: ingresar.php");
    exit;
}

include 'CRUD/conexion.php'; // conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el id del usuario desde la sesión
    $usuario_id = (int)$_SESSION['usuario_id'];

    // Escapar y preparar datos para evitar inyección SQL
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $correo = $conn->real_escape_string($_POST['correo']);
    $fecha_ingreso = $conn->real_escape_string($_POST['fecha_ingreso']);
    $fecha_salida = $conn->real_escape_string($_POST['fecha_salida']);
    $cantidad_personas = (int)$_POST['cantidad_personas'];
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $tipo_habitacion = $conn->real_escape_string($_POST['tipo_habitacion']);
    $preferencias_especiales = $conn->real_escape_string($_POST['preferencias_especiales']);
    $metodo_pago = $conn->real_escape_string($_POST['metodo_pago']);
    $estado = 'pendiente';

    // Consulta SQL para insertar la reserva
    $sql = "INSERT INTO reservas (
                usuario_id, fecha_reserva, nombre, apellido, correo,
                fecha_ingreso, fecha_salida, cantidad_personas, tipo_habitacion,
                estado, telefono, preferencias_especiales, metodo_pago
            ) VALUES (
                $usuario_id, NOW(), '$nombre', '$apellido', '$correo',
                '$fecha_ingreso', '$fecha_salida', $cantidad_personas, '$tipo_habitacion',
                '$estado', '$telefono', '$preferencias_especiales', '$metodo_pago'
            )";

    if ($conn->query($sql) === TRUE) {
        // Reserva exitosa, redirigir o mostrar mensaje
        header("Location: perfil.php?reserva=exitosa");
        exit;
    } else {
        echo "Error al realizar la reserva: " . $conn->error;
    }

    $conn->close();

} else {
    echo "Método de solicitud no permitido.";
}
?>
