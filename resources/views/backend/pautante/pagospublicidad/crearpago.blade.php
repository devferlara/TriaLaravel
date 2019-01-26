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

<div class="page-content-wrapper">

	<div class="content">

		@include ('errors.success')

		@include ('errors.request')

		@include ('errors.errors')			

		<div class="col-md-1"></div>



		<div class="panel-group col-md-10">

			<div class="panel panel-info">

				<div class="panel-heading">

					<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Pago</span> De publicidad</h3>

				</br>

				<h5 class="text-info">Realiza el pago por publicidad con el metodo PAYU. </h5>

			</div>
			<div class="panel panel-body" style="padding:20px;">
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

	<div class="col-md-1"></div>

</div>

<div class="col-md-12">

	<hr>

</div>

</div>

@endsection



@section ('footer')

@include ('layout.footer')

@stop



@section('specific_js')

{!!Html::script('build/assets/js/script/listaraptos.js')!!}

@stop