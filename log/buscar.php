<?php
require "conexion.php";
$salida = "<script>onclick=Select('actualizar','')</script>";
$grupo = $_POST['grupo'];
$clase = $_POST['clase'];
$query = "select * from productos where Grupo=$grupo and Clase=$clase";
if (isset($_POST['consulta'])) {
    $q = $conexion->real_escape_string($_POST['consulta']);
    $query = "select NProducto,Valor from productos where Grupo=$grupo and Clase=$clase and NProducto LIKE '%" . $q . "%'";
}
$resultado = $conexion->query($query);
if ($resultado->num_rows > 0) {
    $salida .= "<div class='card-columns'>";

    while ($fila = $resultado->fetch_assoc()) {
        $a = $fila['NProducto'];
        $a = str_replace(" ", "&nbsp;", $a);
        $b = $fila['Valor'];
        $c = strtolower($a);
        $c = ucwords($c);
        $salida .= " <div class='card'>
        <img class='card-img-top' src='../images/aatrox.png' alt='Card image cap'>
        <div class='card-body'>
          <h5 class='card-title'>$a</h5>
          <p class='card-text'>poder:$b</p>
         
          <button class='btn btn-primary' onclick=Select(\"" . $a . "\",'" . $fila['Valor'] . "')>agregar</button>
        </div>
        </div>";
    }
    $salida .= "</div>";
} else {
    $salida .= "Error en la búsqueda";
}
echo $salida;
