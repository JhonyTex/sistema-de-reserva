<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
  
  <style>
    /* Ajustar para que el contenido no quede debajo del nav */
    body {
      padding-top: 60px; /* Ajusta según la altura real del nav */
      margin: 0;
      min-height: 100vh;
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      font-family: Arial, sans-serif;
    }

    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .login-container {
      position: relative;
      z-index: 1;
      max-width: 400px;
      margin: 10vh auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 2.5rem 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.4);
      text-align: center;
    }

    .login-container h2 {
      margin-bottom: 1.5rem;
      color: #333;
      font-weight: 700;
    }

    form select.form-select,
    form input.form-control {
      margin-bottom: 1rem;
      border-radius: 8px;
      border: 1.5px solid #ccc;
      padding: 0.6rem 1rem;
      font-size: 1rem;
      transition: border-color 0.3s ease;
    }
    form select.form-select:focus,
    form input.form-control:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 8px rgba(0,123,255,0.3);
    }

    .login-button {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 8px;
      background-color: #007bff;
      color: white;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .login-button:hover {
      background-color: #0056b3;
    }

    .footer-link {
      color: #007bff;
      text-decoration: none;
      font-weight: 600;
    }
    .footer-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Menu de nav -->
  <?php include 'docs/header2.php'; ?>

  <!-- Contenedor de inicio de sesión -->
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="procesar-login.php" method="POST" novalidate>
      <select class="form-select" name="tipo_usuario" required>
        <option value="" disabled selected>Seleccione Tipo de Usuario</option>
        <option value="administrador">Administrador</option>
        <!-- <option value="recepcionista">Recepcionista</option> -->
        <option value="cliente">Cliente</option>
      </select>
      <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required />
      <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required />
      <button type="submit" class="login-button">Ingresar</button>
    </form>
    <p><a href="Recovery/recuperar-cuenta.php" class="footer-link">¿Olvidaste tu contraseña?</a></p>
    <p>¿No tienes cuenta? <a href="registro.php" class="footer-link">Regístrate aquí</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
