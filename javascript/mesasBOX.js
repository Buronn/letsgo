
var data;
var largoTotal = 0;
var puntoActual = "";
var puntoActualN = "";
var guardar = false;
$.ajax({
    url: '../PHP/getPuntos.php',
    type: 'GET',

})
    .done(function (respuesta) {

        respuesta = JSON.parse(respuesta);
        /* console.log(respuesta) */
        $(document).ready(function () {

            var lugar = document.getElementById('puntos')
            lugar.innerHTML = '';
            lugar.innerHTML += `<option disabled selected="selected">Seleccione punto</option>`
            for (let i = 0; i < respuesta.length; i++) {
                lugar.innerHTML += `<option value="${respuesta[i]['Codigo']}">${respuesta[i]['Nombre']}</option>`;
            }

        });
    })
    .fail(function () {
    });
$(document).ready(function () {
    $('#crearMesa1').css('pointer-events', 'none')
    $('#crearMesa2').css('pointer-events', 'none')
    $('#crearMesa3').css('pointer-events', 'none')
    $("#puntos").change(function () {
        largoTotal = 0
        var a = true;
        if (guardar) {
            Swal.fire({
                title: `Hay cambios sin guardar en ${puntoActualN}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Salir sin guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    guardar = false
                    $('#crearMesa1').css('pointer-events', '')
                    $('#crearMesa2').css('pointer-events', '')
                    $('#crearMesa3').css('pointer-events', '')
                    var val = $(this).find("option:selected").val();
                    var nombre = $(this).find("option:selected").text();
                    /* console.log(val) */
                    puntoActual = val
                    puntoActualN = nombre
                    obtenerMesas(val)
                } else {
                    a = false;
                    $(this).val(puntoActual);

                }
            })
        }
        else {
            $('#crearMesa1').css('pointer-events', '')
            $('#crearMesa2').css('pointer-events', '')
            $('#crearMesa3').css('pointer-events', '')
            var val = $(this).find("option:selected").val();
            var nombre = $(this).find("option:selected").text();
            /* console.log(val) */
            puntoActual = val
            puntoActualN = nombre
            obtenerMesas(val)
        }


    });
    $("#salir").click(function () {
        if (guardar) {
            Swal.fire({
                title: 'Hay cambios sin guardar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Salir sin guardar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/Admin.html";
                }
            })
        } else {
            window.location.href = "/Admin.html";
        }


    })

})

function obtenerMesas(punto) {
    var lugar = document.getElementById('fondoMesasAdmin')
    lugar.innerHTML = `<div style='
    color:white;
    text-align:center;font-size:600px' id='actualizando' class='text-light' role='status'>
    <div class="lds-hourglass"></div>
</div>
  
    </div>`;
    $.ajax({
        url: '../PHP/consultaMesas.php',
        type: 'POST',
        dataType: 'html',
        data: {
            punto: punto,
        },

    })
        .done(function (respuesta) {

            data = JSON.parse(respuesta);
            /* console.log(data) */
            pintadoMesas(data);
        })
        .fail(function () {
        });
};
var imagenSelectorHeight = $('#fondoMesasAdmin').height();
var imagenSelectorWidth = $('#fondoMesasAdmin').width();

function pintadoMesas(data) {
    var lugar = document.getElementById('fondoMesasAdmin')
    lugar.innerHTML = ``;
    for (let i = 0; i < data.length; i++) {
        var variable = data[i][0];
        if (parseInt(variable) > largoTotal) {
            largoTotal = variable;

        }
        var y = data[i][1];
        var x = data[i][2];
        var x1 = parseFloat(x);
        var y1 = parseFloat(y);
        var tipo = data[i][3];

        if (data[i][3] != 'PLANTA') {

            var imagen = `<img id='${tipo}_${variable}' 
            class='mesasBOX' 
            onClick="BorrarMesa(${tipo}_${variable} )"  
            style='width:9.6%;height: 15%; position:absolute;   
            left:${x}px; top:${y}px' 
            src='images_mesas/${tipo}_BLANCO_0.gif'>
                <h1 
                id='txt${tipo}_${variable}'
                style='pointer-events:none;width:9.6%;height: 15%; position:absolute;   
                left:${x1 + 45}px; top:${y1 + 30}px'>${variable}
                </h1>
            </img>`
            var lugar = document.getElementById('fondoMesasAdmin')
            lugar.innerHTML += imagen;
        }

    }
    cargarBOX();

}

function BorrarMesa(variable) {

    
    Swal.fire({
        width: 120,
        confirmButtonColor: '#d33',
        confirmButtonText: '<i style="padding: 10px 10px; font-size: 40px" class="fas fa-trash-alt"></i>'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Eliminado',


            )
            if($('#'+variable.id).hasClass('new')){
                guardar = true;
                $('#' + variable.id).remove();


            }else{
                
                guardar = true;
                $('#' + variable.id).addClass('borrado')
                $('#' + variable.id).css('display', 'none')
                $('#txt' + variable.id).css('display', 'none')
    
            }
            
        }
    })


}



function crearMesa(tipo) {
    guardar = true;
    /* console.log(tipo) */
    var imagen =
        `<img  
        id='${tipo}_${(parseInt(largoTotal) + 1)}' 
        class='mesasBOX new'  
        onClick="BorrarMesa(${tipo}_${(parseInt(largoTotal) + 1)})"  
        style='width: 9.6%; height: 15%; ;position:absolute;  left:12px; top:4px' 
        src='images_mesas/${tipo}_BLANCO_0.gif'>
        <h1 
        id='txt${tipo}_${(parseInt(largoTotal) + 1)}'
        style='pointer-events:none;width:9.6%;height: 15%; position:absolute;   
        left:57px; top:34px'>${(parseInt(largoTotal) + 1)}
        </h1>
        </img>`
    var lugar = document.getElementById('fondoMesasAdmin')
    lugar.innerHTML += imagen;
    largoTotal = parseInt(largoTotal) + 1;
    cargarBOX();

}

function cargarBOX() {

    var box2 = document.querySelectorAll('.mesasBOX')
    var Xinicial = [box2.length];
    var Yinicial = [box2.length];
    for (let i = 0; i < box2.length; i++) {
        Xinicial[i] = 0;
        Yinicial[i] = 0;
        /* console.log(box2[i].id); */
        Xinicial[i] = parseFloat((box2[i].style.left).replace('px', ''))
        Yinicial[i] = parseFloat((box2[i].style.top).replace('px', ''))

        box2[i].addEventListener('touchmove', function (e) {
            guardar = true;
            var touchLocation = e.targetTouches[0];
            box2[i].style.left = touchLocation.pageX - 90 + 'px';
            box2[i].style.top = touchLocation.pageY - 170 + 'px';
            $('#txt' + box2[i].id).css('top', `${parseFloat(box2[i].style.top.split("px")[0]) + 30}px`)
            $('#txt' + box2[i].id).css('left', `${parseFloat(box2[i].style.left.split("px")[0]) + 45}px`)

        })



        box2[i].addEventListener('touchend', function (e) {

            var x = parseFloat(box2[i].style.left);
            var y = parseFloat(box2[i].style.top);

            if (x > 1185 || y > 635 || y < 10 || x < 10) {

                box2[i].style.left = Xinicial[i] + 'px';
                box2[i].style.top = Yinicial[i] + 'px';
            }
            else {
                Xinicial[i] = parseFloat((box2[i].style.left).replace('px', ''))
                Yinicial[i] = parseFloat((box2[i].style.top).replace('px', ''))
            }
            $('#txt' + box2[i].id).css('top', `${parseFloat(box2[i].style.top.split("px")[0]) + 30}px`)
            $('#txt' + box2[i].id).css('left', `${parseFloat(box2[i].style.left.split("px")[0]) + 45}px`)

        })

    }


}


function guardarData() {
    var box2 = document.querySelectorAll('.mesasBOX')
    data = []

    box2.forEach(function (item) {
        var NEW = false;
        var borrado = false;
        var id = item.id;

        if ($('#' + id).hasClass('new')) {
            NEW = true;
        }
        if ($('#' + id).hasClass('borrado')) {
            borrado = true;
        }

        var x = item.style.top;
        var y = item.style.left;

        y = (y.replace('px', ''));
        x = (x.replace('px', ''));
        var forma = id.split('_')[0];
        var Mesa = id.split('_')[1];


        var objeto = {
            forma: forma,
            x: x,
            y: y,
            Mesa: Mesa,
            Punto: puntoActual,
            new: NEW,
            borrado: borrado
        }
        data.push(objeto);
    })

    $.ajax({
        url: './PHP/pushMesas.php',
        type: 'POST',
        dataType: 'html',
        data: {
            data1: data
        }

    })
        .done(function (resultado) {
            guardar = false;
            Swal.fire({
                icon: 'success',
                title: 'Mesas guardadas correctamente',
                showConfirmButton: false,
                timer: 1500
            })
            /* console.log(resultado) */

        })
        .fail(function () {
            /* console.log("Error: Not user found") */
        });

}













