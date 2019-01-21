@extends('layout.admin')

@section('sidebar')
@include('backend.menu.superadmin')
@stop

@section('head')
@include ('layout.head')
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
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')
    <div class="col-md-12">
      <h1 class="breadcrumb">Super Administrador Pagos de membresias</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/conjuntos">
              <i class="simple-icon-badge" style="font-size:120px;"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-height col-md-6 col-top">
      <div class="panel panel-transparent">
        <div class="panel-heading">
          <div class="panel-title">Bienvenido(a) {{ Auth::user()->nombres }}</div>
        </div>
        <div class="panel-body">
          <h3>Super Administrador</h3>
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra mantener informada a su comunidad, mediante publicaciones y noticias que permitan COMUNICAR a los residentes de su conjunto.</p>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-4 ">
              <h3>Listado Pagos de membresias</h3>
            </div>

            <div class="col-md-4" style="80%">
              {!!Form::open(['action'=>'PagosMembresiasController@buscarpagos','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
              <div class="form-group has-float-label mb-4" style="margin:0 !important">
                <label class= "text-primary" style="font-weight:bold">Busqueda:</label>
                {!!Form::text ('pago', null, ['class'=>'form-control', 'placeholder'=>'Buscar pagos','required' => true])!!}
                {!!Form::close()!!}
              </div>
            </div>
            <div class="col-md-4 text-right">
              {!!link_to_route('superadmin.pagosmembresias.create', $title = '+ Nuevo Pago', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearconjunto'])!!}
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="table-responsive">
            <table class="data-table responsive nowrap tabla_bonos_estilos">
              <thead>
                <tr>
                  <th style="width: auto;">Administrador</th>
                  <th style="width: auto;">Conjunto</th>
                  <th style="width: auto;">Referencia</th>
                  <th style="width: auto;">Total</th>
                  <th style="width: auto;">Tipo de pago</th>
                  <th style="width: auto;">Estado</th>
                  <th style="width: auto;">Fecha de inicio</th>
                  <th style="width: auto;">Fecha de fin</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pagos as $pago)

                <?php 
                $payment_status = 'APROBADO';

                if($pago->payment_status != 'APPROVED'){ $payment_status = 'PENDIENTE';}

                $tipo_pago = 'PAYU';

                if($pago->tipo_pago == 2){ $tipo_pago = 'Manual';}

                ?>
                <tr>
                  <td class="v-align-middle">{{$pago->nombres}} {{$pago->apellidos}}</td> 
                  <td class="v-align-middle">{{$pago->nombre}}</td>
                  <td class="v-align-middle">{{$pago->reference}}</td>
                  <td class="v-align-middle">{{$pago->total}} USD</td>
                  <td class="v-align-middle">{{$tipo_pago}}</td>
                  <td class="v-align-middle">{{$payment_status}}</td>
                  <td class="v-align-middle"><?=  date("d/m/Y", strtotime($pago->fecha_inicio))?></td>
                  <td class="v-align-middle"><?=  date("d/m/Y", strtotime($pago->fecha_fin))?></td>
                  <td>

                    {!!link_to_route('superadmin.pagosmembresias.edit', $title = 'Editar', $parameters = $pago->id, $attributes = ['role'=>'menu-item', 'class'=>'btn btn-secondary btn-xs mb-1'])!!}

                    <a href="javascript:;" onclick="ver_detalles_memb({{$pago->id}})" role="menu-item" class="btn btn-success btn-xs mb-1">Ver detalles</a>

                    <a href="javascript:;" onclick="delete_pago({{$pago->id}})" role="menu-item" class="btn btn-danger btn-xs mb-1">Eliminar</a>

                    <form action="{{ route('superadmin.pagosanuncios.destroy',$pago->id) }}" id="delete_{{$pago->id}}" method="POST">
                      <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                      {{ method_field('DELETE')}}
                    </form>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {!!$pagos->render()!!}
          </div>
          <h6 style="font-weight:bold"> Total de Pagos Registrados: {!!$pagos->total()!!}</h6>
        </div>
      </div>
    </div>


  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="detalles_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalles del pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered" id="detallesTable">
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal" tabindex="-1" role="dialog" id="eliminar_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar Pago de membresia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar este pago de membresia?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn_delete" onclick="" class="btn btn-primary">Eliminar pago</button>
      </div>
    </div>
  </div>
</div>

<script>



  function delete_pago(id)
  {
    $('#btn_delete').attr('onclick','$("#delete_'+id+'").submit()');
    $('#eliminar_modal').modal('show');
  }

</script>

@stop

@section('footer')
@include ('layout.footer')
@stop


@section('js_library')

{!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
{!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
{!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop

@section('specific_js')

{!!Html::script('build/assets/js/init.js')!!}
{!!Html::script('build/assets/js/datatables.js')!!}
{!!Html::script('build/assets/js/script/pagos.js')!!}

@stop