<?php
require "../conexion.php";
(int)$id = $_POST['id'];
$sql = "delete from usuarios where Garzon='" . intval($id) . "'";
$resultado = $conexion->query($sql);
if($resultado == true){
    echo json_encode(true);
}
else{
    echo json_encode(false);
}



?>