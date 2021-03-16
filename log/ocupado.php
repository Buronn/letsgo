<?php

require "conexion.php";
$personas = $_POST['cubiertos'];
$punto = $_POST['punto'];
<<<<<<< HEAD
$mesas = $_POST['mesa2'];
$sql = "update mesas SET color='ROJO' and personas='$personas' where Punto='$punto' and Mesa='$mesas'";
$resultado = $conexion->query($sql);

echo $salida;
=======
$mesa = $_POST['mesa'];
$salida = "";
if($personas != ''){
    $sql = "update mesas SET color='ROJO', personas='".(int)$personas."' where Punto='$punto' and Mesa='$mesa '";
    $resultado = $conexion->query($sql);
}

echo "$salida";

>>>>>>> b0de67fe1e0fb2dbfb6508d8f9ba88e16ffe1a9f


// $sql = "update mesas SET color='ROJO'  WHERE Punto = '$punto1' AND Mesa = '$mesa1'";
// $resultado = $conexion->query($sql);
