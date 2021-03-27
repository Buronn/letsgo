<?php
require "conexion.php";
$salida = "";
$sql = "select * from familias";
$resultado = $conexion->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    $salida .= "<a data-toggle='tab' href='#nav-profile' onclick=SetLocalStorage('Clase','" . $fila['Clase'] . "'),eliminarclase('nav-clase-tab','active'),agregarclase('nav-grupo-tab','active'),Grupo('" . $fila['Clase'] . "')>'" . $fila['NClase'] . "'</a>";
}
echo $salida;
