$(document).ready(function(){
    
        $.ajax({

            type: "GET",
            url: "./PHP/Admin/getUsers.php",         
    
            

            success: function (results) {
                console.log("ALO")
                
                console.log(results)
                data = JSON.parse(results);
                console.log(data);
                
                var table = $('#dataTable').DataTable( {
                    data: data,
                    "columnDefs": [ {
                        "targets": -1,
                        "data": null,
                        "defaultContent": "<a ><i class='fas fa-user-minus' style='text-allign: center'></i></a>"
                    } ],
                    columns: [
                        {title : "Nombre"},
                        {title : "Numero Usuario"},
                        {title : "Admin"},
                        {title : " "}
                                
                        ],
                    "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoPostFix": "",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "loadingRecords": "Cargando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "searchPlaceholder": "Término de búsqueda",
                    "zeroRecords": "No se encontraron resultados",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "aria": {
                        "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    //only works for built-in buttons, not for custom buttons
                    "buttons": {
                        "create": "Nuevo",
                        "edit": "Cambiar",
                        "remove": "Borrar",
                        "copy": "Copiar",
                        "csv": "fichero CSV",
                        "excel": "tabla Excel",
                        "pdf": "documento PDF",
                        "print": "Imprimir",
                        "colvis": "Visibilidad columnas",
                        "collection": "Colección",
                        "upload": "Seleccione fichero...."
                    },
                    "select": {
                        "rows": {
                            _: '%d filas seleccionadas',
                            0: 'clic fila para seleccionar',
                            1: 'una fila seleccionada'
                        }
                    }
                }           
                } );
                $('#dataTable tbody').on( 'click', 'a', function () {
                
                    console.log("ALO");
                    var data = table.row( $(this).parents('tr') ).data();
                    console.log(data[1]);
                    if(data[2]=='N'){
                        $.ajax({
                
                            type: "POST",
                            url: "./PHP/Admin/deleteUser.php",     
                            dataType: 'json',
                            data: {id : parseInt(data[1])},
                            success : function(data){                
                                console.log(data);
                                if(data == true){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Usuario Eliminado',
                                        showConfirmButton: true,
                        
                                    }, 2000);                   
                                }
                                
                                
                                
                            },
                            error: function (data) {       
                            alert("fail");
                            console.log('ajax call error');    
                    
                            }  
                
                        });
                        table.rows( $(this).parents('tr') ).invalidate().draw();
                    }
                    else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Este usuario es administrador, no puede ser eliminado',
                            showConfirmButton: true,
            
                        }, 2000);  
                    }
                } );
                
            },        
            error: function (results) {       
                alert("fail");
                console.log('ajax call error');    

            }  
        });
    
    
    
    
});