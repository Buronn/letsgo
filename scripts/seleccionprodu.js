function select(mesa) {
    var nummesa = mesa;
    $.ajax({
        url: '../log/agregarproducto.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa

        }

    })
        .done(function (respuesta) {
            $("#poder").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};