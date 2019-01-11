@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.usuario')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section('css')

<style>
    .anuncio-btn{
        margin: 0 auto;
        display: -webkit-box;
        border-radius: 5px !important;
        width: 50%;
        margin-top: 23px;
        text-align: center;
    }
    #img-profile{
        width: 50%;
        margin: 0 auto;
        display: block;
        margin-bottom: 30px;
    }
    .card.share.col1 {
        margin-right: 16px;
    }
    .social-wrapper .social .jumbotron {
        height: 35vh;
    }
    .table thead tr th, .table tbody tr td {
        text-align: center;
    }
</style>
@stop

@section('content')
<!-- START PAGE CONTENT WRAPPER -->
<div class="page-content-wrapper">
    <!-- START PAGE CONTENT -->

    <div class="content">

        <div class="social-wrapper">
            <div class="social " data-pages="social">
                <!-- START JUMBOTRON -->
                <div class="jumbotron" data-pages="parallax" data-social="cover">
                    <div class="cover-photo">
                        <img alt="Cover photo" src="{{ asset('uploads/banners/bannerfacturas.png') }}" />
                    </div>
                    <div class="container-fluid container-fixed-lg sm-p-l-20 sm-p-r-20">
                        <div class="inner">
                            <div class="pull-bottom bottom-left m-b-40">
                                <h5 class="text-white no-margin">Conjunto Residencial: </h5>
                                <h1 class="text-white no-margin"><span class="semi-bold">Recibos de Pago Administración</span></h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid container-fixed-lg">
            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title col-md-6">
                        Lista de recibos de pago <br><br>
                        @if(count($banco) > 0)
                        nombre del banco: <b style="color: #000;">{{$banco[0]->nombre}}</b> <br><br>
                        Link del banco: <a href="{{$banco[0]->link}}" target="_blank" style="color: #076c9a;">{{$banco[0]->link}}</a><br><br>

                        @endif
                    </div>
                    
                <div class="pull-left" style="80%">
                    <div class="form-group">
                    <form>
                    <h6 class= "text-primary" style="font-weight:bold">Busqueda:</h6> 
                    <input id="buscar" type="text" onkeyup="busqueda()" class="form-control" style="width:100%;" placeholder="Escriba aquí el valor a buscar" />
                    </form>
                    </div>

                    </div>
                    @if(count($banco) > 0)
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-primary" type="button" onclick="$('#detalles_banco_modal').modal('show')">Ver detalles del banco</button>
                    </div>
                     @endif
                    <div class="clearfix"></div>
                </div>
                <!-- Pegar el panel body -->
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="datos">
                    <thead class="info">
                        <th style="width: auto;">Valor adeudado</th>
                        <th style="width: auto;">Fecha de corte</th>
                        <th style="width: auto;">Fecha de creación</th>
                        <th style="width: auto;">Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>

                    @foreach($recibos as $recibo)

                    <?php 

                        $date = date_create($recibo->created_at);

                        $formato_creacion = date_format($date, 'd/m/Y');

                        $date = date_create($recibo->fecha_corte);

                        $formato_corte = date_format($date, 'd/m/Y');

                        $estado = '<span style="color:orange">Por pagar</span>';

                        if($recibo->estado == 2)
                        { 
                            $estado = '<span style="color:green">pagado</span>';
                        }

                        if($recibo->estado == 3)
                        { 
                            $estado = '<span style="color:red">Anulado</span>';
                        }
                    ?>

                        <td class="v-align-middle">{{ $recibo->valor_adeudado }} USD</td>
                        <td class="v-align-middle">{{ $formato_corte }}</td>
                        <td class="v-align-middle">{{ $formato_creacion }}</td>
                        <td class="v-align-middle"><?php echo $estado ?></td>
                       
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Acciones
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">

                                    <li>
                                        <a href="javascript:;" onclick="ver_detalles({{$recibo->id}})" role="menu-item">Ver detalles</a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </td>

                    @endforeach

                    </tbody>
                </table>
               
            </div>
                <!-- END CONTAINER FLUID -->
            </div>
            <!-- /container -->
        </div>

    </div>
</div>

@stop

@section('footer')
    @include ('layout.footer')
@stop


@section('js_library')

{!!Html::script('build/assets/plugins/imagesloaded/imagesloaded.pkgd.min.js')!!}
{!!Html::script('build/assets/plugins/jquery-isotope/isotope.pkgd.min.js')!!}
{!!Html::script('build/assets/plugins/classie/classie.js')!!}
{!!Html::script('build/assets/plugins/codrops-stepsform/js/stepsForm.js')!!}
<!--[if lte IE 9]>
<script src="{{ asset('build/assets/plugins/jquery-isotope/isotope.pkgd.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('build/assets/plugins/jquery-isotope/masonry-horizontal.js') }}" type="text/javascript"></script>
<![endif]-->
@stop

@section('specific_js')

{!!Html::script('build/pages/js/pages.social.min.js')!!}

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

@if(count($banco) > 0)

<div class="modal fade" id="detalles_banco_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Detalles del banco</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-bordered">
                    
                    <tr>
                        <td>Logotipo</td>
                        <td><img src="uploads/bancos/{{$banco[0]->img_banco}}" alt="" style="width:150px;height:auto"></td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td>{{$banco[0]->nombre}}</td>
                    </tr>
                    <tr>
                        <td>País</td>
                        <td>{{$banco[0]->pais}}</td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td><a href="{{$banco[0]->link}}" target="_blank" style="color: #076c9a;">{{$banco[0]->link}}</a></td>
                    </tr>
                    <tr>
                        <td>Número de cuenta</td>
                        <td>{{$banco[0]->No_cuenta}}</td>
                    </tr>
                    <tr>
                        <td>Número de convenio</td>
                        <td>{{$banco[0]->No_convenio}}</td>
                    </tr>
                    <tr>
                        <td>Tipo de cuenta</td>
                        <td>{{$banco[0]->tipo_cuenta}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endif