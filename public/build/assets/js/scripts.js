(function($) {

    'use strict';

    $(document).ready(function() {

        $("#select_envio").change(function() {
            // Check input( $( this ).val() ) for validity here
            var data = $(this).val();
            if(data == "conjunto"){
                $("#conjunto").fadeIn();
                //Unselect
                $("#barrio").fadeOut();
                $("#localidad").fadeOut();
                $("#ciudad").fadeOut();
            }else if(data == "barrio"){
                $("#barrio").fadeIn();
                //Unselect
                $("#conjunto").fadeOut();
                $("#localidad").fadeOut();
                $("#ciudad").fadeOut();
            }else if(data == "localidad"){
                $("#localidad").fadeIn();
                //Unselect
                $("#barrio").fadeOut();
                $("#conjunto").fadeOut();
                $("#ciudad").fadeOut();
            }else if(data == "ciudad"){
                $("#ciudad").fadeIn();
                //Unselect
                $("#barrio").fadeOut();
                $("#conjunto").fadeOut();
                $("#localidad").fadeOut();
            }else{
                $("#barrio").fadeOut();
                $("#conjunto").fadeOut();
                $("#localidad").fadeOut();
                $("#ciudad").fadeOut();

            }
        });
        
    });

    
    $('.panel-collapse label').on('click', function(e){
        e.stopPropagation();
    })

    
})(window.jQuery);

function ver_detalles(id)
{
    var url = "/facturas/getDetalles";
    parametros = { 'id': id };
                
    $.ajax({
        type: 'POST',
        url:url,
        data:parametros,

        success: function (data) {
            if(data.res == 'success')
            {
                $('#detallesTable').html('');

                var estado = '<span style="color:orange">Por pagar</span>';

                if(data.datos[0].estado == 1)
                { 
                    estado = '<span style="color:green">pagado</span>';
                }

                if(data.datos[0].estado == 2)
                { 
                    estado = '<span style="color:red">Anulado</span>';
                }

                var html = '';

                html += '<tr><td>Id de la factura</td><td>'+data.datos[0].id+'</td></tr>';
                html += '<tr><td>Fecha de creación</td><td>'+data.datos[0].created_at+'</td></tr>';
                html += '<tr><td>Fecha de corte</td><td>'+data.datos[0].fecha_corte+'</td></tr>';
                html += '<tr><td>Nombre del propietario</td><td>'+data.datos[0].nombre_propietaria+'</td></tr>';
                html += '<tr><td>Valor adeudado</td><td>'+data.datos[0].valor_adeudado+' USD</td></tr>';
                html += '<tr><td>Apartamento</td><td>'+data.datos[0].descripcion+'</td></tr>';
                html += '<tr><td>Coeficiente del inmueble</td><td>'+data.datos[0].coeficiente_inmueble+'</td></tr>';
                html += '<tr><td>Concepto de pago</td><td>'+data.datos[0].concepto_pago+'</td></tr>';
                html += '<tr><td>Saldo mes anterior</td><td>'+data.datos[0].saldo_mes_anterior+' USD</td></tr>';
                html += '<tr><td>Saldo anterior</td><td>'+data.datos[0].saldo_anterior+' USD</td></tr>';
                html += '<tr><td>Nuevo saldo</td><td>'+data.datos[0].nuevo_saldo+' USD</td></tr>';
                html += '<tr><td>Total del mes</td><td>'+data.datos[0].total_mes+' USD</td></tr>';
                html += '<tr><td>Correo electrónico del conjunto</td><td>'+data.datos[0].correo_conjunto+'</td></tr>';
                html += '<tr><td>Estado</td><td>'+estado+'</td></tr>';


                $('#detallesTable').html(html);

                $('#detalles_modal').modal('show');
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            alert('Ha ocurrido un error');
        }
    })
}
