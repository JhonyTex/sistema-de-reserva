<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> <!-- Bootstrap -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

   <?php include 'docs.php/header2.php';?>

    <!-- Banner de Imágenes (Carrusel) -->
    <div id="banner" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://cdn.image.geze.com/im/StageSpezial/pboxx-pixelboxx-579337/Tab" class="d-block w-100" alt="Imagen 1" width="511">
                <div class="carousel-caption">
                    <h5>Bienvenido a Suite Star</h5>
                    <p>Un lugar de confort y lujo.</p>
                </div>
            </div>
            <!-- <div class="carousel-item">
                <img src="https://www.piscinasferromar.com/blog/wp-content/uploads/2022/09/agua-piscina.jpg" class="d-block w-100" alt="Imagen 2" width="511">
                <div class="carousel-caption">
                    <h5>Relájate en nuestra piscina</h5>
                    <p>Un lugar ideal para descansar.</p>
                </div>
            </div> -->
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#banner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banner" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button> -->
    </div>

    <!-- Sección de servicios -->
<section class="services-section">
    <div class="service">
        <img src="img/barista.jpg" alt="Servicio 1">
        <h4>Servicio de Bar</h4>
        <p>Disfruta de una variedad de bebidas en nuestro bar, abierto todo el día.</p>
    </div>
    <div class="service">
        <img src="https://jlvhomedesign.com/wp-content/uploads/2018/10/parqueaderos-1200x628.png" alt="Servicio 2">
        <h4>Servicio de Parqueadero</h4>
        <p>Contamos con un amplio parqueadero seguro para nuestros huéspedes.</p>
    </div>
    <div class="service">
        <img src="https://qualitygb.com/wp-content/uploads/2021/11/young-hotel-maid-putting-stack-of-fresh-white-bath-towels-870x440.jpg" alt="Servicio 3">
        <h4>Servicio de Habitaciones</h4>
        <p>Habitaciones cómodas y equipadas para garantizar su descanso.</p>
    </div>
    <div class="service">
        <img src="https://www.unileverfoodsolutions.es/ideas-menu/especial-hoteles/room-service/tipos-de-room-service/jcr:content/parsys/content-aside-footer/image_95613707.img.jpg/1695810655513.jpg" alt="Room Service">
        <h4>Room Service</h4>
        <p>Servicio a la habitación disponible las 24 horas para su comodidad.</p>
    </div>
    <div class="service">
        <img src="https://aranwahotels.com/wp-content/uploads/2019/01/SPA-COLCA-2.jpg" alt="Servicio 5">
        <h4>Servicio de Spa</h4>
        <p>Relájese y disfrute de tratamientos de spa en nuestras instalaciones.</p>
    </div>
    <div class="service">
        <img src="https://www.superprof.com.ar/blog/wp-content/uploads/2019/02/un_entrenador_personal_puede_trabajar_en_el_domicilio_del_alumno_al_aire_libre_o_en_un_gimnasio.jpg" alt="Servicio 6">
        <h4>Gimnasio</h4>
        <p>Manténgase en forma durante su estancia con nuestro gimnasio totalmente equipado.</p>
    </div>
    <div class="service">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTCQ1odV0Y5HHxBEH_lgAY2-t3i_UX3E5WIiQ&s" alt="Servicio 7">
        <h4>Servicio de Lavandería</h4>
        <p>Ofrecemos servicio de lavandería para su conveniencia.</p>
    </div>
    <div class="service">
        <img src=https://st3.depositphotos.com/4385731/19406/i/450/depositphotos_194068810-stock-photo-full-breakfast-table-coffee-juice.jpg alt="Servicio 8">
        <h4>Desayuno Incluido</h4>
        <p>Disfrute de un delicioso desayuno incluido en su estadía.</p>
    </div>
</section>

<?php include 'docs.php/footer.php'; ?>
   
    
</body>
</html>
