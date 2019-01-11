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

<div class="page-content-wrapper">
    <div class="content">
        @include ('errors.errors')
        @include ('errors.request')
        @include ('errors.success')
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg">
                <div class="inner">
                    <h6 class="breadcrumb">Ver Pagos de membresia</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/superadmin/conjuntos">
                                            <i class="fa fa-building" style="font-size:120px;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-height col-md-6 col-top">
                                <div class="panel panel-transparent">
                                    <div class="panel-heading">
                                        <div class="panel-title">Bienvenido(a) {{ Auth::user()->nombres }}</div>
                                    </div>
                                    <div class="panel-body">
                                        <h3>Administrador</h3>
                                        <p style="font-weight:bold; font-size:1em;">
                                            En esta sección podra ver sus pagos de membresia.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">Listado Pagos de membresia</div>
                    <div class="col-md-2 pull-right">
                        
                    </div>
                    <div class="pull-left" style="80%">
                    {!!Form::open(['action'=>'PagosMembresiasController@buscarpagos','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                    <div class="form-group">
                    {!!Form::text ('pago', null, ['class'=>'form-control', 'placeholder'=>'Buscar pagos','required' => true])!!}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    {!!Form::close()!!}
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                    <thead class="info">
                        <th style="width: auto;">Administrador</th>
                        <th style="width: auto;">Conjunto</th>
                        <th style="width: auto;">Referencia</th>
                        <th style="width: auto;">Total</th>
                        <th style="width: auto;">Tipo de pago</th>
                        <th style="width: auto;">Estado</th>
                        <th style="width: auto;">Fecha de inicio</th>
                        <th style="width: auto;">Fecha de fin</th>
                        <th>Acciones</th>
                    </thead>
                    @foreach ($pagos as $pago)

                    <?php 
                    	$payment_status = 'APROBADO';

                        if($pago->payment_status != 'APPROVED'){ $payment_status = 'PENDIENTE';}

                        $tipo_pago = 'PAYU';

                        if($pago->tipo_pago == 2){ $tipo_pago = 'Manual';}

                    ?>
                    <tbody>
                        <td class="v-align-middle">{{$pago->nombres}} {{$pago->apellidos}}</td> 
                        <td class="v-align-middle">{{$pago->nombre}}</td>
                        <td class="v-align-middle">{{$pago->reference}}</td>
                        <td class="v-align-middle">{{$pago->total}} USD</td>
                        <td class="v-align-middle">{{$tipo_pago}}</td>
                        <td class="v-align-middle">{{$payment_status}}</td>
                        <td class="v-align-middle"><?=  date("d/m/Y", strtotime($pago->fecha_inicio))?></td>
                        <td class="v-align-middle"><?=  date("d/m/Y", strtotime($pago->fecha_fin))?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                   
                                    <li>
                                        <a href="javascript:;" onclick="ver_detalles_memb({{$pago->id}})" role="menu-item">Ver detalles</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </td>
                    </tbody>
                    @endforeach
                </table>
                {!!$pagos->render()!!}
            </div>
             <h6 style="font-weight:bold"> Total de Pagos Registrados: {!!$pagos->total()!!}</h6>       
            </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="detalles_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Detalles del pago</h4>
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
            <h4 class="modal-title">Eliminar Pago de membresia</h4>
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