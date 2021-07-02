<?php


require "../conexion.php";
$clase = $_POST['clase'];
$grupo = $_POST['grupo'];
$nombre = $_POST['nombre'];
$valor = $_POST['valor'];

$sql = "select MAX(CAST(Producto AS UNSIGNED)) as maxi from productos where Clase='" . intval($clase) . "'  and Grupo  ='". $grupo .  "'";
$resultado = $conexion->query($sql);
$a = $resultado->fetch_assoc();
$res = strval((int)$a['maxi']+1);

 for ($i=0; $i < 4 ; $i++) { 
    if(strlen($res)<5){
        $res = '0'.$res;
    }
    else{
        $i = 5;
    }
 } 



$sql2 = "INSERT INTO `productos` (`Producto`,`NProducto`,`Valor`,`Grupo`,`Clase`,`Menu`,`Baja`) values('$res','$nombre','$valor','$grupo','$clase','0','0')";
//echo json_encode($sql2);
 $resultado1 = $conexion->query($sql2);


 if($resultado1 == true){
    echo json_encode(true);
}

else{
    echo json_encode(false);
}





?>