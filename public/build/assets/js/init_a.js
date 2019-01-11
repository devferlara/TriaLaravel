$(document).ready(function() {

    // Initializes search overlay plugin.
    // Replace onSearchSubmit() and onKeyEnter() with
    // your logic to perform a search and display results

    //Conjuntos Script JS

    $('#respuesta-form').submit(function(event) {

        var formData = {
            'mensaje-id'              : $('input[name=mensaje-id]').val(),
            'respuesta_mensaje'       : $("#summernote").val()
        };

        $.ajax({
            type        : 'POST',
            url         : 'mensajes/responder',
            data        : formData,
            dataType    : 'json',
            encode          : true
        }).done(function(data) {

            $("#modal-accept").modal('show');
            $( ".content-respuesta-data" ).empty();
            $(".content-respuesta-data").fadeIn();

            $.each(data, function(idx, obj) {
                $(".content-respuesta-data").append("<div class='answer-msj'><div class='date-response'>"+obj.created_at+"</div>"+obj.mensaje+"</div>");

            });
            $("#summernote").val("");
            $(".note-editable").html("");


        });

        event.preventDefault();
    });



    $('.btn-close').click(function() {
        $('#modal-accept').modal('hide');
    });

    $('#nuevo-apartamento').click(function() {
        $('#modal-nuevo-apartamento').modal('show');
    });

    $('#nuevo-usuario').click(function() {
        $('#modal-nuevo-usuario').modal('show');
    });


    $('#show-modal-zona').click(function() {
        $('#modal-nueva-zona').modal('show');
    });


    $('#zona_select').change(function() {

        var zona = $(this).val();
        $('#apartamento_select').empty();
        var select = document.getElementById('apartamento_select');
        $.get( 'apartamentos/listar/'+zona,
            function(data) {

                var list = $('#apartamento_select');
                $.each(data, function(idx, obj) {

                    var option = new Option(obj.apartamento, obj.id);
                    select.add(option);

                });

            })
            .done(function() {

            })
            .fail(function() {
            })
            .always(function() {

            });

    });



    $('.actualizar-conjunto').click(function() {
        var conjunto = $(this).attr("data-value");
        $.get( 'conjuntos/editar/'+conjunto,

            function(data) {
                $('#u_nit').val(data.nit)
                $('#u_tipo').val(data.tipo)
                $('#u_nombre').val(data.nombre)
                $('#u_pais').val(data.pais)
                $('#u_ciudad').val(data.ciudad)
                $('#u_localidad').val(data.localidad)
                $('#u_barrio').val(data.barrio)
                $('#u_direccion').val(data.direccion)
                $('#u_telefono').val(data.telefono)
                $('#u_estrato').val(data.estrato)
                $('#u_horario_administracion').val(data.horario_administracion)
                $('#u_telefono_cuadrante').val(data.telefono_cuadrante)
                $('#u_latitud').val(data.map_latitud)
                $('#u_longitud').val(data.map_longitud)
                $('#u_longitud').val(data.map_longitud)
                $('#actualizar-c').val(conjunto);
            })
            .done(function() {
                $('#actualizarConjunto').modal('show');
            })
            .fail(function() {
            })
            .always(function() {

            });
    });



    $('.eliminar-conjunto').click(function() {
        $('#eliminarConjunto').modal('show');
        $('#value-c').val($(this).attr("data-value"));
    });



    $('.c-a-e-conjunto').click(function() {
        $('#eliminarConjunto').modal('hide');
    });



    $('#btn-create-admin').click(function() {
        $('#modal-nuevo-administrador').modal('show');
    });
    $('.eliminar-administrador').click(function() {
        $('#eliminarAdministrador').modal('show');
        $('#value-a').val($(this).attr("data-value"));
    });

    $('.eliminar-apartamento').click(function() {
        $('#eliminarApartamento').modal('show');
        $('#value-c').val($(this).attr("data-value"));
    });




});


function actualizarApartamento(apartamento){
    $.get( 'apartamentos/editar/'+apartamento,
        function(data) {
            $('#u_apartamento').val(data.apartamento)
            $('#u_descripcion').val(data.descripcion)
            $('#actualizar-apto').val(apartamento);
        })
        .done(function() {
            $('#modal-actualizar-apartamento').modal('show');
        })
        .fail(function() {
        })
        .always(function() {

        });
}
function actualizarUnidad(unidad){
    $.get( 'zonas/editar/'+unidad,
        function(data) {
            $('#u_value').val(data.value)
            $('#actualizar-u').val(unidad);
        })
        .done(function() {
            $('#modal-actualizar-zona').modal('show');
        })
        .fail(function() {
        })
        .always(function() {

        });
}
function actualizarusuario(usuario){

    $('#modal-actualizar-usuario').modal('show');

    var id = usuario;
    $.get( 'usuarios/listar/'+id,

        function(data) {

            $('#user_active').val(id)
            $('#u_identificacion').val(data.identificacion)
            $('#u_nombres').val(data.nombres)
            $('#u_apellidos').val(data.apellidos)
            $('#u_fecha_nacimiento').val(data.fecha_nacimiento)
            $('#u_email').val(data.email)
            $('#u_telefono').val(data.telefono)
            $('#u_celular').val(data.celular)
            $('#u_username').val(data.username)
        })
        .done(function() {
            $('#modal-actualizar-usuario').modal('show');
        })
        .fail(function() {
        })
        .always(function() {

        })

}


function eliminarApartamento(apartamento){
    $('#value-delete').val(apartamento);
    $('#eliminarApartamento').modal('show');
}
function eliminarUnidad(unidad){
    $('#eliminarUnidad').modal('show');
    $('#value-c').val(unidad);
}
function eliminarUsuario(usuario){
    $('#eliminarUsuario').modal('show');
    $('#value-c').val(usuario);
}


