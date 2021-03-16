<?php

require "conexion.php";
$personas = $_POST['cubiertos'];
$punto = $_POST['punto'];
$mesas = $_POST['mesa2'];
$sql = "update mesas SET color='ROJO' and personas='$personas' where Punto='$punto' and Mesa='$mesas'";
$resultado = $conexion->query($sql);

echo $salida;


// $sql = "update mesas SET color='ROJO'  WHERE Punto = '$punto1' AND Mesa = '$mesa1'";
// $resultado = $conexion->query($sql);
