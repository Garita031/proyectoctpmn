<?php 
  session_start();
  require_once "db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Solicitudes Salida</title>
    <link rel="stylesheet" href="css/revision_forms.css">
</head>

<body>

    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
        <a href="inicio.php" class="inicio">INICIO</a>
    </header>

    <main>
        <h1>Solicitudes  de Salida para Justificar</h1>
        <div class="table">
            <div class="row">
                <div class="column omision">
                    <p>Fecha de Envio:</p>
                </div>
                <div class="column omision">
                    <p>Fecha Salida:</p>
                </div>
                <div class="column omision">
                    <p>Hora Inicio:</p>
                </div>
                <div class="column omision">
                    <p>Hora Final:</p>
                </div>
                <div class="column omision">
                    <p>Lecciones</p>
                </div>
                <div class="column omision">
                    <p>Jornada</p>
                </div>
                <div class="column omision">
                    <p>Motivio</p>
                </div>
                <div class="column omision">
                    <p>Justificar</p>
                </div>
            </div>
            <?php
            $connection = Connect_DB();
            $sql = "SELECT * FROM salida_justificar";
            $stmt = $connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            foreach ($result as $element) {
                echo '<div class="row">
                <div class="column omision">' . $element["fecha"] . '</div>
                <div class="column omision">' . $element["fecha_evento"] . '</div>
                <div class="column omision">' . $element["hora_inicio"] . '</div>
                <div class="column omision">' . $element["hora_fin"] . '</div>
                <div class="column omision">' . $element["total_lecciones"] . '</div>
                <div class="column omision">' . $element["jornada"] . '</div>
                <div class="column omision">' . $element["motivo"] . '</div>
                <div class="column omision">
                <form action="justificacion_salida.php" class="button_form" method="post"> 
                    <input type="hidden" name="id_permiso" value="' . $element["id"] . '">
                    <input type="submit" value="Justificar"class="button">
                </form>
                </div>
            </div>';
            }
            ?>
        </div>
    </main>


    <footer>
        <p>Heredia, Mercedes Norte, 400 mts, norte de la Iglesia Católica</p>
        <p>TEL: 22605090 // 22617445</p>
        <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
    </footer>

</body>

</html>