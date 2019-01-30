@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.pautante')
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
    <div class="col-md-12">
      <h1 class="breadcrumb">Ver Pagos de anuncios</h1>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="panel-body text-center">
            <a href="/superadmin/conjuntos">
              <i class="iconsmind-Dollar-Sign2" style="font-size:120px;"></i>
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
          <h3>Pautante</h3>
          <p style="color:#000; font-weight:bold; font-size:1em;">En esta sección podra ver los pagos de sus anuncios.</p>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <div class="row">
            <div class="col-md-6 ">
              <h3>Listado Pagos de anuncios</h3>
            </div>

            <div class="col-md-6">
              {!!Form::open(['action'=>'PagosAnunciosController@buscarpagos','method'=>'GET' , 'class'=>'estilos_buscador_zonas', 'role'=>'search'])!!}
              <div>
                {!!Form::text ('pago', null, ['class'=>'form-control input_buscador_zonas', 'placeholder'=>'Buscar pagos','required' => true])!!}
                <button type="submit" class="btn btn-primary"><i class="iconsmind-Magnifi-Glass2"></i></button>
                {!!Form::close()!!}
              </div>
            </div>
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
                  <th style="width: auto;">Tipo de publicidad</th>
                  <th style="width: auto;">Referencia</th>
                  <th style="width: auto;">Total</th>
                  <th style="width: auto;">Tipo de pago</th>
                  <th style="width: auto;">Estado</th>
                  <th style="width: auto;">Correo electrónico</th>
                  <th style="width: auto;">Utilizado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pagos as $pago)

                <?php 
                $tipo_publicidad = 'Bono de descuento';

                if($pago->publicidad_tipo == 2){ $tipo_publicidad = 'Club de mascotas';}
                if($pago->publicidad_tipo == 3){ $tipo_publicidad = 'Club de motor';}

                $payment_status = 'APROBADO';

                if($pago->payment_status != 'APPROVED'){ $tipo_publicidad = 'Pendiente';}

                $tipo_pago = 'PAYU';

                if($pago->tipo_pago == 2){ $tipo_pago = 'Manual';}

                ?>
                <tr>
                  <td class="v-align-middle">{{$tipo_publicidad}}</td>
                  <td class="v-align-middle">{{$pago->reference}}</td>
                  <td class="v-align-middle">{{$pago->total}} USD</td>
                  <td class="v-align-middle">{{$tipo_pago}}</td>
                  <td class="v-align-middle">{{$payment_status}}</td>
                  <td class="v-align-middle">{{$pago->buyer_email}}</td>

                  <td class="v-align-middle"><?= $pago->utilizado == 1?'Utilizado':'NO Utilizado'?></td>
                  <td>
                    <a class="btn btn-success btn-xs mb-1" href="javascript:;" onclick="ver_detalles_anuncios({{$pago->id}})" role="menu-item">Ver detalles</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <h6 style="font-weight:bold"> Total de Pagos Registrados: {!!$pagos->total()!!}</h6>       
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="detalles_modal">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="eliminar_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Eliminar Pago de anuncio</h4>
      </div>
      <div class="modal-body">
        <p>¿Está seguro que desea eliminar este pago de anuncio?</p>
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

