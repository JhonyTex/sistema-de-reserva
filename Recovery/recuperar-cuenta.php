<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../docs/iconito.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos para la página */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #8367f7, #d7c4f7);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }
        
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
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
            text-align: left;
            font-weight: bold;
            color: #555;
        }

        input[type="email"] {
            padding: 15px;
            font-size: 16px;
            border-radius: 10px;
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
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: linear-gradient(135deg, #8367f7, #6545b0);
            transform: translateY(-3px);
        }

        .success-message, .error-message {
            margin-top: 20px;
            font-size: 14px;
            padding: 10px;
            border-radius: 10px;
        }

        .success-message {
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
        }

        .error-message {
            background-color: #f8d7da;
            color: #842029;
            border: 1px solid #f5c2c7;
        }

        footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        footer a {
            color: #8367f7;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
    
</head>
<body> 
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <form action="procesar-recuperacion.php" method="POST">
            <label for="correo">Ingresa tu correo electrónico</label>
            <input type="email" id="correo" name="correo" required placeholder="ejemplo@correo.com">
            <button type="submit">Enviar Enlace de Recuperación</button>
        </form>
        <footer>
            <p>¿No tienes cuenta? <a href="../registro.php">Regístrate aquí</a></p>
        </footer>
    </div>
</body>
</html>
