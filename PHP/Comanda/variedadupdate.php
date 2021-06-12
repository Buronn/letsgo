<?php
require "../conexion.php";

$mesa = $_POST['mesa'];
$grupo = $_POST['grupo'];
$producto = $_POST['producto'];
$clase = $_POST['clase'];
$punto = $_POST['punto'];
$nota = $_POST['nota'];

$sql = "update produccion set Nota='$nota' where Mesa='" . $mesa . "' and Grupo='" . $grupo . "' and Producto='" . $producto . "' and Clase='" . $clase . "' and Punto='" . $punto . "'";
$resultado = $conexion->query($sql);

echo $sql;

?>