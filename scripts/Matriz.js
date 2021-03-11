
function mapa(punto) {
    $.ajax({
        type: "POST",
        url: "mesas.php",
        data: { lugar: punto },
        success: function (resultado) {
            $('#xd').html(resultado);
        }
    }
    )
}



