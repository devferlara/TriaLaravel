@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
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
        @include ('errors.success')
        @include ('errors.request')
        @include ('errors.errors')
        <div class="jumbotron" data-pages="parallax">
            <div class="container-fluid container-fixed-lg">
                <div class="inner">
                    <h6 class="breadcrumb">Super Administrador de Usuarios</h6>
                    <div class="container-md-height m-b-20">
                        <div class="row row-md-height">
                            <div class="col-lg-6 col-md-6 col-md-height col-middle bg-white">
                                <div class="full-height">
                                    <div class="panel-body text-center">
                                        <a href="/superadmin/usuarios">
                                            <i class="fa fa-user" style="font-size:120px;"></i>
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
                                        <pre class="bg-success" style="color:white; font-weight:bold; font-size:1em;">En esta sección podra agregar usuarios de tipo administradores o residentes y actualizar cualquier información.</pre>
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
                    <div class="panel-title col-md-6">Listado de Usuarios Tria Group</div>
                    <div class="col-md-2 pull-right">
                        {!!link_to_route('superadmin.usuarios.create', $title = '+ Nuevo Usuario', $parameters = null, $attributes = ['class'=>'btn btn-primary','data-target'=>'#crearusuario'])!!}
                    </div>
                    <div class="pull-left" style="80%">
                    {!!Form::open(['action'=>'UsuarioController@buscar','method'=>'GET' , 'class'=>'navbar-form', 'role'=>'search'])!!}
                    <div class="form-group">
                    {!!Form::text ('nombres', null, ['class'=>'form-control', 'placeholder'=>'Buscar Usuarios'])!!}
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    {!!Form::close()!!}
                    </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class= "info">
                    <th style="width: auto;">Identificación</th>
                    <th style="width: auto;">Nombres</th>
                    <th style="width: auto;">Apellidos</th>
                    <th style="width: auto;">Username</th> 
                    <th style="width: auto;">Rol</th>
                    <th style="width: auto;">Email</th>
                    <th style="width: auto;">Telefono</th>
                    <th style="width: auto;">Celular</th>
                    <th style="width: auto;">Documentos</th>
                    <th>Acciones</th>
                </thead> 
                @foreach ($usuarios as $usuario)
                <tbody>
                    <td class="v-align-middle">{{$usuario->identificacion}}</td>
                    <td class="v-align-middle">{{$usuario->nombres}}</td>
                    <td class="v-align-middle">{{$usuario->apellidos}}</td>
                    <td class="v-align-middle">{{$usuario->username}}</td>
                    <td class="v-align-middle">{{$usuario->rol}}</td>
                    <td class="v-align-middle">{{$usuario->email}}</td>
                    <td class="v-align-middle">{{$usuario->telefono}}</td>
                    <td class="v-align-middle">{{$usuario->celular}}</td>
                    <td class="v-align-middle"><a href="#" target="_blank">{{$usuario->documento}}</a>
			{{--*/ 
				if($usuario->documento!=""){ echo "<br> <a href='?docId=".$usuario->documentoId."' >borrar documento</a>";}
			/*--}}		
		    </td>
                    <td>
                    @if($usuario->active == 0)
                    {!!link_to_action('UsuarioController@activatesuper', $title = 'activar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-success'])!!}
                    @else
                    {!!link_to_action('UsuarioController@desactivatesuper', $title = 'desactivar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-warning'])!!} 
                    @endif
                    {!!link_to_route('superadmin.usuarios.edit', $title = 'Editar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-info'])!!} 
                    {!!link_to_action('UsuarioController@deletesuper', $title = 'Eliminar', $parameters = $usuario->id, $attributes = ['class'=>'btn btn-danger'])!!}
                    </td>
                @endforeach
                </tbody>
            </table>
            {!!$usuarios->render()!!}
            </div>
            <h6 style="font-weight:bold"> Total de Usuarios Registrados en sistema: {{$usuarios->total()}}</h6>
            <h6 style="font-weight:bold"> Total de Usuarios sin datos actualizados: {{$data= $noregistrados}}</h6>
            <h6 style="font-weight:bold"> Total de Usuarios con datos actualizados: {{$usuarios->total()-$noregistrados}}</h6>
            </div>
            </div>
        </div>
    </div>
</div>

@stop

@section ('footer')
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
    
@stop