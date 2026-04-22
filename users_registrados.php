<?php 
  require_once "db.php";
  $connection = Connect_DB();
  $sql = "SELECT * FROM usuarios";
  $stmt = $connection->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Usuarios registrados</title>
  <link rel="stylesheet" href="css/users_registrados.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
</head>
<body>
    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
        <a href="inicio_especial.html" class="inicio">Inicio</a>
    </header>


  <main>
    <h1>Usuarios Registrados</h1>
    <form action="" class="search_form" method="get">
    <input type="text" name="search" class="search_bar" placeholder="Buscar por cedula">
    <button type="submit" name="send" class="search_button">
      <i class="fas fa-search" style="color: white; transform: scale(1.3);"></i>
    </button>
    </form>
    <div class="table-users">
      <div class="row-users">
        <div class="column-users"><p>Nombre</p></div>
        <div class="column-users"><p>Cedula</p></div>
        <div class="column-users"><p>Puesto</p></div>
        <div class="column-users"><p>Grupo Profesional</p></div>
        <div class="column-users"><p>Correo</p></div>
        <div class="column-users"><p>Condicion</p></div>
        <div class="column-users"><p>Eliminar</p></div>
      </div>
      <?php 
        if(isset($_GET["send"])){
          $search = "%" . $_GET["search"] . "%";
          $sql = "SELECT * FROM usuarios WHERE cedula LIKE ?";
          $stmt = $connection->prepare($sql);
          $stmt->bind_param("s", $search );
          $stmt->execute();
          $result = $stmt->get_result();
        }
        else{
          $sql = "SELECT * FROM usuarios";
          $stmt = $connection->prepare($sql);
          $stmt->execute();
          $result = $stmt->get_result();
        }
        foreach ($result as $element){
          echo '<div class="row-users">
              <div class="column-users">' . $element["nombre"] . '</div>
              <div class="column-users">' . $element["cedula"] . '</div>
              <div class="column-users">' . ucfirst($element["rol"]) . '</div>
              <div class="column-users">' . $element["grupo_profesional"] . '</div>
              <div class="column-users">' . $element["email"] . '</div>
              <div class="column-users">' . $element["condicion"] . '</div>
              <div class="column-users eliminar">
                <form action="eliminar_user.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="submit" value="Eliminar"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
  </main>

  <footer>
      <p>Heredia, Mercedes Norte, 400 mts, norte de la Iglesia Católica de Mercedes</p>
      <p>TEL: 22605090 // 22617445</p>
      <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
  </footer>
</body>
</html>