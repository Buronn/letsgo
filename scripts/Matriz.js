
function SetLocalStorage(key,punto) {
    localStorage.setItem(key, punto);
}
function GoTo(url){
    window.location.href = url;
}

function mapa(ancho, largo) {
    punto = localStorage.getItem('punto')
    console.log(punto)
    $.ajax({
        url: '../log/mesas.php',
        type: 'POST',
        dataType: 'html',
        data: { lugar: punto, largo: largo, ancho: ancho },

    })
        .done(function (respuesta) {
            $("#xd").html(respuesta);

        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}



