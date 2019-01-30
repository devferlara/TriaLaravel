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
                    <h3 class="p-b-5 text-primary" style="text-align:center;">
                        <span class="semi-bold">Editar</span>
                        Anuncio Club Mascotas- Bono para Mascota
                    </h3>
                    <h4 class="text-info">Podrás crear bonos de descuento para los afiliados a nuestro Club Mascotas para mantener a nuestros usuarios informados y cubran el interés de tu comunidad.</h4>
                    <br>
                    <div class="row form_edit_width">
                        {!!Form::model($publimascotas,['route'=> ['superadmin.publicidad.clubmascotas.update',$publimascotas->id],'method'=>'PUT', 'files'=>'true'])!!}
                        <div class="form-inline">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group has-float-label mb-4">
                                            {!!Form::label('titulo', 'Titulo del Anuncio o Bono')!!}
                                            {!!Form::text ('titulo', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación', 'style'=>'width:100%'])!!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group has-float-label mb-4">
                                            {!!Form::label('emisor', 'Responsable o Emisor del Bono')!!}
                                            {!!Form::text ('emisor', null, ['class'=>'form-control', 'placeholder'=>'Ingresa a que tienda, almacén o empresa pertenece la promoción', 'style'=>'width:100%'])!!}
                                        </div>
                                    </div>
                                </div>
                            </div>                                            
                        </div>
                        <div class="form-inline">

                            <div class="col-md-6 form-group" style="margin-top:10px;" id="archivo">

                                {!!Form::label('img_banner','Carga una imagen o banner publicitario', ['class'=>'form-label'])!!}
                                <div style="width: 100%">
                                    {!!Form::file('img_banner')!!}
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:10px;">
                                <div class="form-group has-float-label mb-4">
                                    {!!Form::label('categoria', 'Categoria-Anuncio', ['class'=>'form-label'])!!}
                                    {!!Form::select('categoria',['Belleza'=>'Salud y Belleza','Comida'=>'Alimentación Sana','Accesorios'=>'Accesorios para Mascotas','Guarderia'=>'Servicios de Guarderia','Veterinaria'=>'Servicios Veterinarios','Clasificados'=>'Clasificados'],null, ['style'=>'width:100%', 'class'=>'full-width form-control'])!!}
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="form-inline">

                            <div class="col-md-6" style="margin-top:10px;">
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
                            
                        </div>

                        <div class="form-inline">
                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="form-group has-float-label mb-4">
                                    {!!Form::label('fecha_desde', 'Valido-Desde', ['class'=>'form-label'])!!}
                                    {!!Form::date('fecha_desde',null,  ['class'=>'form-control', 'style'=>'width:100%'])!!}
                                </div>
                            </div>

                            <div class="col-md-6" style="margin-top:20px;">
                                <div class="form-group has-float-label mb-4">
                                    {!!Form::label('fecha_hasta', 'Valido-Hasta', ['class'=>'form-label'])!!}
                                    {!!Form::date('fecha_hasta',null,['class'=>'form-control', 'style'=>'width:100%'])!!}
                                </div>
                            </div>
                        </div>

                        <div class="form-inline">
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
                        </div>

                        <div class="col-md-12" style="margin-top:10px;">
                            {!!Form::textarea ('descripcion', null, ['id'=>'descripcion', 'class'=>'ckeditor' ,'rows'=>'10' , 'cols'=>'80'])!!}
                        </div>

                        <div class="col-md-6 form-group" style="margin-top:20px;">
                            {!!Form::label('publicar', 'Publicar', ['class'=>'form-label'])!!}
                            {!!Form::radio('enabled','1', ['class'=>'radio radio-success'])!!}
                            {!!Form::label('despublicar', 'Despublicar', ['class'=>'form-label'])!!}
                            {!!Form::radio('enabled','0')!!}
                            <div style="float:none;">
                                {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
                                {!!link_to_route('superadmin.publicidad.clubmascotas.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                            </div>
                        </div>
                        <div class="col-md-6 form-group"></div>
                        {!!Form::close()!!}
                    </div>
                    <br>
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
