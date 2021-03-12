<?php

require "conexion.php";
$salida = "";
$query = "select * from productos";
if (isset($_POST['consulta'])) {
    $q = $conexion->real_escape_string($_POST['consulta']);
    $query = "select NProducto,Valor from productos where NProducto LIKE '%" . $q . "%'";
}
$resultado = $conexion->query($query);
if ($resultado->num_rows > 0) {
    $salida .= "<table>
            <thead>
            <tr>
                <td>Nombre</td>
                <td>Valor</td>
                <td></td>
            </tr>
            </thead>
            ";
    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ","&nbsp;",$a);
        $b = $fila['Valor'];
        $salida .= "<tr>
                <td>" . $a . "</td>
                <td>$" . $fila['Valor'] . "</td>
                <script>console.log('".$a."')</script>
                <td><a onclick=Select(\"".$a."\",'" . $fila['Valor'] . "')>a</td>
                </tr>";
    }
} else {
    $salida .= "Error en la búsqueda";
}
echo $salida;
