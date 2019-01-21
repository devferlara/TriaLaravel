@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.superadmin')
@stop

@section('head')
@include ('layout.head')
@stop

@section ('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nueva</span> Zona</h3>
          <h4 class="text-info" style="text-align: center">Crear la zona de tu conjunto completando el siguiente formulario. ¡Es fácil, recuerda que todos los campos son requeridos *.! </h4>
          <br>

          {!!Form::open(['route'=> ['superadmin.zonas.store'],'method'=>'POST'])!!}

          <div class="form-group has-float-label mb-4">
            {!!Form::label('conjunto', 'Conjunto Residencial')!!}
            {{--*/ $conjuntosA[0]="Por favor seleccione una opcion"; foreach($conjuntos as $key=>$con){
            $conjuntosA[$key]=$con;}/*--}}
            {!!Form::select('conjunto' , $conjuntosA,  null,  ['class' => 'form-control'])!!}
          </div>

          <div class="form-group has-float-label mb-4">

            {!!Form::label('tipo','Tipo de Unidad')!!}

            <select class="full-width form-control" data-init-plugin="select2" id="tipo" name="tipo">
              <optgroup label="Seleccione el tipo de Unidad Residencial">
                <option value="Torre">Torre</option>
                <option value="Casa">Casa</option>
                <option value="Local">Local</option>
                <option value="Oficina">Oficina</option>
                <option value="Piso">Piso</option>
                <option value="Manzana">Manzana</option>
                <option value="Bodega">Bodega</option>
                <option value="Bloque">Bloque</option>
                <option value="Interior">Interior</option>
                <option value="Consejo">Consejo</option>
                <option value="Parqueadero">Parqueadero</option>
                <option value="Garaje">Garaje</option>
                <option value="Etapa">Etapa</option>
              </optgroup>
            </select>
            <br>
            <div class="form-group has-float-label mb-4">
              {!!Form::label('zona','Unidad')!!}
              {!!Form::text ('zona', null, ['class'=>'form-control' , 'placeholder'=>'# Unidad', 'id'=>'zona'])!!}
            </div>

          </div>

          <div class="form-group">
            {!!Form::submit('Crear Zona', ['class'=>'btn btn-primary'])!!}
            {!!link_to_route('superadmin.zonas.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}       
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

