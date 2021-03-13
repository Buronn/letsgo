<?php
require "conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$valor = $_POST['Valor'];
$nombre = $_POST['Nproduct'];
if ($nombre == 'actualizar') {
    $sql = "select NProducto,valor,cantidad from orden where punto='" . $punto . "'and mesa='" . $mesa . "'";
    $resultado = $conexion->query($sql);
    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ", "&nbsp;", $a);
        $a = strtolower($a);
        $a = ucwords($a);
        $salida .= "
        <h3 class='word-hidden'>" . $a . ".</h3>
        <h3>x" . $fila['cantidad'] . " _____________________ $" . $fila['valor'] . " </h3>
        ";
    }
    echo $salida;
} else {
    $sql = "select * from orden where NProducto='" . $nombre . "'and punto='" . $punto . "'and mesa='" . $mesa . "'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0) {
        $sql = "update orden
        SET cantidad=cantidad+1,valor=valor+" . $valor . "
        WHERE NProducto='" . $nombre . "'and punto='" . $punto . "'and mesa='" . $mesa . "'";
        $resultado = $conexion->query($sql);
    } else {
        $sql = "insert into orden (NProducto,punto,valor,mesa,cantidad) values('" . $nombre . "','" . $punto . "','" . $valor . "','" . $mesa . "',1)";
        $resultado = $conexion->query($sql);
    }
    $sql = "select NProducto,valor,cantidad from orden where punto='" . $punto . "'and mesa='" . $mesa . "'";
    $resultado = $conexion->query($sql);
    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ", "&nbsp;", $a);
        $a = strtolower($a);
        $a = ucwords($a);
        $salida .= "
                <h3 class='word-adjust'>" . $a . ".</h3>
                <h3>x" . $fila['cantidad'] . " _____________________ $" . $fila['valor'] . " </h3>
                ";
    }
    echo $salida;
}
