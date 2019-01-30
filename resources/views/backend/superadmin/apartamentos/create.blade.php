@extends('layout.admin')



@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section('sidebar')
@include('backend.menu.superadmin')
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
        <div class="card-body tabs_create_apartamentos_estilo">
          <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Apartamento</h3>
          <h4 class="text-info" style="text-align: center">Crear tus apartamentos de manera individual o masiva completando el siguiente Formulario ¡Es fácil, recuerda que todos los campos son requeridos *.!</h4>
          <br>

          <ul class="nav nav-tabs nav-tabs-simple" role="tablist">
            <li>
              <a href="#Individual" data-toggle="tab" role="tab" class="active show">Individual</a>
            </li>
            <li>
              <a href="#multiple" data-toggle="tab" role="tab">Multiple</a>
            </li>
          </ul>
          <div class="tab-content">

            <div class="tab-pane active" id="Individual">
              {!!Form::open(['route'=>'superadmin.apartamentos.store','method'=>'POST'])!!}
              <div class="form-group has-float-label mb-4">
                {!!Form::label('conjunto', 'Conjunto Residencial ')!!}
                {{--*/ $conjuntosA[0]="Por favor seleccione una opcion"; foreach($conjuntos as $key=>$con){$conjuntosA[$key]=$con;}/*--}}
                {!!Form::select('conjunto', $conjuntosA, null, ['id'=>'conjunto' ,'class'=>'form-control'])!!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('zona', 'Zona o Unidad')!!}
                {!!Form::select('zona',['placeholder'=>'selecciona'], null,['id'=>'zona' ,'class'=>'form-control'] ) !!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('apartamento', 'Apartamento')!!}
                {!!Form::text ('apartamento', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número apartamento'])!!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('matricula_inmobiliaria', 'Apartamento')!!}
                {!!Form::text ('matricula_inmobiliaria', null, ['class'=>'form-control', 'placeholder'=>'Ingresa tu número de matricula'])!!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('descripcion', 'Descripción del Apartamento')!!}
                <div class="wysiwyg5-wrapper b-a b-grey">
                  <textarea id="descripcion" name="descripcion" class="wysiwyg demo-form-wysiwyg form-control" placeholder="Descripcion del apartamento..."></textarea>
                </div>
              </div>

              <div class="form-group">
                {!!Form::submit('Crear Apartamento', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('superadmin.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
              </div>
              {!!Form::close()!!}
            </div>


            <div class="tab-pane" id="multiple">
              <p class="small-text2">Para crear multiples apartamentos debes asignar un apartamento inicial y uno final (Por Unidad) debes tener en cuenta que no deben haber apartamentos repetidos</p>
              {!!Form::open(['action'=>'ApartamentoController@storemultiple1','method'=>'POST'])!!}
              <div class="form-group has-float-label mb-4">
                {!!Form::label('conjunto_m', 'Conjunto Residencial ', ['class'=>'form-control'])!!}
                {!!Form::select('conjunto_m', $conjuntos, null, ['id'=>'conjunto_m' ,'class'=>'form-control'])!!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('zona', 'Zona o Unidad')!!}
                {!!Form::select('zona_m',['placeholder'=>'selecciona'], null,['id'=>'zona_m' ,'class'=>'form-control'] ) !!}
              </div>
              <div class="form-group has-float-label mb-4">
                {!!Form::label('apartamento', 'Apartamento')!!}
                {!!Form::text ('apartamento_m', null, ['class'=>'form-control', 'placeholder'=>'Ingresa un rango de apartamentos. Ejemplo: 101-106'])!!}
              </div>
              <div class="form-group">
                {!!Form::submit('Crear Multiples Apartamentos', ['class'=>'btn btn-primary'])!!}
                {!!link_to_route('superadmin.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}                        
              </div>
              {!!Form::close()!!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop

@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/listarzonas.js?v=2')!!}
{!!Html::script('build/assets/js/script/listarzonasmultiples.js')!!}
@stop
