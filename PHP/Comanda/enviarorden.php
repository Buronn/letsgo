<?php
require "../conexion.php";
$punto = $_POST['punto'];
$mesa = $_POST['mesa'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];


$sql = "update produccion set Flag='1',Fecha='$fecha',Hora='$hora' where Punto='$punto' and Flag='0' and Mesa='$mesa'";
$resultado = $conexion->query($sql);


echo $sql;

