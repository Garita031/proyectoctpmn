<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Justificación de Omisión de Marca</title>
    <link rel="stylesheet" href="css/estilos_omision.css">
</head>
<body>
<div class="contenido">
    <header>
        <div class="logo">
            <img src="img/logo mejorado 1.png" alt="Logo CTPMN">
        </div>
    </header>

    <main>
        <h1>Justificación de Omisión de Marca</h1>
        <form class="formulario" action="procesar_permiso.php" method="post">
            <input type="hidden" name="tipo_permiso" value="omision">
            <div class="fila">
                <input type="text" name="name" placeholder="Nombre" value="<?php echo $_SESSION["user"]?>" required>
                <select class="fill-small" name="job_position" required>
                    <option value="<?php echo $_SESSION["rol"]?>" selected hidden><?php echo $_SESSION["rol"]?></option>
                    <option value="admin" required>Administrativo</option>
                    <option value="profesor">Profesor</option>
                </select>
                <input type="text" name="cedula" placeholder="Cédula" value="<?php echo $_SESSION["cedula"]?>" required>
            </div>

            <fieldset  class="instancia" >
                <legend>Instancia:</legend>
                <label><input type="radio" name="instancia" value="Personal Docente" required> Personal Docente</label>
                <label><input type="radio" name="instancia" value="Título II"> Título II</label>
                <label><input type="radio" name="instancia" value="Personal administrativo"> Personal administrativo</label>
                <label><input type="radio" name="instancia" value="Título I"> Título I</label>
            </fieldset>

            <div class="fila etiqueta-verde">
                <div class="grupo">
                    <label>Fecha:</label>
                    <input type="date" name="fecha_evento" required>
                </div>
                <div class="grupo">
                    <label>Entrada:</label>
                    <input type="time" name="entrada" required>
                </div>
                <div class="grupo">
                    <label>Salida:</label>
                    <input type="time" name="salida" required>
                </div>
            </div>

            <div class="fila espacio-azul">
                <label><input type="radio" name="jornada" value="Todo el día" required> Todo el día</label>
                <label><input type="radio" name="jornada" value="Salida anticipada"> Salida anticipada</label>
            </div>

            <div class="fila">
                <input type="text" placeholder="Firma digital de la Persona Funcionaria">
                <textarea placeholder="Justificación" name="justificacion" required maxlength="255"></textarea>
            </div>
            <input class="button" type="submit" value="Enviar todo">
        </form>

    </main>

    <footer>
        <p>Heredia, Mercedes Norte de la Iglesia Católica</p>
        <p>TEL:22605090 // 22617445</p>
        <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
    </footer>
</div>
</body>
</html>
