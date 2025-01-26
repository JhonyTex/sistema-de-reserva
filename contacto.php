<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// session_start(); // Eliminar esta línea
?>

<?php include 'docs.php/header2.php';?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Contacto</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> <!-- Bootstrap -->
    <style>
        /* Estilos generales */
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f0e5f7, #d7c4f7);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        /* Header de navegación */
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
            z-index: 100;
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

        .menu-icon, .back-button {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .menu-icon:hover, .back-button:hover {
            transform: scale(1.2);
        }

        /* Sección de contacto */
        .contact-section {
            margin-top: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            padding: 25px;
            border-radius: 20px;
            width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .contact-section h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Estilos del formulario */
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

        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
        }

        .submit-button {
            background-color: #8367f7;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #5b42d6;
        }

        /* Seccion preguntas frecuentes */
        

        .faq-section {
        margin-top: 40px;
        width: 90%;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .faq-item {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .faq-question {
        cursor: pointer;
        background-color: #f8f9fa;
        color: #333;
        transition: background-color 0.3s ease;
    }

    .faq-question:hover {
        background-color: #8367f7;
        color: #fff;
    }

    .faq-answer {
        display: none;
        animation: fadeIn 0.3s ease-in-out;
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
            display: none; /* Ocultar footer por defecto */
        }
    </style>
</head>
<body>
    <!-- Header de navegación -->
    
    

    <!-- Sección de contacto -->
        <section class="contact-section">
            <h2>Contacto</h2>
            <form class="contact-form" action="CRUD/enviar_contacto.php" method="POST">
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
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
    <h2 class="text-center my-4">Preguntas Frecuentes</h2>
    <div class="container">
        <div class="faq-item card my-3">
            <div class="card-header faq-question">
                <h5>1. ¿Cómo puedo contactar al soporte?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Puede enviar un mensaje desde esta misma página utilizando el formulario de contacto.</p>
            </div>
        </div>
        <div class="faq-item card my-3">
            <div class="card-header faq-question">
                <h5>2. ¿Cuánto tiempo tarda en responder el soporte?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Nuestro equipo responderá su consulta en un plazo de 24 a 48 horas hábiles.</p>
            </div>
        </div>
        <div class="faq-item card my-3">
            <div class="card-header faq-question">
                <h5>3. ¿Qué tipo de consultas puedo realizar?</h5>
            </div>
            <div class="card-body faq-answer">
                <p>Puede realizar consultas relacionadas con el uso del sistema, reportar problemas o enviar sugerencias.</p>
            </div>
        </div>
    </div>
</section>


<script>
    // Mostrar/ocultar respuestas a preguntas frecuentes
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

        
        // Eliminar la prevención del envío para permitir el envío real
            const form = document.querySelector('.contact-form');
            form.addEventListener('submit', function (event) {
                alert('Mensaje enviado. ¡Gracias por contactarnos!');
            });

    </script>
</body>
</html>
