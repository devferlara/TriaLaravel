@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.administrador')
@stop
        <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@stop

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
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Nueva </span> Zona </h3>
                        </br>
                        <h5 class="text-info">Crear la zona de tu conjunto completando el siguiente formulario. ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>
                    </div>
                <div class="panel panel-body" style="padding:20px;">
                   {!!Form::model($zona,['route'=> ['administrador.zonas.update', $zona->id],'method'=>'PUT'])!!}
                    <div class="form-group">
                        {!!Form::label('conjunto', 'Conjunto Residencial', ['class'=>'form-control'])!!}
                        {!!Form::select('conjunto' ,  $conjuntos, $zona->conjunto_id,  ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('tipo','Tipo de Unidad',['class'=>'form-control'])!!}
                        {!!Form::select('tipo',
                            [   'Torre' => 'Torre', 
                                'Casa' => 'Casa',
                                'Local' => 'Local', 
                                'Oficina' => 'Oficina',
                                'Piso' => 'Piso',
                                'Manzana' => 'Manzana',
                                'Bodega' => 'Bodega', 
                                'Bloque' => 'Bloque',
                                'Interior' => 'Interior', 
                                'Consejo' => 'Consejo',
                                'Parqueadero' => 'Parqueadero', 
                                'Garaje' => 'Garaje',
                                'Etapa' => 'Etapa'
                            ], null, ['class' => 'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('zona','Unidad',['class'=>'form-control'])!!}
                        {!!Form::text ('zona', $zona->zona, null,['class'=>'form-control' , 'placeholder'=>'# Unidad', 'id'=>'zona'])!!}
                    </div>
                    <div class="form-group">
                    {!!Form::submit('Actualizar Zona', ['class'=>'btn btn-primary'])!!}
                    {!!link_to_route('administrador.zonas.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}       
                    </div>

                </div>
                {!!Form::close()!!}  
             </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
@stop

@section ('footer')
 @include ('layout.footer')
@stop
