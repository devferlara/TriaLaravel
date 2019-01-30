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

@section('content')

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors') 
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Anuncio o Noticia</h3>
          <h4 class="text-info" style="text-align: center">Podrás crear anuncios publicitarios promocionando servicios y productos cubriendo los interés de tu comunidad. </h4>
          <br>
          {!!Form::open(['route'=>'administrador.anuncios.store','method'=>'POST','files'=>'true'])!!}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre', 'Titulo', ['class'=>'form-label'])!!}
                {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('envio', 'Enviar a:' , ['class'=>'form-label'])!!}
                <select name="conjunto_id" class="form-control">
                  <option value="{{$valoresconjunto->id}}">{{$valoresconjunto->nombre}}</option>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                {!!Form::label('activar', 'Agregar Banner', ['class'=>'form-label'])!!}
                <div class="radio radio-success" id="activar">
                  <input type="radio" value="si" name="activar" id="si">
                  <label for="si">SI</label>
                  <input type="radio" value="no" name="activar" id="no">
                  <label for="no">NO</label>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group" id="archivo">
                {!!Form::label('img_banner','Carga una imagen', ['class'=>'form-label'])!!}
                {!!Form::file('img_banner')!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('categoria', 'Categoria-Anuncio', ['class'=>'form-label'])!!}
                <select class="full-width form-control" data-init-plugin="select2" id="categoria" name="categoria">
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

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('valoracion', 'Importancia', ['class'=>'form-label'])!!}
                <select class="full-width form-control" data-init-plugin="select2" id="valoracion" name="valoracion">
                  <optgroup label="Seleccione el tipo de Importancia">
                    <option value="Importante">Importante</option>
                    <option value="Urgente">Urgente</option>
                    <option value="Relevante">Relevante</option>
                    <option value="Normal">Normal</option>
                  </optgroup>
                </select>
              </div>
            </div>


            <div class="col-md-12" style="margin-top:10px;">
              <textarea class="ckeditor" name="descripcion" id="descripcion" rows="10" cols="80"></textarea>
            </div>
          </div>
          <div class="col-md-6 form-group" style="margin-top:20px;">
            {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
            {!!link_to_route('administrador.anuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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
  CKEDITOR.replace( 'descripcion', {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
    
   $("select").multipleSelect({
            width: '100%',
            filter: true,
        });
   $('select').multipleSelect('refresh');

</script>
@stop



