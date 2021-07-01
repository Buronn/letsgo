<?php
require 'conexion.php';



$sql = "select * from produccion as p INNER JOIN productos as pr on p.Producto=pr.Producto and p.Grupo=pr.Grupo and p.Clase=pr.Clase WHERE p.Pagado='1'";

$resultado = $conexion->query($sql);

$array = array();
while($fila = $resultado->fetch_assoc()){
    $arrayDos = array($fila['Punto'] , $fila['NProducto'], $fila['Clase'], $fila['Cantidad'], $fila['Valor'], $fila['Fecha'], $fila['Hora'], $fila['Nota'] );
    array_push($array , $arrayDos);
}

echo json_encode($array);