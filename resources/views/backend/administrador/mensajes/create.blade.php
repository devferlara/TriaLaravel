@extends('layout.mensajes')


@section('sidebar')
@include('backend.menu.administrador')
@stop

@section('head')
@include('layout.head')
@stop


@section ('content')

<div class="container-fluid">
  <div class="row app-row" >
    @include ('errors.errors')
    @include ('errors.request')
    @include ('errors.success')
    <div class="col-12 chat-app bloques_mensajeria">
      <div class="row">

        <div class="col-md-12 fondo_blanco_mensajeria" style="padding-top: 40px; padding-bottom:40px">
          {!!Form::open(['route'=>'administrador.mensajes.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="form-inline">
            <div class="col-md-12 form-group">
              {!!Form::label('enviar_a', 'Enviar a:' , ['class'=>'form-label'])!!}
              <select class="form-control select2-multiple" multiple="multiple" multiple="multiple" style="width:100%" name="enviar_a[]">

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
              <select  class="form-control select2-multiple" multiple="multiple" class="full-width" data-init-plugin="select2" id="importancia" name="importancia" style="width: 100%">
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
            <div class="col-md-12 " style="margin-top:10px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('asunto', 'Asunto', ['class'=>'form-label'])!!}
                {!!Form::text ('asunto', null, ['class'=>'form-control', 'placeholder'=>'Asunto de tu publicación', 'style'=>'width:100%'])!!}
              </div>
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
            <input type="file" multiple="true" name="adjuntos[]" id="adjuntos" /> 
          </div>
          <div class="form-inline">
            <div class="col-md-12 form-group" style="margin-top:10px;">   
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('administrador.mensajes.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
            </div>  
          </div> 
          {!!Form::close()!!} 
        </div>
      </div>
      <div class="col-md-6 form-group"></div>
    </div>
  </div>
</div>


<div class="app-menu">
  <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
    <li class="nav-item text-center" style="width: 100%">
      <a class="nav-link active" id="first-tab" data-toggle="tab" href="#firstFull" role="tab"
      aria-selected="true">Mensajes</a>
    </li>
  </ul>

  <div class="p-4">

    <div class="tab-content link_mensajeria">
      <div class="tab-pane fade show active" id="firstFull" role="tabpanel" aria-labelledby="first-tab">

        <div class="scroll">
          <a href="/mensajes/create" class="btn btn-danger mb-1 boton_crear_mensaje">Crear mensaje</a>
          <h5>NAVEGACION</h5>
          <ul>
            <li><a href="{{ url('administrador/mensajes') }}">Recibidos </a><span class="label label-danger label-as-badge pull-right" id="badges" style="color:white;"></span></li>
            <li>
              <a href="{{ url('administrador/mensajes') }}">Todos</a>
              <ul>
                <li>
                  <a href="{{ url('administrador/importantes') }}">Importante</a>
                </li>
                <li>
                  <a href="{{ url('administrador/relevantes') }}">Relevante</a>
                </li>
                <li>
                  <a href="{{ url('administrador/normales') }}">Normal</a>
                </li>
              </ul>
            </li>
            <li><a href="{{ url('administrador/enviados') }}">Enviados</a></li>
          </ul>    
        </div>
      </div>
    </div>
  </div>

  <a class="app-menu-button d-inline-block d-xl-none" href="#">
    <i class="simple-icon-refresh"></i>
  </a>
</div>

<br>
<br>



@stop

@section('footer')
@include('layout.footer')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
{!!Html::script('build/assets/plugins/multiple-select/multiple-select.js')!!}
{!!Html::script('build/assets/js/script/mensajes.js')!!}
@stop
