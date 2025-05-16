<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Registro de Usuario</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />

  <style>
    /* Para que el contenido no quede debajo del nav fijo */
    body {
      padding-top: 60px; /* Ajusta si el nav es más alto o bajo */
      font-family: Arial, sans-serif;
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80') no-repeat center center fixed;
      background-size: cover;
      position: relative;
      margin: 0;
      min-height: 100vh;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      background-color: rgba(0,0,0,0.6);
      z-index: 0;
      pointer-events: none;
    }

    /* Contenedor centrado y con estilo */
    .register-container {
      position: relative;
      z-index: 1;
      max-width: 420px;
      margin: 8vh auto 4rem auto;
      background: rgba(255, 255, 255, 0.95);
      padding: 2.5rem 2rem;
      border-radius: 12px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
      text-align: center;
      color: #333;
    }

    .register-container h2 {
      font-weight: 700;
      margin-bottom: 1.5rem;
    }

    /* Formularios y selects */
    form select.form-select,
    form input.form-control {
      margin-bottom: 1rem;
      border-radius: 8px;
      border: 1.5px solid #ced4da;
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

    /* Botón estilo similar */
    .register-button {
      width: 100%;
      padding: 0.75rem;
      font-size: 1.1rem;
      font-weight: 600;
      color: white;
      background-color: #007bff;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .register-button:hover {
      background-color: #0056b3;
    }

    /* Enlaces */
    .footer-link {
      color: #007bff;
      font-weight: 600;
      text-decoration: none;
    }
    .footer-link:hover {
      text-decoration: underline;
    }

    /* Alertas bootstrap dentro del contenedor para que se vean bien */
    .alert {
      text-align: left;
    }
  </style>
</head>
<body>

  <!-- Menu de nav -->
  <?php include 'docs.php/header2.php'; ?>

  <!-- Contenedor de registro de usuario -->
  <div class="register-container">
    <h2>Registro de Usuario</h2>
    
    <?php
    if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso') {
        echo '<div class="alert alert-success" role="alert">¡Registro exitoso! Puedes iniciar sesión ahora.</div>';
    }
    
    if (isset($_GET['error']) && $_GET['error'] == 'correo_existente') {
        echo '<div class="alert alert-danger" role="alert">Este correo ya está registrado. Por favor, usa otro correo electrónico.</div>';
    }
    ?>

    <form action="CRUD/registrar.php" method="POST"> 
      <select class="form-select" name="tipo_usuario" required>
        <option value="" disabled selected>Seleccione Tipo de Usuario</option>
        <option value="administrador">Administrador</option>
        <option value="recepcionista">Recepcionista</option>
        <option value="cliente">Cliente</option>
      </select>
      <input type="email" class="form-control" name="correo" placeholder="Correo Electrónico" required />
      <input type="text" class="form-control" name="cedula" placeholder="Cédula" required />
      <input type="text" class="form-control" name="nombre" placeholder="Nombre" required />
      <input type="text" class="form-control" name="apellido" placeholder="Apellido" required />
      <input type="password" class="form-control" name="contrasena" placeholder="Contraseña" required />
      <button type="submit" class="register-button">Registrar</button>
    </form>
    <p>¿Ya tienes cuenta? <a href="ingresar.php" class="footer-link">Inicia sesión aquí</a></p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

  <script>
  // Redirige después de 5 segundos si registro exitoso
  <?php
  if (isset($_GET['registro']) && $_GET['registro'] == 'exitoso') {
      echo 'setTimeout(function() { window.location.href = "ingresar.php"; }, 5000);';
  }
  ?>
  </script>
</body>
</html>
