
var contenedor = document.getElementById('contenedorIMG');

for(let i = 0 ; i < 10 ; i++){
    var fila ='';
    fila +=`<div  class='row'> `
    for(let j = 0 ; j < 10 ; j++){
        var col = ''
        col = `<div style='height: 70px' id='fila${i}-col${j}' class='col'> </div>`
        fila += col;

        if(j == 9){
            fila += '</div>'
        }
    }
    contenedor.innerHTML += fila;

}



var mesasCIR = [
    
]

var mesasCUA = [
    

]

var mesasREC = [
   

]


function crearMesa( tipo ){
    console.log(tipo);
    var variable = ''
    
    var mesasBOX = ''
    switch (tipo) {
        case 'CIR':
            var largo = mesasCIR.length;
            variable += largo;
            var objeto = {
                X:0,
                Y:0
            }
            mesasBOX = 'mesasBOX'
            mesasCIR.push(objeto)
            break;
    
         case 'CUA':
            var largo = mesasCUA.length;
            variable += largo;
            var objeto = {
               
                X:0,
                Y:0
            }
            mesasBOX = 'mesasBOX2'
            mesasCUA.push(objeto)
            break;
        case 'REC':
            var largo = mesasREC.length;
            variable += largo;
            var objeto = {
                X:0,
                Y:0
            }
            mesasBOX = 'mesasBOX1'
            mesasREC.push(objeto)
            break;
    }


    totalImagen = '';
    var imagen = `<img  class='${tipo}${variable} ${mesasBOX}' style='width: 9.6%;height: 15%;;position:absolute;  ' src='images_mesas/${tipo}_BLANCO_0.gif'></img>`
    var lugar = document.getElementById("fila0-col0");
    totalImagen += imagen;
    lugar.innerHTML += totalImagen;
    cargarBOX();
    
}

function cargarBOX(){
    
    var box = document.querySelectorAll('.mesasBOX')
    var box1 = document.querySelectorAll('.mesasBOX1')
    var box2 = document.querySelectorAll('.mesasBOX2')
    console.log(box)
    console.log(box1)
    console.log(box2)
   

    for(let i = 0 ; i < mesasCIR.length  ; i++){
        box[i].addEventListener('touchmove', function(e) {
      
            var touchLocation = e.targetTouches[0];
            
            box[i].style.left = touchLocation.pageX - 60 + 'px';
            box[i].style.top = touchLocation.pageY - 60 + 'px';
          })
          
          
          
          box[i].addEventListener('touchend', function(e) {
          
            var x = parseInt(box[i].style.left);
            var y = parseInt(box[i].style.top);
          })

    }
    for(let i = 0 ; i < mesasCUA.length  ; i++){
       
        box2[i].addEventListener('touchmove', function(e) {
      
            var touchLocation = e.targetTouches[0];
            
            box2[i].style.left = touchLocation.pageX - 60 + 'px';
            box2[i].style.top = touchLocation.pageY - 60 + 'px';
          })
          
          
          
          box2[i].addEventListener('touchend', function(e) {
          
            var x = parseInt(box2[i].style.left);
            var y = parseInt(box2[i].style.top);
          })

    }
    for(let i = 0 ; i < mesasREC.length  ; i++){
        box1[i].addEventListener('touchmove', function(e) {
      
            var touchLocation = e.targetTouches[0];
            
            box1[i].style.left = touchLocation.pageX - 60 + 'px';
            box1[i].style.top = touchLocation.pageY - 60 + 'px';
          })
          
          
          
          box1[i].addEventListener('touchend', function(e) {
          
            var x = parseInt(box1[i].style.left);
            var y = parseInt(box1[i].style.top);
          })

    }

}
    
function cargaAlgoritmo(){
    
    
    var totalImagen = '';
    
    for(let i = 0; i < mesasCIR.length ; i++ ){
        totalImagen = '';
        var imagen = `<img class='CIR${i} mesasBOX' style='width: 9.6%;height: 15%;;position:absolute;  ' src='images_mesas/CIR_BLANCO_0.gif'></img>`
        var lugar = document.getElementById(`fila${mesasCIR[i].X}-col${mesasCIR[i].Y}`);
        totalImagen += imagen;
        lugar.innerHTML += totalImagen;
    }

    for(let i = 0; i < mesasREC.length ; i++ ){
        totalImagen = '';
        var imagen = `<img class='REC${i} mesasBOX1' style='width: 9.6%;height: 15%;;position:absolute;  ' src='images_mesas/REC_BLANCO_0.gif'></img>`
        var lugar = document.getElementById(`fila${mesasREC[i].X}-col${mesasREC[i].Y}`);
        totalImagen += imagen;
        lugar.innerHTML += totalImagen;
    }
    for(let i = 0; i < mesasCUA.length ; i++ ){
        totalImagen = '';
        var imagen = `<img  class='CUA${i} mesasBOX2' style='width: 9.6%;height: 15%;;position:absolute;  ' src='images_mesas/CUA_BLANCO_0.gif'></img>`
        var lugar = document.getElementById(`fila${mesasCUA[i].X}-col${mesasCUA[i].Y}`);
        totalImagen += imagen;
        lugar.innerHTML += totalImagen;
    }

    
    cargarBOX();
    
}
cargaAlgoritmo();

function guardarData(){
    var box = document.querySelectorAll('.mesasBOX')
    var box1 = document.querySelectorAll('.mesasBOX1')
    var box2 = document.querySelectorAll('.mesasBOX2')

    data = []

    box.forEach(function(item){
        var id = item.classList[0];
        var X = item.style.top;
        var Y = item.style.left;
        console.log(X);
        console.log(Y);
        var objeto = {
            ID : id,
            X : X,
            Y : Y
        }
        data.push(objeto);
    })

    box1.forEach(function(item){
        var id = item.classList[0];
        var X = item.style.top;
        var Y = item.style.left;
        console.log(X);
        console.log(Y);
        var objeto = {
            ID : id,
            X : X,
            Y : Y
        }
        data.push(objeto);
    })

    box2.forEach(function(item){
        var id = item.classList[0];
        var X = item.style.top;
        var Y = item.style.left;
        console.log(X);
        console.log(Y);
        var objeto = {
            ID : id,
            X : X,
            Y : Y
        }
        data.push(objeto);
    })
    
    console.log(data)
}


   

  


   


    
    
  
  