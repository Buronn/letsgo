//CREA ALGO EN EL LOCAL STORAGE
function SetLocalStorage(key, punto) {
    localStorage.setItem(key, punto);
}


//LINK DIRECTO
function GoTo(url) {
    window.location.href = url;
}


//ELIMINA UNA CLASE
function eliminarclase(id, clase) {
    var xd = document.getElementById(id)
    xd.classList.remove(clase);
}



//AGREGA UNA CLASE
function agregarclase(id, clase) {
    var xd = document.getElementById(id)
    xd.classList.add(clase);
}



//BORRA TODAS LAS COOKIES
function deleteCookies() {
    document.cookie.split(";").forEach(function (c) {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
}




//FUNCION QUE LLAMA EL MAPEO DE MESAS
function mapa(ancho, largo) {
    punto = localStorage.getItem('punto');
    $.ajax({
        url: '../log/mesas.php',
        type: 'POST',
        dataType: 'html',
        data: { lugar: punto, largo: largo, ancho: ancho },

    })
        .done(function (respuesta) {
            $("#mapa").html(respuesta);

        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}

//SONIDO DE TIMBRE
function timbre() {
    var audio = new Audio('../sounds/bell.mp3');
    audio.play();
}


//CLASES DE LOS PRODUCTOS
function Clases() {
    $.ajax({
        url: '../log/clases.php',
        type: 'POST',
        dataType: 'html',
        data: {

        },

    })
        .done(function (respuesta) {
            $("#clases").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};


//GRUPO DE LOS PRODUCTOS
function Grupo(clase) {
    $.ajax({
        url: '../log/Grupo.php',
        type: 'POST',
        dataType: 'html',
        data: {
            clase: clase

        },

    })
        .done(function (respuesta) {
            $("#grupos").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};


//SELECCIONA PRODUCTO PARA AÑADIRLO A LA ORDEN
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


//INICIO DE SESIÓN
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


//OBTENER COOKIES
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



// CKECK DEL LOGIN
function check_login() {
    var a;
    a = getCookie('u_lg');
    a = a.split(",")
    var decodedString = "";
    if (a != 0) {
        var encodedString = String.fromCharCode.apply(null, a),
            decodedString = decodeURIComponent(escape(atob(encodedString)));
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
        });
};


//CONVERTIDOR DE ARRAY
function toUTF8Array(str) {
    var string = btoa(unescape(encodeURIComponent(str))),
        charList = string.split(''),
        uintArray = [];
    for (var i = 0; i < charList.length; i++) {
        uintArray.push(charList[i].charCodeAt(0));
    }
    return new Uint8Array(uintArray);
}


//BORRA TODA LA ORDEN
function BorrarTodo() {
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
            Select('actualizar', '');
            GoTo('mapa.html')
            $("#nose").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};



//
function ocupado() {
    punto = localStorage.getItem('punto');
    mesa = localStorage.getItem('mesa_num');
    cubiertos = localStorage.getItem('cubiertos');
    localStorage.removeItem('cubiertos');
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




//BORRA UN PRODUCTO
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
