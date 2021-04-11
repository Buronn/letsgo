<?php
require "conexion.php";
$punto=$_POST['lugar'];
$dia=$_POST['dia'];
$mesa=$_POST['mesa'];
$cubiertos=$_POST['cubiertos'];
$year=$_POST['year'];
$minutos=$_POST['minutos'];
$hora=$_POST['hora'];
$mes=$_POST['mes'];
$sql="Select MAX(Folio) FROM `tables` ";
$result = $conexion->query($sql);
$max=$result->fetch_array();
$folio= $max['MAX(Folio)']+1;
$fecha=$dia."-".$mes."-".$year;
$hora=$hora.":".$minutos;
$sql="INSERT INTO `tables` (`Punto`, `Mesa`,`Cubiertos`,`Hora`,`Status`, `Fecha`, `Folio`) VALUES ($punto,$mesa,$cubiertos,$hora,0,$fecha,$folio)";

