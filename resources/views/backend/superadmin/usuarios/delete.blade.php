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
		@include ('errors.success')
		@include ('errors.request')
		@include ('errors.errors')				
		<div class="col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h3 class="p-b-5 text-primary" style="text-align:center;">
						<span class="semi-bold">Eliminar</span>
						Usuarios
					</h3>
					<h5 class="text-info text-center">Desde el siguiente formulario podras eliminar los usuarios, sin embargo recuerda, que este proceso solo puede hacer un administrador.! </h5>
					{!!Form::model($usuario,['route'=> ['superadmin.usuarios.destroy',$usuario->id],'method'=>'DELETE'])!!}
					<div class="">
						<h4><span class="semi-bold">ELIMINAR USUARIO:</span> <span style="font-style:oblique; font-size:1.2em;">{{$usuario->nombres}} {{$usuario->apellidos}}</span></h4>
						<p class="p-b-10">¿Estas seguro de eliminar este usuario, no podras recuperarlo luego de haber confirmado la eliminación?</p>
					</div>
					<div class="">
						<p class="p-b-10">Si es así, dale click en eliminar, sino puedes cancelar esta solicitud</p>
					</div>
					{!!Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
					{!!link_to_route('superadmin.usuarios.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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