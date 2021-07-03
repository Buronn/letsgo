<?php


require "../conexion.php";

$arr = array();
$query = "SELECT * from `usuarios`";
$resultado = $conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {
    $arrayDos = array($fila['Nombre'] ,$fila['Garzon'], $fila['Admin']);
    array_push($arr , $arrayDos);
    
}
echo json_encode($arr);


?>