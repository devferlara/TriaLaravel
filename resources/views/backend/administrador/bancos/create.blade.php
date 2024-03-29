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

<div class="container-fluid">
  <div class="row">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')

    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body ">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Crear</span> Banco</h3>
          <h4 class="text-info" style="text-align: center">Crea la entidad bancaria que permita recibir los pagos através de sus portales virtuales o convenios.</h4>
          <br>

          {!!Form::open(['route'=>'administrador.bancos.store','method'=>'POST', 'files'=>'true'])!!}

          <div class="row">
            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('nombre', 'Nombre')!!}
                {!!Form::text ('nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Banco'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group has-float-label mb-4">
                {!!Form::label('pais', 'Pais')!!}
                <select class="form-control" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
                  <optgroup label="Escoge un Pais">
                    <option value="Colombia">Colombia</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Peru">Perú</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Espana">España</option>
                    <option value="USA">Estados Unidos</option>
                    <option value="Venezuela">Venezuela</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('link', 'Link Portal de Pagos')!!}
                {!!Form::text('link', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique la página web de pagos del banco'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                {!!Form::label('enabled','Habilitar', ['class'=>'form-label'])!!}
                {!!Form::checkbox('enabled', '1')!!}
              </div>
            </div>
            <div class="col-md-4">
              {!!Form::label('img_banco','Cargar logo banco')!!}
              {!!Form::file('img_banco', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
            </div>
            <div class="col-md-4">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('conjunto', 'Conjunto Residencial ')!!}
                {!!Form::select('conjunto', $conjuntos, null, ['placeholder'=>'Selecciona un conjunto','id'=>'conjunto' ,'class'=>'form-control'])!!}
              </div>
            </div>



            <div class="col-md-4" style="margin-top: 20px">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('tipo_cuenta', 'Tipo de Cuenta')!!}
                <select class="form-control" data-init-plugin="select2" id="tipo_cuenta" name="tipo_cuenta" style="width:100%;">
                  <optgroup label="Escoge un tipo de cuenta">
                    <option value="Ahorros">Cuenta de Ahorros</option>
                    <option value="Corriente">Cuenta Corriente</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4" style="margin-top: 20px">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('No_cuenta', 'Número de Cuenta')!!}
                {!!Form::text('No_cuenta', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de cuenta'])!!}
              </div>
            </div>
            <div class="col-md-4" style="margin-top: 20px">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('No_convenio', 'No de Convenio Bancario')!!}
                {!!Form::text('No_convenio', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de convenio'])!!}
              </div>
            </div>
          </div>

          <div class="form-group" style="margin: 20px;">
            {!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}
            {!!link_to_route('administrador.bancos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
          </div>
          {!!Form::close()!!} 


        </div>
      </div>
    </div>
  </div>
</div>








@endsection

@section ('footer')
@include ('layout.footer')
@stop