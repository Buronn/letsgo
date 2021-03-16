
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
        url: '../log/verificarlogin.php',
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
function toUTF8Array(str) {
    let utf8 = [];
    for (let i = 0; i < str.length; i++) {
        let charcode = str.charCodeAt(i);
        if (charcode < 0x80) utf8.push(charcode);
        else if (charcode < 0x800) {
            utf8.push(0xc0 | (charcode >> 6),
                0x80 | (charcode & 0x3f));
        }
        else if (charcode < 0xd800 || charcode >= 0xe000) {
            utf8.push(0xe0 | (charcode >> 12),
                0x80 | ((charcode >> 6) & 0x3f),
                0x80 | (charcode & 0x3f));
        }
        // surrogate pair
        else {
            i++;
            // UTF-16 encodes 0x10000-0x10FFFF by
            // subtracting 0x10000 and splitting the
            // 20 bits of 0x0-0xFFFFF into two halves
            charcode = 0x10000 + (((charcode & 0x3ff) << 10)
                | (str.charCodeAt(i) & 0x3ff));
            utf8.push(0xf0 | (charcode >> 18),
                0x80 | ((charcode >> 12) & 0x3f),
                0x80 | ((charcode >> 6) & 0x3f),
                0x80 | (charcode & 0x3f));
        }
    }
    return utf8;
}
function pagar(personas) {
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
            $("#prueba").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}
function ocupado(personas) {
    punto1 = localStorage.getItem('punto');
    mesa1 = localStorage.getItem('mesa_num');
    console.log('poto')
    $.ajax({
        url: '../log/ocupado.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa1: mesa1,
            punto1: punto1,
            personas: personas,
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
