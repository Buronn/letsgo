<?php
require "../conexion.php";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$producto = $_POST['product'];
$clase = $_POST['clase'];
$grupo = $_POST['Grupo'];
$sql="select * from variedades where VClase='".$clase ."' and VGrupo='".$grupo ."' and VProducto='".$producto."' ";
$result = $conexion->query($sql);
$xd=array("codigo"=>$producto,"variedad"=>false,"variedades"=>array());
if(mysqli_num_rows($result) > 0){
    $xd["variedad"]=true;
    $temp=array();
    while($fila = $result->fetch_assoc()){
        array_push($temp,$fila['Variedad']);
    }
    $xd["variedades"]=$temp;
}
echo json_encode($xd);