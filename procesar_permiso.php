<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    session_start();
    require 'libs/vendor/autoload.php'; 
    require_once "db.php";
    $connection = Connect_DB();
    $null = null;
    $mail = new PHPMailer(true);

    // Procesar firma en caso de que haya
    if (isset($_FILES['firma']) && $_FILES['firma']['error'] == 0) {
        $fileTmpPath = $_FILES['firma']['tmp_name'];
        $fileName = $_FILES['firma']['name'];
        $fileType = $_FILES['firma']['type'];

        $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($fileType, $allowedTypes)) {
            echo "Solo se permiten firma PDF, JPG y PNG.";
            exit;
        }

        $fileContent = file_get_contents($fileTmpPath);
    } else {
        $fileName = null;
        $fileType = null;
        $fileContent = null;
    }

        // Procesar comprobante en caso de que haya
    if (isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] == 0) {
        $fileTmpPath2 = $_FILES['comprobante']['tmp_name'];
        $fileName2 = $_FILES['comprobante']['name'];
        $fileType2 = $_FILES['comprobante']['type'];

        $allowedTypes2 = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($fileType2, $allowedTypes2)) {
            echo "Solo se permiten comprobante PDF, JPG y PNG.";
            exit;
        }

        $fileContent2 = file_get_contents($fileTmpPath2);
    } else {
        $fileName2 = null;
        $fileType2 = null;
        $fileContent2 = null;
    }



    //omision
    if ($_POST["tipo_permiso"] == "omision"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id = $_POST["cedula"];
        $instance = $_POST["instancia"];
        $event_date = $_POST["fecha_evento"];
        $entry = $_POST["entrada"];
        $exit = $_POST["salida"];
        $journey = $_POST["jornada"];
        $justification = $_POST["justificacion"];

        $sql = "INSERT INTO omision(nombre, cedula, rol, instancia, fecha_evento, entrada, salida, tipo_omision, justificacion) VALUES (?, ?, ?, ?, ?, ? , ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sisssssss", $name, $id, $job_position, $instance, $event_date, $entry, $exit, $journey, $justification);
        $stmt->execute();
        $mail->Subject = "Nueva Solicitud de Omision de Marca - $name";
        $mail->Body = "
        <h2>Justificación de Omisión de Marca</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Puesto:</b> $job_position</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Instancia:</b> $instance</p><br>
        <p><b>Fecha:</b> $event_date</p><br>
        <p><b>Entrada:</b> $entry</p><br>
        <p><b>Salida:</b> $exit</p><br>
        <p><b>Jornada:</b> $journey</p><br>
        <p><b>Justificación:</b> $justification</p>
        ";
    }
    else if (empty($_POST["tipo_permiso"])) {
        echo "Error: tipo_permiso está vacío<br>";
    }
    //permiso de salida
    else if($_POST["tipo_permiso"] == "solicitud_salida"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id = $_POST["cedula"];
        $condition = $_POST["condicion"];
        $prof_group = $_POST["prof_group"];
        $lessons = $_POST["lessons"];
        $exit_date = $_POST["exit_date"];
        $exit_hour = $_POST["exit_hour"];
        $final_hour = $_POST["final_hour"];
        $journey = $_POST["jornada"];
        $reason = $_POST["motivo"];
        $observations = $_POST["observaciones"];
        $sending_hour = $_POST["hora_envio"];
        $sending_date = $_POST["fecha_envio"];

    // Insertar solicitud de salida con firma
    $sql = "INSERT INTO solicitud_salida(nombre, cedula, rol, condicion, grupo_profesional, fecha, fecha_evento, hora_inicio, hora_fin, total_lecciones, jornada, motivo, observaciones, hora_presentado, nombre_firma, tipo_firma, firma) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "sssssssssissssssb",
        $name, $id, $job_position, $condition, $prof_group, $sending_date,
        $exit_date, $exit_hour, $final_hour, $lessons, $journey, $reason,
        $observations, $sending_hour, $fileName, $fileType, $null
    );
    $stmt->send_long_data(16, $fileContent);
    $stmt->execute();

    $sql = "INSERT INTO salida_justificar(fecha, fecha_evento, hora_inicio, hora_fin, total_lecciones, jornada, motivo, cedula) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "ssssisss",
        $sending_date, $exit_date, $exit_hour, $final_hour, $lessons, $journey, $reason, $id,
    );
    $stmt->execute();

    $mail->Subject = "Nueva Solicitud de salida - $name";
    $mail->Body    = "
        <h2>Solicitud de Salida</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Puesto:</b> $job_position</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Condición:</b> $condition</p><br>
        <p><b>Grupo Profesional:</b>$prof_group</p><br>
        <p><b>Lecciones:</b>$lessons</p><br>
        <p><b>Fecha de salida:</b>$exit_date</p><br>
        <p><b>Hora de salida:</b>$exit_hour</p><br>
        <p><b>Hora Final:</b>$final_hour</p><br>
        <p><b>Jornada:</b> $journey</p><br>
        <p><b>Motivo:</b>$reason</p><br>
        <p><b>Observaciones:</b>$observations</p><br>
        <p><b>Fecha de envío:</b> $sending_date</p><br>
        <p><b>Hora de envío:</b>$sending_hour</p><br>
    ";
    }
    //
    else if($_POST["tipo_permiso"] == "justificacion_salida"){

        $name = $_POST["nombre"];
        $id = $_POST["cedula"];
        $sql = "SELECT * FROM salida_justificar where cedula = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $element = $stmt->get_result();
        foreach($element as $result){
        $date = $result["fecha"];
        $event_date = $result["fecha_evento"];
        $starting_hour = $result["hora_inicio"];
        $ending_hour = $result["hora_fin"];
        $lessons = $result["total_lecciones"];
        $reason = $result["motivo"];
        $journey = $result["jornada"];
        }
        $sql = "INSERT INTO justificacion_salida(nombre, cedula, fecha, fecha_envio, hora_inicio, hora_fin, total_lecciones, motivo, jornada, comprobante, nombre_comprobante, tipo_comprobante) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "ssssssissbss",
        $name, $id, $date, $event_date, $starting_hour, $ending_hour, $lessons, $reason, $journey, $null, $fileName2, $fileType2
    );
    $stmt->send_long_data(9, $fileContent2);
    $stmt->execute();
    $mail->Subject = "Nueva Justificacion Salida - $name";
    $mail->Body    = "
        <h2>Justificación Ausencia</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Fecha de envio:</b> $date</p><br>
        <p><b>Fecha de evento:</b>$exit_date</p><br>
        <p><b>Desde las:</b>$starting_hour<b> Hasta las:</b>$ending_hour</p><br>
        <p><b>Lecciones:</b>$lessons</p><br>
        <p><b>Motivo:</b>$reason</p><br>
    ";
    }

    else if($_POST["tipo_permiso"] == "justificacion_ausencia"){
    $name = $_POST["name"];
    $job_position = $_POST["job_position"];
    $id = $_POST["cedula"];
    $condition = $_POST["condicion"];
    $prof_group = $_POST["prof_group"];
    $lessons = $_POST["lessons"];
    $date = $_POST["fecha_envio"];
    $exit_date = $_POST["exit_date"];
    $reason = $_POST["motivo"];
    $observations = $_POST["observaciones"];
    $sending_hour = $_POST["hora_envio"];
    $starting_hour = $_POST["hora_inicio"];
    $ending_hour = $_POST["hora_fin"];


    // Insertar solicitud de ausencia con firma
    $sql = "INSERT INTO justificacion_ausencia(nombre, cedula, rol, condicion, grupo_profesional, fecha, fecha_evento, total_lecciones, motivo, observaciones, nombre_firma, tipo_firma, firma, hora_presentado, hora_inicio, hora_fin, nombre_comprobante, tipo_comprobante, comprobante) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "sssssssissssbsssssb",
        $name, $id, $job_position, $condition, $prof_group, $date,
        $exit_date, $lessons, $reason,
        $observations, $fileName, $fileType, $null, $sending_hour, $starting_hour, $ending_hour, $fileName2, $fileType2, $null
    );
    $stmt->send_long_data(12, $fileContent);
    $stmt->send_long_data(18, $fileContent2);
    $stmt->execute();
    $mail->Subject = "Nueva Justificacion Ausencia - $name";
    $mail->Body    = "
        <h2>Justificación Ausencia</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Rol:</b> $job_position</p><br>
        <p><b>Condición:</b> $condition</p><br>
        <p><b>Grupo Profesional:</b>$prof_group</p><br>
        <p><b>Fecha:</b> $date</p><br>
        <p><b>Fecha de evento:</b>$exit_date</p><br>
        <p><b>Desde las:</b>$starting_hour<b> Hasta las:</b>$ending_hour</p><br>
        <p><b>Lecciones:</b>$lessons</p><br>
        <p><b>Motivo:</b>$reason</p><br>
        <p><b>Observaciones:</b>$observations</p><br>
        <p><b>Hora de presentación:</b>$presentation_time</p><br>
    ";
    }
else if($_POST["tipo_permiso"] == "solicitud_ausencia"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id = $_POST["cedula"];
        $condition = $_POST["condicion"];
        $prof_group = $_POST["prof_group"];
        $lessons = $_POST["lessons"];
        $date = $_POST["fecha_envio"];
        $exit_date = $_POST["exit_date"];
        $reason = $_POST["motivo"];
        $observations = $_POST["observaciones"];
        $sending_hour = $_POST["hora_envio"];
        $starting_hour = $_POST["hora_inicio"];
        $ending_hour = $_POST["hora_fin"];




// Procesar firma


    // Insertar solicitud de ausencia con firma
    $sql = "INSERT INTO solicitud_ausencia(nombre, cedula, rol, condicion, grupo_profesional, fecha, fecha_evento, total_lecciones, motivo, observaciones, nombre_firma, tipo_firma, firma, hora_presentado, hora_estimada, hora_final_estimada) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param(
        "sssssssissssbsss",
        $name, $id, $job_position, $condition, $prof_group, $date,
        $exit_date, $lessons, $reason,
        $observations, $fileName, $fileType, $null, $sending_hour, $starting_hour, $ending_hour
    );
    $stmt->send_long_data(12, $fileContent);
    $stmt->execute();
    $mail->Subject = "Nueva Solicitud  Ausencia - $name";
    $mail->Body    = "
        <h2>Solicitud de ausencia - $name</h2> <br><br>
        <p><b>Nombre:</b> $name</p><br>
        <p><b>Cédula:</b> $id</p><br>
        <p><b>Rol:</b> $job_position</p><br>
        <p><b>Condición:</b> $condition</p><br>
        <p><b>Grupo Profesional:</b>$prof_group</p><br>
        <p><b>Fecha:</b> $date</p><br>
        <p><b>Fecha de evento:</b>$exit_date</p><br>
        <p><b>Desde las:</b>$starting_hour<b> Hasta las:</b>$ending_hour</p><br>
        <p><b>Lecciones:</b>$lessons</p><br>
        <p><b>Motivo:</b>$reason</p><br>
        <p><b>Observaciones:</b>$observations</p><br>
        <p><b>Hora de presentación:</b>$presentation_time</p><br>
    ";
    }

    //maternidad

    else if($_POST["tipo_permiso"] == "maternidad"){
        $name = $_POST["name"];
        $id = $_POST["id"];
    //ingresr tardia---- falta conectar a la base de datos

        $sql = "INSERT INTO maternidad(nombre, cedula, comprobante, tipo_comprobante, nombre_comprobante) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
            "ssbss",
            $name,$id,$null, $fileName2, $fileType2
        );
        $stmt->send_long_data(2, $fileContent2);
        $stmt->execute();
        $mail->Subject = "Nueva Licencia de maternidad - $name";
        $mail->Body    = "
            <h2>Justificación de Permiso De Tardía</h2> <br><br>
            <p><b>Nombre:</b> $name</p><br>
            <p><b>Cédula:</b> $id</p><br>
        ";
    }

    //tardía
    else if($_POST["tipo_permiso"] == "justificacion_tardia"){
        $name = $_POST["name"];
        $job_position = $_POST["job_position"];
        $id_num = $_POST["id_num"];
        $condicion = $_POST["condition"];
        $proffesional_group = $_POST["proffesional_group"];
        $form_date = $_POST["form_date"];
        $enter_time = $_POST["enter_time"];
        $arrive_time = $_POST["arrive_time"];
        $observations = $_POST["observations"];

    //ingresr tardia---- falta conectar a la base de datos

        $sql = "INSERT INTO justificacion_tardias(nombre, cedula, rol, condicion, grupo_profesional, fecha, hora_entrada, hora_llegada, observaciones, firma, tipo_firma, nombre_firma, comprobante, tipo_comprobante, nombre_comprobante) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
            "sssssssssbssbss",// faltan las de la firma
            $name,$id_num, $job_position, $condicion, 
            $proffesional_group, $form_date, 
            $enter_time, $arrive_time, $observations, 
            $null, $fileType, $fileName, $null, $fileType2, $fileName2
        );
        $stmt->send_long_data(9, $fileContent);
        $stmt->send_long_data(12, $fileContent2);
        $stmt->execute();
        $mail->Subject = "Nueva Justificacion de Tardia - $name";
        $mail->Body    = "
            <h2>Justificación de Permiso De Tardía</h2> <br><br>
            <p><b>Nombre:</b> $name</p><br>
            <p><b>Cédula:</b> $id_num</p><br>
            <p><b>Rol:</b> $job_position</p><br>
            <p><b>Condición:</b> $condition</p><br>
            <p><b>Grupo Profesional:</b>$proffesional_group</p><br>
            <p><b>Desde:</b>$form_date</p><br>
            <p><b>Hora de entrada:</b>$enter_time</p><br>
            <p><b>Observaciones:</b>$obsevations</p><br>
        ";
    }

    else {
        echo "Error al guardar la solicitud.";
    }

    try {
    // Configuración servidor
    $mail->SMTPDebug = 0; 
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'desarrolloweb2527@gmail.com'; 
    $mail->Password   = "gxqu sapg gaiw kpcs"; // ⚠️ Usar contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Destinatarios
    $mail->setFrom('desarrolloweb2527@gmail.com', 'Sistema Permisos CTPMN');
    $mail->addAddress("aaroncastillo009@gmail.com");
    $mail->addAddress("mejialepizpablo@gmail.com"); // dirección fija del receptor del correo(doña laura)

    // Contenido
    $mail->isHTML(true);

    $mail->send();
    header("Location: inicio.php");
    exit();
} catch (Exception $e) {
    echo "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}";
}

/*
    $prof_gruop = $_POST["prof_group"];
    $lessons = $_POST["lessons"];
    $type_justification = $_POST["justifico"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $condition = $_POST["condicion"];
    */


    $stmt->close();
    $connection->close();
    header("Location: inicio.php");
?>