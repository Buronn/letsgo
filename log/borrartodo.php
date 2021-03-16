<?php
require "conexion.php";
$punto = $_POST['punto1'];
$mesas = $_POST['mesa1'];
$sql = "delete from orden where punto='$punto' and mesa='$mesas'";
$resultado = $conexion->query($sql);
$sql = "update mesas SET personas=0,color='VERDE' where Punto='$punto' and Mesa='$mesas'";
$resultado = $conexion->query($sql);
