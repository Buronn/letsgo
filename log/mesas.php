<?php
require "conexion.php";
$salida = "";
$lugar = $_POST['lugar'];
$sql = "Select Mesa,x,y from mesas where Punto='" . $lugar . "'";
$result = $conexion->query($sql);
$salida .= "<img src='../images/Fondo/piso.jpg' usemap='#image-map'>";
?>
<script>
    const img = new Image();
    img.onload = function() {
        console.log(this.width + 'x' + this.height);
    }
    img.src = '../images/Fondo/piso.jpg';
</script>
<?php
if ($result->num_rows > 0) {

    while ($fila = $result->fetch_assoc()) {
    }
}
echo "$salida";
