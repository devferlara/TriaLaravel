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

<div class="page-content-wrapper">
    <div class="content">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')          
        <div class="col-md-1"></div>

            <div class="panel-group col-md-10">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Editar</span> Anuncio o Noticia</h3>
                        </br>
                        <h5 class="text-info">Podrás editar todos tus anuncio o noticias de interés para tu comunidad, tales como: Información de la propiedad horizontal, reuniones y resultados de las mismas, etc... </h5>
                    </div>
                    <div class="panel panel-body" style="padding:20px;">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    {!!Form::model($anuncio,['route'=> ['administrador.anuncios.update',$anuncio->id],'method'=>'PUT', 'files'=>'true'])!!}

                                        <div class="form-group">
                                            {!!Form::label('nombre', 'Titulo', ['class'=>'form-label'])!!}
                                            {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un titulo para tu publicación'])!!}
                                        </div>

                                        <div class="form-inline">
                                            <div class="col-md-12">
                                            {!!Form::label('conjunto_id', 'Enviar a:' , ['class'=>'form-label'])!!}
                                            <select name="conjunto_id">
                                                <option value="{{$conjunto->first()->id}}">{{$conjunto->first()->nombre}}</option>
                                            </select>
                                            </div>
                                        <div class="form-inline">
                                        <div class="col-md-6 form-group" style="text-align:left; margin-top:10px;">
                                            {!!Form::label('activar', 'Agregar Banner', ['class'=>'form-label'])!!}
                                            <div class="radio radio-success" id="activar">
                                                <input type="radio" value="si" name="activar" id="si">
                                                <label for="si">SI</label>
                                                <input type="radio" value="si" name="activar" id="no">
                                                <label for="no">NO</label>
                                            </div>
                                        </div>
                        
                                        <div class="col-md-6 form-group" style="margin-top:10px;" id="archivo">
                                            {!!Form::label('img_banner','Carga una imagen', ['class'=>'form-label'])!!}
                                            {!!Form::file('img_banner', ['class'=>'btn btn-success'])!!}
                                        </div>
                                        </div>

                                        <div class="form-inline">
                                        <div class="col-md-6 form-group" style="margin-top:10px;">
                                            {!!Form::label('categoria', 'Categoria-Anuncio', ['class'=>'form-label'])!!}
                                            {!!Form::select('categoria',[
                                                'Eventos'=>'Eventos Sociales',
                                                'Info-general'=>'Información General',
                                                'Mantenimientos'=>'Mantenimientos',
                                                'Asambleas'=>'Reuniones y Asambleas',
                                                'Servicios'=>'Servicios Públicos',
                                                'Seguridad'=>'Seguridad'
                                                ],null, ['style'=>'width:100%', 'class'=>'full-width'])!!}
                                        </div>

                                        <div class="col-md-6 form-group" style="margin-top:10px;">
                                            {!!Form::label('valoracion', 'Importancia', ['class'=>'form-label'])!!}
                                            {!!Form::select('valoracion',[
                                                'Importante'=>'Importante',
                                                'Urgente'=>'Urgente',
                                                'Relevante'=>'Relevante',
                                                'Normal'=>'Normal'
                                                ],null, ['style'=>'width:100%', 'class'=>'full-width'])!!}
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
                                        {!!link_to_route('administrador.anuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                                        </div>
                                        </div>
                                        <div class="col-md-6 form-group"></div>
                                    {!!Form::close()!!}
                                </div>
                          </div>
                        </div>                          
                    </div>
                </div>
        </div>
    </div>
</div>
@stop

@section ('footer')
    @include('layout.footer')
@stop


@section('js_library')
{!!Html::script('build/assets/plugins/multiple-select/multiple-select.js')!!}
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop

@section('specific_js')
<script>
    $("select").multipleSelect({
            width: '100%',
            filter: true
        });

    CKEDITOR.replace('descripcion');

    CKEDITOR.replace( 'descripcion', {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

@stop