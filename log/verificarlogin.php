<?php
require 'conexion.php';
$salida = "";
$usuario = $_POST['user'];
$password = $_POST['pass'];
echo $usuario;
echo $password;
$sql = "select Nombre,Password from usuarios where Nombre='" . $usuario . "' and Password='" . $password . "'";
echo $sql;
$resultado = $conexion->query($sql);
if (mysqli_num_rows($resultado) == 1) {
    $_SESSION['login'] = "conexion good";
    header("Location:punto.html");
} else {
    $salida .= "<div class=\"alert alert-warning\" role=\"alert\">
                A simple warning alert—check it out!
                </div>";
    
}
echo $salida;
