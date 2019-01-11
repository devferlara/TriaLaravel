@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.administrador')
@endsection
        <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@endsection

@section ('content')
<div class="page-content-wrapper">
    <div class="content">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')          
        <div class="col-md-1"></div>

            <div class="panel-group col-md-10">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Cargar</span> Facturación</h3>
                        </br>
                        <h5 class="text-info">Por medio de este módulo podrás cargar la facturación por conjunto residencial</h5>
                    </div>
                    <div class="panel panel-body" style="padding:20px;">
                        {!!Form::open(['route'=>'administrador.recibosdepago.store','method'=>'POST', 'files'=>'true'])!!}
                            
                            <div class="form-group" style="margin-top:10px;" id="cargarecibos">
                                {!!Form::label('archivo','Archivo de Facturación', ['class'=>'form-label'])!!}
                                {!!Form::file('archivo', ['class'=>'btn btn-success'])!!}
                            </div>
                            <div class="form-group">
                                {!!Form::submit('Cargar Facturación', ['class'=>'btn btn-primary'])!!}
                                {!!link_to_route('administrador.recibosdepago.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>                  
    </div>
</div>
@stop

@section ('footer')
    @include ('layout.footer')
@stop
