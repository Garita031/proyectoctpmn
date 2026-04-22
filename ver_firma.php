<?php 
ob_clean();
require_once "db.php";
$connect = Connect_DB();

if (ob_get_length()) {
    ob_end_clean(); // Asegura que no haya nada en el buffer
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $permiso = $_GET['bd'];
    if ($permiso == "solicitud_salida"){
        $sql = "SELECT nombre_firma, tipo_firma, firma FROM solicitud_salida WHERE id = ?";
    }
    elseif ($permiso == "solicitud_ausencia"){
        $sql = "SELECT nombre_firma, tipo_firma, firma FROM solicitud_ausencia WHERE id = ?";
    }
    elseif ($permiso == "justificacion_ausencia"){
        $sql = "SELECT nombre_firma, tipo_firma, firma FROM justificacion_ausencia WHERE id = ?";
    }
    elseif ($permiso == "justificacion_tardia"){
        $sql = "SELECT nombre_firma, tipo_firma, firma FROM justificacion_tardias WHERE id = ?";
    }

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();              // <-- reemplaza store_result() + bind_result + fetch
    if ($row = $result->fetch_assoc()) {
        $nombreFirma = $row['nombre_firma'];
        $tipoFirma = $row['tipo_firma'];
        $firma = $row['firma'];
    }

    if ($firma) {
        error_log("Tipo MIME: $tipoFirma, Nombre archivo: $nombreFirma, Tamaño firma: " . strlen($firma));
        header("Content-Type: $tipoFirma");
        header("Content-Length: " . strlen($firma));
        flush();
        echo $firma;
        exit();
    } else {
        echo "Firma no encontrada.";
    }

    $stmt->close();
} else {
    echo "Parámetro 'id' no especificado en la URL.";
}
$connect->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="es">
    <title>Permiso de Salida</title>
    <link rel="stylesheet" href="css/salida.css">
    <link rel="icon" href="/img/favicon.ico">
</head>
<body>
    
</body>
</html>