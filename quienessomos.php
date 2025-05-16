<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quiénes Somos - Suite Star</title>
    <meta name="description" content="Conoce a Suite Star: visión, misión, historia y nuestro equipo dedicado a brindarte experiencias inolvidables en Medellín." />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> <!-- Bootstrap -->
    <link rel="stylesheet" href="css/quienessomos.css" />
    <style>
        /* Estilos básicos para las imágenes del equipo */
        .team-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
        }
        .team-member {
            flex: 1 1 150px;
            max-width: 180px;
            text-align: center;
        }
        .team-member img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.75rem;
            border: 2px solid #007bff;
        }
        .about-section,
        .vision,
        .mission,
        .history,
        .team-section,
        .testimonials-section {
            margin-bottom: 3rem;
        }
        .about-section h2,
        .vision h3,
        .mission h3,
        .history h3,
        .team-section h3,
        .testimonials-section h3 {
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: #004085;
        }
        /* Carrusel testimonial */
        .testimonials-section .carousel-item {
            text-align: center;
            padding: 2rem 1rem;
        }
        .testimonials-section .carousel-item img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 1rem;
            border: 2px solid #6c757d;
        }
        .testimonials-section .carousel-item p {
            font-style: italic;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            color: #343a40;
        }
        .testimonials-section .carousel-item h4 {
            font-weight: 700;
            color: #212529;
        }
    </style>
</head>
<body>

    <?php include 'docs.php/header2.php'; ?>

    <main class="container py-5">

        <!-- Sección "Quiénes Somos" -->
        <section class="about-section">
            <h2>Quiénes Somos</h2>
            <p>En nuestro motel, nos dedicamos a ofrecer experiencias únicas y confortables a nuestros huéspedes. Nuestro compromiso es brindar un servicio excepcional y crear recuerdos inolvidables.</p>
        </section>

        <!-- Nuestra Visión -->
        <section class="vision">
            <h3>Nuestra Visión</h3>
            <figure class="mb-4 text-center">
                <img src="https://chpeti20182916533.home.blog/wp-content/uploads/2019/03/vision.png" alt="Icono representativo de la visión de Suite Star" class="img-fluid" style="max-width: 120px;" />
                <figcaption class="visually-hidden">Icono representativo de la visión</figcaption>
            </figure>
            <article>
                <p class="lead">En Suite Star, nuestra visión es ser reconocidos como el mejor destino de descanso en Medellín, un lugar donde cada visitante no solo encuentra un lugar para alojarse, sino un refugio que les brinda comodidad y calidez. Aspiramos a crear un ambiente que supere las expectativas de nuestros clientes, convirtiendo cada estancia en una experiencia inolvidable.</p>

                <p>Nos esforzamos por ser líderes en la industria hotelera, destacando por nuestro compromiso con la excelencia en el servicio, la innovación en nuestras instalaciones y la personalización de la experiencia del huésped. Creemos que la atención al detalle es fundamental, y nos proponemos que cada rincón de Suite Star refleje la dedicación y el cuidado que ponemos en nuestro trabajo.</p>

                <p>Nuestra visión también implica ser un ejemplo de sostenibilidad y responsabilidad social, implementando prácticas que minimicen nuestro impacto ambiental y apoyen a la comunidad local. Buscamos colaborar con negocios y artistas locales, promoviendo así el desarrollo económico y cultural de nuestra ciudad.</p>

                <p>En Suite Star, estamos comprometidos a evolucionar constantemente, adaptándonos a las nuevas tendencias del mercado y a las necesidades cambiantes de nuestros huéspedes. Nuestro objetivo es construir relaciones duraderas con nuestros visitantes, para que siempre elijan Suite Star como su lugar de descanso preferido, volviendo una y otra vez a disfrutar de lo que ofrecemos.</p>
            </article>
        </section>

        <!-- Nuestra Misión -->
        <section class="mission">
            <h3>Nuestra Misión</h3>
            <figure class="mb-4 text-center">
                <img src="https://www.fundacionjan.cl/wp-content/uploads/mision.png" alt="Icono representativo de la misión de Suite Star" class="img-fluid" style="max-width: 120px;" />
                <figcaption class="visually-hidden">Icono representativo de la misión</figcaption>
            </figure>
            <article>
                <p class="lead">En Suite Star, nuestra misión es proporcionar una experiencia de alojamiento excepcional, donde cada huésped se sienta valorado, respetado y completamente a gusto. Nos esforzamos por crear un ambiente acogedor y personalizado, diseñado para satisfacer las necesidades individuales de cada uno de nuestros visitantes.</p>

                <p>Nos comprometemos a ofrecer un servicio de alta calidad, apoyándonos en un equipo apasionado y profesional que trabaja incansablemente para garantizar que cada estancia sea memorable. Desde el momento del check-in hasta el momento del check-out, cada detalle está cuidadosamente pensado para asegurar la máxima comodidad y satisfacción de nuestros huéspedes.</p>

                <p>Además, en Suite Star creemos que la hospitalidad va más allá de simplemente proporcionar un lugar donde quedarse. Por eso, fomentamos un ambiente de calidez y amabilidad, donde todos nuestros empleados están capacitados para brindar un servicio amigable y atento, asegurando que cada huésped se sienta como en casa.</p>

                <p>Nuestra misión también incluye la promoción de experiencias únicas que reflejen la cultura y belleza de Medellín. A través de nuestras recomendaciones personalizadas y servicios locales, buscamos enriquecer la estancia de nuestros huéspedes y ayudarles a descubrir lo mejor de nuestra ciudad.</p>

                <p>Finalmente, nuestra misión es evolucionar continuamente, adaptándonos a las tendencias del mercado y a las expectativas de nuestros huéspedes. Nos comprometemos a invertir en nuestras instalaciones y en la formación de nuestro personal, para seguir siendo un referente en la industria de la hospitalidad, donde la excelencia sea nuestra norma.</p>
            </article>
        </section>

        <!-- Nuestra Historia -->
        <section class="history text-center">
            <h3>Nuestra Historia</h3>
            <figure class="mb-4">
                <img src="https://www.periodicovictoria.cu/wp-content/uploads/2022/04/NuestraHistoria.png" alt="Icono representativo de la historia de Suite Star" class="img-fluid mx-auto" style="max-width: 120px;" />
                <figcaption class="visually-hidden">Icono representativo de la historia</figcaption>
            </figure>
            <article>
                <p class="lead">
                    Fundado en 1994 en la vibrante ciudad de Medellín, Suite Star nació con la misión de ofrecer un espacio acogedor y privado, diseñado para satisfacer las necesidades de nuestros huéspedes. Desde sus inicios, este pequeño motel familiar ha evolucionado hasta convertirse en un híbrido que combina lo mejor de un motel y un hotel, permitiendo a nuestros visitantes disfrutar de la flexibilidad y comodidad que buscan.
                </p>

                <p>
                    A lo largo de los años, hemos experimentado un crecimiento significativo. Inicialmente, nos enfocamos en ofrecer estancias breves y comenzamos a recibir a viajeros de diversas procedencias: desde parejas que buscan un refugio romántico, hasta familias que necesitan un lugar cómodo para descansar. Esta diversidad nos impulsó a expandir nuestras instalaciones y servicios, asegurando que cada huésped encuentre en Suite Star lo que necesita.
                </p>

                <p>
                    Con el tiempo, hemos llevado a cabo múltiples renovaciones y actualizaciones, adaptando nuestras habitaciones y áreas comunes para reflejar las tendencias contemporáneas, mientras mantenemos ese toque cálido y familiar que nos caracteriza. Nos enorgullece contar con un equipo apasionado y dedicado, que trabaja incansablemente para brindar un servicio excepcional y asegurarse de que cada visita sea memorable.
                </p>

                <p>
                    En Suite Star, creemos que cada huésped merece una experiencia única. Por eso, ofrecemos servicios personalizados que van desde check-ins discretos hasta recomendaciones locales, permitiendo que cada persona sienta que su estancia ha sido diseñada exclusivamente para ella. Nuestra ubicación estratégica en Medellín nos convierte en el punto de partida ideal para explorar la rica cultura y belleza de la ciudad.
                </p>

                <p>
                    Hoy, Suite Star no solo es un lugar para descansar; es un destino donde cada detalle ha sido cuidadosamente pensado para garantizar la satisfacción de nuestros huéspedes. Miramos hacia el futuro con la misma pasión y compromiso con los que comenzamos, agradeciendo a todos los que han formado parte de nuestra historia y han permitido que seamos parte de sus momentos más especiales.
                </p>
            </article>
        </section>

        <!-- Sección de equipo -->
        <section aria-label="Conoce a nuestro equipo">
            <h3 class="text-center mb-4">Conoce a Nuestro Equipo</h3>
            <div class="team-section" role="list">
                <article class="team-member" role="listitem">
                    <img src="https://cdn-icons-png.flaticon.com/512/4792/4792929.png" alt="Juan Pérez, Recepcionista" />
                    <h4>Juan Pérez</h4>
                    <p>Recepcionista</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://marketplace.canva.com/EAFmvP-YN8M/1/0/1600w/canva-avatar-foto-de-perfil-mujer-estudiante-dibujo-alegre-ilustrado-moderno-beige-y-morado-fD5F8qXmiwY.jpg" alt="Ana Gómez, Gerente" />
                    <h4>Ana Gómez</h4>
                    <p>Gerente</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://www.shutterstock.com/image-vector/young-smiling-man-avatar-3d-600nw-2124054758.jpg" alt="Pedro Pérez, Gerente de Ventas y Marketing" />
                    <h4>Pedro Pérez</h4>
                    <p>Gerente de Ventas y Marketing</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://img.freepik.com/fotos-premium/eleve-su-marca-avatar-amistoso-que-refleje-profesionalismo-ideal-gerentes-ventas_1283595-18531.jpg" alt="Jorge Camacho, Analista de Ventas" />
                    <h4>Jorge Camacho</h4>
                    <p>Analista de Ventas</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://static.vecteezy.com/system/resources/previews/002/002/403/non_2x/man-with-beard-avatar-character-isolated-icon-free-vector.jpg" alt="Mateo Rivera, Atención al Cliente" />
                    <h4>Mateo Rivera</h4>
                    <p>Atención al Cliente</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://img.freepik.com/vector-premium/ilustracion-avatar-mujer-negocios-retrato-usuario-dibujos-animados-simple-lider-empresarial_118339-4410.jpg" alt="Carolina Gómez, Procesos Financieros" />
                    <h4>Carolina Gómez</h4>
                    <p>Procesos Financieros</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://w7.pngwing.com/pngs/857/213/png-transparent-man-avatar-user-business-avatar-icon.png" alt="Ricardo Salazar, Vigilancia" />
                    <h4>Ricardo Salazar</h4>
                    <p>Vigilancia</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://img.clasf.co/2019/01/26/Aseo-General-20190126071301.2124140015.jpg" alt="Lucía Hernández, Servicios Generales" />
                    <h4>Lucía Hernández</h4>
                    <p>Servicios Generales</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://cdn3d.iconscout.com/3d/premium/thumb/granjero-indio-3378847-2808622.png?f=webp" alt="Pedro Jiménez, Jardinería" />
                    <h4>Pedro Jiménez</h4>
                    <p>Jardinería</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://img.freepik.com/vector-premium/ilustracion-avatar-mujer-negocios-retrato-usuario-dibujos-animados-simple-lider-empresarial_118339-4424.jpg" alt="María Torres, Servicios y Productividad" />
                    <h4>María Torres</h4>
                    <p>Servicios y Productividad</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://png.pngtree.com/png-clipart/20231019/original/pngtree-user-profile-avatar-png-image_13369991.png" alt="Javier López, Recursos Humanos" />
                    <h4>Javier López</h4>
                    <p>Recursos Humanos</p>
                </article>
                <article class="team-member" role="listitem">
                    <img src="https://cdn2.iconfinder.com/data/icons/professions/512/cook_woman_user-512.png" alt="Sofía Mendoza, Auxiliar de Cocina" />
                    <h4>Sofía Mendoza</h4>
                    <p>Auxiliar de Cocina</p>
                </article>
            </div>
        </section>

        <!-- Sección de testimonios con carrusel -->
        <section class="testimonials-section" aria-label="Testimonios de clientes">
            <h3 class="text-center mb-4">Testimonios</h3>
            <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel" aria-live="polite" aria-atomic="true">
                <div class="carousel-inner">
                    <div class="carousel-item active text-center">
                        <p>"¡Una experiencia increíble! El servicio fue excelente y la habitación muy cómoda."</p>
                        <img src="https://img.freepik.com/vector-premium/imagen-perfil-avatar-hombre-aislada-fondo-imagen-profil-avatar-hombre_1293239-4867.jpg" alt="Foto de Alvaro Bermudez, cliente" />
                        <h4>Alvaro Bermudez</h4>
                    </div>
                    <div class="carousel-item text-center">
                        <p>"Un lugar encantador con una atención excepcional. Me sentí como en casa."</p>
                        <img src="https://img.freepik.com/vector-premium/imagen-perfil-avatar-hombre-aislada-fondo-imagen-profil-avatar-hombre_1293239-4848.jpg" alt="Foto de Rafael Peña, cliente" />
                        <h4>Rafael Peña</h4>
                    </div>
                    <div class="carousel-item text-center">
                        <p>"Una experiencia maravillosa, el personal fue muy amable y atento. Sin duda volveré."</p>
                        <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211468.png" alt="Foto de Anderson Carmona, cliente" />
                        <h4>Anderson Carmona</h4>
                    </div>
                    <div class="carousel-item text-center">
                        <p>"Las instalaciones son impecables y la ubicación es perfecta. ¡Altamente recomendado!"</p>
                        <img src="https://st2.depositphotos.com/1006318/42378/v/950/depositphotos_423785530-stock-illustration-young-woman-profile-avatar-beautiful.jpg" alt="Foto de María Fernández, cliente" />
                        <h4>María Fernández</h4>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
                <div class="carousel-indicators mt-3">
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Testimonio 1"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Testimonio 2"></
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Testimonio 2"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Testimonio 3"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="3" aria-label="Testimonio 4"></button>
                </div>
            </div>
        </section>

    </main>

    <?php include 'docs.php/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
