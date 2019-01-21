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
        <div class="card-body">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Cargar</span> Facturación</h3>
          <h4 class="text-info" style="text-align: center">Crea la entidad bancaria que permita recibir los pagos através de sus portales virtuales o convenios.</h4>
          <br>
          <br>
          {!!Form::model($banco,['route'=> ['administrador.bancos.update',$banco[0]->id],'method'=>'PUT', 'files'=>'true'])!!}
          <div class="row">

            <div class="col-md-4">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('nombre', 'Nombre')!!}
                {!!Form::text ('nombre',$banco[0]->nombre ,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Banco'])!!}
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('pais', 'Pais' )!!}
                <select class="form-control" data-init-plugin="select2" id="pais" name="pais" style="width:100%;">
                  <optgroup label="Escoge un Pais">
                    <option value="Colombia">Colombia</option>
                    <option value="Ecuador" <?= $banco[0]->pais == 'Ecuador'?'selected':''?>>Ecuador</option>
                    <option value="Peru" <?= $banco[0]->pais == 'Peru'?'selected':''?>>Perú</option>
                    <option value="Argentina" <?= $banco[0]->pais == 'Argentina'?'selected':''?>>Argentina</option>
                    <option value="Espana" <?= $banco[0]->pais == 'Espana'?'selected':''?>>España</option>
                    <option value="USA" <?= $banco[0]->pais == 'USA'?'selected':''?>>Estados Unidos</option>
                    <option value="Venezuela" <?= $banco[0]->pais == 'Venezuela'?'selected':''?>>Venezuela</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-4" >
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('link', 'Link Portal de Pagos')!!}
                {!!Form::text('link', $banco[0]->link, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique la página web de pagos del banco'])!!}
              </div>
            </div>



            <div class="col-md-4">
              {!!Form::label('enabled','Habilitar', ['class'=>'form-label'])!!}
              <input type="checkbox" value="1" name="enabled" <?= $banco[0]->enabled == 1?'checked':''?>>
            </div>
            <div class="col-md-4">
              {!!Form::label('img_banco','Cargar logo banco')!!}
              {!!Form::file('img_banco', null, ['class'=>'btn btn-success', 'style'=>'width:100%'])!!}
            </div>
            <div class="col-md-4">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('tipo_cuenta', 'Tipo de Cuenta')!!}
                <select class="form-control" data-init-plugin="select2" id="tipo_cuenta" name="tipo_cuenta" style="width:100%;">
                  <optgroup label="Escoge un tipo de cuenta">
                    <option value="Ahorros">Cuenta de Ahorros</option>
                    <option value="Corriente" <?= $banco[0]->tipo_cuenta == 'Corriente'?'selected':''?>>Cuenta Corriente</option>
                  </optgroup>
                </select>
              </div>
            </div>

            <div class="col-md-6" style="margin-top: 20px">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('No_cuenta', 'Número de Cuenta')!!}
                {!!Form::text('No_cuenta', $banco[0]->No_cuenta, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de cuenta'])!!}
              </div>
            </div>
            <div class="col-md-6" style="margin-top: 20px">
              <div class="form-group  has-float-label mb-4">
                {!!Form::label('No_convenio', 'No de Convenio Bancario')!!}
                {!!Form::text('No_convenio', $banco[0]->No_convenio, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Indique el Número de convenio'])!!}
              </div>
            </div>
          </div>
        </div>
        <div class="form-group" style="margin: 20px;">
          {!!Form::submit('Editar', ['class'=>'btn btn-primary'])!!}
          {!!link_to_route('administrador.bancos.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}
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