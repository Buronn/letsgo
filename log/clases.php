<?php
require "conexion.php";
$salida = "<nav>
            <div class='nav nav-tabs' id='nav-tab' role='tablist'>";
$sql = "select * from familias";
$resultado = $conexion->query($sql);
$contador=0;
while ($fila = $resultado->fetch_assoc()) {
    
    if($contador>0){
        $salida .= "<a class='nav-item nav-link' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
        aria-controls='nav-home' aria-selected='true' onclick=Grupo('".$fila['Clase']."')>'".$fila['NClase']."'</a>"
        ;
        
    }else{
        $salida .= "<a class='nav-item nav-link active' id='nav-clase-tab' data-toggle='tab' href='#nav-'".$fila['Clase']."'' role='tab'
    aria-controls='nav-home' aria-selected='true' onclick=Grupo('".$fila['Clase']."')>'".$fila['NClase']."'</a>
    <script>Grupo('".$fila['Clase']."')</script>";

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
/* <div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <script>
        Clases();
    </script>

    </div>
</div>
<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="nav nav-tabs" id="grupos"></div>
</div>
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    <input type="text" name="caja_busqued" id="caja_busqueda"></input>
    <div class="col" id="agregados"></div>
    <div id="prueba"></div>
</div>
</div> */

echo $salida;
