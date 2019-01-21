@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.pautante')
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
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Anuncio Publicitario- Bono de Descuento</h3>
          <h4 class="text-info" style="text-align: center">Podrás crear anuncios publicitarios promocionando servicios y productos cubriendo los interés de tu comunidad. </h4>
          <br>
          {!!Form::open(['route'=>'pautante.publicidad.bonos.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="row">


            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('titulo', 'Titulo del Anuncio o Bono')!!}
                {!!Form::text ('titulo', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tienda', 'Tienda o Almacén')!!}
                {!!Form::text ('tienda', null, ['class'=>'form-control', 'placeholder'=>'Ingresa a que tienda, almacén o empresa pertenece la promoción', 'style'=>'width:100%'])!!}
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('local', 'Local')!!}
                {!!Form::text ('local', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el local de la promoción', 'style'=>'width:100%'])!!}
              </div>
            </div>


            <div class="col-md-6" style="text-align:left; margin-top:10px;">
              {!!Form::label('logo', 'Agregar Logo de la tienda o producto', ['class'=>'form-label'])!!}
              <div style="width: 100%">
                {!!Form::file('logo')!!}
              </div>
            </div>

            <div class="col-md-6" style="margin-top:10px;" id="archivo">
              {!!Form::label('img_publicidad','Carga una imagen o banner publicitario', ['class'=>'form-label'])!!}
              <div style="width: 100%">
                {!!Form::file('img_publicidad')!!}
              </div>
            </div>

            <div class="col-md-6" style="margin-top:30px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('categoria', 'Categoria-Anuncio')!!}
                <select class="form-control" data-init-plugin="select2" id="categoria" name="categoria">
                  <optgroup label="Seleccione una Categoria">
                    <option value="Belleza">Belleza</option>
                    <option value="Calzado">Calzado</option>
                    <option value="Deportes">Deportes</option>
                    <option value="Entretenimiento">Entretenimiento</option>
                    <option value="Hogar">Hogar</option>
                    <option value="Moda">Moda</option>
                    <option value="Restaurantes">Restaurantes</option>
                    <option value="Salud">Salud</option>
                    <option value="Tecnologia">Tecnología</option>
                    <option value="Turismo">Turismo</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-6" style="margin-top:30px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('link', 'Link o Enlace Web', ['class'=>'form-label'])!!}
                {!!Form::text ('link', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el enlace o web para publicitar', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6" style="margin-top:10px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('valor', 'Valor Bono', ['class'=>'form-label'])!!}
                {!!Form::text ('valor', null, ['class'=>'form-control', 'placeholder'=>'$', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <p style="font-size: 14px;">Posibles usuarios que veran el anuncio: <span id="posibles_u" style="font-weight: bold;">0</span></p>
            </div>

            <div class="col-md-12" style="margin-top:20px;">


              {!!Form::label('envio', 'Enviar a:' , ['class'=>'form-label'])!!}
              <select class="form-control select2-multiple"  multiple="multiple" style="width:100%" name="envio[]">
                <optgroup label="Paises">
                  @foreach($paises as $pais)
                  <option value="pais_{{$pais->id}}">{{$pais->pais}} </option>
                  @endforeach
                </optgroup>
                <optgroup label="Ciudades">
                  @foreach($ciudades as $ciudad)
                  <option value="ciudad_{{$ciudad->id}}">{{$ciudad->ciudad}} - ({{$ciudad->pais}})</option>
                  @endforeach
                </optgroup>
                <optgroup label="Localidades">
                  @foreach($localidades as $localidad)
                  <option value="local_{{$localidad->id}}">{{$localidad->localidad}} - ({{$localidad->ciudad}})</option>
                  @endforeach
                </optgroup>
                <optgroup label="Conjuntos">
                  @foreach($conjuntos as $conjunto)
                  <option value="conjunto_{{$conjunto->id}}">{{$conjunto->nombre}} - ({{$conjunto->localidad}} - {{$conjunto->ciudad}} - {{$conjunto->pais}})</option>
                  @endforeach
                </optgroup>
              </select>
            </div>

            <div class="col-md-12" style="margin-top:10px;">
              <textarea class="ckeditor" name="descripcion" id="ckEditorClassic" rows="10" cols="80"></textarea>
            </div>
          </div>

          <div class="col-md-6 form-group" style="margin-top:20px;">
            {!!Form::label('enabled','Publicar', ['class'=>'form-label'])!!}
            {!!Form::checkbox('enabled', '1')!!}
            <div style="float:none;">
              {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
              {!!link_to_route('superadmin.publicidad.bonos.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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
@stop
