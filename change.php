<?php 
    include_once "db.php";

    $email = $_POST["email"];
    $passact = $_POST["passact"];
    $passnew = $_POST["passnew"];

    $connection = Connect_DB();
    $sql = "SELECT id FROM usuarios WHERE email = ? and contrasena = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $email, $passact);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 0){
        echo "Usuario no encontrado o datos erroneos";
        echo '<br> <a href="change.html">Regresar al cambio de contraseña</a>';
    }
    else{
        $sql = "UPDATE usuarios SET contrasena = ? WHERE email = ? AND contrasena = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sss", $passnew, $email, $passact);
        if ($stmt->execute()) {
            header("Location: contra_cambiada.html");
        }
        else{
            echo "Error, de algo";
            echo '<br> <a href="change.html">Regresar al cambio de contraseña</a>';
        }
        $stmt->close();
        $connection->close();
    }

?>