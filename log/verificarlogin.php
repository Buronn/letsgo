<?php
require 'conexion.php';
$salida = "";
$usuario = $_POST['user'];
$password = $_POST['pass'];

$sql = "select Nombre,Password from usuarios where Nombre='" . $usuario . "' and Password='" . $password . "'";

$resultado = $conexion->query($sql);
if (mysqli_num_rows($resultado) == 1) {

    header("Location:../routes/punto.html");
} else {
    $salida .= "<div class=\"alert alert-warning\" role=\"alert\">
                Clave o usuario incorrectos
                </div>";
    
}
echo $salida;
