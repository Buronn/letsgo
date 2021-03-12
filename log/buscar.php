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
                <td>Boton</td>
            </tr>
            </thead>
            <tbody>";
    while ($fila = $resultado->fetch_assoc()) {
        $salida .= "<tr>
                <td>" . $fila['NProducto'] . "</td>
                <td>$" . $fila['Valor'] . "</td>
                <td><a class='btn btn-default' onclick='agregarprodu()'>agregar</a>
                </tr>";
    }
} else {
    $salida .= "Error en la búsqueda";
}
echo $salida;
