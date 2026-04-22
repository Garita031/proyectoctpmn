<?php
  session_start();
  $_SESSION['id_permiso'] = $_POST["id_permiso"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Justificación de Salida</title>
<link rel="stylesheet" href="CSS/maternidad.css">
</head>
<body>
 
    <header>          
        <nav>
            <a href="inicio.php" class="inicio">INICIO</a>
            <img src="img/logo mejorado 1.png" class="logo">
        </nav>
    </header>
 
  <main>
    <form class="form-container" action="procesar_permiso.php" method="POST" enctype="multipart/form-data">
      <h1>Justificación de Salida</h1>
 
      <h2>Datos generales</h2>
      <br>  
        <div class="form-group">
          <input type="text" class="fill" name="nombre" required placeholder="Nombre completo">
        </div>
 
        <div>
          <div class="form-group">
            <input type="text" class="fill" name="cedula" required placeholder="Cedula de identidad">
          </div>
 
      <p>Por favor adjunte el documento correspondiente:</p>
 
      <input name="comprobante" id="comprobante" type="file" accept=".pdf, .jpg, .png" class="btn" />
 
 
      <p id="file-name" class="archivo-nombre"></p>
      <input type="hidden" name="tipo_permiso" value="justificacion_salida">
      <button id="btn-subir" type="submit" class="btn_subir">Enviar</button>
  </form>
</main>
 
 
 
  <footer>
    <p>Heredia, Mercedes Norte, 400m norte de la Iglesia Católica</p>
    <p>TEL: 22605090 // 22617445</p>
    <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
  </footer>
 
  <script>
    const fileInput = document.getElementById("file-upload");
    const fileName = document.getElementById("file-name");
    const btn_class = document.getElementById("btn-subir")
 
    fileInput.addEventListener("change", () => {
      if (fileInput.files.length > 0) {
        fileName.textContent = "Archivo seleccionado: " + fileInput.files[0].name;
        btn();
      } else {
        fileName.textContent = "";
      }
    });
 
    function btn() {
        if (fileName.textContent != "Archivo seleccionado: ") {
            btn_class.classList.toggle("btn-subir");
        }
    }
 
  </script>
</body>
</html>