
function SetLocalStorage(punto) {
    localStorage.setItem('punto', punto);
    window.location.href = "mapa.html";
}

function mapa() {
    punto = localStorage.getItem('punto')
    console.log(punto)
    $.ajax({
        url: '../log/mesas.php',
		type: 'POST',
		dataType: 'html',
		data: { lugar: punto },

    })
        .done(function (respuesta) {
            $("#xd").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}



