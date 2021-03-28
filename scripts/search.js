$(buscar_datos());

function buscar_datos(consulta) {
    clase = localStorage.getItem('Clase');
    grupo = localStorage.getItem('Grupo');
    $.ajax({
        url: '../log/buscar.php',
        type: 'POST',
        dataType: 'html',
        data: {
            consulta: consulta,
            grupo: grupo,
            clase: clase
        },
    })
        .done(function (respuesta) {
            $("#agregados").html(respuesta);
        })
        .fail(function () {
            console.log("error");
        });
}


$(document).on('keyup', '#caja_busqueda', function () {
    var valor = $(this).val();
    if (valor != "") {
        buscar_datos(valor);
    } else {
        buscar_datos();
    }
});