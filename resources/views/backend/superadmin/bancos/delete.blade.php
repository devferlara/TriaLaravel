@extends ('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section ('sidebar')
@include('backend.menu.superadmin')
@stop

@section ('head')
@include ('layout.head')
@stop

@section ('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body">
					<h3 class="p-b-5 text-primary" style="text-align:center;">
						<span class="semi-bold">Eliminar</span>
						Bancos
					</h3>
					<h5 class="text-info text-center">Desde el siguiente formulario podras eliminar los apartamentos, sin embargo recuerda, que este proceso solo puede hacer un administrador.!</h5>
					<br>
					{!!Form::model($banco,['route'=> ['superadmin.bancos.destroy',$banco->id],'method'=>'DELETE'])!!}
					<div class="">
						<h4><span class="semi-bold">ELIMINAR BANCO:</span> <span style="font-style:oblique; font-size:1.2em;">{{$banco->nombre}}</span></h4>
						<h5 class="p-b-10">¿Estas seguro de eliminar este banco, no podras recuperarlo luego de haber confirmado la eliminación?, además se borraran tambien los enlaces con los usuarios y apartamentos</h5>
					</div>
					<div class="">
						<p class="p-b-10">Si es así, dale click en eliminar, sino puedes cancelar esta solicitud</p>
					</div>
					{!!Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
					{!!link_to_route('superadmin.bancos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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