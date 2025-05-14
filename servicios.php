<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Servicios</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> <!-- Bootstrap -->
    <link rel="stylesheet" href="css/servicios.css">
</head>
<body> 
    <!-- Header de navegación -->
    <?php include 'docs.php/header2.php'; ?>

    <!-- Sección de servicios -->
    <section class="services-section">
        <h2>Nuestros Servicios</h2>

        <div class="services-grid">
            <div class="service-card">
    
                <img src="img/habitaciones/standar.jpg" alt="Habitación Estándar" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Estándar</h3>
                <p>Disfruta de nuestra habitación estándar con todas las comodidades necesarias para una estancia placentera.</p>
            </div>
            
            <div class="service-card">
                <img src="img/habitaciones/Deluxe.jpg" alt="Habitación Deluxe" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Deluxe</h3>
                <p>Nuestra habitación deluxe ofrece un espacio más amplio y lujoso, ideal para relajarse y descansar.</p>
            </div>
            
            <div class="service-card">
                <img src="img/habitaciones/president.jpg" alt="Suite Presidencial" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Suite Presidencial</h3>
                <p>La suite presidencial cuenta con una vista espectacular y servicios exclusivos para una experiencia inolvidable.</p>
            </div>

            <div class="service-card">
                <img src="img/habitaciones/complement.jpg" alt="Servicios Complementarios" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Servicios Complementarios</h3>
                <p>Ofrecemos servicio de limpieza diario, acceso a piscina, y gimnasio para todos nuestros huéspedes.</p>
            </div>

            <!-- Nuevas habitaciones añadidas -->
            <div class="service-card">
                <img src="img/habitaciones/junior.jpg" alt="Habitación Junior" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Junior</h3>
                <p>Una habitación moderna, ideal para viajes de negocios o escapadas románticas, con una decoración elegante y funcional.</p>
            </div>

            <div class="service-card">
                <img src="img/habitaciones/premium.jpg" alt="Habitación Premium" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Premium</h3>
                <p>La habitación Premium cuenta con una decoración sofisticada, servicios exclusivos y una vista impresionante para una experiencia única.</p>
            </div>
        </div>
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

    <!-- Pie de página -->
    <?php include 'docs.php/footer.php'; ?>

</body>
</html>
