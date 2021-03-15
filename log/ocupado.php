<?php

require "conexion.php";

if (isset($_POST['personas'])) {
    $salida .= "<script>console.log('poder')</script>";
} else {
    $salida .= "<script>console.log('f')</script>";
}
echo $salida;


// $sql = "update mesas SET color='ROJO'  WHERE Punto = '$punto1' AND Mesa = '$mesa1'";
// $resultado = $conexion->query($sql);
