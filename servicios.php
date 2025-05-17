<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Página de Servicios</title>

  <!-- Bootstrap y FontAwesome -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
  />

  <style>
    /* Asegura header y footer visibles */
    header,
    footer {
      position: relative;
      z-index: 10;
    }

    /* Fondo con overlay para la sección de servicios */
    .services-section {
      position: relative;
      background-image: url(
        "https://www.infobae.com/new-resizer/xBbI9tmdUpBYPN4T7yKzUpwYonQ=/arc-anglerfish-arc2-prod-infobae/public/TBF3OLDXRVFA5CBDDVOJ3HCUYI.jpg"
      );
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: white;
      padding: 4rem 2rem;
      z-index: 0;
    }

    .services-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: -1;
      pointer-events: none;
    }

    /* Estilo de títulos dentro de servicios para mejor contraste */
    .services-section h2 {
      text-align: center;
      margin-bottom: 2rem;
      font-weight: 700;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.7);
    }

    /* Grid para las tarjetas */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* Tarjetas de servicio */
    .service-card {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 10px;
      padding-bottom: 1rem;
      color: #000;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      overflow: hidden;
    }
    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
    }
    .service-card img {
      width: 100%;
      border-radius: 10px 10px 0 0;
      display: block;
    }
    .service-card h3 {
      padding: 0.5rem 1rem 0;
      font-weight: 700;
    }
    .service-card p {
      padding: 0 1rem 1rem;
      font-size: 0.95rem;
    }

    /* Sección reserva y estadísticas normales */
    .booking-section,
    .stats-section {
      padding: 3rem 1rem;
      max-width: 900px;
      margin: 2rem auto;
    }

    /* Fondo con overlay para la sección reserva */
    .booking-section {
      position: relative;
      background-image: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1350&q=80');
      background-size: cover;
      background-position: center;
      color: white;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.4);
    }
    .booking-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      border-radius: 15px;
      z-index: -1;
      pointer-events: none;
    }

    /* Estadísticas estilo simple */
    .stats-section {
      display: flex;
      justify-content: center;
      gap: 4rem;
      text-align: center;
    }
    .stat h3 {
      font-size: 2.5rem;
      color: #007bff;
      margin-bottom: 0.3rem;
    }
    .stat p {
      font-weight: 600;
      color: #555;
    }

    /* Mejoras formulario */
    .reservation-form {
      background: rgba(255, 255, 255, 0.95);
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
      color: #000;
    }

    .reservation-form .form-label {
      font-weight: 600;
      color: #333;
    }

    .reservation-form input.form-control,
    .reservation-form select.form-select,
    .reservation-form textarea.form-control {
      border-radius: 8px;
      border: 1.5px solid #ced4da;
      transition: border-color 0.3s ease;
    }
    .reservation-form input.form-control:focus,
    .reservation-form select.form-select:focus,
    .reservation-form textarea.form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
      outline: none;
    }

    .reservation-form button.btn-primary {
      width: 100%;
      padding: 0.75rem;
      font-size: 1.1rem;
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }
    .reservation-form button.btn-primary:hover {
      background-color: #0056b3;
    }

    /* Layout columnas en md+ */
    @media (min-width: 768px) {
      .reservation-form .row > div {
        margin-bottom: 1rem;
      }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <?php include 'docs.php/header2.php'; ?>

  <!-- Sección de servicios con fondo -->
  <section class="services-section">
    <h2>Nuestros Servicios</h2>

    <div class="services-grid">
      <div class="service-card">
        <img src="img/habitaciones/standar.jpg" alt="Habitación Estándar" />
        <h3>Habitación Estándar</h3>
        <p>
          Disfruta de nuestra habitación estándar con todas las comodidades necesarias para
          una estancia placentera.
        </p>
      </div>

      <div class="service-card">
        <img src="img/habitaciones/Deluxe.jpg" alt="Habitación Deluxe" />
        <h3>Habitación Deluxe</h3>
        <p>
          Nuestra habitación deluxe ofrece un espacio más amplio y lujoso, ideal para
          relajarse y descansar.
        </p>
      </div>

      <div class="service-card">
        <img src="img/habitaciones/president.jpg" alt="Suite Presidencial" />
        <h3>Suite Presidencial</h3>
        <p>
          La suite presidencial cuenta con una vista espectacular y servicios exclusivos para
          una experiencia inolvidable.
        </p>
      </div>

      <div class="service-card">
        <img src="img/habitaciones/complement.jpg" alt="Servicios Complementarios" />
        <h3>Servicios Complementarios</h3>
        <p>
          Ofrecemos servicio de limpieza diario, acceso a piscina, y gimnasio para todos
          nuestros huéspedes.
        </p>
      </div>

      <div class="service-card">
        <img src="img/habitaciones/junior.jpg" alt="Habitación Junior" />
        <h3>Habitación Junior</h3>
        <p>
          Una habitación moderna, ideal para viajes de negocios o escapadas románticas, con
          una decoración elegante y funcional.
        </p>
      </div>

      <div class="service-card">
        <img src="img/habitaciones/premium.jpg" alt="Habitación Premium" />
        <h3>Habitación Premium</h3>
        <p>
          La habitación Premium cuenta con una decoración sofisticada, servicios exclusivos y
          una vista impresionante para una experiencia única.
        </p>
      </div>
    </div>
  </section>

  <!-- Sección de reserva con imagen de fondo -->
  <section class="booking-section">
    <h2>Realiza tu Reserva</h2>
    <form action="procesar_reserva.php" method="POST" class="reservation-form">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="nombre" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Tu nombre" />
        </div>
        <div class="col-md-6 mb-3">
          <label for="apellido" class="form-label">Apellido</label>
          <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Tu apellido" />
        </div>
      </div>

      <div class="mb-3">
        <label for="correo" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="correo" name="correo" required placeholder="ejemplo@correo.com" />
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
          <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required />
        </div>
        <div class="col-md-6 mb-3">
          <label for="fecha_salida" class="form-label">Fecha de Salida</label>
          <input type="date" class="form-control" id="fecha_salida" name="fecha_salida" required />
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="cantidad_personas" class="form-label">Cantidad de Personas</label>
          <input
            type="number"
            class="form-control"
            id="cantidad_personas"
            name="cantidad_personas"
            required
            min="1"
            placeholder="Ej: 2"
          />
        </div>
        <div class="col-md-6 mb-3">
          <label for="telefono" class="form-label">Número de Teléfono</label>
          <input
            type="tel"
            class="form-control"
            id="telefono"
            name="telefono"
            required
            pattern="[0-9]{10}"
            placeholder="10 dígitos"
          />
        </div>
      </div>

      <div class="mb-3">
        <label for="tipo_habitacion" class="form-label">Tipo de Habitación Preferida</label>
        <select class="form-select" id="tipo_habitacion" name="tipo_habitacion" required>
          <option value="" disabled selected>Seleccione el tipo de habitación</option>
          <option value="estandar">Habitación Estándar</option>
          <option value="deluxe">Habitación Deluxe</option>
          <option value="presidencial">Suite Presidencial</option>
          <option value="junior">Habitación Junior</option>
          <option value="premium">Habitación Premium</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="preferencias_especiales" class="form-label">Preferencias Especiales</label>
        <textarea
          class="form-control"
          id="preferencias_especiales"
          name="preferencias_especiales"
          rows="3"
          placeholder="Escribe aquí cualquier detalle adicional..."
        ></textarea>
      </div>

      <div class="mb-3">
        <label for="metodo_pago" class="form-label">Método de Pago</label>
        <select class="form-select" id="metodo_pago" name="metodo_pago" required>
          <option value="" disabled selected>Seleccione un método de pago</option>
          <option value="tarjeta_credito">Tarjeta de Crédito</option>
          <option value="tarjeta_debito">Tarjeta de Débito</option>
          <option value="efectivo">Efectivo</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary btn-lg w-100">Realizar Reserva</button>
    </form>
  </section>

  <!-- Sección de estadísticas -->
  <div class="stats-section">
    <div class="stat">
      <h3>100+</h3>
      <p>Habitaciones Disponibles</p>
    </div>
    <div class="stat">
      <h3>2000+</h3>
      <p>Clientes Satisfechos</p>
    </div>
    <div class="stat">
      <h3>24/7</h3>
      <p>Servicio al Cliente</p>
    </div>
  </div>

  <!-- Footer -->
  <?php include "docs.php/footer.php"; ?>

  <!-- Scripts Bootstrap -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
