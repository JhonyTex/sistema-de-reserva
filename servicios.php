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
                <input type="checkbox" id="service1" value="Habitación Estándar">
                <img src="https://hotelesdann.com/dann-carlton-bogota/wp-content/uploads/sites/3/2020/08/habitacin-estndar-hotel-dann-carlton-bogot-colombia_37577235816_o.jpg" alt="Habitación Estándar" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Estándar</h3>
                <p>Disfruta de nuestra habitación estándar con todas las comodidades necesarias para una estancia placentera.</p>
            </div>
            
            <div class="service-card">
                <input type="checkbox" id="service2" value="Habitación Deluxe">
                <img src="https://www.lasdunashotel.com/uploads/1/1/2/9/112964637/deluxe-rooms_1_orig.jpg" alt="Habitación Deluxe" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Habitación Deluxe</h3>
                <p>Nuestra habitación deluxe ofrece un espacio más amplio y lujoso, ideal para relajarse y descansar.</p>
            </div>
            
            <div class="service-card">
                <input type="checkbox" id="service3" value="Suite Presidencial">
                <img src="https://s3.amazonaws.com/static-webstudio-accorhotels-usa-1.wp-ha.fastbooking.com/wp-content/uploads/sites/19/2022/03/11175445/DUF_7063-v-ok-1170x780.jpg" alt="Suite Presidencial" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Suite Presidencial</h3>
                <p>La suite presidencial cuenta con una vista espectacular y servicios exclusivos para una experiencia inolvidable.</p>
            </div>

            <div class="service-card">
                <input type="checkbox" id="service4" value="Servicios Complementarios">
                <img src="https://hotelcongresosibiza.wordpress.com/wp-content/uploads/2010/06/piscina-exterior1.jpg" alt="Servicios Complementarios" style="width:100%; border-radius: 10px 10px 0 0;">
                <h3>Servicios Complementarios</h3>
                <p>Ofrecemos servicio de limpieza diario, acceso a piscina, y gimnasio para todos nuestros huéspedes.</p>
            </div>
        </div>

        <!-- Botón para agregar al carrito -->
        <button class="btn btn-primary mt-3" id="addToCartButton">Agregar al carrito</button>
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

    <!-- Carrito de compras (Modal) -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Servicios en el Carrito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="cartItems" class="list-group">
                        <!-- Los servicios seleccionados se mostrarán aquí -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="#">
                        <button type="button" class="btn btn-primary">Proceder al Pago</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Pie de página -->
    <?php include 'docs.php/footer.php'; ?>

    
    <script>
        document.getElementById('addToCartButton').addEventListener('click', function() {
            const selectedServices = [];
            const checkboxes = document.querySelectorAll('.service-card input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedServices.push(checkbox.value);
                }
            });

            if (selectedServices.length > 0) {
                // Mostrar el modal del carrito
                const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
                const cartItemsList = document.getElementById('cartItems');
                cartItemsList.innerHTML = ''; // Limpiar la lista

                selectedServices.forEach(service => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = service;
                    cartItemsList.appendChild(listItem);
                });

                cartModal.show();
            } else {
                alert('Por favor selecciona al menos un servicio.');
            }
        });

        // Lógica para el botón de proceder al pago
        document.getElementById('proceedToPaymentButton').addEventListener('click', function() {
            // Aquí puedes agregar la lógica para proceder al pago
            alert('Procediendo al pago...');
        });

        // Lógica para el botón del carrito
        document.getElementById('cartButton').addEventListener('click', function() {
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });
    </script>
</body>
</html>
