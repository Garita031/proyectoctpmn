<?php 
    session_start();
    $cedula = $_POST["cedula"];
    $id = $_POST["id"];
    require_once "db.php";
    $connection = Connect_DB();
    $correo = "";
    $sql = "SELECT email FROM usuarios WHERE cedula = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();
    foreach($result as $element){
        $correo = $element["email"];
    }
    $_SESSION["user_email"] = $correo;
    $_SESSION["user_id"] = $id;
    $_SESSION["tipo_permiso"] = $_POST["tipo_permiso"];
    $stmt->close();
    $connection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolución de Justificación Permiso</title>
    <link rel="stylesheet" href="css/resolucion.css">
    <link rel="icon" href="/img/favicon.ico">
</head>
 
<body>
    <header>
        <nav>
            <a href="#">INICIO</a>
            <img src="img/logo mejorado 1.png" alt="Logo CTPMN">
        </nav>
    </header>

    <h1>Resolución de Justificación Permiso</h1>
    <hr>

    <form action="enviar_correo.php" method="post">
        <p>Quien se suscribe, M.Sc. Laura Ramón Elizondo en calidad de Directora, con base en las leyes
        y reglamentos vigentes, responde al permiso/justificacion solicitado; bajo la resolución de:</p>
        <input type="hidden" name="body" value="Quien se suscribe, M.Sc. Laura Ramón Elizondo en calidad de Directora, con base en las leyes
        y reglamentos vigentes, responde al permiso/justificacion solicitado/a; bajo la resolución de:">
        <div class="radio-group">
            <label><input type="radio" name="resolucion" value="Aceptar con rebajo salarial parcial"> Aceptar con rebajo salarial parcial</label>
            <label><input type="radio" name="resolucion" value="Aceptar sin rebajo salarial"> Aceptar sin rebajo salarial</label>
            <label><input type="radio" name="resolucion" value="Denegar lo solicitado"> Denegar lo solicitado</label>
            <label><input type="radio" name="resolucion" value="Aceptar con rebajo salarial total"> Aceptar con rebajo salarial total</label>
            <label><input type="radio" name="resolucion" value="Acoger convocatoria"> Acoger convocatoria</label>
        </div>

 
        <label for="observaciones">Observaciones:</label>
        <input type="text" name="observaciones" id="observaciones" >
 
        <input type="submit" class="submit_button" value="Enviar">
    </form>
 
    <footer>
        <p>Heredia, Mercedes Norte de la Iglesia Católica</p>
        <p>TEL: 22605090 // 22617445</p>
        <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
    </footer>
</body>
</html>