<?php
require 'conexion.php';
$sql = "select * from puntos";

$resultado = $conexion->query($sql);

$array = array();
while($fila = $resultado->fetch_assoc()){
    $array2 = array("Nombre"=>$fila['Nombre'],"Codigo"=>$fila['Codigo']);
    array_push($array , $array2);
}

echo json_encode($array);