<?php
require "conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$valor = $_POST['Valor'];
$nombre = $_POST['Nproduct'];
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
$sql = "select NProducto,valor,cantidad from orden where NProducto='" . $nombre . "'and punto='" . $punto . "'and mesa='" . $mesa . "'";
$resultado = $conexion->query($sql);
$salida .= "<table>
<thead>
<tr>
    <td>Nombre</td>
    <td>Cantidad</td>
    <td>Valor</td>
</tr>
</thead>
";
while ($fila = $resultado->fetch_assoc()) {
    $a = $fila['NProducto'];
    $a = str_replace(" ","&nbsp;",$a);
    $salida .= "<tr>
            <td>" . $a . ".</td>
            <td>x" . $fila['cantidad'] . "</td>
            <td>$" . $fila['valor'] . "
            </tr>";
}
echo $salida;
