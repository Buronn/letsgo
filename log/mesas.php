<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$ancho = $_POST['ancho'];
$largo = $_POST['largo'];
$sql = "Select Mesa,x,y from mesas where Punto='BAR'";
$result = $conexion->query($sql);
$ancho = (float)$ancho / 10;
$largo = (float)$largo / 10;
$salida .= "<div class='sesion'><img src='../images/Fondo/piso.jpg' >";
while ($fila = $result->fetch_assoc()) {
    $salida .= "<a href='../routes/orden.html'>
    <img style='position: relative;
    left: " . $ancho * ((float)$fila['x']) . "px;
    top: " . $largo * ((float)$fila['y']) . "px;
    width: 80px;
    height: 80px;' href='../routes/orden.html' src='../icons/Mesa Redonda 4 Sillas/Mesa Blanco/vacia.gif'>
    </a>
    ";
}
$salida .= "</div>";



echo "$salida";
