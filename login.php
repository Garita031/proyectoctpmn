<?php
    session_start();
    require_once "db.php";


    $cedula = $_POST["cedula"];
    $pass = $_POST["pass"];
    $rol = $_POST["rol"];


    $connection = Connect_DB();
    $sql = "SELECT nombre, cedula, rol, grupo_profesional FROM usuarios WHERE contrasena = ? AND cedula = ? AND rol = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $pass, $cedula, $rol);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION["user"] = $row['nombre'];
        $_SESSION["cedula"] = $row['cedula'];
        $_SESSION["rol"] = $row['rol'];
        $_SESSION["grupo_profesional"] = $row['grupo_profesional'];
        if ($rol == "admin"){
            header("Location: inicio_especial.html");
        }
        else{
            header("Location: inicio.php");
        }

        exit();
    }
    else{
        echo "Credenciales incorrectos, <a href='index.html'> Volver </a>";
    }
    $stmt->close();
    $connection->close();
?>