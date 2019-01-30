@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop


@section('content')

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')          
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Anuncio o Noticia</h3>
          <h4 class="text-info" style="text-align: center">Podrás crear todos las noticias de interés para tu comunidad, tales como: Información de la propiedad horizontal, reuniones y resultados de las mismas, etc... </h4>
          <br>
          {!!Form::open(['route'=>'superadmin.anuncios.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="col-md-12">
            <div class="form-group has-float-label mb-4">
              {!!Form::label('nombre', 'Titulo', ['class'=>'form-label'])!!}
              {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación'])!!}
            </div>
          </div>

          
          <div class="col-md-12">
            {!!Form::label('envio', 'Enviar a:' , ['class'=>'form-label'])!!}
            <select class="select2-multiple form-control " multiple="multiple" style="width:100%" name="envio[]">
              <optgroup label="Conjuntos">
                @foreach($conjuntos as $conjunto)
                <option style="font-family:verdana;"value="{{$conjunto->id}}">{{$conjunto->nombre}}</option>
                @endforeach
              </optgroup>
              <optgroup label="Barrios">
                @foreach($barrios as $barrio)
                <option value="{{$barrio->id}}">{{$barrio->barrio}}</option>
                @endforeach
              </optgroup>
              <optgroup label="Localidades">
                @foreach($localidades as $localidad)
                <option value="{{$localidad->id}}">{{$localidad->localidad}}</option>
                @endforeach
              </optgroup>
              <optgroup label="Ciudades">
                @foreach($ciudades as $ciudad)
                <option value="{{$ciudad->id}}">{{$ciudad->ciudad}}</option>
                @endforeach
              </optgroup>
            </select>
          </div>
          
          <div class="form-inline">
            <div class="col-md-6 form-group " style="text-align:left; margin-top:10px;">
              {!!Form::label('activar', 'Agregar Banner', ['class'=>'form-label'])!!}
              <div class="radio radio-success botones_radius_estilos" id="activar">
                <div class="display_inline_block_radio">
                  <input type="radio" value="si" name="activar" id="si">
                  <label for="si">SI</label>
                </div>
                <div class="display_inline_block_radio">
                  <input type="radio" value="si" name="activar" id="no">
                  <label for="no">NO</label>
                </div>
              </div>
            </div>

            <div class="col-md-6 form-group" style="margin-top:10px;" id="archivo">
              {!!Form::label('img_banner','Carga una imagen', ['class'=>'form-label'])!!}
              <div style="width: 100%">
                {!!Form::file('img_banner')!!}
              </div>
            </div>
          </div>

          <div class="form-inline">
            <div class="col-md-6" style="margin-top:20px;">
              <div class=" form-group has-float-label mb-4">
                {!!Form::label('categoria', 'Categoria-Anuncio', ['class'=>'form-label'])!!}
                <select class="full-width form-control" data-init-plugin="select2" id="categoria" name="categoria" style="width: 100%">
                  <optgroup label="Seleccione una Categoria">
                    <option value="Eventos">Eventos Sociales</option>
                    <option value="Info-general">Información General</option>
                    <option value="Mantenimientos">Mantenimientos</option>
                    <option value="Asambleas">Reuniones y Asambleas</option>
                    <option value="Responsabilidad">Responsabilidad Social</option>
                    <option value="Servicios">Servicios Públicos</option>
                    <option value="Seguridad">Seguridad</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-6" style="margin-top:20px;">
              <div class=" form-group has-float-label mb-4">
                {!!Form::label('valoracion', 'Importancia', ['class'=>'form-label'])!!}
                <select class="full-width form-control" data-init-plugin="select2" id="valoracion" name="valoracion" style="width: 100%">
                  <optgroup label="Seleccione el tipo de Importancia">
                    <option value="Importante">Importante</option>
                    <option value="Urgente">Urgente</option>
                    <option value="Relevante">Relevante</option>
                    <option value="Normal">Normal</option>
                  </optgroup>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12" style="margin-top:10px;">
            <textarea class="ckeditor" name="descripcion" id="descripcion" rows="10" cols="80"></textarea>
          </div>
          <div class="col-md-6 form-group" style="margin-top:20px;">
            {!!Form::label('enabled','Publicar', ['class'=>'form-label'])!!}
            {!!Form::checkbox('enabled', '1')!!}
            <div style="float:none;">
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('superadmin.anuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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

@section ('footer')
@include('layout.footer')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
<script>
   $("select").multipleSelect({
            width: '100%',
            filter: true,
        });
   $('select').multipleSelect('refresh');

    CKEDITOR.replace('descripcion');

    CKEDITOR.replace( 'descripcion', {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>
@stop

