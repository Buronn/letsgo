<?php
require "conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$salida .= $mesa;
echo $salida;
