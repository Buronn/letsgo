<?php
require "../conexion.php";
$salida = "";
(int)$clase = $_POST['clase'];
$grupo = $_POST['grupo'];
$punto = $_POST['punto'];
$sql = "Select p.Producto,p.NProducto,p.Grupo,p.Clase,t.Valor from productos as p INNER JOIN tarifas as t ON p.Clase=t.Clase and p.Grupo=t.Grupo and p.Producto=t.Codigo where  t.Punto='$punto' and p.Baja=0 and p.Grupo='$grupo' and p.Clase='$clase' ORDER BY p.NProducto ASC;";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
  $a = $fila['NProducto'];
  $a = str_replace(" ", "&nbsp;", $a);

  $salida .= "
    " .
    /* <img style='min-height: 30vw;max-height: 30vw'id=$n src='../icons/cargando.gif' class='card-img-top' alt='...'> */
    "<div style='margin-top:2vw;margin-left:2vw;min-height: 6vw;
    min-width: 25vw;
    max-width: 29vw;
    max-height: 6vw;
    font-size: 1.5vw;
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;'>
<<<<<<< HEAD
      <div
        style='min-height:6vw;min-width:25vw;max-width:25vw;max-height:7vw;font-size:1.5vw;text-align: center;' 
        href='#'
        onclick='AlertaAñadido(), Select('".$fila['Producto']."')'
=======
      <div onclick='AlertaAñadido()'
        style='min-height:6vw;min-width:25vw;max-width:25vw;max-height:7vw;font-size:1.5vw;text-align: center;' 
>>>>>>> 382d4dcce97e77628c07ddcff080b631770214d5
      >" . $fila['NProducto'] . "</div>
        
      </div>
   ";
}

echo $salida;
