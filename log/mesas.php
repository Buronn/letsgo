<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$sql = "Select Mesa,x,y from mesas where Punto='" . $lugar . "'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    $salida .= "<table>
            <thead>
            <tr>
                <td>mesa</td>
                <td>x</td>
                <td>y</td>
            </tr>
            </thead>
            <tbody>";
    while ($fila = $result->fetch_assoc()) {
        $salida .= "<tr>
                <td class=\"numero\">" . $fila['Mesa'] . "</td>
                <td class=\"numero\">x=" . $fila['x'] . "</td>
                <td class=\"numero\">y=" . $fila['y'] . "</td>
                </tr>";
    }
}
echo "$salida";
