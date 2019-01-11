@extends('layout.admin')

<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.superadmin')
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
                    <h6 class="breadcrumb">Super Administrador Pagos de anuncios</h6>
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
                                        <h3>Super Administrador</h3>
                                        <p style="font-weight:bold; font-size:1em;">
                                            En esta sección podra agregar y administrar los pagos de anuncios, crearlos y actualizarlos en un instante.
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
                    <div class="panel-title col-md-6">Listado Pagos de anuncios</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.pagosanuncios.create', $title = '+ Nuevo Pago', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearconjunto'])!!}
                    </div>
                    <div class="pull-left" style="80%">
                    {!!Form::open(['action'=>'PagosAnunciosController@buscarpagos','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
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
                        <th style="width: auto;">Pautante</th>
                        <th style="width: auto;">Tipo de publicidad</th>
                        <th style="width: auto;">Referencia</th>
                        <th style="width: auto;">Total</th>
                        <th style="width: auto;">Tipo de pago</th>
                        <th style="width: auto;">Estado</th>
                        <th style="width: auto;">Correo electrónico</th>
                        <th style="width: auto;">Utilizado</th>
                        <th>Acciones</th>
                    </thead>
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
                    <tbody>
                        <td class="v-align-middle">{{$pago->nombres}} {{$pago->apellidos}}</td> 
                        <td class="v-align-middle">{{$tipo_publicidad}}</td>
                        <td class="v-align-middle">{{$pago->reference}}</td>
                        <td class="v-align-middle">{{$pago->total}} USD</td>
                        <td class="v-align-middle">{{$tipo_pago}}</td>
                        <td class="v-align-middle">{{$payment_status}}</td>
                        <td class="v-align-middle">{{$pago->buyer_email}}</td>

                        <td class="v-align-middle"><?= $pago->utilizado == 1?'Utilizado':'NO Utilizado'?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li>
                                        {!!link_to_route('superadmin.pagosanuncios.edit', $title = 'Editar', $parameters = $pago->id, $attributes = ['role'=>'menu-item'])!!}
                                    </li>
                                    <li>
                                        <a href="javascript:;" onclick="ver_detalles_anuncios({{$pago->id}})" role="menu-item">Ver detalles</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" onclick="delete_pago({{$pago->id}})" role="menu-item">Eliminar</a>
                                        <form action="{{ route('superadmin.pagosanuncios.destroy',$pago->id) }}" id="delete_{{$pago->id}}" method="POST">
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