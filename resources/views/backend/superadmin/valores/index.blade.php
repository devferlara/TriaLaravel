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
	@include ('errors.success')
	@include ('errors.request')
	@include ('errors.errors')			
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-8 text-center ">
			<div class="card mb-4 ">
				<div class="card-body ">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 style="text-align:center;"><strong>Nuevo</strong> Valor de Conjuntoss</h3>
						</br>
						<h5 class="text-info">Crear tus valores, recuerda que todos los campos son requeridos </h5>
					</div>
					<div class="panel panel-body" style="padding:20px;">
						{!!Form::open(['route'=>'superadmin.valores.store','method'=>'POST'])!!}
						@foreach($valores as $valor)
						<div class="form-group has-float-label mb-4">
							{!!Form::label('valor', $valor->descripcion)!!}
							{!!Form::text ($valor->modulo, $valor->valor, ['class'=>'form-control', 'placeholder'=> $valor->descripcion,'required' => 'true'])!!}
						</div>
						@endforeach
						{!!Form::submit('Guardar', ['class'=>'btn btn-primary'])!!}
						{!!Form::close()!!}

					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection



@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/listaraptos.js')!!}
@stop


