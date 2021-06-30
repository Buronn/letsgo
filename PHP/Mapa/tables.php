<?php
require "../conexion.php";

$hacer=$_POST['hacer'];
$punto=$_POST['lugar'];
$mesa=$_POST['mesa'];
if($hacer=="cerrar"){

    $sql="update tables
    SET Status='1'
    WHERE Status='0'  and Punto='" . $punto . "'and Mesa='" . $mesa . "'";
    $conexion->query($sql);
    $sql="update produccion
    SET Pagado='1'
    WHERE Punto='" . $punto . "'and Mesa='" . $mesa . "'";
    $conexion->query($sql);
    
}else{
$dia=$_POST['dia'];
$cubiertos=$_POST['cubiertos'];
$year=$_POST['year'];
$minutos=$_POST['minutos'];
$hora=$_POST['hora'];
$mes=$_POST['mes'];
$sql="Select MAX(Folio) FROM `tables` ";
$result = $conexion->query($sql);
$max=$result->fetch_array();
$folio=intval($max['MAX(Folio)'])+1;
$fecha=$dia."-".$mes."-".$year;
$hora=$hora.":".$minutos;
$sql="INSERT INTO `tables` (`Punto`, `Mesa`,`Cubiertos`,`Hora`,`Status`, `Fecha`, `Folio`) VALUES ('$punto','$mesa','$cubiertos','$hora','0','$fecha','$folio')";
$conexion->query($sql);
}
