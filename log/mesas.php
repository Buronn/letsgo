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
$salida .= "<div class='mapa'><img class='img-fluid' style='border-radius: 5%; max-width=100%' usemap='#workmap' src='../images/Fondo/piso2.jpg' >";
$salida .= "<map name=\"workmap\">"; 

while ($fila = $result->fetch_assoc()) {
    $salida .= "<area src='../icons/Mesa Redonda 4 Sillas/Mesa Verde/vacia.gif' target='_self' alt='algo' title='algo' href='' coords=\"" . $ancho * ((float)$fila['x']+1) . "," . $largo * ((float)$fila['y']+1) . ",44\" shape='circle'>";
    $salida .= "<script>console.log(" . (((float)$fila['x'])*100)/$ancho . ")</script><a href='../routes/orden.html'>
    <img class='img-fluid mesitas' style='position: fixed;
    left: " . ((((float)$fila['x']) * 100) / $ancho * 6.8) . "%;
    top: " . (((float)$fila['y']) * 110) / $largo * 4.5 . "%;
    width: 9.6%;
    height: 15%;' href='../routes/orden.html' src='../icons/Mesa Redonda 4 Sillas/Mesa Verde/vacia.gif'>
    </a>
    ";

    /* coords=\"" . $ancho * ((float)$fila['x']+1) . "," . $largo * ((float)$fila['y']+1) . ",44\" */
}
/* LOGO */
$salida.="
<img class='img-fluid mesitas' style='position: fixed;
left: " . 42 . "%;
top: " . -19 . "%;
width: 10%;
height: 17%;' href='../routes/punto.html' src='../icons/logo-x.png'>";
/* BACK */
$salida.="<a href='../routes/punto.html'>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 2 . "%;
top: " . -15 . "%;
width: 7%;
height: 11%;' href='../routes/punto.html' src='../icons/back-red.png'>
</a>";
/* LOGOUT */
$salida.="<a href='../index.html'>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 85 . "%;
top: " . -15 . "%;
width: 7%;
height: 11%;' href='../index.html' src='../icons/logout-red.png'>
</a>";
/* PUNTO */
$salida.="
<img class='img-fluid mesitas' style='position: fixed;
left: " . 27.3 . "%;
top: " . 86 . "%;
width: 40%;
height: 20%;' href='../index.html' src='../icons/".$lugar.".text.png'>";
$salida .= "</map>";
$salida .= "</div>";
echo "$salida";
