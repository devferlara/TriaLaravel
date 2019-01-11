@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
@stop
    
<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
    @include('layout.head')
@stop

@section('css')
    {!!Html::style('build/assets/plugins/multiple-select/multiple-select.css')!!}
@stop

@section ('content')
<div class="page-content-wrapper full-height">
    <div class="content full-height">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 
<div class="email-wrapper">
    <nav class="email-sidebar padding-40">
        <p class="menu-title" style="padding-top">NAVEGACIÓN</p>
        <ul class="main-menu">
            <li class="active">
                <a href="{{ url('administrador/mensajes') }}">
                    <span class="title"><i class="pg-inbox"></i> Recibidos</span>
                    <span class="label label-danger label-as-badge pull-right" id="badges" style="color:white;"></span>
                </a>
            </li>
            <li class="">
                <a href="{{ url('administrador/mensajes') }}">
                    <span class="title"><i class="pg-folder"></i> Todos</span>
                </a>
                <ul class="sub-menu no-padding">
                    <li>
                        <a href="{{ url('administrador/importantes') }}">
                            <span class="title">Importante</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administrador/relevantes') }}">
                            <span class="title">Relevante</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('administrador/normales') }}">
                            <span class="title">Normales</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ url('administrador/enviados') }}">
                    <span class="title"><i class="pg-sent"></i>Enviados</span>
                </a>
            </li>
        </ul>
    </nav>

<div class="email-composer container-fluid">
    <div class="row">
        <div class="col-sm-12 no-padding">
            <div class="col-md-12" style="margin-top:20px;">
                {!!Form::open(['route'=>'administrador.mensajes.store','method'=>'POST', 'files'=>'true'])!!}
                    <div class="form-inline">
                        <div class="col-md-12 form-group">
                            {!!Form::label('enviar_a', 'Enviar a:' , ['class'=>'form-label'])!!}
                            <select multiple="multiple" style="width:80%" name="enviar_a[]">

                                 <optgroup label="Zonas">                              
                                @foreach($zonas as $zona)
                                    <option style="font-family:verdana;"value="zona_{{$zona->id}}">{{$zona->zona}} {{$zona->tipo}}</option>
                                @endforeach
                                </optgroup>

                                <optgroup label="Apartamentos">                              
                                @foreach($usuarios as $usuario)
                                    <option style="font-family:verdana;"value="{{$usuario->id}}">{{$usuario->nombres}} {{$usuario->apellidos}} -
                                        Apartamento: {{$usuario->apartamento}} Zona: {{$usuario->zona}}</option>
                                @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="col-md-12 form-group" style="margin-top:10px;">
                        {!!Form::label('importancia', 'Importancia', ['class'=>'form-label'])!!}
                            <select class="full-width" data-init-plugin="select2" id="importancia" name="importancia">
                                <optgroup label="Seleccione el tipo de Importancia">
                                    <option value="Importante">Importante</option>
                                    <option value="Urgente">Urgente</option>
                                    <option value="Relevante">Relevante</option>
                                    <option value="Normal">Normal</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="col-md-12 form-group" style="margin-top:10px;">
                            {!!Form::label('asunto', 'Asunto', ['class'=>'form-label'])!!}
                            {!!Form::text ('asunto', null, ['class'=>'form-control', 'placeholder'=>'Asunto de tu publicación', 'style'=>'width:100%'])!!}
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="col-md-12" style="margin-top:10px;">
                            <textarea class="ckeditor" name="mensaje" id="mensaje" rows="10" cols="80"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4 form-group" style="text-align:left; margin-top:10px;">
                        {!!Form::label('enabled','Adjuntar archivos', ['class'=>'form-label'])!!}
                        <input id="adjuntar" type="checkbox" name="adjuntar" value="1" />
                    </div>
                    <div class="col-md-8 form-group" style="margin-top:10px;" id="attach">
                        {!!Form::label('adjuntos', 'Archivos Adjuntos:  Máximo 5 archivos y un total de 20MB:', ['class'=>'form-label'])!!}
                        <input type="file" multiple="true" name="adjuntos[]" id="adjuntos" class="btn btn-success"/> 
                    </div>
                    <div class="form-inline">
                        <div class="col-md-12 form-group" style="margin-top:10px;">   
                        {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
                        {!!link_to_route('administrador.mensajes.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                        </div>  
                    </div>  
                </div>
            </div>
                <div class="col-md-6 form-group"></div>
                {!!Form::close()!!}
        </div>
    </div>
</div>
</div>
</div>

@stop

@section('footer')
    @include('layout.footer')
@stop

@section('js_library')
    {!!Html::script('vendor/ckeditor/ckeditor.js')!!}
    {!!Html::script('build/assets/plugins/multiple-select/multiple-select.js')!!}
@stop

@section('specific_js')
    {!!Html::script('build/assets/js/script/mensajes.js')!!}
@stop