@extends('layout.mensajes')

@section('sidebar')
@include('backend.menu.pautante')
@stop

@section('head')
@include('layout.head')
@stop

@section('content')
 
<script>
  window.onload = function()
  {
    getresultado(); 
  }
</script>

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
            Anuncio Publicitario- Bono de Descuento
          </h3>
          <h4 class="text-info">Podrás editar anuncios publicitarios publicados en el sistema de Bonos, asi como agregar o despublicar los bonos dirigidos a nuestros usuarios.</h4>
          <br>

          {!!Form::model($publicidad,['route'=> ['pautante.publicidad.bonos.update',$publicidad->id],'method'=>'PUT', 'files'=>'true'])!!}

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
              {!!Form::file('logo')!!}
            </div>

            <div class="col-md-6" style="margin-top:10px;" id="archivo">
              {!!Form::label('img_publicidad','Carga una imagen o banner publicitario', ['class'=>'form-label'])!!}
              {!!Form::file('img_publicidad')!!}
            </div>

            <div class="col-md-6" style="margin-top:30px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('categoria', 'Categoria-Anuncio')!!}
                {!!Form::select('categoria',['Belleza'=>'Salud y Belleza','Electrodomesticos'=>'Articulos Electrónicos','Comida'=>'Comida','Mercado'=>'Mercado','Ropa-Calzado'=>'Ropa-Calzado','Servicios'=>'Servicios Varios'],null, ['style'=>'width:100%', 'class'=>'full-width form-control'])!!}
              </div>
            </div>

            <div class="col-md-6" style="margin-top:30px;">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('link', 'Link o Enlace Web')!!}
                {!!Form::text ('link', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el enlace o web para publicitar', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('valor', 'Valor Bono', ['class'=>'form-label'])!!}
                {!!Form::text ('valor', null, ['class'=>'form-control', 'placeholder'=>'$', 'style'=>'width:100%'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <p style="font-size: 14px;">Posibles usuarios que veran el anuncio: <span id="posibles_u" style="font-weight: bold;">Calculando...</span></p>
            </div>


            <div class="col-md-12" style="margin-top:20px;">
              {!!Form::label('envio', 'Enviar a:' , ['class'=>'form-label'])!!}
              <select class="form-control select2-multiple" multiple="multiple" style="width:100%" name="envio[]">

                <optgroup label="Paises">
                  @foreach($paises as $pais)
                  <option value="pais_{{$pais->id}}" <?= (in_array($pais->pais, $arreglo_segmentos))?'selected':''?>>{{$pais->pais}} </option>
                  @endforeach
                </optgroup>
                <optgroup label="Ciudades">
                  @foreach($ciudades as $ciudad)
                  <option value="ciudad_{{$ciudad->id}}" <?= (in_array($ciudad->ciudad, $arreglo_segmentos))?'selected':''?>>{{$ciudad->ciudad}} - ({{$ciudad->pais}})</option>
                  @endforeach
                </optgroup>
                <optgroup label="Localidades">
                  @foreach($localidades as $localidad)
                  <option value="local_{{$localidad->id}}" <?= (in_array($localidad->localidad, $arreglo_segmentos))?'selected':''?>>{{$localidad->localidad}} - ({{$localidad->ciudad}})</option>
                  @endforeach
                </optgroup>
                <optgroup label="Conjuntos">
                  @foreach($conjuntos as $conjunto)
                  <option value="conjunto_{{$conjunto->id}}" <?= (in_array($conjunto->id, $arreglo_segmentos))?'selected':''?>>{{$conjunto->nombre}} - ({{$conjunto->localidad}} - {{$conjunto->ciudad}} - {{$conjunto->pais}})</option>
                  @endforeach
                </optgroup>
              </select>
            </div>
            <div class="col-md-12" style="margin-top:10px;">
              {!!Form::textarea ('descripcion', null, ['id'=>'descripcion', 'class'=>'ckeditor' ,'rows'=>'10' , 'cols'=>'80'])!!}
            </div>
          </div>
          <div class="col-md-6 form-group" style="margin-top:20px;">
            {!!Form::label('publicar', 'Publicar', ['class'=>'form-label'])!!}
            {!!Form::radio('enabled','1', ['class'=>'radio radio-success'])!!}
            {!!Form::label('despublicar', 'Despublicar', ['class'=>'form-label'])!!}
            {!!Form::radio('enabled','0')!!}
            <div style="float:none;">
              {!!Form::submit('Actualizar y Enviar', ['class'=>'btn btn-primary'])!!}
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
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
<script>
 $("select").multipleSelect({
  width: '100%',
  filter: true,
  onOptgroupClick: function(){
    getresultado();
  },
  onClick: function(){
    getresultado();
  }
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
{!!Html::script('build/assets/js/script/contarvisitantes.js?v=1')!!}
@stop