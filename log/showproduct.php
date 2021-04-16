<?php
require "conexion.php";
$salida = "";
(int)$clase = $_POST['clase'];
$grupo = $_POST['grupo'];
$punto = $_POST['punto'];
$sql = "Select p.Producto,p.NProducto,p.Grupo,p.Clase,t.Valor from productos as p INNER JOIN tarifas as t ON p.Clase=t.Clase and p.Grupo=t.Grupo and p.Producto=t.Codigo where  t.Punto='$punto' and p.Baja=0 and p.Grupo='$grupo' and p.Clase='$clase' ;";
$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
  $a = $fila['NProducto'];
  $a = str_replace(" ", "&nbsp;", $a);

  $salida .= "
    " .
    /* <img style='min-height: 30vw;max-height: 30vw'id=$n src='../icons/cargando.gif' class='card-img-top' alt='...'> */
    "<div class='form-check form-check-inline col-4' style='margin-top:2vw;margin-left:2vw;min-height: 6vw;
    min-width: 25vw;
    max-width: 29vw;
    max-height: 6vw;
    font-size: 1.5vw;
    color: #fff;
    background-color: #343a40;
    border-color: #343a40;'>
      <input 
        type='radio' 
        class='form-check-input' 
        name='ProductOptions' 
        style='margin-left: 1vw;'
        id='" . $clase . $grupo . $fila['Producto'] . "' 
        value='" . $clase . $grupo . $fila['Producto'] . "'
        autocomplete='off'
      >
      <label 
        style='min-height:6vw;min-width:25vw;max-width:25vw;max-height:7vw;font-size:1.5vw;text-align: center;' 
        href='#' 
        for='" . $clase . $grupo . $fila['Producto'] . "'
        class='form-check-label' 
      >" . $fila['NProducto'] . " $" . $fila['Valor'] . "</label>
        
      </div>
   ";
}

echo $salida;
