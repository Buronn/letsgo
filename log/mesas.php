<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$sql = "Select * from mesas where Punto='" . $lugar . "' and x is not null and y is not null";
$table_puntos = "select * from puntos";
$result = $conexion->query($sql);
$result2 = $conexion->query($table_puntos);
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
        <a class='nav-link nav-link-test' style='font-size: 1.4vw;' onclick=AgregarClase('actualizando','spinner-border'),SetLocalStorage('punto','" . $fila['Codigo'] . "'),FunctionDelay(mapa,500)>・" . $fila['Nombre'] . "</a>
        </li>";
}

$salida .= "
  
      
    </ul>
  </div>
</nav>




<div class='mapa'><img class='img-fluid' style='border-radius: 5%; max-width=100%' usemap='#workmap' src='../images/Fondo/pisoprueba2.png' >";
$salida .= "<map name=\"workmap\">";
$aux = 0;
while ($fila = $result->fetch_assoc()) {

    $left = ((((float)$fila['x']) * 100) / 80 * 6.8);
    $top = (((float)$fila['y']) * 110) / 60 * 4.5;
    if ($fila['personas'] == 0) {
        $salida .= "
    <div class='contenedor'>
        <a class='btn-abrir-popup' id='btn-abrir-popup$aux'>
            <img class='animation' style='position:fixed;left: " . $left + 3  . "%;top: " . $top + 2 . "%;width: 9.6%;height: 15%;' 
            src='../images_mesas/" . $fila['forma'] . "_" . $fila['color'] . "_" . $fila['personas'] . ".gif'>

            <h1 onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "') class='mesitas' style='position: fixed;
            left: " . $left + 3.5 . "%;
            top: " . $top + 5 . "%;font-size:2vw'>" . $fila['Mesa'] . "</h1>
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
            left: " . $left + 3.5 . "%;
            top: " . $top + 5 . "%;font-size:2vw'>" . $fila['Mesa'] . "</h1>
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
    $aux = $aux + 1;
}

//CERRAR SESION
$salida .=
    "<a href='../index.html' onclick=deleteCookies(),clearLocalStorage()>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 89 . "%;
top: " . -11 . "%;
width: 5%;
height: 8%;' href='../index.html' src='../icons/logout-red.png'>
</a>";

//ACTUALIZAR
$salida .=
    "<a onclick=AgregarClase('actualizando','spinner-border'),FunctionDelay(mapa,1000)>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 81 . "%;
top: " . -11 . "%;
width: 5%;
height: 8%;' href='../index.html' src='../icons/actualizar.png'>
<div style='position: fixed;
left: " . 94 . "%;
top: " . 94 . "%;width: 2.5vw; height: 2.5vw;' id='actualizando' class='text-light' role='status'>
    <span class='visually-hidden'></span>
  </div>
</a>";




// PUNTO
$sql = "select Nombre from puntos where Codigo='" . $lugar . "'";
$result = $conexion->query($sql);
$npunto = '';
while ($fila = $result->fetch_assoc()) {
    $npunto = $fila['Nombre'];
}
if ($npunto != '') {
    $salida .= "
    <h1 class='img-fluid mesitas' style='position: fixed;
    left: " . 5 . "%;
    top: " . 100 . "%;font-family:Bulletto Killa;font-size:4vw;color: white;text-shadow: 10px 7px 3px black;
    '>" . $npunto . "</img>
    ";
} else {
    $salida .= "
        <h1 class='img-fluid mesitas' style='position: fixed;
        left: " . 5 . "%;
        top: " . 10 . "%;font-family:Verdana;font-size:4vw;color: white;text-shadow: 1px 7px 3px black;
        '>Escoja un punto porfavor.</img>
";
}
$salida .= "</map>";
$salida .= "</div>";
echo "$salida";
