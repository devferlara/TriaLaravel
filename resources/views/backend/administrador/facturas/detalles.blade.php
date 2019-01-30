@extends('layout.mensajes')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.administrador')
@stop

@section('head')
@include('layout.head')
@stop

@section('css')

<style>
.table thead tr th, .table tbody tr td {
  text-align: center;
}
</style>

@stop

@section('content') 


<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <h3>Listado de facturas <span style="font-weight: bold">{{$recibos->name}}</span></h3>
            </div>

            <div class="col-md-4">
              <form>
                <div class="form-group has-float-label mb-4">
                  <label class= "text-primary" style="font-weight:bold">Busqueda:</label> 
                  <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                </div>
              </form>
            </div>

            <div class="col-md-4">
              {!!link_to_route('administrador.facturas.index', $title = 'Volver a recibos', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
              {!!link_to_route('administrador.facturas.crearfactura', $title = '+ Crear factura', $parameters = $recibos->id, $attributes = ['class'=>'btn btn-primary'])!!}
            </div>

          </div>

          
          
        </div>
      </div>
    </div>



    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos" id="datos">
              <thead>
                <tr>
                  <th style="width: auto;">Nombre propietario</th>
                  <th style="width: auto;">Valor adeudado</th>
                  <th style="width: auto;">Fecha de corte</th>
                  <th style="width: auto;">Fecha creación</th>
                  <th style="width: auto;">Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($facturas as $factura)

                <?php 

                $date = date_create($factura->created_at);

                $formato_creacion = date_format($date, 'd-m-Y');

                $date = date_create($factura->fecha_corte);

                $formato_corte = date_format($date, 'd-m-Y');

                $estado = '<span style="color:orange">Por pagar</span>';

                if($factura->estado == 2)
                { 
                  $estado = '<span style="color:green">pagado</span>';
                }

                if($factura->estado == 3)
                { 
                  $estado = '<span style="color:red">Anulado</span>';
                }
                ?>

                <td class="v-align-middle">{{$factura->nombre_propietaria}}</td>
                <td class="v-align-middle">{{$factura->valor_adeudado}} USD</td>
                <td class="v-align-middle">{{$formato_corte}}</td>
                <td class="v-align-middle">{{$formato_creacion}}</td>
                <td class="v-align-middle"><?php echo $estado?></td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                      <li>
                        <a href="javascript:;" onclick="ver_detalles({{$factura->id}})" role="menu-item">Ver detalles</a>
                      </li>
                      <li>
                        {!!link_to_route('administrador.facturas.editfactura', $title = 'Editar', $parameters = $factura->id , $attributes = ['role'=>'menu-item'])!!}
                      </li>
                      <li>
                        <a href="javascript:;" onclick="delete_f({{ $factura->id }})" role="menu-item">Eliminar</a>
                        <form action="{{ route('administrador.facturas.destroyfactura',$factura->id) }}" id="delete_{{$factura->id}}" method="POST">
                          <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                          {{ method_field('DELETE')}}
                        </form>
                      </li>
                    </ul>
                  </div>
                </td>

                @endforeach
              </tbody>
            </table>

          </div>

        </div>
      </div>
    </div>


  </div>
</div>





<div class="modal fade" id="eliminar_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Eliminar factura</h4>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar esta factura?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn_delete" onclick="" class="btn btn-primary">Eliminar factura</button>
      </div>
    </div>
  </div>
</div>




@stop

@section ('footer')
@include('layout.footer')
{!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop


<script>
  function ver_detalles(id)
  {
    var url = "{{ action('FacturasController@getDetalles') }}";

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

          if(data.datos[0].estado == 2)
          { 
            estado = '<span style="color:green">pagado</span>';
          }

          if(data.datos[0].estado == 3)
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

  function change(id)
  {
    $('#id_change').val(id);
    $('#change_modal').modal('show');
  }

</script>

<script>
  function delete_f(id)
  {
    $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
    $('#eliminar_modal').modal('show');
  }
</script>