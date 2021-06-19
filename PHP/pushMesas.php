<?php
require 'conexion.php';


$data = $_POST['data1'];

$sql = '';

$sql = "update mesas set x = CASE Mesa  ";
foreach($data as $mesa){
    $sql.= "WHEN '".$mesa['Mesa']."' THEN '".$mesa['x']."' ";
}
$sql.= "END, y = CASE Mesa ";

foreach($data as $mesa){
    $sql.= "WHEN '".$mesa['Mesa']."' THEN '".$mesa['y']."' ";
    $puntoDef = $mesa['Punto'];
}
$sql.= "END WHERE Punto='".$puntoDef."' AND Mesa in ( ";
$aux = 0;
foreach($data as $mesa){
    if($aux == 0){
        $sql.= " '".$mesa['Mesa']."' ";
    }
    $sql.= " ,'".$mesa['Mesa']."' ";
    $aux = $aux + 1;
}
$sql.= ")";

$resultado = $conexion->query($sql);
echo $sql;
 