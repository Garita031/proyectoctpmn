<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - CTPMN</title>
    <link rel="stylesheet" href="css/inicio_user.css">
</head>

<body>

    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
    </header>

    <div class="bienvenida">
        <h1 class="titulo-inicio-especial">¡Bienvenido <?php echo $_SESSION["user"]?>!</h1>
        <h3>¿Qué tarea desea realizar?</h3>
    </div>

    <main>
        <section class="inicio-container">
            <div class="columna">
                <h2>Formularios Solicitudes</h2>
                <a href="#" class="btn" onclick="toggleMenu('menu-solicitudes')">Ingresar</a>
                <div class="dropdown-menu" id="menu-solicitudes">

                    <a href="salida.html">Salida</a>

                    <a href="/Frontend - Profesores, Administrativo (No dirección)/Formularios Solicitudes/Solicitud Ausencia/ausencia.html">Ausencia</a>

                    <a href="/Frontend - Profesores, Administrativo (No dirección)/Formularios Solicitudes/Solicitud Tardia/tardia.html">Tardía</a>
                </div>
            </div>
            <div class="columna">
                <h2>Formularios Justificación</h2>
                <a href="/Frontend - Profesores, Administrativo (No dirección)/Formularios de Justificación Pendiente/formsjustificar.html" class="btn">Ingresar</a>
            </div>

            <div class="columna">

                <h2>Otros formularios</h2>

                <a href="#" class="btn" onclick="toggleMenu('menu-otros')">Ingresar</a>

                <div class="dropdown-menu" id="menu-otros">

                    <a href="omision.php">Omisión</a>

                    <a href="/Frontend - Profesores, Administrativo (No dirección)/Otros forms/Incapacidad/Incapacidad.html">Incapacidad</a>
                </div>
            </div>

        </section>

        <footer>
            <p>Heredia, Mercedes Norte, 400m norte de la Iglesia Católica</p>
            <p>TEL: 22605090 // 22617445</p>
            <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
        </footer>
    </main>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            const isVisible = menu.style.display === 'block';

            // Ocultar todos los menús primero
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });

            // Mostrar solo si estaba oculto
            if (!isVisible) {
                menu.style.display = 'block';
            }
        }

        // Ocultar si se hace clic fuera
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.columna')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.style.display = 'none';
                });
            }
        });
    </script>
</body>

</html>