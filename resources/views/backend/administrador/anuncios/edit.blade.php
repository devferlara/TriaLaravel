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
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;">
            <span class="semi-bold">Editar</span>
            Anuncio o Noticia
          </h3>
          <h4 class="text-info text-center">Podrás editar todos tus anuncio o noticias de interés para tu comunidad, tales como: Información de la propiedad horizontal, reuniones y resultados de las mismas, etc...</h4>
          <br>
          {!!Form::model($anuncio,['route'=> ['administrador.anuncios.update',$anuncio->id],'method'=>'PUT', 'files'=>'true'])!!}

          <div class="row">
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre', 'Titulo', ['class'=>'form-label'])!!}
                {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('conjunto_id', 'Enviar a:' , ['class'=>'form-label'])!!}
                <select name="conjunto_id" class="form-control">
                  <option value="{{$conjunto->first()->id}}">{{$conjunto->first()->nombre}}</option>
                </select>
              </div>
            </div>

            <div class="col-md-4 form-group" >
              {!!Form::label('activar', 'Agregar Banner', ['class'=>'form-label'])!!}
              <div class="radio radio-success" id="activar">
                <input type="radio" value="si" name="activar" id="si">
                <label for="si">SI</label>
                <input type="radio" value="si" name="activar" id="no">
                <label for="no">NO</label>
              </div>
            </div>


            <div class="col-md-4 " id="archivo">
              {!!Form::label('img_banner','Carga una imagen', ['class'=>'form-label'])!!}
              {!!Form::file('img_banner')!!}
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('categoria', 'Categoria-Anuncio', ['class'=>'form-label'])!!}
                {!!Form::select('categoria',[ 'Eventos'=>'Eventos Sociales', 'Info-general'=>'Información General', 'Mantenimientos'=>'Mantenimientos', 'Asambleas'=>'Reuniones y Asambleas', 'Servicios'=>'Servicios Públicos','Seguridad'=>'Seguridad'],null, ['style'=>'width:100%', 'class'=>'full-width form-control'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('valoracion', 'Importancia', ['class'=>'form-label'])!!}
                {!!Form::select('valoracion',[ 'Importante'=>'Importante', 'Urgente'=>'Urgente', 'Relevante'=>'Relevante', 'Normal'=>'Normal' ],null, ['style'=>'width:100%', 'class'=>'full-width form-control'])!!}
              </div>
            </div>

            <div class="col-md-12" style="margin-top:10px;">
              {!!Form::textarea ('descripcion', null, ['id'=>'ckEditorClassic', 'class'=>'ckeditor' ,'rows'=>'10' , 'cols'=>'80'])!!}
            </div>
          </div>
          <div class="col-md-6 form-group" style="margin-top:20px;">
            {!!Form::label('publicar', 'Publicar', ['class'=>'form-label'])!!}
            {!!Form::radio('enabled','1', ['class'=>'radio radio-success'])!!}
            {!!Form::label('despublicar', 'Despublicar', ['class'=>'form-label'])!!}
            {!!Form::radio('enabled','0')!!}
            <div style="float:none;">
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('administrador.anuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
            </div>
          </div>
          <div class="col-md-6 form-group"></div>
        </div>
        {!!Form::close()!!}



      </div>
    </div>
  </div>

</div>
</div>


@stop

@section ('footer')
@include('layout.footer')
@stop
