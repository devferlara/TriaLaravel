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
          <h3 class="p-b-5 text-primary" style="text-align:center;">
            <span class="semi-bold">Actualizar</span>
            Apartamento
          </h3>
          <h4 class="text-info">Si ya creaste un apartamento y necesitas actualizar datos, solo debes confirmar los siguientes ! recuerda que todos los campos son requeridos *.!</h4>
          <br>
          {!!Form::model($apartamento,['route'=> ['superadmin.apartamentos.update',$apartamento->id],'method'=>'PUT'])!!}

          <div class="form-group has-float-label mb-4">
            {!!Form::label('conjunto', 'Conjunto Residencial ')!!}
            {{--*/ $conjuntosA[0]="Por favor seleccione una opcion"; foreach($conjuntos as $key=>$con){$conjuntosA[$key]=$con;}/*--}}

            {!!Form::select('conjunto', $conjuntosA, null, ['class'=>'form-control', 'id'=>'conjunto'])!!}
          </div>
          <div class="form-group has-float-label mb-4">
            {!!Form::label('zona', 'Zona o Unidad')!!}
            {!!Form::select('zona', $zonas, $apartamento->zona_id, ['class'=>'form-control', 'id'=>'zona'])!!}
          </div>

          <div class="form-group has-float-label mb-4">
            {!!Form::label('apartamento', 'Apartamento')!!}
            {!!Form::text ('apartamento', null, ['class'=>'form-control'])!!}
          </div>

          <div class="form-group has-float-label mb-4">
            {!!Form::label('descripcion', 'Descripción del Apartamento')!!}
            <div class="wysiwyg5-wrapper b-a b-grey">
              <textarea id="descripcion" name="descripcion" class="wysiwyg demo-form-wysiwyg form-control" placeholder="Descripcion del apartamento..."></textarea>
            </div>
          </div>

          <div class="form-group">
            {!!Form::submit('Actualizar Apartamento', ['class'=>'btn btn-primary'])!!}
            {!!link_to_route('superadmin.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
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