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
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Apartamento</h3>
                        </br>
                        <h5 class="text-info">Crear tus apartamentos de manera individual o masiva completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>
                    </div>
                    <div class="panel panel-body" style="padding:20px;">
                    <ul class="nav nav-tabs nav-tabs-simple" role="tablist">
                        <li class="active">
                            <a href="#Individual" data-toggle="tab" role="tab">Individual</a>
                        </li>
                        <li>
                            <a href="#multiple" data-toggle="tab" role="tab">Multiple</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="Individual">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    {!!Form::open(['route'=>'administrador.apartamentos.store','method'=>'POST'])!!}

                                     <div class="form-group">
                                        {!!Form::label('conjunto', 'Conjunto Residencial ', ['class'=>'form-control'])!!}
                                        {!!Form::select('conjunto', $conjunto, null, ['placeholder'=>'Selecciona un conjunto','id'=>'conjunto' ,'class'=>'form-control'])!!}
                                    </div>
            
                                    <div class="form-group">
                                        {!!Form::label('zona', 'Zona o Unidad', ['class'=>'form-control'])!!}
                                         {!!Form::select('zona',['placeholder'=>'selecciona'], null,['id'=>'zona' ,'class'=>'form-control'] ) !!}
                                    </div>
                                    <div class="form-group">
                                        {!!Form::label('apartamento', 'Apartamento', ['class'=>'form-control'])!!}
                                        {!!Form::text ('apartamento', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número apartamento'])!!}
                                    </div>
                                    <div class="form-group">
                                        {!!Form::label('matricula_inmobiliaria', 'Apartamento', ['class'=>'form-control'])!!}
                                        {!!Form::text ('matricula_inmobiliaria', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número de matricula'])!!}
                                    </div>
                                    <div class="form-group">
                                        {!!Form::label('descripcion', 'Descripción del Apartamento', ['class'=>'form-control'])!!}
                                        <div class="wysiwyg5-wrapper b-a b-grey">
                                            <textarea id="descripcion" name="descripcion" class="wysiwyg demo-form-wysiwyg" placeholder="Descripcion del apartamento..."></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!!Form::submit('Crear Apartamento', ['class'=>'btn btn-primary'])!!}
                                        {!!link_to_route('administrador.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
                                    </div>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="multiple">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="small-text2">Para crear multiples apartamentos debes asignar un apartamento inicial y uno final (Por Unidad) debes tener en cuenta que no deben haber apartamentos repetidos</p>

                                    {!!Form::open(['action'=>'ApartamentoController@storemultiple','method'=>'POST'])!!}

                                    <div class="form-group">
                                        {!!Form::label('conjunto_m', 'Conjunto Residencial ', ['class'=>'form-control'])!!}
                                        {!!Form::select('conjunto_m', $conjunto, null, ['placeholder'=>'Selecciona un conjunto','id'=>'conjunto_m' ,'class'=>'form-control'])!!}
                                    </div>

                                    <div class="form-group">
                                        {!!Form::label('zona', 'Zona o Unidad', ['class'=>'form-control'])!!}
                                        {!!Form::select('zona_m',['placeholder'=>'selecciona'], null,['id'=>'zona_m' ,'class'=>'form-control'] ) !!}
                                    </div>

                                    <div class="form-group">
                                        {!!Form::label('apartamento', 'Apartamento', ['class'=>'form-control'])!!}
                                        {!!Form::text ('apartamento_m', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un rango de apartamentos. Ejemplo: 101-106'])!!}
                                    </div>

                                    <div class="form-group">
                                        {!!Form::submit('Crear Multiples Apartamentos', ['class'=>'btn btn-primary'])!!}
                                        {!!link_to_route('administrador.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
                                    </div>

                                    {!!Form::close()!!}
                                </div>
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
    @include ('layout.footer')
@stop

@section ('specific_js')
{!!Html::script('build/assets/js/script/listarzonas.js')!!}
{!!Html::script('build/assets/js/script/listarzonasmultiples.js')!!}
@stop