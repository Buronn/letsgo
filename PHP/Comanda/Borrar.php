<?php
require "../conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$producto = $_POST['product'];
$clase = $_POST['clase'];
$grupo = $_POST['Grupo'];
$sql="delete from produccion where Mesa='" . $mesa . "' and Grupo='" . $grupo . "' and Producto='" . $producto. "' and Clase='" . $clase . "' and Punto='" . $punto . "'";
$resultado = $conexion->query($sql);
