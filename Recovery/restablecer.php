<?php
include '../CRUD/conexion.php'; // Conexión a la base de datos

$token = $_GET['token'] ?? null;

if ($token) {
    // Validar el token y verificar si ha expirado
    $sql = "SELECT usuario_id, expira FROM recuperacion_password WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $recuperacion = $resultado->fetch_assoc();
        if (strtotime($recuperacion['expira']) > time()) {
            // Mostrar formulario para restablecer contraseña
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Restablecer Contraseña</title>
                <style>
                    /* Estilos Generales */
                    body {
                        font-family: Arial, sans-serif;
                        background: linear-gradient(135deg, #8367f7, #d7c4f7);
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                        color: #333;
                    }

                    .container {
                        background-color: #fff;
                        padding: 30px;
                        border-radius: 15px;
                        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
                        text-align: center;
                        width: 100%;
                        max-width: 400px;
                    }

                    h2 {
                        color: #6545b0;
                        margin-bottom: 20px;
                    }

                    form {
                        display: flex;
                        flex-direction: column;
                        gap: 15px;
                    }

                    label {
                        font-weight: bold;
                        text-align: left;
                        color: #555;
                    }

                    input[type="password"] {
                        padding: 10px;
                        font-size: 14px;
                        border-radius: 8px;
                        border: 1px solid #ccc;
                        width: 100%;
                        box-sizing: border-box;
                    }

                    button {
                        background: linear-gradient(135deg, #6545b0, #8367f7);
                        color: white;
                        font-weight: bold;
                        font-size: 16px;
                        border: none;
                        padding: 12px;
                        border-radius: 8px;
                        cursor: pointer;
                        transition: background 0.3s ease, transform 0.2s ease;
                    }

                    button:hover {
                        background: linear-gradient(135deg, #8367f7, #6545b0);
                        transform: translateY(-2px);
                    }

                    .error-message, .success-message {
                        margin-top: 20px;
                        font-size: 14px;
                        padding: 10px;
                        border-radius: 8px;
                        display: inline-block;
                        width: calc(100% - 20px);
                    }

                    .error-message {
                        background-color: #f8d7da;
                        color: #842029;
                        border: 1px solid #f5c2c7;
                    }

                    .success-message {
                        background-color: #d1e7dd;
                        color: #0f5132;
                        border: 1px solid #badbcc;
                    }
                </style>
            </head>
                <?php include '../docs/iconito.php'; ?>
            <body>
                <div class="container">
                    <h2>Restablecer Contraseña</h2>
                    <form action="actualizar-contrasena.php" method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo $recuperacion['usuario_id']; ?>">
                        <label for="nueva_contrasena">Nueva Contraseña</label>
                        <input type="password" id="nueva_contrasena" name="nueva_contrasena" required>
                        <button type="submit">Actualizar Contraseña</button>
                    </form>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "<div class='error-message'>El enlace ha expirado. Solicita uno nuevo.</div>";
        }
    } else {
        echo "<div class='error-message'>El token proporcionado no es válido.</div>";
    }
} else {
    echo "<div class='error-message'>No se proporcionó un token.</div>";
}
?>
