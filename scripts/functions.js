//CREA ALGO EN EL LOCAL STORAGE
function SetLocalStorage(key, punto) {
    localStorage.setItem(key, punto);
}

//MUESTRA EL PRODUCTO EN LA NAVBAR DE probar.html
function MostrarProductoNavbar() {
    document.getElementById("produabajo").innerText = $("input[name='ProductOptions']:checked").val()
}


//Borrardiv al seleccionar
function ocultardivs2() {
    $("#ocultar").remove();
}

//BORRAR TODO EL LOCALSTORAGE
function clearLocalStorage() {
    localStorage.clear()
}

//DELAY
function FunctionDelay(func, time) {
    setTimeout(() => { func() }, time)
}

//ALERTA AÑADIR
function AlertaAñadido(name) {
    if($('#mult').prop('checked') && $('#multinput').val()==""){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Campo para multiplicar vacio',
            

          })
    
    }else{
        // Swal.fire({
        //     icon: 'success',
        //     title: 'Agregado correctamente '+name,
        //     showConfirmButton: false,
        //     timer: 1500
        //   })
        const { value: text } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Message',
            inputPlaceholder: 'Type your message here...',
            inputAttributes: {
              'aria-label': 'Type your message here'
            },
            showCancelButton: true
          })
          
          if (text) {
            Swal.fire(text)
          }}
    }

//SLEEP
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
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
function AgregarClase(id, clase) {
    console.log('entra aqui')
    var xd = document.getElementById(id);
    xd.classList.add(clase);
}

//CAMBIAR CLASE
function CambiarClase(id, clase1, clase2) {
    var xd = document.getElementById(id);
    xd.classList.remove(clase1);
    xd.classList.add(clase2);
}

//QUITAR ONCLICK
function DeleteOnClick(id) {
    var xd = document.getElementById(id);
}

//BORRA TODAS LAS COOKIES
function deleteCookies() {
    document.cookie.split(";").forEach(function (c) {
        document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
    });
}


//FUNCION QUE LLAMA EL MAPEO DE MESAS
function mapa() {
    npunto = localStorage.getItem('npunto');
    punto = localStorage.getItem('punto');
    $.ajax({
        url: '../PHP/Mapa/mesas.php',
        type: 'POST',
        dataType: 'html',
        data: { lugar: punto, npunto: npunto },

    })
        .done(function (respuesta) {
            $("#mapa").html(respuesta);

        })
        .fail(function () {
            console.log("Error: Not user found")
        });
}





//AGREGA LA MESA A LA TABLA tables
function tables(xd) {
    let punto = localStorage.getItem('punto');
    let cubiertos = localStorage.getItem('cubiertos');
    let mesa = localStorage.getItem('mesa_num');
    let hoy = new Date
    let dia = hoy.getDate();
    let mes = hoy.getMonth() + 1;
    let year = hoy.getFullYear();
    let hora = hoy.getHours();
    let minutos = hoy.getMinutes();
    console.log(punto, cubiertos, mesa, hoy, dia, mes, year, hora, minutos)
    $.ajax({
        url: '../PHP/Mapa/tables.php',
        type: 'POST',
        dataType: 'html',
        data: {
            lugar: punto,
            dia: dia,
            mes: mes,
            year: year,
            hora: hora,
            minutos: minutos,
            mesa: mesa,
            cubiertos: cubiertos,
            hacer: xd
        },

    })
        .done(function (respuesta) {
            $("#paraningunlado").html(respuesta);

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
        url: '../PHP/Comanda/clases.php',
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
//GET IMAGE FROM API
/* function getImage(id, buscar, time) {
    setTimeout(function () {
        const settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://bing-image-search1.p.rapidapi.com/images/search?q=" + buscar + " comida&count=1&mkt=es-CL&offset=10",
            "method": "GET",
            "headers": {
                "x-rapidapi-key": "4f543c0795msh46f19973d533f9ep12cff9jsn7118f7632446",
                "x-rapidapi-host": "bing-image-search1.p.rapidapi.com"
            }
        };
        $.ajax(settings).done(function (response) {
            document.getElementById(id).src = response.value[0].contentUrl;
        });
    }, time);


} */
//MOSTRAR PRODUCTOS
function showproduct(nombre) {
    clase = localStorage.getItem('clase');
    grupo = localStorage.getItem('Grupo');
    punto = localStorage.getItem('punto');
    document.getElementById("arribaregistro").innerText = nombre;
    document.getElementById("arribaclase").style.color = "white"

    $.ajax({
        url: '../PHP/Comanda/mostrarproducto.php',
        type: 'POST',
        dataType: 'html',
        data: {
            clase: clase,
            grupo: grupo,
            punto: punto

        },

    })
        .done(function (respuesta) {
            $("#grupos").html(respuesta);
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};



//GRUPO DE LOS PRODUCTOS
function mostrargrupos(clase, nombre) {
    if (clase == '' && nombre == '') {
        clase = localStorage.getItem('clase');
        document.getElementById("arribaregistro").innerText = "";
        document.getElementById("arribaclase").style.color = "#65eec0"
        document.getElementById("produabajo").innerText = "";
    } else {
        document.getElementById("arribaclase").style.color = "#65eec0"
        document.getElementById("arribaclase").innerText = nombre;
        document.getElementById("arribaregistro").innerText = "";
        document.getElementById("produabajo").innerText = "";

    }

    $.ajax({
        url: '../PHP/Comanda/grupos.php',
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


//ELIMINAR DIVS DE LA CUENTA
function ocultardivs() {

    if (document.getElementById('barra0') == null) {
        setTimeout(function () {
            $("#addProd").addClass("hide");
            document.getElementById('barra1').id = 'barra0'
        }, 500);


    } else {
        $("#addProd").removeClass("hide");
        Select("actualizar");
        document.getElementById('barra0').id = 'barra1';
        CambiarClase('mult', 'enabled', 'disabled');


    }

}
function Borrar(codigo,clase,Grupo,div) {
    $("#"+div).remove()
    punto = localStorage.getItem('punto');
    mesa = localStorage.getItem('mesa_num');
    
    

    $.ajax({
        url: '../PHP/Comanda/Borrar.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa,
            punto: punto,
            product: codigo,
            clase: clase,
            Grupo: Grupo,

        },

    })
        .done(function (respuesta) {
            
        })
        .fail(function () {
            console.log("Error: Not user found")
        });
};

//SELECCIONA PRODUCTO PARA AÑADIRLO A LA ORDEN
function Select(codigo) {

    punto = localStorage.getItem('punto');
    mesa = localStorage.getItem('mesa_num');
    clase = localStorage.getItem('clase');
    Grupo = localStorage.getItem('Grupo');
    var cantidad = 1;
    if($('#mult').prop('checked')){
        cantidad = $('#multinput').val();
    }
    $.ajax({
        url: '../PHP/Comanda/agregarproducto.php',
        type: 'POST',
        dataType: 'html',
        data: {
            mesa: mesa,
            punto: punto,
            product: codigo,
            cantidad: cantidad,
            clase: clase,
            Grupo: Grupo,
            fecha: new Date().toLocaleDateString('en-ES'),
            hora: new Date().toLocaleTimeString('en-US', { hour12: false, 
                hour: "numeric", 
                minute: "numeric"}),

        },

    })
        .done(function (respuesta) {
            $("#addProd").html(respuesta);

        })
        .fail(function () {
            console.log("Error: Not user found")
        })

}





//INICIO DE SESIÓN
function login() {
    var user = document.getElementById("user").value;
    var pass = document.getElementById("pass").value;
    $.ajax({
        url: '../PHP/Index/login.php',
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
        url: '../PHP/check_login.php',
        type: 'POST',
        dataType: 'html',
        data: {
            name: decodedString,
        },

    })
        .done(function (respuesta) {
            if (respuesta == true) {
                GoTo('index.html')
            }
        })
        .fail(function () {
        });
};


function uintToString(uintArray) {
    uintArray = uintArray.split(",");
    var encodedString = String.fromCharCode.apply(null, uintArray),
        decodedString = decodeURIComponent(escape(atob(encodedString)));
    return decodedString;
}


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

