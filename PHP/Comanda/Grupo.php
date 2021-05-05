<?php
require "../conexion.php";
(int)$clase = $_POST['clase'];
$salida = "";
$sql = "select * from grupos where Clase='" . intval($clase) . "'";
$resultado = $conexion->query($sql);
$salida .= "<div class=nav>";
$aux = 0;
while ($fila = $resultado->fetch_assoc()) {
  $a = $fila['NGrupo'];
  $a = str_replace(" ", "&nbsp;", $a);
  $a = strtolower($a);
  $a = ucwords($a);

    $salida .="
    ".
      /* <img style='min-height: 30vw;max-height: 30vw'id=$n src='../icons/cargando.gif' class='card-img-top' alt='...'> */
      "<div class='card-body col-4'>
        <a style='min-height:6vw;min-width:25vw;max-width:25vw;max-height:6vw;font-size:1.5vw' href='#' class='btn btn-dark' onclick=SetLocalStorage('Grupo','".$fila['Grupo']."'),showproduct('$a')>" . $fila['NGrupo'] . "</a>
      </div>
   ";
    /* <script>
      getImage('$n','" . $fila['NGrupo'] . "',$aux);
    </script>"; */
  $aux = $aux + 500;
}
$salida.="</div>";


echo $salida;
