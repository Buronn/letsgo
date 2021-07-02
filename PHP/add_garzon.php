<?php
require "./conexion.php";

$nombre = $_POST['name'];
$pass = $_POST['pass'];
$mail = $_POST['mail'];
$admin = $_POST['admin'];
$salida = "";
$sql = "INSERT INTO `usuarios` (`Id`,`Nombre`,`Password`,`Cargo`,`Admin`) values('$mail','$nombre','".md5($pass)."','Garzon','$admin')";

$resultado = $conexion->query($sql);





if($resultado == true){
    $salida .= "<div class=\"alert alert-success\" role=\"alert\">
                    Usuario agregado con exito
                </div>";
}
else{
    $salida .= "<div class=\"alert alert-warning\" role=\"alert\">
                    ERROR ALGO SALIO MAL
                </div>";
}

echo $salida

?>