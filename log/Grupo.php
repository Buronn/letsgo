<?php
require "conexion.php";
(int)$clase = $_POST['clase'];
$salida = "";
$sql = "select * from grupos where Clase='" . intval($clase) . "'";
$resultado = $conexion->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    $salida .= "<a data-toggle='tab' href='#nav-contact' onclick=SetLocalStorage('Grupo','" . $fila['Grupo'] . "'),eliminarclase('nav-grupo-tab','active'),agregarclase('nav-producto-tab','active')>'" . $fila['NGrupo'] . "'</a>";
}
echo $salida;
