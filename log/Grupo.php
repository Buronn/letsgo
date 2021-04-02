<?php
require "conexion.php";
(int)$clase = $_POST['clase'];
$salida = "";
$sql = "select * from grupos where Clase='" . intval($clase) . "'";
$resultado = $conexion->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    $salida .= "<a data-toggle='tab' href='#nav-'".$_POST['clase']."'' onclick=SetLocalStorage('Grupo','" . $fila['Grupo'] . "'),buscar_datos();>'" . $fila['NGrupo'] . "'</a>";
}
echo $salida;
