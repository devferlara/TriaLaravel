@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
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
      <h1 class="breadcrumb">Administrador de Usuarios</h1>
    </div>


    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/conjuntos">
              <i class="iconsmind-Dollar-Sign2" style="font-size: 90px; margin-right: 15px;"></i>
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
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra ver sus pagos de membresia.</p>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Listado de Usuarios Plataforma</h3>
            </div>

            <div class="col-md-6">
              {!!Form::open(['action'=>'PagosMembresiasController@buscarpagos','method'=>'GET' , 'class'=>'navbar-form estilos_buscador_zonas', 'role'=>'search'])!!}
              <div class="form-group" style="margin: 0">
                {!!Form::text ('pago', null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Buscar pagos','required' => true])!!}
                <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>

              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
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
                    <a class="btn btn-secondary btn-xs mb-1" href="javascript:;" onclick="ver_detalles_memb({{$pago->id}})" role="menu-item">Ver detalles</a>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
{!!Html::script('build/assets/js/init.js')!!}
    {!!Html::script('build/assets/js/datatables.js')!!}
    {!!Html::script('build/assets/js/script/pagos.js')!!}
@stop
