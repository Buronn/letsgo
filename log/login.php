<?php
require 'conexion.php';
$salida = "";
$usuario = $_POST['user'];
$password = $_POST['pass'];

$sql = "select Nombre,Password from usuarios where Nombre='" . $usuario . "' and Password='" . $password . "'";

$resultado = $conexion->query($sql);

if (mysqli_num_rows($resultado) == 1) {
  echo "
    <script>
    array = toUTF8Array('" . $usuario . "');
    var a = '';
    console.log(array);
    array.forEach(element => {
      a = a+element;
    });
    createCookie('u_lg',a,0.1);
    function createCookie(cookieName,cookieValue,daysToExpire)
        {
          var date = new Date();
          date.setTime(date.getTime()+(daysToExpire*24*60*60*1000));
          document.cookie = cookieName + '=' + cookieValue + '; expires=' + date.toGMTString()+';priority= high';
        }
    
      
      
    </script>
  <div class=\"spinner-grow\" style=\"width: 3rem; height: 3rem;\" role=\"status\">
    <span class=\"visually-hidden\"></span>
  </div></span>
    </div><script>setTimeout(() => { window.top.location='../routes/punto.html';},2000);</script>";
} else {
  $salida .= "<div class=\"alert alert-warning\" role=\"alert\">
                Clave o usuario incorrectos
                </div>";
}
echo $salida;
