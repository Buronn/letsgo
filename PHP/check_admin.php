<?php
require "./conexion.php";
$usuario = $_POST['user'];
$password = $_POST['pass'];

$siguienteLocacion = '../mapa.html';
$esAdmin = 'N';


$sql = "select Admin from usuarios where Nombre='" . $usuario . "' and Password='" . md5($password) . "'";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $esAdmin =   $fila['Admin'];
};
echo $esAdmin;

