<?php

require "../conexion.php";
$personas = $_POST['cubiertos'];
$punto = $_POST['punto'];
$mesa = $_POST['mesa'];
$salida = "";
if ($personas != '') {
    $sql = "update mesas SET color='VERDE', personas='" . (int)$personas . "' where Punto='$punto' and Mesa='$mesa '";
    $resultado = $conexion->query($sql);
}

echo "$salida";



// $sql = "update mesas SET color='ROJO'  WHERE Punto = '$punto1' AND Mesa = '$mesa1'";
// $resultado = $conexion->query($sql);
