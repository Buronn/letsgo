<?php
require "conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$valor = $_POST['Valor'];
$nombre = $_POST['Nproduct'];
$clase = $_POST['clase'];
$grupo = $_POST['Grupo'];
$codigoProducto = null;
$codigoFolio = null;

if ($nombre == 'actualizar') {
    $sql = "select NProducto,valor,cantidad from orden where punto='" . $punto . "'and mesa='" . $mesa . "'";
    $resultado = $conexion->query($sql);
    $total = 0;
    $salida .= "<div id='ocultar' style='background-color:#454545;padding:2vh;border-radius:2vw'>";
    while ($fila = $resultado->fetch_assoc()) {
        
        $nombre_prod_arreglado = $fila['NProducto'];
        $nombre_prod_arreglado = str_replace(" ", "&nbsp;", $nombre_prod_arreglado);
        $nombre_prod = str_replace(" ", "&nbsp;", $fila['NProducto']);
        $nombre_prod_arreglado = strtolower($nombre_prod_arreglado);
        $nombre_prod_arreglado = ucwords($nombre_prod_arreglado);
        $salida .= "<p class='input-group mb-3'>
        
        <span style='border-color: #ffffff61;pointer-events:none;background-color:rgb(51 51 51)' class='btn btn-primary btn-lg'>x" . $fila['cantidad'] . "</span>
        <a type='text' style='font-size:2vw;pointer-events:none;' class='form-control'>" . $fila['NProducto'] . "</a>
        <span style='border-color: #ffffff61;pointer-events:none;background-color:#348242ab'class='btn btn-success btn-lg'>$" . $fila['valor'] . "</span>
        <span style='border-color: #ffffff61;' class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')><i class='fas fa-minus'></i></span>
        <span style='border-color: #ffffff61;' class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')><i class='fas fa-trash-alt'></i></i></span>
        <button style='border-color: #ffffff61;' href='.modal-body' class='btn btn-info btn-lg' data-toggle='modal' data-target='#" . $nombre_prod . "1'><i class='fas fa-edit'></i></button>
        </p>";
        $salida .= "<div class='modal fade' style='padding-top:20vw' id='" . $nombre_prod . "1' tabindex='-1' role='dialog' aria-labelledby='" . $nombre_prod . "2'
    aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h2 style='
          font-weight: bolder;color:black
      'class='modal-title' id='" . $nombre_prod . "2'>Nota del producto</h2>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span style='font-size:3vw;color:white' aria-hidden='true'><i class='far fa-times-circle'></i></span>
          </button>
        </div>
        <div class='modal-body'>
        <div class='mb-3'>
        <textarea style='background-color:#ffffffbf;font-size:2vw;color:black' class='form-control' id='" . $nombre_prod . "3' rows='3'></textarea>
      </div>
        </div>
        <div class='modal-footer'>
          <button style='font-size:2.4vw' type='button' class='btn btn-success btn-lg'>Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>
  <script>document.getElementById('".$nombre_prod."3').value = '$nombre_prod'</script>";
        $total = $total + $fila['valor'];
    }
    $salida .= "<span style='font-size:3vw;pointer-events:none;background-color:#646f6b;min-width:100%;border-color: #ffffff;' class='btn btn-info btn-lg'>$$total</span>";
    $salida .= "</div>";
    $salida .="<script>console.log('$nombre_prod')</script>";

    echo $salida;
} else {
  $sql = "select NProducto,valor,cantidad from orden where punto='" . $punto . "'and mesa='" . $mesa . "'";
  $sql = "select * from orden where NProducto='" . $nombre . "'and punto='" . $punto . "'and mesa='" . $mesa . "'";
  $resultado = $conexion->query($sql);
  if ($resultado->num_rows > 0) {
      $sql = "update orden
      SET cantidad=cantidad+1,valor=valor+" . $valor . "
      WHERE NProducto='" . $nombre . "'and punto='" . $punto . "'and mesa='" . $mesa . "'";
      $resultado = $conexion->query($sql);
  } else {
      $sql = "insert into orden (NProducto,punto,valor,mesa,cantidad) values('" . $nombre . "','" . $punto . "','" . $valor . "','" . $mesa . "',1)";
      $resultado = $conexion->query($sql);
  }
    $resultado = $conexion->query($sql);
    $total = 0;
    */
    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */

    $consultaFolio = "select Folio from tables where Punto = '".$punto."' and  Mesa = '".$mesa."' and status = 0";
    $codigoFolioLista = $conexion->query($codigoFolioLista);

    while($fila =  $codigoFolioLista->fetch_assoc()){
      $codigoFolio = $fila['Folio'];
    }

    $nombreProductoParaQuery = str_replace(' ',' ',$nombre);
  
    $consultaCodigoProducto = "select Producto from productos where NProducto = '". $nombreProductoParaQuery ."'";
    $codigoProductoLista = $conexion->query($consultaCodigoProducto);

    while($fila = $codigoProductoLista->fetch_assoc()){
      $codigoProducto = $fila['Producto'];
    }
   
    $sql = "insert into produccion (punto,valor,mesa,cantidad,grupo,producto,status,folio,flag) values('" . $punto . "','" . $valor . "','" . $mesa . "',1 , '" . $clase . "', '" . $grupo . "', '" . $codigoProducto . "' , 0 , '" . $codigoFolio . "', 0 )";
    $resultado = $conexion->query($sql);
    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */

    $sql = "select NProducto,valor,cantidad from orden where punto='" . $punto . "'and mesa='" . $mesa . "'";
    $resultado = $conexion->query($sql);
    $total = 0;
    while ($fila = $resultado->fetch_assoc()) {
        
        $nombre_prod_arreglado = $fila['NProducto'];
        $nombre_prod_arreglado = str_replace(" ", "&nbsp;", $nombre_prod_arreglado);
        $nombre_prod = str_replace(" ", "&nbsp;", $fila['NProducto']);
        $nombre_prod_arreglado = strtolower($nombre_prod_arreglado);
        $nombre_prod_arreglado = ucwords($nombre_prod_arreglado);
        $salida .= "<div id='ocultar' style='background-color:#454545;padding:2vh;border-radius:2vw'>";
        $salida .= "<p class='input-group mb-3'>
        <span class='btn btn-primary btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')>x" . $fila['cantidad'] . "</span>
        <a type='text' style='font-size:2vw' class='form-control'>" . $fila['NProducto'] . "</a>
        <span class='btn btn-success btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')>$" . $fila['valor'] . "</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')>-1</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar','')>Delete</span>
        <span class='btn btn-info btn-lg'>note</span>
        </p>";
        $total = $total + $fila['valor'];
    }
    $salida .= "<span style='font-size:3vw' class='btn btn-info btn-lg'>Total=$$total</span>";

    $salida .= "</div>";


    echo $salida;
}
