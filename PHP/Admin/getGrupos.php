<?php
require "../conexion.php";
(int)$clase = $_POST['clase'];
$sql = "select * from grupos where Clase='" . intval($clase) . "'";
$resultado = $conexion->query($sql);
$arr = array();
while ($fila = $resultado->fetch_assoc()) {
    array_push($arr,$fila);
}
echo json_encode($arr);

?>