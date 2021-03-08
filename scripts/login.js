$(login());

function login(user, pass) {
    $.ajax({
        url: '../log/verificarlogin.php',
        type: 'POST',
        dataType: 'html',
        data: {
            user: user,
            pass: pass
        }

    })
    .done(function (respuesta){
        $("#alerta").html(respuesta);
    })
    .fail(function (){
        console.log("Error: Not user found")
    });
}

$(document).on('keyup', '#user', function () {
	var valor = $(this).val();

	login(user,pass)
});