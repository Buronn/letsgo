<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$ancho = $_POST['ancho'];
$largo = $_POST['largo'];
$sql = "Select Mesa,x,y from mesas where Punto='" . $lugar . "' and x is not null and y is not null";
$result = $conexion->query($sql);
$ancho = (float)$ancho / 10;
$largo = (float)$largo / 10;
$salida .= "<div class='mapa'><img class='img-fluid' usemap='#workmap' src='../images/Fondo/piso2.jpg' >";
$salida .= "<map name=\"workmap\">";

while ($fila = $result->fetch_assoc()) {
    $salida .= "<area src='../icons/Mesa Redonda 4 Sillas/Mesa Blanco/vacia.gif target='_self' alt='" . $fila['Mesa'] . "' title='" . $fila['Mesa'] . "' href='' coords=\"" . $ancho * ((float)$fila['x'] + 1) . "," . $largo * ((float)$fila['y'] + 1) . ",44\" shape='circle'>";
    $salida .= "<script>console.log(" . (((float)$fila['x']) * 100) / $ancho . ")</script><a href='../routes/Busqueda.html' onclick='select('" . $fila['Mesa'] . "')'>
    <img class='img-fluid mesitas' style='position: fixed;
    left: " . ((((float)$fila['x']) * 100) / $ancho * 6.8) . "%;
    top: " . (((float)$fila['y']) * 110) / $largo * 4.5 . "%;
    width: 9.6%;
    height: 9.6%;' href='../routes/orden.html' src='../icons/Mesa Redonda 4 Sillas/Mesa Blanco/vacia.gif'>
    </a>
    ";

    /* coords=\"" . $ancho * ((float)$fila['x']+1) . "," . $largo * ((float)$fila['y']+1) . ",44\" */
}
$salida .= "</map>";
$salida .= "</div>";
echo "$salida";
