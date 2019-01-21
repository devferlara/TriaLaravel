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
          {!!Form::open(['route'=> ['administrador.zonas.store'],'method'=>'POST'])!!}
          <div class="row">

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('conjunto', 'Conjunto Residencial')!!}
                {!!Form::select('conjunto' , $conjuntos,  null,  ['class' => 'form-control'])!!}
              </div>
            </div>

            <div class="col-md-6">
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
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('zona','Unidad')!!}
                {!!Form::text ('zona', null, ['class'=>'form-control' , 'placeholder'=>'# Unidad', 'id'=>'zona'])!!}
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                {!!Form::submit('Crear Zona', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('administrador.zonas.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}       
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