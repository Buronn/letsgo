<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$ancho = $_POST['ancho'];
$largo = $_POST['largo'];
$sql = "Select * from mesas where Punto='" . $lugar . "' and x is not null and y is not null";
$result = $conexion->query($sql);
$ancho = (float)$ancho / 10;
$largo = (float)$largo / 10;
$salida .= "
<div class='mapa'><img class='img-fluid' style='border-radius: 5%; max-width=100%' usemap='#workmap' src='../images/Fondo/piso2.jpg' >";
$salida .= "<map name=\"workmap\">";
$aux = 0;
while ($fila = $result->fetch_assoc()) {

    $left = ((((float)$fila['x']) * 100) / $ancho * 6.8);
    $top = (((float)$fila['y']) * 110) / $largo * 4.5;
    if ($fila['personas'] == 0) {
        $salida .= "
    <div class='contenedor'>
        <a onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "')>
            <img class='img-fluid mesitas btn-abrir-popup animation' id='btn-abrir-popup$aux'
            style='position:fixed;left: " . $left  . "%;top: " . $top . "%;width: 9.6%;height: 15%;' 
            src='../images_mesas/" . $fila['forma'] . "_" . $fila['color'] . "_" . $fila['personas'] . ".gif'>
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
            <img class='img-fluid mesitas btn-abrir-popup animation' id='btn-abrir-popup$aux'
            style='position: absolute;left: " . $left  . "%;top: " . $top . "%;width: 9.6%;height: 15%;' 
            src='../images_mesas/" . $fila['forma'] . "_" . $fila['color'] . "_" . $fila['personas'] . ".gif'>
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
/* $salida .= "
<img class='img-fluid mesitas' style='position: fixed;
left: " . 42 . "%;
top: " . -19 . "%;
width: 10%;
height: 17%;' href='../routes/punto.html' src='../icons/logo-x.png'>"; */
/* BACK */
/* $salida .= "<a href='../routes/punto.html'>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 2 . "%;
top: " . -15 . "%;
width: 6%;
height: 11%;' href='../routes/punto.html' src='../icons/back-red.png'>
</a>"; */
/* LOGOUT */
$salida .= "<a href='../index.html' onclick='deleteCookies()'>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 85 . "%;
top: " . -15 . "%;
width: 7%;
height: 11%;' href='../index.html' src='../icons/logout-red.png'>
</a>";
/* PUNTO */
/* $salida .= "
<img class='img-fluid mesitas' style='position: fixed;
left: " . 27.3 . "%;
top: " . 86 . "%;
width: 40%;
height: 20%;' href='../index.html' src='../icons/" . $lugar . ".text.png'>"; */
$salida .= "</map>";
$salida .= "</div>";
echo "$salida";
