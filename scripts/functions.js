
function SetLocalStorage(key, punto) {
    localStorage.setItem(key, punto);
}
function GoTo(url) {
    window.location.href = url;
}

function mapa(ancho, largo) {
    punto = localStorage.getItem('punto');
    console.log(punto);
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
function timbre() {
    var audio = new Audio('../sounds/bell.mp3');
    audio.play();
}


function Select(Nproduct, Valor) {
    punto = localStorage.getItem('punto');
    mesa = localStorage.getItem('mesa_num');
    $.ajax({
        url: '../log/agregarproducto.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa,
            punto: punto,
            Valor: Valor,
            Nproduct: Nproduct
        },

    })
        .done(function (respuesta) {
            $("#poder").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};
function login() {
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;
    $.ajax({
        url: '../log/login.php',
        type: 'POST',
        dataType: 'html',
        data: {
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
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function check_login() {
    var a;
    a = getCookie('u_lg');
    console.log('a = ' + a)
    a = Array.from(a, x => x);
    var b;
    b = [a.length / 2];
    for (let i = 0; i < a.length; i = i + 2) {
        console.log(i)
        b[i / 2] = a[i] + a[i + 1]
    }
    console.log('b = ' + b)
    var decodedString = "";
    if (b != 0) {
        var encodedString = String.fromCharCode.apply(null, b),
            decodedString = decodeURIComponent(escape(atob(encodedString)));
        console.log(decodedString);
    }
    $.ajax({
        url: '../log/check_login.php',
        type: 'POST',
        dataType: 'html',
        data: {
            name: decodedString,
        },

    })
        .done(function (respuesta) {
            if (respuesta == true) {
                GoTo('../index.html')
            }
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};

function toUTF8Array(str) {
    var string = btoa(unescape(encodeURIComponent(str))),
        charList = string.split(''),
        uintArray = [];
    for (var i = 0; i < charList.length; i++) {
        uintArray.push(charList[i].charCodeAt(0));
    }
    return new Uint8Array(uintArray);
}

function BorrarTodo(borrar) {
    punto1 = localStorage.getItem('punto');
    mesa1 = localStorage.getItem('mesa_num');
    $.ajax({
        url: '../log/borrartodo.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa1: mesa1,
            punto1: punto1,
        },

    })
        .done(function (respuesta) {
            $("#nose").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};
function ocupado() {
    punto = localStorage.getItem('punto');
    mesa = localStorage.getItem('mesa_num');
    cubiertos = localStorage.getItem('cubiertos');
    localStorage.removeItem('cubiertos');
    console.log('poto')
    $.ajax({
        url: '../log/ocupado.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa,
            punto: punto,
            cubiertos: cubiertos,
        },

    })
        .done(function (respuesta) {
            $("#prueba").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}
function Borrar(borrar) {
    punto1 = localStorage.getItem('punto');
    mesa1 = localStorage.getItem('mesa_num');
    $.ajax({
        url: '../log/borrarprodu.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa1: mesa1,
            punto1: punto1,
            borrar: borrar
        },

    })
        .done(function (respuesta) {
            $("#nose").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};
