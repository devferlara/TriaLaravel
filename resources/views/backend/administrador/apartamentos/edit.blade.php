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
      <div class="card mb-4 tabs_create_apartamentos_estilo">
        <div class="card-body tabs_create_apartamentos_estilo">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Anuncio Publicitario- Bono de Descuento</h3>
          <h4 class="text-info" style="text-align: center">Podrás crear anuncios publicitarios promocionando servicios y productos cubriendo los interés de tu comunidad. </h4>
          <br>
          {!!Form::model($apartamento,['route'=> ['administrador.apartamentos.update',$apartamento->id],'method'=>'PUT'])!!}

          <div class="col-md-6">
            <div class="form-group has-float-label mb-4">
              {!!Form::label('conjunto', 'Conjunto Residencial ')!!}
              {!!Form::select('conjunto', $conjuntos, null, ['class'=>'form-control', 'id'=>'conjunto'])!!}
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group has-float-label mb-4">
              {!!Form::label('zona', 'Zona o Unidad')!!}
              {!!Form::select('zona', $zonas, $apartamento->zona_id, ['class'=>'form-control', 'id'=>'zona'])!!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-float-label mb-4">
              {!!Form::label('apartamento', 'Apartamento')!!}
              {!!Form::text ('apartamento', null, ['class'=>'form-control'])!!}
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-float-label mb-4">
              {!!Form::label('descripcion', 'Descripción del Apartamento', ['class'=>'form-control'])!!}
              <div class="wysiwyg5-wrapper b-a b-grey">
                <textarea id="descripcion" name="descripcion" class="wysiwyg demo-form-wysiwyg form-control" placeholder="Descripcion del apartamento..."></textarea>
              </div>
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
  </div>
</div>


@stop

@section ('footer')
@include ('layout.footer')
@stop