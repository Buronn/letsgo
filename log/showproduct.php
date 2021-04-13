<?php
require "conexion.php";
$salida = "";
(int)$clase = $_POST['clase'];
$grupo = $_POST['grupo'];
$punto = $_POST['punto'];
$sql="Select p.Producto,p.NProducto,p.Grupo,p.Clase,t.Valor from productos as p INNER JOIN tarifas as t ON p.Clase=t.Clase and p.Grupo=t.Grupo and p.Producto=t.Codigo where  t.Punto='$punto' and p.Baja=0 and p.Grupo='$grupo' and p.Clase='$clase' ;";
$resultado = $conexion->query($sql);
while ($fila = $resultado->fetch_assoc()) {
    
    $salida .="
    ".
      /* <img style='min-height: 30vw;max-height: 30vw'id=$n src='../icons/cargando.gif' class='card-img-top' alt='...'> */
      "<div class='card-body col-4'>
        <a style='min-height:6vw;min-width:25vw;max-width:25vw;max-height:7vw;font-size:1.5vw' href='#' class='btn btn-dark'>" . $fila['NProducto'] . "
        $".$fila['Valor']."</a>
      </div>
   ";
    
}
echo $salida;
