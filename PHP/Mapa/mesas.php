<?php
require "../conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$sql = "Select * FROM mesas where Mesa NOT IN(Select Mesa from `tables` where `Status`='0' and Punto='" . $lugar . "') and Punto='" . $lugar . "'";
$sql2 = "Select  t.Mesa,t.`Status`,t.Cubiertos,t.Cuenta,m.forma,m.x,m.y FROM `tables` as t INNER JOIN mesas  as m on m.Mesa=t.Mesa WHERE t.`Status`='0' and m.Punto='" . $lugar . "' and t.Punto='" . $lugar . "' GROUP BY Mesa";
$table_puntos = "select * from puntos";
$result = $conexion->query($sql);
$result2 = $conexion->query($table_puntos);
$result3 = $conexion->query($sql2);

//-----------------NAVBAR------------------
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
        <a class='nav-link nav-link-test' style='font-size: 1.4vw;' onclick=AgregarClase('actualizando','spinner-border'),SetLocalStorage('punto','" . $fila['Codigo'] . "'),FunctionDelay(mapa,0)>・" . $fila['Nombre'] . "</a>
        </li>";
}

$salida .= "
  
      
    </ul>
  </div>
</nav>
<div class='mapa'><img class='img-fluid' style='width: 1311px; height: 738px; border-radius: 5%; max-width=100%' usemap='#workmap' src='../images/Fondo/pisoprueba2.png' >";
$salida .= "<map name=\"workmap\">";
$aux = 0;
//MESAS


//-----------------POSICIONAMENTO MESAS------------------
while ($fila = $result->fetch_assoc()) {
    if ($fila['forma'] != 'PARED' && $fila['forma'] != 'PLANTA' && $fila['forma'] != 'PUERTA') {
        $left =  (float)$fila['y'] + 21 ;
        $top = (float)$fila['x']+ 21 ;
        //MESAS DESOCUPADAS
        if ($fila['x'] != null and $fila['y'] != null) {
            $salida .= "
        <div class='contenedor'>
            <a class='btn-abrir-popup' id='mesa$aux' onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "'),Mesa$aux() >
                <img class='animation' style='position:fixed;left: " . ($left )  . "px;top: " . ($top ) . "px;width: 125.84px;height: 110.69px;' 
                src='../images_mesas/" . $fila['forma'] . "_BLANCO_0.gif'>
    
                <h1 class='mesitas' style='position: fixed;
                left: " . ($left + 7 ) . "px;
                top: " . ($top + 25) . "px;font-size:2vw'>" . $fila['Mesa'] . "</h1>
            </a>
            <script>
            ";
            if($fila['forma']=='REC'){
                $salida.="function Mesa$aux(){
                    (async () => {
                    const inputOptions = new Promise((resolve) => {
                        setTimeout(() => {
                          resolve({
                            '1': '1',
                            '2': '2',
                            '3': '3',
                            '4':'4',
                            '5':'5',
                            '6':'6',
                          })
                        }, 0)
                      })
                      
                      const { value: color } = await Swal.fire({
                        title: 'Cantidad de cubiertos',
                        input: 'radio',
                        inputOptions: inputOptions,
                        inputValidator: (value) => {
                          if (!value) {
                            return 'Necesitas escoger una opción!'
                          }
                        }
                      })
                      
                      if (color) {
                        SetLocalStorage('cubiertos',color);
                        tables('xd');
                        GoTo('comanda.html');
                      }
                    })()
                }
                    </script>";
            }else{
                $salida.="function Mesa$aux(){
                    (async () => {
                    const inputOptions = new Promise((resolve) => {
                        setTimeout(() => {
                          resolve({
                            '1': '1',
                            '2': '2',
                            '3': '3',
                            '4':'4',
                          })
                        }, 0)
                      })
                      
                      const { value: color } = await Swal.fire({
                        title: 'Cantidad de cubiertos',
                        input: 'radio',
                        inputOptions: inputOptions,
                        inputValidator: (value) => {
                          if (!value) {
                            return 'Necesitas escoger una opción!'
                          }
                        }
                      })
                      
                      if (color) {
                        SetLocalStorage('cubiertos',color);
                        tables('xd');
                        GoTo('comanda.html');
                      }
                    })()
                }
                    </script>";
            }
            
            

        $salida.="</div>";
            $aux = $aux + 1;
            /* 
            SetLocalStorage('cubiertos','4'),tables('xd'),GoTo('comanda.html')
            <script>
        var btnAbrirPopup$aux = document.getElementById('btn-abrir-popup$aux'),
        overlay$aux = document.getElementById('overlay$aux'),
        popup$aux = document.getElementById('popup$aux'),
        btnCerrarPopup$aux = document.getElementById('btn-cerrar-popup$aux');
    
    btnAbrirPopup$aux.addEventListener('click', function () {
        overlay$aux.classList.add('active');
        popup$aux.classList.add('active');
    });
    
    btnCerrarPopup$aux.addEventListener('click', function (e) {
        e.preventDefault();
        overlay$aux.classList.remove('active');
        popup$aux.classList.remove('active');
    });
        </script> */
        }
    } else {
        $left =  (float)$fila['y'] ;
        $top = (float)$fila['x'];
        
        
        
        if ($fila['forma'] == 'PLANTA') {
            $salida .= "<img style='position:fixed;left: " . ($left )  . "px;top: " . ($top ) . "px;width: 6.6%;height: 13%;' 
        src='../images_mesas/PLANTA.png'>";
        }
        if ($fila['forma'] == 'PARED') {
            $salida .= "<img style='position:fixed;left: " . ($left )  . "px;top: " . ($top ) . "px;width: 20%;height: 5%;' 
        src='../images_mesas/PARED.png'>";
        }
        if ($fila['forma'] == 'PUERTA') {
            $salida .= "<img style='position:fixed;left: " . ($left )  . "px;top: " . ($top ) . "px;width: 6.6%;height: 13%;' 
        src='../images_mesas/PUERTA.png'>";
        }
    }
}

while ($fila = $result3->fetch_assoc()) {
    $left =  (float)$fila['y'] - 21;
     $top = (float)$fila['x'] - 21;

    //MESAS OCUPADAS
    if ($fila['x'] != null and $fila['y'] != null) {
        $salida .= "

    <div class='contenedor'>
        <a href='./comanda.html' onclick=SetLocalStorage('mesa_num','" . $fila['Mesa'] . "'),localStorage.removeItem('cubiertos'),SetLocalStorage('cubiertos','" . $fila['Cubiertos'] . "')>
            <img class='img-fluid mesitas btn-abrir-popup animation'
            style='position: absolute;left: " . $left  . "px;top: " . $top . "px;width: 125.84px;height: 110.69px;' 
            src='../images_mesas/";
        if ($fila['Cuenta'] == 1) {
            $salida .= "" . $fila['forma'] . "_ROJO_" . $fila['Cubiertos'] . "";
        } else {
            $salida .= "" . $fila['forma'] . "_VERDE_" . $fila['Cubiertos'] . "";
        }
        $salida .= ".gif'>
            <h1 class='img-fluid mesitas btn-abrir-popup animation' id='btn-abrir-popup$aux' style='position: fixed;
            left: " . ($left + 47) . "px;
            top: " . ($top + 38) . "px;font-size:2vw'>" . $fila['Mesa'] . "</h1>
        </a><script>setTimeout(() => {},2000);</script>
        
        <div class='overlay' style='z-index:-1' id='overlay$aux'>
            <div class='popup' id='popup$aux'>
                
                <h3><label href='#' id='btn-cerrar-popup$aux' class='btn-cerrar-popup'>x</label></h3>
            </div>
        </div>
    </div>
    ";
        $aux = $aux + 1;
    }
}


//-----Tooltip para cerrar sesion------




//--------------CERRAR SESION--------------

$salida .=
    "<a data-toggle='tooltip' data-placement='top' title='Cerrar Sesión' href='../index.html' onclick=deleteCookies(),clearLocalStorage()>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 89 . "%;
top: " . -11 . "%;
width: 5%;
height: 8%;' href='../index.html' src='../iconos/logout-red.png'>
</a>";

//--------------ACTUALIZAR--------------
$salida .=
    "<a onclick=AgregarClase('actualizando','spinner-border'),FunctionDelay(mapa,0)>
<img class='img-fluid mesitas' style='position: fixed;
left: " . 81 . "%;
top: " . -11 . "%;
width: 5%;
height: 8%;' href='../index.html' src='../iconos/actualizar.png'>
<div style='position: fixed;
left: " . 94 . "%;
top: " . 94 . "%;width: 2.5vw; height: 2.5vw;' id='actualizando' class='text-light' role='status'>
    <span class='visually-hidden'></span>
  </div>
</a>";




//--------------PUNTO--------------
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
