<?php
define("host_bd", "database-merken.ccvzxrt75imq.us-east-1.rds.amazonaws.com");
define("user_bd", "root");
define("pass_bd", "merquen1");
define("name_bd", "merquen");
$conexion = new mysqli(
    constant("host_bd"),
    constant("user_bd"),
    constant("pass_bd"),
    constant("name_bd")
);
$salida = "";
$usuario = $_POST['user'];
$password = $_POST['pass'];

$siguienteLocacion = './mapa.html';
$esAdmin = '';


$sql = "select Nombre,Password,Admin from usuarios where Nombre='" . $usuario . "' and Password='" . md5($password) . "'";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
  $esAdmin =   $fila['Admin'];
}

if ($esAdmin == 'Y') {
  $siguienteLocacion =  './Admin.html';
}

if (mysqli_num_rows($resultado) == 1) {
  echo "
        <script>
        array = toUTF8Array('" . $usuario . "');
        var a = '';
        
      
        array.forEach(element => {
          a = a+element;
        });
        createCookie('u_lg',array,0.1);
        function createCookie(cookieName,cookieValue,daysToExpire)
            {
              var date = new Date();
              date.setTime(date.getTime()+(daysToExpire*24*60*60*1600));
              document.cookie = cookieName + '=' + cookieValue + '; expires=' + date.toGMTString()+';priority= high';
            }
        </script>
        
      <div class=\"spinner-grow\" style=\"width: 3rem; height: 3rem;\" role=\"status\">
        <span class=\"visually-hidden\"></span>
      </div></span>
        </div><script>setTimeout(() => { window.top.location='" . $siguienteLocacion . "';},2000);</script>";
} else {
  $salida .= "<div class=\"alert alert-warning\" role=\"alert\">
                    Clave o usuario incorrectos
                    </div>";
}




echo $salida;
