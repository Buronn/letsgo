<?php


require "../conexion.php";

$arr = array();
$query = "SELECT * from `familias`";
$resultado = $conexion->query($query);
while ($fila = $resultado->fetch_assoc()) {
    array_push($arr,$fila);
}
echo json_encode($arr);


?>