$(document).ready(function(){
    $.ajax({
        
        type: "GET",
        url: "./PHP/Admin/getClases.php",     
        
        
        success : function(data){
            
            data = JSON.parse(data);
            
            var sel = document.getElementById('clase');            
            
            for (let i = 0; i<data.length; i++) {
               
                $('#clase').append(`<option value="${data[i].Clase}">
                                       ${data[i].NClase}
                </option>`);
            };
        },
        error: function (data) {       
           alert("fail");
        console.log('ajax call error');    

        }  
    });
    $("#clase").change(function(){
        
        var sel = document.getElementById('grupo');
        sel.length = 0;
        $.ajax({
        
            type: "POST",
            url: "./PHP/Admin/getGrupos.php",     
            dataType: 'json',
            data: {clase : parseInt(document.getElementById('clase').value)},
            success : function(data){             
                
                
                
                for (let i = 0; i<data.length; i++) {
                    
                    $('#grupo').append(`<option value="${data[i].Grupo}">
                                           ${data[i].NGrupo}
                    </option>`);
                };
            },
            error: function (data) {       
               alert("fail");
            console.log('ajax call error');    
    
            }  
        });
    });

    $('#addProd').on('click', function () {
        $.ajax({
        
            type: "POST",
            url: "./PHP/Admin/addProd.php",     
            dataType: 'json',
            data: {clase : parseInt(document.getElementById('clase').value),
                   grupo : document.getElementById('grupo').value,
                   nombre : document.getElementById('nombre').value,
                   valor :  parseInt(document.getElementById('precio').value)},
            success : function(data){                
                console.log(data);
                if(data == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto Agregado',
                        showConfirmButton: true,
        
                    }, 2000);                   
                }
                
            },
            error: function (data) {       
               alert("fail");
            console.log('ajax call error');    
    
            }  

        });
    })
})           