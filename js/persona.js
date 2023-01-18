$(document).ready(function () {

    $("#frmAddPersona").submit(function (evt) {
        evt.preventDefault();

        $.ajax({
            url: "add_persona.php",
            type: "post",
            dataType: "json",
            data: $("#frmAddPersona").serialize(),
            success: function (respuesta) {
                if (respuesta == "registrado" ) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Persona registrada satisfactoriamente',
                        showConfirmButton: false,
                        timer: 1600
                    })
                    setTimeout(() => {
                        location.href = 'index.php';
                    }, 1650);
                } else if( respuesta == "ya existe" ) {
                    Swal.fire({
                        icon: "error",
                        title: "Una persona con esa identificación ya existe",
                        showConfirmButton: false,
                        timer: 1600,
                    });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error al registrar",
                        showConfirmButton: false,
                        timer: 1600,
                    });
                }
            },
            error: function (controlador, mensaje) {
                Swal.fire({
                    icon: "error",
                    title: "Petición no procesada " + mensaje,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    });

    $("#frmModPersona").submit(function (evt) {
        evt.preventDefault();

        $.ajax({
            url: "mod_persona2.php",
            type: "post",
            dataType: "json",
            data: $("#frmModPersona").serialize(),
            success: function (respuesta) {
                if (respuesta == "modificado" ) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Persona modificada satisfactoriamente',
                        showConfirmButton: false,
                        timer: 1600
                    })
                    setTimeout(() => {
                        location.href = 'index.php';
                    }, 1650);
                } else if( respuesta == "ya existe" ) {
                    Swal.fire({
                        icon: "error",
                        title: "Una persona con esa identificación ya existe",
                        showConfirmButton: false,
                        timer: 1600,
                    });
                }else{
                    Swal.fire({
                        icon: "error",
                        title: "Error al modificar",
                        showConfirmButton: false,
                        timer: 1600,
                    });
                }
            },
            error: function (controlador, mensaje) {
                Swal.fire({
                    icon: "error",
                    title: "Petición no procesada " + mensaje,
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    });
});

function cancelar(){
    $("#frmAddPersona")[0].reset();
}

function añadir(){
    var modalAdd = new bootstrap.Modal(document.getElementById('modalAdd'), {
        backdrop: false,
        keyboard: false
    })
    modalAdd.show();
}

function editar(id){
    var modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'), {
        backdrop: false,
        keyboard: false
    })
    modalEdit.show();
    $.ajax({
        url: "mod_persona1.php",
        type: "post",
        data: { "id_persona": id },
        success: function (datos) {
            $("#divres").html(datos);
        },
        error: function (controlador, mensaje) {
            $("#divres").html("Error<br>Petición no procesada<br>" + mensaje);
        }
    });
}

function eliminar(id){
    Swal.fire({
        title: '¿Está seguro de eliminar una persona?',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        denyButtonText: `Eliminar`,
    }).then((result) => {
       
        if (result.isDenied) {
            $.ajax({
                url: "del_persona.php",
                type: "post",
                data: {"id_persona": id},
                success: function (respuesta) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Persona eliminada satisfactoriamente',
                        showConfirmButton: false,
                        timer: 1600
                    })
                    setTimeout(() => {
                        location.href = 'index.php';
                    }, 1650);
                },
                error: function (controlador, mensaje){
                    Swal.fire({
                        icon: "error",
                        title: "Petición no procesada, no se pudo eliminar" + mensaje,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            });
        }
    });
}
