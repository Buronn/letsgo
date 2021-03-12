function select() {
    mesa = localStorage.getItem('mesa_num')
    punto = localStorage.getItem('punto')
    $.ajax({
        url: '../log/agregarproducto.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa,
            punto: punto
        },

    })
        .done(function (respuesta) {
            $("#poder").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};