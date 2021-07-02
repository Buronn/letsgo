
var data;
var largoTotal = 0;

function obtenerMesas() {
    var punto  = 'BAR'
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
            console.log(data)
            pintadoMesas(data);
        })
        .fail(function () {
        });
};
var imagenSelectorHeight = $('#fondoMesasAdmin').height();
var imagenSelectorWidth = $('#fondoMesasAdmin').width();

function pintadoMesas( data ){
    var lugar = document.getElementById('fondoMesasAdmin')
    lugar.innerHTML = '';
    for(let i = 0 ; i < data.length ; i++){
            var variable = data[i][0];
            if(parseInt(variable) > largoTotal){
                largoTotal = variable;

            }
            var y = data[i][1];
            var x = data[i][2];
            var tipo = data[i][3];
            
        if(data[i][3] != 'PLANTA'){
            
            var imagen = `<img id='${tipo}_${variable}' class='mesasBOX' onClick="BorrarMesa(${tipo}_${variable} )"  style='width:9.6%;height: 15%; position:absolute;   left:${x}px; top:${y}px' src='images_mesas/${tipo}_BLANCO_0.gif'></img>`
            var lugar = document.getElementById('fondoMesasAdmin')
            lugar.innerHTML += imagen;
        }

    }
    cargarBOX();
    
}

function BorrarMesa( variable ){
   

    Swal.fire({
    width: 120,
    confirmButtonColor: '#d33',
    confirmButtonText: '<i style="padding: 10px 10px; font-size: 40px" class="fas fa-trash-alt"></i>'
  }).then((result) => {
    if (result.isConfirmed) {
        Swal.fire({
            title: 'Estás seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText : 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Eliminado',
                

              )
              $('#' + variable.id).addClass('borrado')
              $('#' + variable.id).css('display', 'none')
            }
          })
    }
  })


}



function crearMesa( tipo ){
    
   console.log(parseInt(largoTotal) + 1)
    var imagen = `<img  id='${tipo}_${(parseInt(largoTotal) + 1)}' class='mesasBOX new'  onClick="BorrarMesa(${tipo}_${(parseInt(largoTotal) + 1)} + "" )"  style='width: 9.6%; height: 15%; ;position:absolute;  left:12px; top:4px' src='images_mesas/${tipo}_BLANCO_0.gif'></img>`
    var lugar = document.getElementById('fondoMesasAdmin')
    lugar.innerHTML += imagen;
    largoTotal = parseInt(largoTotal) + 1;
    cargarBOX();
    
}

function cargarBOX(){
    
    var box2 = document.querySelectorAll('.mesasBOX')
    var Xinicial = [box2.length];
    var Yinicial = [box2.length];
    for(let i = 0 ; i < box2.length  ; i++){
        Xinicial[i] = 0;
        Yinicial[i] = 0;
        console.log(box2[i].id);
        Xinicial[i] = parseFloat((box2[i].style.left).replace('px', ''))
        Yinicial[i] =  parseFloat((box2[i].style.top).replace('px', '')) 
        
        box2[i].addEventListener('touchmove', function(e) {
       
            var touchLocation = e.targetTouches[0];
            box2[i].style.left = touchLocation.pageX - 90 + 'px';
            box2[i].style.top = touchLocation.pageY - 80 + 'px';
            
        })
          
          
          
          box2[i].addEventListener('touchend', function(e) {
          
            var x = parseFloat(box2[i].style.left);
            var y = parseFloat(box2[i].style.top);
            
            if(x > 1185 || y > 635 || y < 10 || x < 10){
            
                box2[i].style.left = Xinicial[i] + 'px';
                box2[i].style.top =  Yinicial[i] + 'px';
            }
            else {
                Xinicial[i] = parseFloat((box2[i].style.left).replace('px', '')) 
                Yinicial[i] =  parseFloat((box2[i].style.top).replace('px', '')) 
            }
            
          })

    }
   

}
    

function guardarData(){
    var box2 = document.querySelectorAll('.mesasBOX')
    data = []

    box2.forEach(function(item){
        var NEW = false;
        var borrado = false;
        var id = item.id;

        if($('#' + id).hasClass('new')){
            NEW = true;
        }
        if($('#' + id).hasClass('borrado')){
            borrado = true;
        }

        var x = item.style.top;
        var y = item.style.left;
        
        y = (y.replace('px',''));
        x = (x.replace('px',''));
        var forma =  id.split('_')[0];
        var Mesa = id.split('_')[1];
        
        
        var objeto = {
            forma : forma,
            x : x,
            y : y,
            Mesa : Mesa,
            Punto: 'BAR',
            new: NEW,
            borrado : borrado
        }
        data.push(objeto);
    })

    $.ajax({
        url: './PHP/pushMesas.php',
        type: 'POST',
        dataType: 'html',
        data: {
            data1 : data
        }

    })
        .done(function (resultado) {
            
            Swal.fire({
                icon: 'success',
                title: 'Mesas guardadas correctamente',
                showConfirmButton: false,
                timer: 1500
              })
            console.log(resultado)

        })
        .fail(function () {
            console.log("Error: Not user found")
        });
   
}


   

  


   


    
    
  
  