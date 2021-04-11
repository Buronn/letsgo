<?php
require 'conexion.php';
$salida = "";

$sql2=$sql2 ="Select  t.Mesa,t.`Status`,t.Cubiertos,t.Cuenta,m.forma FROM `tables` as t INNER JOIN mesas  as m on m.Mesa=t.Mesa WHERE t.`Status`='0' and t.Punto='BAR' GROUP BY Mesa";;
$result3 = $conexion->query($sql2);
$rows=array();
if((mysqli_num_rows($result3)> 0)){
    while($fila = $result3->fetch_array())
    {
       echo "".$fila['forma']."_ROJO_".$fila['Cubiertos']."";
    }
    
    

    
    
    
}
