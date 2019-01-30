@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@endsection
<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
@include ('layout.head')
@endsection

@section ('content')

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')          
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Cargar</span> Facturación</h3>
          <h4 class="text-info" style="text-align: center">Por medio de este módulo podrás cargar la facturación por conjunto residencial </h4>
          <br>
          {!!Form::open(['route'=>'superadmin.recibosdepago.store','method'=>'POST', 'files'=>'true'])!!}
          <div class="form-group has-float-label mb-4">

            {!!Form::label('conjunto', 'Conjunto Residencial ')!!}
            {!!Form::select('conjunto', $conjuntos, null, ['placeholder'=>'Selecciona un conjunto','id'=>'conjunto' ,'class'=>'form-control'])!!}
          </div>
          <div class="form-group" style="margin-top:10px;" id="cargarecibos">
            {!!Form::label('archivo','Archivo de Facturación', ['class'=>'form-label'])!!}
            <div style="width: 100%">
              {!!Form::file('archivo')!!}
            </div>
          </div>
          <div class="form-group">
            {!!Form::submit('Cargar Facturación', ['class'=>'btn btn-primary'])!!}
            {!!link_to_route('superadmin.recibosdepago.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
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
