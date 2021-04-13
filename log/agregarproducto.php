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
    $total = 0;
    $salida .= "<div style='background-color:#454545;padding:2vh;border-radius:2vw'>";
    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ", "&nbsp;", $a);
        $xd = str_replace(" ", "&nbsp;", $fila['NProducto']);
        $a = strtolower($a);
        $a = ucwords($a);
        $salida .= "<p class='input-group mb-3'>
        <span class='btn btn-primary btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>x" . $fila['cantidad'] . "</span>
        <a type='text' style='font-size:2vw' class='form-control'>" . $a . "</a>
        <span class='btn btn-success btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>$" . $fila['valor'] . "</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>-1</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>Delete</span>
        <span class='btn btn-info btn-lg'>note</span>
        </p>";
        $total = $total + $fila['valor'];
    }
    $salida .= "<span style='font-size:3vw' class='btn btn-info btn-lg'>Total=$$total</span>";
    $salida .= "</div>";
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
    $total = 0;
    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ", "&nbsp;", $a);
        $xd = str_replace(" ", "&nbsp;", $fila['NProducto']);
        $a = strtolower($a);
        $a = ucwords($a);
        $salida .= "<div style='background-color:#454545;padding:2vh;border-radius:2vw'>";
        $salida .= "<p class='input-group mb-3'>
        <span class='btn btn-primary btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>x" . $fila['cantidad'] . "</span>
        <a type='text' style='font-size:2vw' class='form-control'>" . $a . "</a>
        <span class='btn btn-success btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>$" . $fila['valor'] . "</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>-1</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$xd'),Select('actualizar','')>Delete</span>
        <span class='btn btn-info btn-lg'>note</span>
        </p>";
        $total = $total + $fila['valor'];
    }
    $salida .= "<span style='font-size:3vw' class='btn btn-info btn-lg'>Total=$$total</span>";
    $salida .= "</div>";

    echo $salida;
}
