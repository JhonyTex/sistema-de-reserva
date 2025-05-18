<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start(); // Correcto, no inicias sesión aquí
?>

<?php include 'docs/header2.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Página de Contacto</title>

    <link rel="stylesheet" href="styles.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    /> <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    /> <!-- Bootstrap -->

    <style>
        /* Fondo con imagen y overlay */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1470&q=80') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(131, 103, 247, 0.65); /* Overlay violeta semitransparente */
            z-index: 0;
        }

        /* Contenedor principal para aislar contenido del overlay */
        .content-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 900px;
            padding: 100px 20px 60px;
            box-sizing: border-box;
        }

        /* Header */
        .header {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            position: fixed;
            top: 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
            border-radius: 0 0 15px 15px;
        }

        /* Logo */
        .logo {
            height: 50px;
        }

        /* Menú de navegación */
        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #8367f7;
        }

        /* Sección de contacto */
        .contact-section {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
        }

        .contact-section h2 {
            margin-bottom: 20px;
            color: #4a3cbc;
            font-weight: 700;
            text-align: center;
        }

        /* Formulario */
        .contact-form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 14px;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #8367f7;
            outline: none;
            box-shadow: 0 0 8px rgba(131, 103, 247, 0.6);
        }

        .form-group textarea {
            resize: vertical;
        }

        .submit-button {
            background-color: #8367f7;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            width: 100%;
        }

        .submit-button:hover {
            background-color: #5b42d6;
        }

        /* FAQ */
        .faq-section {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            margin-bottom: 60px;
        }

        .faq-section h2 {
            color: #4a3cbc;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .faq-item {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .faq-question {
            cursor: pointer;
            background-color: #f8f9fa;
            color: #333;
            padding: 12px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-weight: 600;
            border-radius: 10px;
        }

        .faq-question:hover {
            background-color: #8367f7;
            color: #fff;
        }

        .faq-answer {
            display: none;
            padding: 15px 20px;
            background-color: #fff;
            border-radius: 0 0 10px 10px;
            animation: fadeIn 0.3s ease-in-out;
            box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
        }

        .faq-answer.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Footer oculto inicialmente */
        footer {
            width: 100%;
            background-color: #8367f7;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            display: none; /* Se muestra solo al final de la página */
            z-index: 10;
        }

        /* Responsive tweaks */
        @media (max-width: 576px) {
            .contact-section, .faq-section {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="content-wrapper">
    <!-- Sección de contacto -->
    <section class="contact-section">
        <h2>Contacto</h2>
        <form class="contact-form" action="CRUD/enviar_contacto.php" method="POST">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required />
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <select id="motivo" name="motivo" required>
                    <option value="" disabled selected>Seleccione un motivo</option>
                    <option value="queja">Queja</option>
                    <option value="reclamo">Reclamo</option>
                    <option value="felicitacion">Felicitación</option>
                    <option value="consulta">Consulta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="submit-button">Enviar</button>
        </form>
    </section>

    <!-- Sección de preguntas frecuentes -->
    <section class="faq-section">
        <h2 class="text-center">Preguntas Frecuentes</h2>
        <div class="faq-item card">
            <div class="card-header faq-question">
                <h5>1. ¿Cómo puedo contactar al soporte?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Puede enviar un mensaje desde esta misma página utilizando el formulario de contacto.</p>
            </div>
        </div>
        <div class="faq-item card">
            <div class="card-header faq-question">
                <h5>2. ¿Cuánto tiempo tarda en responder el soporte?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Nuestro equipo responderá su consulta en un plazo de 24 a 48 horas hábiles.</p>
            </div>
        </div>
        <div class="faq-item card">
            <div class="card-header faq-question">
                <h5>3. ¿Qué tipo de consultas puedo realizar?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Puede realizar consultas relacionadas con el uso del sistema, reportar problemas o enviar sugerencias.</p>
            </div>
        </div>
    </section>
</div>

<script>
    // Toggle FAQ answers
    document.querySelectorAll('.faq-question').forEach(question => {
        question.addEventListener('click', () => {
            const answer = question.nextElementSibling;
            answer.classList.toggle('active');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

<script>
    // Mostrar footer al llegar al final de la página
    window.addEventListener('scroll', function () {
        const footer = document.querySelector('footer');
        const scrollPosition = window.scrollY + window.innerHeight;
        const pageHeight = document.documentElement.scrollHeight;

        if (scrollPosition >= pageHeight - 20) {
            footer.style.display = 'block';
        } else {
            footer.style.display = 'none';
        }
    });

    // Mostrar alerta al enviar el formulario (puedes eliminar si no quieres alert)
    const form = document.querySelector('.contact-form');
    form.addEventListener('submit', function (event) {
        alert('Mensaje enviado. ¡Gracias por contactarnos!');
    });
</script>

</body>
</html>
