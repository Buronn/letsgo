<?php
require "conexion.php";
$borrar = $_POST['borrar'];
$mesa1 = $_POST['mesa1'];
$punto1 = $_POST['punto1'];
$salida = "<script>console.log('$borrar')</script>";
$sql = "select * from orden where NProducto='$borrar'and punto='$punto1'and mesa='$mesa1'";
$resultado = $conexion->query($sql);
$fila = $resultado->fetch_assoc();
$valor = (int)$fila['valor'] / $fila['cantidad'];


if ($fila['cantidad'] == 1) {
    $sql = "delete  from orden WHERE Nproducto = '$borrar' and punto = '$punto1' AND mesa = '$mesa1'";
    $salida = "<script>Select('actualizar','')</script>";
    $resultado = $conexion->query($sql);
} else {
    $sql = "update orden SET cantidad=cantidad-1, valor=valor-$valor  WHERE Nproducto = '$borrar' AND punto = '$punto1' AND mesa = '$mesa1'";
    $resultado = $conexion->query($sql);
    $salida = "<script>Select('actualizar','')</script>";
}
echo "$salida";
