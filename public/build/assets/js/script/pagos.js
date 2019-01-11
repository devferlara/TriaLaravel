function ver_detalles_memb(id)
{
    var url = "/pagosmembresias/getDetalles";

    parametros = { 'id': id };
            
    $.ajax({
        type: 'POST',
        url:url,
        data:parametros,

        success: function (data) {

            if(data.res == 'success')
            {
                $('#detallesTable').html('');

                var estado = '<span style="color:red">'+data.datos[0].payment_status+'</span>';

                if(data.datos[0].payment_status == 'APPROVED')
                {
                    estado = '<span style="color:gren">APROBADO</span>';
                }

                if(data.datos[0].payment_status == 'Pending')
                { 
                    estado = '<span style="color:orange">Pendiente</span>';
                }

                if(data.datos[0].estado == 'Vencido')
                { 
                    estado = '<span style="color:red">Vencido</span>';
                }

                var tipo_pago = 'Metodo PAYU';

                if(data.datos[0].tipo_pago == 2)
                {
                    tipo_pago = 'PAGO MANUAL';
                }

                var html = '';

                html += '<tr><td>Id del pago</td><td>'+data.datos[0].id+'</td></tr>';
                html += '<tr><td>Administrador</td><td>'+data.datos[0].nombres+' '+data.datos[0].apellidos+'</td></tr>';
                html += '<tr><td>Conjunto</td><td>'+data.datos[0].nombre+'</td></tr>';
                html += '<tr><td>Referencia del pago</td><td>'+data.datos[0].reference+'</td></tr>';
                html += '<tr><td>Total</td><td>'+data.datos[0].total+' USD</td></tr>';
                html += '<tr><td>Mensaje</td><td>'+data.datos[0].mensaje+'</td></tr>';
                html += '<tr><td>ID de la transacción</td><td>'+data.datos[0].transaction_id+'</td></tr>';
                html += '<tr><td>Método de pago</td><td>'+data.datos[0].payment_method+'</td></tr>';
                html += '<tr><td>E-mail del comprador</td><td>'+data.datos[0].buyer_email+'</td></tr>';
                html += '<tr><td>Estado del pago</td><td>'+estado+'</td></tr>';
                html += '<tr><td>Fecha de inicio</td><td>'+data.datos[0].fecha_inicio+'</td></tr>';
                html += '<tr><td>Fecha de finalización</td><td>'+data.datos[0].fecha_fin+'</td></tr>';
                html += '<tr><td>Fecha de creación</td><td>'+data.datos[0].created_at+'</td></tr>';
                html += '<tr><td>Tipo de pago</td><td>'+tipo_pago+'</td></tr>';
                


                $('#detallesTable').html(html);

                $('#detalles_modal').modal('show');
            }
        },
        error: function( jqXHR, textStatus, errorThrown ) {
            alert('Ha ocurrido un error');
        }
    })
}

function ver_detalles_anuncios(id)
    {
        var url = "/pagosanuncios/getDetalles";;

        parametros = { 'id': id };
                
        $.ajax({
            type: 'POST',
            url:url,
            data:parametros,

            success: function (data) {

                if(data.res == 'success')
                {
                    $('#detallesTable').html('');

                    var estado = '<span style="color:red">'+data.datos[0].payment_status+'</span>';

                    if(data.datos[0].payment_status == 'APPROVED')
                    {
                        estado = '<span style="color:gren">APROBADO</span>';
                    }

                    if(data.datos[0].payment_status == 'Pending')
                    { 
                        estado = '<span style="color:orange">Pendiente</span>';
                    }

                    if(data.datos[0].estado == 'Vencido')
                    { 
                        estado = '<span style="color:red">Vencido</span>';
                    }

                    var tipo_publicidad = 'Bono de descuento';

                    if(data.datos[0].publicidad_tipo == 2)
                    {
                        tipo_publicidad = 'Club Mascotas';
                    }

                    if(data.datos[0].publicidad_tipo == 3)
                    {
                        tipo_publicidad = 'Club Motores';
                    }

                    var utilizado = 'Si';

                    if(data.datos[0].utilizado == 0)
                    {
                        utilizado = 'No';
                    }

                    var tipo_pago = 'Metodo PAYU';

                    if(data.datos[0].tipo_pago == 2)
                    {
                        tipo_pago = 'PAGO MANUAL';
                    }

                    var html = '';

                    html += '<tr><td>Id del pago</td><td>'+data.datos[0].id+'</td></tr>';
                    html += '<tr><td>Pautante</td><td>'+data.datos[0].nombres+' '+data.datos[0].apellidos+'</td></tr>';
                    html += '<tr><td>Tipo de publicidad</td><td>'+tipo_publicidad+'</td></tr>';
                    html += '<tr><td>Referencia del pago</td><td>'+data.datos[0].reference+'</td></tr>';
                    html += '<tr><td>Total</td><td>'+data.datos[0].total+' USD</td></tr>';
                    html += '<tr><td>Mensaje</td><td>'+data.datos[0].mensaje+'</td></tr>';
                    html += '<tr><td>ID de la transacción</td><td>'+data.datos[0].transaction_id+'</td></tr>';
                    html += '<tr><td>Método de pago</td><td>'+data.datos[0].payment_method+'</td></tr>';
                    html += '<tr><td>E-mail del comprador</td><td>'+data.datos[0].buyer_email+'</td></tr>';
                    html += '<tr><td>Estado del pago</td><td>'+estado+'</td></tr>';
                    html += '<tr><td>Fecha de creación</td><td>'+data.datos[0].created_at+'</td></tr>';
                    html += '<tr><td>Anuncio utilizado</td><td>'+utilizado+'</td></tr>';
                    html += '<tr><td>Tipo de pago</td><td>'+tipo_pago+'</td></tr>';
                    


                    $('#detallesTable').html(html);

                    $('#detalles_modal').modal('show');
                }
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                alert('Ha ocurrido un error');
            }
        })
    }