<?php



require "../conexion.php";
$salida = "";
$mesa = $_POST['mesa'];
$punto = $_POST['punto'];
$producto = $_POST['product'];
$clase = $_POST['clase'];
$grupo = $_POST['Grupo'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$codigoProducto = null;
$codigoFolio = null;
if ($producto == 'actualizar') {
    $sql = "select p.Punto,p.Mesa,pr.NProducto,p.Cantidad,p.Valor from produccion as p INNER JOIN productos as pr on p.Producto=pr.Producto and p.Grupo=pr.Grupo and p.Clase=pr.Clase WHERE p.Mesa='" . $mesa . "' and p.Punto='" . $punto . "'";
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
        
        <span style='border-color: #ffffff61;pointer-events:none;background-color:rgb(51 51 51)' class='btn btn-primary btn-lg'>x" . $fila['Cantidad'] . "</span>
        <a type='text' style='font-size:2vw;pointer-events:none;' class='form-control'>" . $fila['NProducto'] . "</a>
        <span style='border-color: #ffffff61;pointer-events:none;background-color:#348242ab'class='btn btn-success btn-lg'>$" . $fila['Valor'] . "</span>
        <span style='border-color: #ffffff61;' class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')><i class='fas fa-minus'></i></span>
        <span style='border-color: #ffffff61;' class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')><i class='fas fa-trash-alt'></i></i></span>
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
  ";
        $total = $total + $fila['Valor'];
    }
    $salida .= "<span style='font-size:3vw;pointer-events:none;background-color:#646f6b;min-width:100%;border-color: #ffffff;' class='btn btn-info btn-lg'>$$total</span>";
    $salida .= "</div>";

    echo $salida;
} else {
    echo "<script>console.log('entro al else')</script>";

    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */

    $consultaFolio = "select t.Folio,ta.Valor from tables as t INNER JOIN tarifas as ta where t.`Status`=0 and t.Punto='" . $punto . "' and t.Mesa='" . $mesa . "' and ta.Punto='" . $punto . "' and ta.Clase='" . $clase . "' and ta.Codigo='" . $producto. "' and ta.Grupo='" . $grupo . "'";
    $codigoFolioLista = $conexion->query($consultaFolio);
    echo "<script>console.log('paso la primera query')</script>";
    
    while($fila =  $codigoFolioLista->fetch_assoc()){
      
      $codigoFolio = $fila['Folio'];
      
      $valorreal =$fila['Valor'];
    }
    
    $sql = "insert into produccion (Punto,Mesa,Grupo,Producto,Cantidad,Valor,SW,Status,Folio,Fecha,Clase,Hora) VALUES ('" . $punto . "','" . $mesa . "','" . $grupo . "','" . $producto . "',1, '" . $valorreal . "',0,0,'" . $codigoFolio . "','$fecha','" . $clase . "','$hora')";
    
    $resultado = $conexion->query($sql);
    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */


    $sql = "select p.Punto,p.Mesa,pr.NProducto,p.Cantidad,p.Valor from produccion as p INNER JOIN productos as pr on p.Producto=pr.Producto and p.Grupo=pr.Grupo and p.Clase=pr.Clase WHERE p.Mesa='" . $mesa . "' and p.Punto='" . $punto . "'";
    $resultado = $conexion->query($sql);
    while ($fila = $resultado->fetch_assoc()) {
      
        
        $nombre_prod_arreglado = $fila['NProducto'];
        $nombre_prod_arreglado = str_replace(" ", "&nbsp;", $nombre_prod_arreglado);
        $nombre_prod = str_replace(" ", "&nbsp;", $fila['NProducto']);
        $nombre_prod_arreglado = strtolower($nombre_prod_arreglado);
        $nombre_prod_arreglado = ucwords($nombre_prod_arreglado);
        $salida .= "<div id='ocultar' style='background-color:#454545;padding:2vh;border-radius:2vw'>";
        $salida .= "<p class='input-group mb-3'>
        <span class='btn btn-primary btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')>x" . $fila['Cantidad'] . "</span>
        <a type='text' style='font-size:2vw' class='form-control'>" . $fila['NProducto'] . "</a>
        <span class='btn btn-success btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')>$" . $fila['Valor'] . "</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')>-1</span>
        <span class='btn btn-danger btn-lg' onclick=Borrar('$nombre_prod'),Select('actualizar')>Delete</span>
        <span class='btn btn-info btn-lg'>note</span>
        </p>";
        
    }
    // $salida .= "<span style='font-size:3vw' class='btn btn-info btn-lg'>Total=$$total</span>";

    $salida .= "</div>";


    echo $salida;
}
