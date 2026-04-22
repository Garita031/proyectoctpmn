<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="/img/favicon.ico">
</head>
<body>
    <?php 
    require_once "db.php";


    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $name = $_POST["nombre"];
    $id = $_POST["id"];
    $prof_group = $_POST["prof_group"];
    $job = $_POST["job"];
    $condition = $_POST["condition"];
    $rol = $_POST["rol"];


    $connection = Connect_DB();
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1){
        echo"El Usuario ya existe";
        echo '<br> <a href="register.html">Regresar al registro</a>';
    }
    else{
        $sql = "INSERT INTO usuarios(email, contrasena, nombre, cedula, grupo_profesional, puesto, condicion, rol) VALUES (?, ?, ?, ?, ?, ? , ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssissss", $email,$pass, $name, $id, $prof_group, $job, $condition, $rol );
        if ($stmt->execute()) {
            header("Location: usuario-registrado.html");
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
        $stmt->close();
        $connection->close();
    }
?>
</body>
</html>

