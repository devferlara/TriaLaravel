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
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">

        <div class="content">
        @include ('errors.errors')
        @include ('errors.success')
        @include ('errors.request')

            <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado de facturas  <span style="color: #ef893f;">{{$recibos->name}}</span></div>
                    <div class="col-md-4 pull-right">
                        {!!link_to_route('administrador.facturas.index', $title = '<- Volver a recibos', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                        {!!link_to_route('administrador.facturas.crearfactura', $title = '+ Crear factura', $parameters = $recibos->id, $attributes = ['class'=>'btn btn-primary'])!!}
                    </div>
                <div class="pull-left" style="80%">

                    <div class="form-group">
                        <form>
                            <h6 class= "text-primary" style="font-weight:bold">Busqueda:</h6> 
                            <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                        </form>
                    </div>
                </div>
                    <div class="clearfix"></div>
                </div>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered" id="datos">
                <thead class="info">
                    <th style="width: auto;">Nombre propietario</th>
                    <th style="width: auto;">Valor adeudado</th>
                    <th style="width: auto;">Fecha de corte</th>
                    <th style="width: auto;">Fecha creación</th>
                    <th style="width: auto;">Estado</th>
                    <th>Acciones</th>
                </thead>
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
                <tbody>
                    <td class="v-align-middle">{{$factura->nombre_propietaria}}</td>
                    <td class="v-align-middle">{{$factura->valor_adeudado}} USD</td>
                    <td class="v-align-middle">{{$formato_corte}}</td>
                    <td class="v-align-middle">{{$formato_creacion}}</td>
                    <td class="v-align-middle"><?php echo $estado?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                            <span class="caret"></span></button>
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
                </tbody>
                @endforeach
            </table>
            
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
@stop

@section ('footer')
    @include('layout.footer')
@stop

@section('js_library')

@stop

@section('specific_js')
    {!!Html::script('build/assets/js/script/busqueda.js')!!}
@stop

<div class="modal fade" id="detalles_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Detalles de la factura</h4>
          </div>
          <div class="modal-body">
          <table class="table table-hover table-bordered" id="detallesTable">
          </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
   </div>

   <div class="modal fade" id="change_modal">
      <div class="modal-dialog">
        <form action="{{ action('FacturasController@changeStatus') }}" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Cambiar estado de la factura</h4>
          </div>
          <div class="modal-body">
            <select name="status" class="form-control" style="margin-top: 13px;height: 37px;">
                <option value="2">Pagado</option>
                <option value="1">Por pagar</option>
                <option value="3">Anulado</option>
            </select>
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
          </div>
          <input type="hidden" name="id" id="id_change">
          <input type="hidden" name="id_csv" value="{{$recibos->id}}">
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Cambiar estado</button>
          </div>
        </div>
        </form>
      </div>
   </div>

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

<script>
    function delete_f(id)
    {
        $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
        $('#eliminar_modal').modal('show');
    }
</script>