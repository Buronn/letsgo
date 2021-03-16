<?php
require 'conexion.php';
$salida = "";
$usuario = $_POST['name'];

$sql = "select Nombre,Password from usuarios where Nombre='" . $usuario . "'";

$resultado = $conexion->query($sql);

if (mysqli_num_rows($resultado) == 1) {
    echo false;
}
if (mysqli_num_rows($resultado) == 0){
    echo true;
}
