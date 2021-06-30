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
$nota = "";
if (isset($_POST['nota'])) {
  $nota = $_POST['nota'];
}
$cantidad = $_POST['cantidad'];
$codigoProducto = null;
$codigoFolio = null;
if ($producto == 'actualizar') {
  $sql = "select p.Punto,p.Mesa,pr.NProducto,p.Cantidad,p.Valor,p.Producto,p.Grupo,p.Clase,p.Nota,p.Flag from produccion as p INNER JOIN productos as pr on p.Producto=pr.Producto and p.Grupo=pr.Grupo and p.Clase=pr.Clase WHERE p.Mesa='" . $mesa . "' and p.Punto='" . $punto . "' and p.Pagado='0' ";
  $resultado = $conexion->query($sql);
  $total = 0;
  $salida .= "<div id='ocultar' style='background-color:#454545;padding:2vh;border-radius:2vw'>";
  while ($fila = $resultado->fetch_assoc()) {

    $nombre_prod_arreglado = $fila['NProducto'];
    $nombre_prod_arreglado = str_replace(" ", "&nbsp;", $nombre_prod_arreglado);
    $nombre_prod = str_replace(" ", "&nbsp;", $fila['NProducto']);
    $nombre_prod_arreglado = strtolower($nombre_prod_arreglado);
    $nombre_prod_arreglado = ucwords($nombre_prod_arreglado);
    $disabled = "";
    $funcion0 = "Borrar('" . $fila['Producto'] . "','" . $fila['Clase'] . "','" . $fila['Grupo'] . "','" . md5($nombre_prod) . "')";
    $funcion1 = "Funcion" . md5($nombre_prod) . "()";
    
    if($fila['Flag']=="1"){
      $disabled = "disabled";
      $funcion1 = "FuncionAdmin". md5($nombre_prod) . "('editar')";
      $funcion0 = "FuncionAdmin". md5($nombre_prod) . "('borrar')";
    }

    $salida .= "<p class='input-group mb-3' id='" . md5($nombre_prod) . "'>
        
        <span style='border-color: #ffffff61;pointer-events:none;background-color:rgb(51 51 51)' class='btn btn-primary btn-lg'>x" . $fila['Cantidad'] . "</span>
        <a type='text' style='font-size:2vw;pointer-events:none;' class='form-control $disabled'>" . $fila['NProducto'] . "</a>
        <span id='borrar" . md5($nombre_prod) . "' style='border-color: #ffffff61;pointer-events:none;background-color:#348242ab'class='btn btn-success btn-lg'>$" . $fila['Valor'] . "</span>
        <span style='border-color: #ffffff61;' class='btn btn-danger btn-lg' onclick=$funcion0><i class='fas fa-trash-alt'></i></i></span>
        <button style='border-color: #ffffff61;' class='btn btn-info btn-lg' onclick=$funcion1><i class='fas fa-edit'></i></button>
        </p>
        <script>
          function FuncionAdmin". md5($nombre_prod) . "(accion){
            (async () => {
              const { value: formValues } = await Swal.fire({
                  icon: 'warning',
                  title: 'Autorización de un administrador',
                  showCancelButton: true,
                  html:
                      '<input id=\"swal-input1\" class=\"swal2-input\">' +
                      '<input id=\"swal-input2\" type=\"password\" class=\"swal2-input\">',
                  focusConfirm: false,
                  preConfirm: () => {
                      return [
                          document.getElementById('swal-input1').value,
                          document.getElementById('swal-input2').value
                      ]
                  }
              })
      
              if (formValues) {
                  $.ajax({
                    url: '../PHP/check_admin.php',
                    type: 'POST',
                    dataType: 'html',
                    data: { user: formValues[0], pass: formValues[1], },
            
                })
                    .done(function (respuesta) {
                        if(respuesta==\"Y\"){
                          if(accion == 'borrar'){
                            Borrar('" . $fila['Producto'] . "','" . $fila['Clase'] . "','" . $fila['Grupo'] . "','" . md5($nombre_prod) . "');
                          }
                          if(accion=='editar'){
                            Funcion" . md5($nombre_prod) . "();
                          }

                        }else{
                          Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El usuario no es administrador o error en colocar datos',
                          })
                        }

            
                    })
                    .fail(function () {
                        console.log('Error: Not user found')
                    });
              }
          })()

          }

          function Funcion" . md5($nombre_prod) . "(){
          (async () => {
          
                      const { value: text } = await Swal.fire({
                        input: 'textarea',
                        inputValue: '" . ($fila['Nota']) . "',
                        inputLabel: 'NOTA',
                        inputPlaceholder: 'Escribe una nota...',
                        inputAttributes: {
                          'aria-label': 'Escribe una nota',
                          'name':'name" . md5($nombre_prod) . "',
                        },
                        showCancelButton: true,
                      })
                      
                      if(text){
                        $.ajax({
                          url: '../PHP/Comanda/variedadupdate.php',
                          type: 'POST',
                          dataType: 'html',
                          data: {
                            mesa: '$mesa', 
                            punto: '$punto',
                            producto:'" . $fila['Producto'] . "',
                            clase:'" . $fila['Clase'] . "',
                            grupo:'" . $fila['Grupo'] . "',
                            nota:text,
                          },
                      })
                          .done(function (respuesta) {
                            Select('actualizar');
                            
                          })
                          .fail(function () {
                              console.log('Error: Not user found')
                          });
                      }
                      
          })()
                      
        }
        
        </script>
        ";


    $total = $total + $fila['Valor'];
  }
  $salida .= "<span id='total' style='font-size:3vw;pointer-events:none;background-color:#646f6b;min-width:100%;border-color: #ffffff;' class='btn btn-info btn-lg'>$$total</span>";
  $salida .="<button style='font-size:3vw;background-color:#305e70;min-width:100%;border-color: #ffffff;' class='btn btn-info btn-lg' id='enviarorden' onclick=enviarOrden()>ENVIAR ORDEN</button>";
  $salida .= "</div>";

  echo $salida;
} else {
  if ($cantidad != "") {


    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */

    $consultaFolio = "select t.Folio,ta.Valor from tables as t INNER JOIN tarifas as ta where t.`Status`=0 and t.Punto='" . $punto . "' and t.Mesa='" . $mesa . "' and ta.Punto='" . $punto . "' and ta.Clase='" . $clase . "' and ta.Codigo='" . $producto . "' and ta.Grupo='" . $grupo . "'";
    $codigoFolioLista = $conexion->query($consultaFolio);


    while ($fila =  $codigoFolioLista->fetch_assoc()) {

      $codigoFolio = $fila['Folio'];

      $valorreal = $fila['Valor'] * $cantidad;
    }
    $sql = "select * from produccion where Mesa='" . $mesa . "' and Grupo='" . $grupo . "' and Producto='" . $producto . "' and Clase='" . $clase . "' and Punto='" . $punto . "' and Pagado='0' and Flag='0' ";
    $resultado = $conexion->query($sql);

    if (mysqli_num_rows($resultado) == 0) {
      $sql = "insert into produccion (Punto,Mesa,Grupo,Producto,Cantidad,Valor,SW,Status,Folio,Fecha,Clase,Hora,Nota,Flag) VALUES ('" . $punto . "','" . $mesa . "','" . $grupo . "','" . $producto . "',$cantidad, '" . $valorreal . "',0,0,'" . $codigoFolio . "','$fecha','" . $clase . "','$hora','$nota','0')";
      $resultado = $conexion->query($sql);
    } else {
      $sql = "update produccion set Valor=Valor+$valorreal,Cantidad=Cantidad+$cantidad,Nota=CONCAT(Nota,',','$nota') where Mesa='" . $mesa . "' and Grupo='" . $grupo . "' and Producto='" . $producto . "' and Clase='" . $clase . "' and Punto='" . $punto . "'";
      $resultado = $conexion->query($sql);
    }
    /*----------------- CODIGO SEBA 03-05-2021 ------------------- */


    $sql = "select p.Punto,p.Mesa,pr.NProducto,p.Cantidad,p.Valor from produccion as p INNER JOIN productos as pr on p.Producto=pr.Producto and p.Grupo=pr.Grupo and p.Clase=pr.Clase WHERE p.Mesa='" . $mesa . "' and p.Punto='" . $punto . "'";
    $resultado = $conexion->query($sql);

    // $salida .= "<span style='font-size:3vw' class='btn btn-info btn-lg'>Total=$$total</span>";
  }
}
