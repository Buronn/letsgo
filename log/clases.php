<?php
require "conexion.php";
$salida = "<nav>
            <div class='nav nav-tabs' id='nav-tab' role='tablist'>";
$sql = "select * from familias";
$resultado = $conexion->query($sql);
$contador=0;

while ($fila = $resultado->fetch_assoc()) {
    $a = $fila['NClase'];
    $a = str_replace(" ", "&nbsp;", $a);
    $a = strtolower($a);
    $a = ucwords($a);
    
    if($contador>0){
        $salida .= "<a class='nav-item nav-link' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
        aria-controls='nav-home' aria-selected='true' onclick=Grupo('".$fila['Clase']."','$a'),SetLocalStorage('clase','".$fila['Clase']."')>".$fila['NClase']."</a>"
        ;
        
    }else{
        $salida .= "<a class='nav-item nav-link active' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
    aria-controls='nav-home' aria-selected='true' onclick=Grupo('".$fila['Clase']."','$a'),SetLocalStorage('clase','".$fila['Clase']."')>".$fila['NClase']."</a>
    <script>Grupo('".$fila['Clase']."','$a')</script>";

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
    <div class='nav nav-tabs' id='grupos'></div>
    </div>";

    }else{
        $salida.="<div class='tab-pane fade' id='nav-'".$fila['Clase']."'' role='tabpanel' aria-labelledby='nav-'".$fila['Clase']."'-tab'>
        <div class='nav nav-tabs' id='grupos'></div>
        </div>"
        ;
    }
    
}
$salida.="</div>";

echo $salida;
