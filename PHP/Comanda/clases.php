<?php
require "../conexion.php";
$salida = "<nav style='background-color:black'>
            <div style='border-bottom: 0px solid #dee2e6;' class='nav nav-tabs' id='nav-tab' role='tablist'>";
$sql = "select * from familias";
$resultado = $conexion->query($sql);
$contador=0;

while ($fila = $resultado->fetch_assoc()) {
    $a = $fila['NClase'];
    $a = str_replace(" ", "&nbsp;", $a);
    $a = strtolower($a);
    $a = ucwords($a);
    
    if($contador>0){
        $salida .= "<a style='border: 1px solid #b2b2b287;' class='nav-item nav-link' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
        aria-controls='nav-home' aria-selected='true' onclick=mostrargrupos('".$fila['Clase']."','$a'),SetLocalStorage('clase','".$fila['Clase']."')>".$fila['NClase']."</a>"
        ;
        
    }else{
        $salida .= "<a style='border: 1px solid #b2b2b287;' class='nav-item nav-link active' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
    aria-controls='nav-home' aria-selected='true' onclick=mostrargrupos('".$fila['Clase']."','$a'),SetLocalStorage('clase','".$fila['Clase']."')>".$fila['NClase']."</a>
    <script>mostrargrupos('".$fila['Clase']."','$a')</script>";

    }
    $contador++;
}
$salida.=" </nav>";
$salida.=" <div class='tab-content' id='nav-tabContent'>";
$resultado = $conexion->query($sql);
$contador=0;
while($fila = $resultado->fetch_assoc()){
    if($contador==0){
        $salida.="<div class='tab-pane fade show active' id='nav-'".$fila['Clase']."'' role='tabpanel' aria-labelledby='nav-'".$fila['Clase']."'-tab'>
    
    </div>";

    }else{
        $salida.="<div class='tab-pane fade' id='nav-'".$fila['Clase']."'' role='tabpanel' aria-labelledby='nav-'".$fila['Clase']."'-tab'>
        </div>"
        ;
    }
    
}
$salida.="<div class='nav nav-tabs' style='min-height:81.8vh' id='grupos'></div></div>";

echo $salida;
