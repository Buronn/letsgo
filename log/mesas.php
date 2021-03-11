<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$sql = "Select Mesa,x,y from mesas where Punto='" . $lugar . "'";
$result = $conexion->query($sql);
if ($resultado->num_rows > 0) {
    $salida .= "<table>
            <thead>
            <tr>
                <td>mesa</td>
                <td>x</td>
                <td>y</td>
            </tr>
            </thead>
            <tbody>";
    while ($fila = $resultado->fetch_assoc()) {
        $salida .= "<tr>
                <td>" . $fila['Mesa'] . "</td>
                <td>$" . $fila['x'] . "</td>
                <td>$" . $fila['y'] . "</td>
                </tr>";
    }
}
echo "$salida";
