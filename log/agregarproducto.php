<?php
require "conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$salida .= "<script>console.log('" . $mesa . "')</script>";
echo "$salida";
