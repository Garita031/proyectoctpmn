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
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM solicitud_salida WHERE id = ?";
    }
    elseif ($permiso == "justificacion_salida"){
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM justificacion_salida WHERE id = ?";
    }
    elseif ($permiso == "solicitud_ausencia"){
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM solicitud_ausencia WHERE id = ?";
    }
    elseif ($permiso == "justificacion_ausencia"){
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM justificacion_ausencia WHERE id = ?";
    }
    elseif ($permiso == "justificacion_tardia"){
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM justificacion_tardia WHERE id = ?";
    }
    elseif ($permiso == "maternidad"){
        $sql = "SELECT nombre_comprobante, tipo_comprobante, comprobante FROM maternidad WHERE id = ?";
    }

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();              // <-- reemplaza store_result() + bind_result + fetch
    if ($row = $result->fetch_assoc()) {
        $nombre_comprobante = $row['nombre_comprobante'];
        $tipo_comprobante = $row['tipo_comprobante'];
        $comprobante = $row['comprobante'];
    }

    if ($comprobante) {
        error_log("Tipo MIME: $tipo_comprobante, Nombre archivo: $nombre_comprobante, Tamaño firma: " . strlen($comprobante));
        header("Content-Type: $tipo_comprobante");
        header("Content-Length: " . strlen($comprobante));
        flush();
        echo $comprobante;
        exit();
    } else {
        echo "comprobante no encontrada.";
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