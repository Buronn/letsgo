<?php
require 'conexion.php';

$punto = $_POST['punto'];

$sql = "select * from mesas where Punto='" . $punto . "' and x is not null and y is not null and forma is not null";

$resultado = $conexion->query($sql);

$array = array();
while($fila = $resultado->fetch_assoc()){
    $arrayDos = array($fila['Mesa'] ,$fila['x'] , $fila['y'] , $fila['forma']);
    array_push($array , $arrayDos);
}

echo json_encode($array);