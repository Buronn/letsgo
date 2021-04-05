<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$ancho = $_POST['ancho'];
$largo = $_POST['largo'];
$sql = "Select * from mesas where Punto='" . $lugar . "' and x is not null and y is not null";
$table_puntos = "select * from puntos";
$result = $conexion->query($sql);
$result2 = $conexion->query($table_puntos);
$ancho = (float)$ancho / 10;
$largo = (float)$largo / 10;
$salida .= "

<nav class='navbar navbar-expand-lg navbar-test navbar-light bg-light' style='z-index:101;position:absolute;left: " . 5 . "%;
top: " . -10 . "%;' >
<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>
  <div class='collapse navbar-collapse' id='navbarNav'>
    <ul class='navbar-nav'>";
while ($fila = $result2->fetch_assoc()) {
    $salida .= "
        <li class='nav-item'>
        <a class='nav-link nav-link-test' style='font-size: 1.4vw;' onclick=SetLocalStorage('punto','" . $fila['Codigo'] . "'),mapa(800,600)>・" . $fila['Nombre'] . "</a>
        </li>";

    }

$salida.="
  
      
    </ul>
  </div>
</nav>




<div class='mapa'><img class='img-fluid' style='border-radius: 5%; max-width=100%' usemap='#workmap' src='../images/Fondo/pisoprueba2.png' >";
$salida .= "<map name=\"workmap\">";
$aux = 0;
while ($fila = $result->fetch_assoc()) {

    $left = ((((float)$fila['x']) * 100) / $ancho * 6.8);
    $top = (((float)$fila['y']) * 110) / $largo * 4.5;
    if ($fila['personas'] == 0) {
        $salida .= "
    <div class='contenedor'>
        <a class='btn-abrir-popup' id='btn-abrir-popup$aux'>
            <img class='animation' style='position:fixed;left: " . $left+3  . "%;top: " . $top+2 . "%;width: 9.6%;height: 15%;' 
            src='../images_mesas/" . $fila['forma'] . "_" . $fila['color'] . "_" . $fila['personas'] . ".gif'>

            <h1 onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "') class='mesitas' style='position: fixed;
            left: " . $left+3.5 . "%;
            top: " . $top+5 . "%;font-size:2vw'>".$fila['Mesa']."</h1>
        </a>
        
        <div class='overlay' id='overlay$aux'>
            <div class='popup' id='popup$aux'>
                <h3>Cubiertos</h3>";
        if ($fila['forma'] != 'REC') {
            $salida .= "<button class='btn-submit' onclick=SetLocalStorage('cubiertos','1'),GoTo('probar.html') >1</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','2'),GoTo('probar.html') >2</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','3'),GoTo('probar.html') >3</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','4'),GoTo(probar.html') >4</button>";
        }
        if ($fila['forma'] == 'REC') {
            $salida .= "<button class='btn-submit' onclick=SetLocalStorage('cubiertos','1'),GoTo('probar.html') >1</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','2'),GoTo('probar.html') >2</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','3'),GoTo('probar.html') >3</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','4'),GoTo('probar.html') >4</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','5'),GoTo('probar.html') >5</button>
                    <button class='btn-submit' onclick=SetLocalStorage('cubiertos','6'),GoTo('probar.html') >6</button>";
        }
        $salida .= "
                <h1><label href='#' id='btn-cerrar-popup$aux' class='btn-cerrar-popup'>x</label></h1>
            </div>
        </div>
    </div>
    <script src='/scripts/popup.js'></script>
    ";
    } else {
        $salida .= "
    <div class='contenedor'>
        <a href='./probar.html' onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "')>
            <img class='img-fluid mesitas btn-abrir-popup animation'
            style='position: absolute;left: " . $left  . "%;top: " . $top . "%;width: 9.6%;height: 15%;' 
            src='../images_mesas/" . $fila['forma'] . "_" . $fila['color'] . "_" . $fila['personas'] . ".gif'>
            <h1 onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "') class='img-fluid mesitas btn-abrir-popup animation' id='btn-abrir-popup$aux' style='position: fixed;
            left: " . $left+3.5 . "%;
            top: " . $top+5 . "%;font-size:2vw'>".$fila['Mesa']."</h1>
        </a><script>setTimeout(() => {},2000);</script>
        
        <div class='overlay' style='z-index:-1' id='overlay$aux'>
            <div class='popup' id='popup$aux'>
                
                <h3><label href='#' id='btn-cerrar-popup$aux' class='btn-cerrar-popup'>x</label></h3>
            </div>
        </div>
    </div>
    <script src='/scripts/popup.js'></script>
    ";
    }

    /* coords=\"" . $ancho * ((float)$fila['x']+1) . "," . $largo * ((float)$fila['y']+1) . ",44\" */
    $aux = $aux + 1;
}
/* LOGO */



while ($fila = $result2->fetch_assoc()) {
    $salida .= "
        <a class='list-group-item list-group-item-action list-group-item-primary' onclick=SetLocalStorage('punto','" . $fila['Codigo'] . "'),mapa(800,600)>" . $fila['Nombre'] . "</a>";
}
$salida .= "</div>
            
        </div>
    </div>
</div>
<script src='/scripts/popup.js'></script>
";

$salida .=
    "<a href='../index.html' onclick='deleteCookies()'>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 87 . "%;
top: " . -13 . "%;
width: 7%;
height: 11%;' href='../index.html' src='../icons/logout-red.png'>
</a>";


/* PUNTO */
$salida .= "
<img class='img-fluid mesitas' style='position: fixed;
left: " . 26 . "%;
top: " . 95 . "%;width: 44%;height: 15%;' href='../index.html' src='../icons/" . $lugar . ".text.png'>
";
$salida .= "</map>";
$salida .= "</div>";
echo "$salida";
