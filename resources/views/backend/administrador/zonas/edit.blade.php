@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.administrador')
@stop

@section('head')
@include ('layout.head')
@stop

@section ('content')

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;">
            <span class="semi-bold">Nueva</span>
            Zona
          </h3>
          <h4 class="text-info text-center">Crear la zona de tu conjunto completando el siguiente formulario. ¡Es fácil, recuerda que todos los campos son requeridos *.!</h4>
          <br>

          {!!Form::model($zona,['route'=> ['administrador.zonas.update', $zona->id],'method'=>'PUT'])!!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('conjunto', 'Conjunto Residencial')!!}
                {!!Form::select('conjunto' ,  $conjuntos, $zona->conjunto_id,  ['class' => 'form-control'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('tipo','Tipo de Unidad')!!}
                {!!Form::select('tipo',['Torre' => 'Torre', 'Casa' => 'Casa','Local' => 'Local', 'Oficina' => 'Oficina','Piso' => 'Piso','Manzana' => 'Manzana','Bodega' => 'Bodega', 'Bloque' => 'Bloque','Interior' => 'Interior', 'Consejo' => 'Consejo','Parqueadero' => 'Parqueadero', 'Garaje' => 'Garaje','Etapa' => 'Etapa'], null, ['class' => 'form-control'])!!}
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('zona','Unidad')!!}
                {!!Form::text ('zona', null,['class'=>'form-control' , 'placeholder'=>'# Unidad', 'id'=>'zona'], $zona->zona)!!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {!!Form::submit('Actualizar Zona', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('administrador.zonas.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}       
              </div>
            </div>
          </div>
        </div>
        {!!Form::close()!!}


      </div>
    </div>
  </div>
</div>
</div>



@stop

@section ('footer')
@include ('layout.footer')
@stop
