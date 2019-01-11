$(document).ready(function() {
    // Initializes search overlay plugin.
    // Replace onSearchSubmit() and onKeyEnter() with
    // your logic to perform a search and display results



    //Conjuntos Script JS
    $('#show-modal').click(function() {
        $('#nuevoConjunto').modal('show');
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




    //Close Forms Functions

    $('#close-modal-a-conjunto').click(function() {
        $('#actualizarConjunto').modal('hide');
    });





});


function actualizarAdministrador(val){
    $.get( 'administradores/editar/'+val,
        function(data) {

            $('#u_identificacion').val(data.identificacion)
            $('#u_nombres').val(data.nombres)
            $('#u_apellidos').val(data.apellidos)
            $('#u_fecha_nacimiento').val(data.fecha_nacimiento)
            $('#u_email').val(data.email)
            $('#u_telefono').val(data.telefono)
            $('#u_celular').val(data.celular)
            $('#u_username').val(data.username)
            $('#actualizar-a').val(val);

        })
        .done(function() {
            $('#actualizarAdministrador').modal('show');
        })
        .fail(function() {
        })
        .always(function() {

        });
}


function actualizarConjunto(val){
    $.get( 'conjuntos/editar/'+val,
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
            $('#actualizar-c').val(val);
        })
        .done(function() {
            $('#actualizarConjunto').modal('show');
        })
        .fail(function() {
        })
        .always(function() {

        });
}

function eliminarConjunto(val){
    $('#eliminarConjunto').modal('show');
    $('#value-c').val(val);
}


