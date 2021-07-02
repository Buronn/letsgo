$(document).ready(function(){

    

      $('#addGarzon').on('click', function () {
        const name = document.getElementById("name").value; 
        const pass1 = document.getElementById("pass1").value; 
        const pass2 = document.getElementById("pass2").value; 
        const mail = document.getElementById("mail").value;
        var admin;
        if ($("#inlineRadio1").is(':checked')) {
            admin = 'Y';
        }
        else{
            admin = 'N';
        }

        console.log(name, pass1, mail);
        console.log("ALOOOO");
        if( pass1 == pass2){
            $.ajax
            ({                
                type: "POST",
                url: "./PHP/add_garzon.php",
                dataType: 'html',
                                       
                data: {
                    name: name,
                    pass: pass1,
                    mail : mail,
                    admin : admin
                },
                
                success: function(respuesta){  
                    Swal.fire({
                        icon: 'success',
                        title: 'Usuario Agregado',
                        showConfirmButton: true,
        
                    }, 2000); 
                },
                error: function(textStatus, errorThrown) {
                     
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                }   
            })
        }
        else{
            $("#alerta").html("<div class=\"alert alert-warning\" role=\"alert\"> Paswwords no coincidentes</div>");
        }
    });  
});