$(document).ready(function () {


    $.ajax({

        type: "GET",
        url: "./PHP/Admin/getUsers.php",
        success: function (results) {
            console.log("ALO")

            console.log(results)
            data = JSON.parse(results);
            console.log(data);

            var table = $('#dataTable').DataTable({
                data: data,
                "columnDefs": [{
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<a class='remove'><i class='fas fa-user-minus' style='text-allign: center'></i></a>"
                }],
                columns: [
                    { title: "Nombre" },
                    { title: "Numero Usuario" },
                    { title: "Admin" },
                    { title: " " }

                ],
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                    "info": "Mostrando usuarios del _START_ al _END_ de un total de _TOTAL_",
                    "infoEmpty": "Mostrando usuarios del 0 al 0 de un total de 0",
                    "infoPostFix": "",
                    "infoFiltered": "(filtrado de un total de _MAX_ usuarios)",
                    "loadingRecords": "Cargando...",
                    "lengthMenu": "Mostrar _MENU_ usuarios",
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
                        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
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
            });
            $('#dataTable tbody').on('click', 'a', function () {

                console.log("ALO");
                var data = table.row($(this).parents('tr')).data();
                console.log(data[1]);
                if (data[2] == 'N') {
                    console.log(data);
                        Swal.fire({
                            title: `Está a punto de eliminar a ${data[0]}. ¿Continuar?`,
                            showCancelButton: true,
                            confirmButtonText: `Borrar`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                table.row($(this).parents('tr')).remove().draw();
                                $.ajax({

                                    type: "POST",
                                    url: "./PHP/Admin/deleteUser.php",
                                    dataType: 'json',
                                    data: { id: parseInt(data[1]) },
                                    success: function () {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Usuario borrado correctamente',
                                            showConfirmButton: false,
                                            timer: 1000
                                        })

                                    },
                                    error: function () {
                                        alert("fail");
                                        console.log('ajax call error');

                                    }

                                });
                            } else{
                                Swal.fire('Operación cancelada', '', 'info')
                            }
                        })
                    
                }


                else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Este usuario no puede ser eliminado, consulte con la persona a cargo',
                        showConfirmButton: true,

                    }, 2000);
                }
            });

        },
        error: function (results) {
            alert("fail");
            console.log('ajax call error');

        }
    });




});