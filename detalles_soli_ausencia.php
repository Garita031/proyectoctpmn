<?php 
    session_start();
    require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Solicitud Ausencia</title>
    <link rel="icon" href="/img/favicon.ico">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .information{
        margin: 30px;
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: row;
        justify-content: left;
        gap: 5%;
        font-family:Arial, Helvetica, sans-serif;
    }

    .column{
        margin: 5px;
    }

    header {
        background-color: #1e1e1e;
        width: 100vw;
        padding: 15px 20px;
        border-bottom: 4px solid #7c2c2c;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    h1 {
        margin: 9px 0 0 9px;
    }

    .logo {
        width: 130px;
    }

    .separador {
        margin: 8px 0;
        border: 1.5px black solid;
    }

    .column{
        display: flex;
        flex-direction: column;
    }
    </style>
</head>
<body>
    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
    </header>
    <main>
        <h1>Detalles de permiso</h1>
        <div class="information">
        <div class="row">
            <div class="column omision"><p>Nombre:</p></div>
            <div class="column omision"><p>Cedula:</p></div>
            <div class="column omision"><p>Puesto:</p></div>
            <div class="column omision"><p>Instancia:</p></div>
            <div class="column omision"><p>Fecha de Evento:</p></div>
            <div class="column omision"><p>Hora Entrada:</p></div>
            <div class="column omision"><p>Hora Salida:</p></div>
            <div class="column omision"><p>Tipo de Omision:</p></div>
            <div class="column omision"><p>Justificacion:</p></div>
            <div class="column omision"><p>Resolucion:</p></div>
        </div>
        <?php
        $connection = Connect_DB();
        $sql = "SELECT * FROM omision";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
            echo '<div class="row">
            <div class="column omision">' . $element["nombre"] . '</div>
            <div class="column omision">' . $element["cedula"] . '</div>
            <div class="column omision">' . ucfirst($element["rol"])  . '</div>
            <div class="column omision">' . $element["instancia"] . '</div>
            <div class="column omision">' . $element["fecha_evento"] . '</div>
            <div class="column omision">' . $element["entrada"] . '</div>
            <div class="column omision">' . $element["salida"] . '</div>
            <div class="column omision">' . $element["tipo_omision"] . '</div>
            <div class="column omision">' . $element["justificacion"] . '</div>
            <div class="column omision">
                <form action="resolucion.php" class="button_form" method="post"> 
                    <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                    <input type="hidden" name="tipo_permiso" value="omision">
                    <input type="submit" value="Resolucion"class="button">
                </form>
            </div>
            </div>';
        }
        ?>
        </div>

        <hr class="separador">
    </main>
</body>
</html>