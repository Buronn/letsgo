<?php
require 'conexion.php';
session_start();

$usuario = $_POST['user'];
$password = $_POST['pass'];
$sql = "select Nombre,Password from usuarios where Nombre='" . $usuario . "' and Password='" . $password . "'";
$resultado = $conexion->query($sql);
if (mysqli_num_rows($resultado) == 1) {
    $_SESSION['login'] = "conexion good";
    header("Location:home.php");
} else {
    $_SESSION['loginf'] = "El usuario o la contraseña son incorrectos";
    header("Location: index.php");
}