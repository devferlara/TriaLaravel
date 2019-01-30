@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.pautante')
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

		<div class="col-lg-12 col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h3>Pago De membresia</h3>
					<h5 class="text-info">Realiza el pago de tu membresia con el metodo PAYU. </h5>
					{!!Form::open(['route'=>'pautante.pagospublicidad.store','method'=>'POST'])!!}
					<div class="form-group">
						{!!Form::label('valor', 'Valor', ['class'=>'form-control'])!!}
						{!!Form::label(null,$valor.' USD', ['class'=>'form-control'])!!}
						<input type="hidden" value="{{$tipo_pago}}" name="publicidad_tipo">
					</div>
					{!!Form::submit('Guardar', ['class'=>'btn btn-primary'])!!}
					{!!Form::close()!!}
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
