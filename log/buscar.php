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
        $salida .= "<tr>
                <td>" . $fila['NProducto'] . "</td>
                <td>$" . $fila['Valor'] . "</td>
                <script>console.log('onclick='select('" . $fila['NProducto'] . "','" . $fila['Valor'] . "')'')
                </script>
                <td><button class='btn btn-default' >agregar</button>
                </tr>";
    }
} else {
    $salida .= "Error en la búsqueda";
}
echo $salida;
