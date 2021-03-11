
function mapa(punto) {
    $.ajax({
        type: "POST",
        url: "mesas.php",
        data: { lugar: punto },

    }
    )
        .done(function (respuesta) {
            $("#xd").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}



