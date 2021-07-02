<?php
require 'conexion.php';


$data = $_POST['data1'];

$sql2 = '';
$sql3 = '';

foreach($data as $mesa){
    if($mesa['new'] == 'true'){
        $sql2 = " insert into mesas (Punto, Mesa, x , y , forma) values ('".$mesa['Punto']."' , '".$mesa['Mesa']."', '".$mesa['x']."', '".$mesa['y']."', '".$mesa['forma']."') ";
        $resultado = $conexion->query($sql2);
    }
    if($mesa['borrado'] == 'true'){
        $sql3 = "delete from mesas where Punto ='".$mesa['Punto']."' and  Mesa = '".$mesa['Mesa']."' ";
        $resultado = $conexion->query($sql3);
    }
    
}

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

echo $sql .'xdsfsdfsdfdsfdssdfsdfdsdfsdfsfds' .$sql2;
 