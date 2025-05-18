<?php session_start() ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Quiénes Somos - Suite Star</title>
    <meta name="description" content="Conoce a Suite Star: hotel y motel híbrido en Medellín, que combina privacidad, comodidad y servicios excepcionales para todos nuestros huéspedes." />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" /> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" /> <!-- Bootstrap -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        main.container {
            max-width: 1100px;
            margin-top: 4rem;
            margin-bottom: 4rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 2rem 2.5rem;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        /* Fondos con overlay para secciones */
        .vision, .mission, .history {
            position: relative;
            border-radius: 12px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            color: #fff;
            overflow: hidden;
        }
        .vision {
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1050&q=80') center/cover no-repeat;
        }
        .mission {
            background: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwwjG2TH8JP7gdinbjSWJsZtHP0aIYXuvOag&s') center/cover no-repeat;
        }
        .history {
            background: url('https://cdn0.matrimonio.com.co/vendor/2828/3_2/960/jpg/nuestrahh-mesa-de-trabajo-1_10_112828-173219309545441.jpeg') center/cover no-repeat;
        }

        /* Overlay semitransparente para que el texto resalte */
        .vision::before,
        .mission::before,
        .history::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 51, 102, 0.65);
            z-index: 0;
            border-radius: 12px;
        }

        /* Texto por encima del overlay */
        .vision > article,
        .mission > article,
        .history > article {
            position: relative;
            z-index: 1;
        }
        .vision h3,
        .mission h3,
        .history h3 {
            position: relative;
            z-index: 1;
        }

        /* Ajuste de imágenes en figuras para que tengan sombra y margen */
        figure img {
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }

        /* Equipo: más espacios y fondo blanco con sombra */
        .team-section {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
            background: #fff;
            padding: 2rem 1rem;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
            margin-bottom: 3rem;
        }

        /* Sutil sombra en cards de equipo para destacarlos */
        .team-member {
            flex: 1 1 150px;
            max-width: 180px;
            text-align: center;
            background: #f1f9ff;
            border-radius: 12px;
            padding: 1rem 1rem 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
            transition: transform 0.3s ease;
        }
        .team-member:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }
        .team-member img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.75rem;
            border: 3px solid #007bff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* Testimonios: fondo y margen */
        .testimonials-section {
            background: #fff;
            padding: 2rem 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        .testimonials-section h3 {
            color: #004085;
        }
        /* Ajuste de flechas carousel */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(25%) sepia(100%) saturate(500%) hue-rotate(200deg);
        }
    </style>
</head>
<body>

    <?php include 'docs/header2.php'; ?>

    <main class="container py-5">

        <!-- Nuestra Visión -->
        <section class="vision">
            <h3>Nuestra Visión</h3>
            <figure class="mb-4 text-center">
                <img src="https://chpeti20182916533.home.blog/wp-content/uploads/2019/03/vision.png" alt="Icono representativo de la visión de Suite Star" class="img-fluid" style="max-width: 120px;" />
                <figcaption class="visually-hidden">Icono representativo de la visión</figcaption>
            </figure>
            <article>
                <p class="lead">En Suite Star aspiramos a ser el principal destino híbrido en Medellín que combina la discreción y privacidad de un motel con la comodidad y servicios de un hotel de alta calidad.</p>

                <p>Buscamos superar las expectativas de cada huésped, ofreciendo un espacio versátil que se adapta tanto a estancias cortas como prolongadas, siempre con atención personalizada y un ambiente acogedor.</p>

                <p>Nuestra visión incluye liderar con innovación, sostenibilidad y compromiso social, colaborando con la comunidad local y fomentando un turismo responsable y de calidad.</p>

                <p>Queremos que Suite Star sea reconocido como un referente en hospitalidad, donde cada visitante se sienta valorado y regrese una y otra vez por la experiencia única que ofrecemos.</p>
            </article>
        </section>

        <!-- Nuestra Misión -->
        <section class="mission">
            <h3>Nuestra Misión</h3>
            <figure class="mb-4 text-center">
                <img src="https://cdn-akled.nitrocdn.com/yJLDuGsJiIYmcFrHluMbClisxRQPfGZw/assets/images/optimized/rev-226fe51/academia.crandi.com/wp-content/uploads/2020/07/Mision2-1024x661.jpg" alt="Icono representativo de la misión de Suite Star" class="img-fluid" style="max-width: 120px;" />
                <figcaption class="visually-hidden">Icono representativo de la misión</figcaption>
            </figure>
            <article>
                <p class="lead">Proporcionar a nuestros huéspedes una experiencia de alojamiento flexible y excepcional, donde la privacidad y el confort se unen para satisfacer diversas necesidades.</p>

                <p>Ofrecemos un ambiente cálido y seguro, apoyado por un equipo comprometido que garantiza atención profesional y personalizada en cada etapa de la estancia.</p>

                <p>Fomentamos un servicio amable y atento, entendiendo que la hospitalidad va más allá de un espacio físico, buscando siempre que nuestros visitantes se sientan como en casa.</p>

                <p>Además, promovemos la riqueza cultural de Medellín a través de recomendaciones y servicios locales que enriquecen la experiencia de nuestros clientes.</p>

                <p>Nos mantenemos en constante evolución, invirtiendo en infraestructura y capacitación para mantenernos como un referente en el sector hotelero y motelero híbrido.</p>
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
                    Fundado en 1994 en Medellín, Suite Star comenzó como un motel familiar enfocado en ofrecer espacios privados y discretos para estancias breves.
                </p>

                <p>
                    Con el tiempo, evolucionamos para convertirnos en un hotel híbrido que combina la flexibilidad y privacidad de un motel con las comodidades y servicios completos de un hotel tradicional.
                </p>

                <p>
                    Nuestra clientela es diversa: parejas buscando momentos íntimos, viajeros de negocios y familias que valoran la comodidad y atención personalizada.
                </p>

                <p>
                    Hemos realizado renovaciones constantes para adaptar nuestras instalaciones a las tendencias actuales, manteniendo siempre un ambiente cálido y familiar.
                </p>

                <p>
                    Suite Star es hoy un espacio único en Medellín que ofrece confort, versatilidad y un servicio dedicado para garantizar experiencias memorables.
                </p>
            </article>
        </section>

        <!-- Sección de equipo -->
        <section aria-label="Conoce a nuestro equipo">
            <h3 class="text-center mb-4">Conoce a Nuestro Equipo</h3>
            <div class="team-section" role="list">
                <!-- El contenido del equipo queda igual -->
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
                    <div class="carousel-item active">
                        <div class="d-flex flex-column align-items-center px-3">
                            <img src="https://img.freepik.com/vector-premium/imagen-perfil-avatar-hombre-aislada-fondo-imagen-profil-avatar-hombre_1293239-4867.jpg" alt="Foto de Alvaro Bermudez, cliente" class="mb-3 rounded-circle" style="width:100px; height:100px; object-fit:cover;" />
                            <p class="fst-italic fs-5 text-center max-w-600">"¡Una experiencia increíble! El servicio fue excelente y la habitación muy cómoda."</p>
                            <h4 class="mt-2 text-primary">Alvaro Bermudez</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex flex-column align-items-center px-3">
                            <img src="https://img.freepik.com/vector-premium/imagen-perfil-avatar-hombre-aislada-fondo-imagen-profil-avatar-hombre_1293239-4848.jpg" alt="Foto de Rafael Peña, cliente" class="mb-3 rounded-circle" style="width:100px; height:100px; object-fit:cover;" />
                            <p class="fst-italic fs-5 text-center max-w-600">"Un lugar encantador con una atención excepcional. Me sentí como en casa."</p>
                            <h4 class="mt-2 text-primary">Rafael Peña</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex flex-column align-items-center px-3">
                            <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211468.png" alt="Foto de Anderson Carmona, cliente" class="mb-3 rounded-circle" style="width:100px; height:100px; object-fit:cover;" />
                            <p class="fst-italic fs-5 text-center max-w-600">"Una experiencia maravillosa, el personal fue muy amable y atento. Sin duda volveré."</p>
                            <h4 class="mt-2 text-primary">Anderson Carmona</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="d-flex flex-column align-items-center px-3">
                            <img src="https://st2.depositphotos.com/1006318/42378/v/950/depositphotos_423785530-stock-illustration-young-woman-profile-avatar-beautiful.jpg" alt="Foto de María Fernández, cliente" class="mb-3 rounded-circle" style="width:100px; height:100px; object-fit:cover;" />
                            <p class="fst-italic fs-5 text-center max-w-600">"Las instalaciones son impecables y la ubicación es perfecta. ¡Altamente recomendado!"</p>
                            <h4 class="mt-2 text-primary">María Fernández</h4>
                        </div>
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
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Testimonio 2"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Testimonio 3"></button>
                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="3" aria-label="Testimonio 4"></button>
                </div>
            </div>
        </section>

    </main>

    <?php include 'docs/footer.php'; ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
