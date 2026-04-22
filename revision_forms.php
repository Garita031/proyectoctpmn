<?php 
  session_start();
  require_once "db.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Revisión de formularios</title>
  <link rel="stylesheet" href="css/revision_forms.css" />
  <link rel="icon" href="/img/favicon.ico">
</head>
<body>
    <header>
        <img src="img/logo mejorado 1.png" class="logo" alt="Logo CTPMN">
        <a href="inicio_especial.html" class="inicio">Inicio</a>
    </header>


  <main>
    <h1>Revisión de formularios</h1>
    <h2>Omision de Marca</h2>
    <div class="table">
      <div class="row">
        <div class="column omision"><p>Nombre:</p></div>
        <div class="column omision"><p>Cedula:</p></div>
        <div class="column omision"><p>Puesto:</p></div>
        <div class="column omision"><p>Instancia:</p></div>
        <div class="column omision"><p>Fecha de Evento</p></div>
        <div class="column omision"><p>Hora Entrada</p></div>
        <div class="column omision"><p>Hora Salida</p></div>
        <div class="column omision"><p>Tipo de Omision</p></div>
        <div class="column omision"><p>Justificacion</p></div>
        <div class="column omision"><p>Resolucion</p></div>
      </div>
      <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM omision";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column omision">' . $element["nombre"] . '</div>
              <div class="column omision">' . $element["cedula"] . '</div>
              <div class="column omision">' . ucfirst($element["rol"])  . '</div>
              <div class="column omision">' . $element["instancia"] . '</div>
              <div class="column omision">' . $element["fecha_evento"] . '</div>
              <div class="column omision">' . $element["entrada"] . '</div>
              <div class="column omision">' . $element["salida"] . '</div>
              <div class="column omision">' . $element["tipo_omision"] . '</div>
              <div class="column omision">' . $element["justificacion"] . '</div>
              <div class="column omision">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="omision">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
    <h2>Solicitud permiso de Salida</h2>
    <div class="table">
      <div class="row">
        <div class="column solicitud_salida"><p>Nombre</p></div>
        <div class="column solicitud_salida"><p>Cedula</p></div>
        <div class="column solicitud_salida"><p>Puesto</p></div>
        <div class="column solicitud_salida"><p>Condicion</p></div>
        <div class="column solicitud_salida"><p>Fecha envio</p></div>
        <div class="column solicitud_salida"><p>Hora envio</p></div>
        <div class="column solicitud_salida"><p>Fecha evento</p></div>
        <div class="column solicitud_salida"><p>Jornada</p></div>
        <div class="column solicitud_salida"><p>Hora Salida</p></div>
        <div class="column solicitud_salida"><p>Hora Final</p></div>
        <div class="column solicitud_salida"><p>Lecciones</p></div>
        <div class="column solicitud_salida"><p>Motivo</p></div>
        <div class="column solicitud_salida"><p>Firma</p></div>
        <div class="column solicitud_salida"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM solicitud_salida";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column solicitud_salida">' . $element["nombre"] . '</div>
              <div class="column solicitud_salida">' . $element["cedula"] . '</div>
              <div class="column solicitud_salida">' . ucfirst($element["rol"])  . '</div>
              <div class="column solicitud_salida">' . $element["condicion"] . '</div>
              <div class="column solicitud_salida">' . $element["fecha"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_presentado"] . '</div>
              <div class="column solicitud_salida">' . $element["fecha_evento"] . '</div>
              <div class="column solicitud_salida">' . $element["jornada"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_inicio"] . '</div>
              <div class="column solicitud_salida">' . $element["hora_fin"] . '</div>
              <div class="column solicitud_salida">' . $element["total_lecciones"] . '</div>
              <div class="column solicitud_salida">' . $element["motivo"] . '</div>
              <div class="column solicitud_salida"> <img class="firma" src="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_firma.php?id=' . $element["id"] . '&bd=solicitud_salida" alt=""> </div>

              <div class="column solicitud_salida">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="justificacion_ausencia">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
      
    <h2>Justificaciones de Salida</h2>
    <div class="table">
      <div class="row">
        <div class="column justificacion_salida"><p>Nombre</p></div>
        <div class="column justificacion_salida"><p>Cedula</p></div>
        <div class="column justificacion_salida"><p>Fecha envio</p></div>
        <div class="column justificacion_salida"><p>Fecha evento</p></div>
        <div class="column justificacion_salida"><p>Jornada</p></div>
        <div class="column justificacion_salida"><p>Hora Salida</p></div>
        <div class="column justificacion_salida"><p>Hora Final</p></div>
        <div class="column justificacion_salida"><p>Lecciones</p></div>
        <div class="column justificacion_salida"><p>Motivo</p></div>
        <div class="column justificacion_salida"><p>Comprobante</p></div>
        <div class="column justificacion_salida"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM justificacion_salida";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column justificacion_salida">' . $element["nombre"] . '</div>
              <div class="column justificacion_salida">' . $element["cedula"] . '</div>
              <div class="column justificacion_salida">' . $element["fecha_envio"] . '</div>
              <div class="column justificacion_salida">' . $element["fecha"] . '</div>
              <div class="column justificacion_salida">' . $element["jornada"] . '</div>
              <div class="column justificacion_salida">' . $element["hora_inicio"] . '</div>
              <div class="column justificacion_salida">' . $element["hora_fin"] . '</div>
              <div class="column justificacion_salida">' . $element["total_lecciones"] . '</div>
              <div class="column justificacion_salida">' . $element["motivo"] . '</div>';
              if (!empty($element["comprobante"])) {
                echo '<div class="column justificacion_salida"> <a class="comprobante_link" href="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_comprobante.php?id=' . $element["id"] . '&bd=justificacion_salida" alt="">Ver Comprobante</a> </div>';
              }
              else{
                echo '<div class="column justificacion_salida">No Hay</div>';
              }
              echo'<div class="column justificacion_salida">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="justificacion_salida">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>

    <h2>Solicitud Solicitud de Ausencia</h2>
    <div class="table">
      <div class="row">
        <div class="column solicitud_ausencia"><p>Nombre</p></div>
        <div class="column solicitud_ausencia"><p>Cedula</p></div>
        <div class="column solicitud_ausencia"><p>Puesto</p></div>
        <div class="column solicitud_ausencia"><p>Condicion</p></div>
        <div class="column solicitud_ausencia"><p>Grupo Prof.</p></div>
        <div class="column solicitud_ausencia"><p>Fecha envio</p></div>
        <div class="column solicitud_ausencia"><p>Fecha evento</p></div>
        <div class="column solicitud_ausencia"><p>Desde las</p></div>
        <div class="column solicitud_ausencia"><p>Estimado Hora Final</p></div>
        <div class="column solicitud_ausencia"><p>Lecciones</p></div>
        <div class="column solicitud_ausencia"><p>Motivo</p></div>
        <div class="column solicitud_ausencia"><p>Observaciones</p></div>
        <div class="column solicitud_ausencia"><p>Hora Presentado</p></div>
        <div class="column solicitud_ausencia"><p>Firma</p></div>
        <div class="column solicitud_ausencia"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM solicitud_ausencia";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column solicitud_ausencia">' . $element["nombre"] . '</div>
              <div class="column solicitud_ausencia">' . $element["cedula"] . '</div>
              <div class="column solicitud_ausencia">' . ucfirst($element["rol"])  . '</div>
              <div class="column solicitud_ausencia">' . $element["condicion"] . '</div>
              <div class="column solicitud_ausencia">' . $element["grupo_profesional"] . '</div>
              <div class="column solicitud_ausencia">' . $element["fecha"] . '</div>
              <div class="column solicitud_ausencia">' . $element["fecha_evento"] . '</div>
              <div class="column solicitud_ausencia">' . $element["hora_estimada"] . '</div>
              <div class="column solicitud_ausencia">' . $element["hora_final_estimada"] . '</div>
              <div class="column solicitud_ausencia">' . $element["total_lecciones"] . '</div>
              <div class="column solicitud_ausencia">' . $element["motivo"] . '</div> 
              <div class="column solicitud_ausencia">' . $element["observaciones"] . '</div>
              <div class="column solicitud_ausencia">' . $element["hora_presentado"] . '</div>
              <div class="column solicitud_ausencia"> <img class="firma" src="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_firma.php?id=' . $element["id"] . '&bd=solicitud_ausencia" alt=""> </div>

              <div class="column justificacion_salida">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="solicitud_ausencia">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>

    <h2>Solicitud Justificacion de Ausencia</h2>
    <div class="table">
      <div class="row">
        <div class="column justificacion_ausencia"><p>Nombre</p></div>
        <div class="column justificacion_ausencia"><p>Cedula</p></div>
        <div class="column justificacion_ausencia"><p>Puesto</p></div>
        <div class="column justificacion_ausencia"><p>Condicion</p></div>
        <div class="column justificacion_ausencia"><p>Fecha envio</p></div>
        <div class="column justificacion_ausencia"><p>Fecha evento</p></div>
        <div class="column justificacion_ausencia"><p>Desde las</p></div>
        <div class="column justificacion_ausencia"><p>Hasta las</p></div>
        <div class="column justificacion_ausencia"><p>Lecciones</p></div>
        <div class="column justificacion_ausencia"><p>Motivo</p></div>
        <div class="column justificacion_ausencia"><p>Observaciones</p></div>
        <div class="column justificacion_ausencia"><p>Hora Presentado</p></div>
        <div class="column justificacion_ausencia"><p>Firma</p></div>
        <div class="column justificacion_ausencia"><p>Comprobante</p></div>
        <div class="column justificacion_ausencia"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM justificacion_ausencia";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column justificacion_ausencia">' . $element["nombre"] . '</div>
              <div class="column justificacion_ausencia">' . $element["cedula"] . '</div>
              <div class="column justificacion_ausencia">' . ucfirst($element["rol"])  . '</div>
              <div class="column justificacion_ausencia">' . $element["condicion"] . '</div>
              <div class="column justificacion_ausencia">' . $element["fecha"] . '</div>
              <div class="column justificacion_ausencia">' . $element["fecha_evento"] . '</div>
              <div class="column justificacion_ausencia">' . $element["hora_inicio"] . '</div>
              <div class="column justificacion_ausencia">' . $element["hora_fin"] . '</div>
              <div class="column justificacion_ausencia">' . $element["total_lecciones"] . '</div>
              <div class="column justificacion_ausencia">' . $element["motivo"] . '</div> 
              <div class="column justificacion_ausencia">' . $element["observaciones"] . '</div>
              <div class="column justificacion_ausencia">' . $element["hora_presentado"] . '</div>
              <div class="column justificacion_ausencia"> <img class="firma" src="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_firma.php?id=' . $element["id"] . '&bd=justificacion_ausencia" alt=""> </div>';
              if (!empty($element["comprobante"])) {
                echo '<div class="column justificacion_ausencia"> <a class="comprobante_link" href="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_comprobante.php?id=' . $element["id"] . '&bd=justificacion_ausencia" alt="">Ver Comprobante</a> </div>';
              }
              else{
                echo '<div class="column justificacion_ausencia">No Hay</div>';
              }
              echo '<div class="column justificacion_salida">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="justificacion_ausencia">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
        <h2>Solicitud Justificacion de Tardias</h2>
    <div class="table">
      <div class="row">
        <div class="column justificacion_tardia"><p>Nombre</p></div>
        <div class="column justificacion_tardia"><p>Cedula</p></div>
        <div class="column justificacion_tardia"><p>Rol</p></div>
        <div class="column justificacion_tardia"><p>Condicion</p></div>
        <div class="column justificacion_tardia"><p>Grupo Profesional</p></div>
        <div class="column justificacion_tardia"><p>Fecha</p></div>
        <div class="column justificacion_tardia"><p>Hora de Entrada</p></div>
        <div class="column justificacion_tardia"><p>Hora de Llegada</p></div>
        <div class="column justificacion_tardia"><p>Observaciones</p></div>
        <div class="column justificacion_tardia"><p>Firma</p></div>
        <div class="column justificacion_tardia"><p>Comprobante</p></div>
        <div class="column justificacion_tardia"><p>Resolucion</p></div>


      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM justificacion_tardias";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column justificacion_tardia">' . $element["nombre"] . '</div>
              <div class="column justificacion_tardia">' . $element["cedula"] . '</div>
              <div class="column justificacion_tardia">' . ucfirst($element["rol"])  . '</div>
              <div class="column justificacion_tarida">' . $element["condicion"] . '</div>
              <div class="column justificacion_tardia">' . $element["grupo_profesional"] . '</div>
              <div class="column justificacion_tardia">' . $element["fecha"] . '</div>
              <div class="column justificacion_tardia">' . $element["hora_entrada"] . '</div>
              <div class="column justificacion_tardia">' . $element["hora_llegada"] . '</div>
              <div class="column justificacion_tardia">' . $element["observaciones"] . '</div>
              <div class="column justificacion_tardia"> <img class="firma" src="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_firma.php?id=' . $element["id"] . '&bd=justificacion_tardia" alt=""> </div>';
              if (!empty($element["comprobante"])) {
                echo '<div class="column justificacion_tardia"> <a class="comprobante_link" href="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_comprobante.php?id=' . $element["id"] . '&bd=justificacion_tardia" alt="">Ver Comprobante</a> </div>';
              }
              else{
                echo '<div class="column justificacion_tardia">No Hay</div>';
              }
              echo '<div class="column justificacion_tardia">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="justificacion_tardia">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
    <h2>Licencia Maternidad</h2>
    <div class="table">
      <div class="row">
        <div class="column maternidad"><p>Nombre</p></div>
        <div class="column maternidad"><p>Cedula</p></div>
        <div class="column maternidad"><p>Comprobante</p></div>
        <div class="column maternidad"><p>Resolucion</p></div>
      </div>
            <?php 
        $connection = Connect_DB();
        $sql = "SELECT * FROM maternidad";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        foreach ($result as $element){
          echo '<div class="row">
              <div class="column maternidad">' . $element["nombre"] . '</div>
              <div class="column maternidad">' . $element["cedula"] . '</div>';
              if (!empty($element["comprobante"])) {
                echo '<div class="column maternidad"> <a class="comprobante_link" href="http://localhost/Sistema Permisos CTP Mercedes Norte/ver_comprobante.php?id=' . $element["id"] . '&bd=maternidad" alt="">Ver Comprobante</a> </div>';
              }
              else{
                echo '<div class="column maternidad">No Hay</div>';
              }
              echo '<div class="column maternidad">
                <form action="resolucion.php" class="button_form" method="post"> 
                  <input type="hidden" name="cedula" value="' . $element["cedula"] . '">
                  <input type="hidden" name="id" value="' . $element["id"] . '">
                  <input type="hidden" name="tipo_permiso" value="maternidad">
                  <input type="submit" value="Resolucion"class="button">
                </form>
              </div>
            </div>';
        }
      ?>
    </div>
  </main>
  

<footer>
    <p>Heredia, Mercedes Norte, 400 mts, norte de la Iglesia Católica</p>
    <p>TEL: 22605090 // 22617445</p>
    <p>Correo: ctp.mercedes.norte@mep.go.cr</p>
</footer>



