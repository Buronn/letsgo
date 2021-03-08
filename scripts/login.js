function login() {
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;
    $.ajax({
        url: '../log/verificarlogin.php',
        type: 'POST',
        dataType: 'html',
        data:{
            user: user,
            pass: pass
        }

    })
        .done(function (respuesta) {
            $("#alerta").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};