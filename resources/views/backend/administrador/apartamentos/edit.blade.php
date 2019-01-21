@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.administrador')
@endsection

@section('head')
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
                    <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Actualizar </span> Apartamento</h3>
                </br>
                <h5 class="text-info">Si ya creaste un apartamento y necesitas actualizar datos, solo debes confirmar los siguientes ! recuerda que todos los campos son requeridos *.! </h5>
            </div>
            <div class="panel panel-body" style="padding:20px;">
                {!!Form::model($apartamento,['route'=> ['administrador.apartamentos.update',$apartamento->id],'method'=>'PUT'])!!}

                <div class="form-group">
                    {!!Form::label('conjunto', 'Conjunto Residencial ', ['class'=>'form-control'])!!}
                    {!!Form::select('conjunto', $conjuntos, null, ['class'=>'form-control', 'id'=>'conjunto'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('zona', 'Zona o Unidad', ['class'=>'form-control'])!!}
                    {!!Form::select('zona', $zonas, $apartamento->zona_id, ['class'=>'form-control', 'id'=>'zona'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('apartamento', 'Apartamento', ['class'=>'form-control'])!!}
                    {!!Form::text ('apartamento', null, ['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                    {!!Form::label('descripcion', 'Descripción del Apartamento', ['class'=>'form-control'])!!}
                    <div class="wysiwyg5-wrapper b-a b-grey">
                        <textarea id="descripcion" name="descripcion" class="wysiwyg demo-form-wysiwyg" placeholder="Descripcion del apartamento..."></textarea>
                    </div>
                </div>

                <div class="form-group">
                    {!!Form::submit('Actualizar Apartamento', ['class'=>'btn btn-primary'])!!}
                    {!!link_to_route('administrador.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
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