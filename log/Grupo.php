<?php
require "conexion.php";
(int)$clase = $_POST['clase'];
$salida = "";
$sql = "select * from grupos where Clase='" . intval($clase) . "'";
$resultado = $conexion->query($sql);
$salida .= "<div class=row>";
$aux = 0;
while ($fila = $resultado->fetch_assoc()) {

    $n = $fila['NGrupo'];
    $n = str_replace(" ", "", $n);
    $salida .="<div class='card' style='width: 18rem;'>
  <img style='min-height: 30vw;max-height: 30vw'id=$n src='../icons/cargando.gif' class='card-img-top' alt='...'>
  
  <div class='card-body'>
    <a href='#' class='btn btn-primary'>" . $fila['NGrupo'] . "</a>
  </div>
</div>
<script>
getImage('$n','" . $fila['NGrupo'] . "',$aux);
  </script>";
  $aux = $aux + 500;
}
$salida.="</div>";


echo $salida;
