@extends ('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section ('sidebar')
@include('backend.menu.usuario')
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
				<div class="card-body">
					<h3 class="p-b-5 text-primary" style="text-align:center;">
						<span class="semi-bold">Borrar</span>
						Mascotas
					</h3>
					<h5 class="text-info text-center">Aquí podras eliminar del sistema todas las mascotas que tienes registradas.</h5>

					{!!Form::model($mascota,['route'=> ['usuario.clubmascotas.destroy',$mascota->id],'method'=>'DELETE', 'files'=>'true'])!!}
					<div class="">
						<h4><span class="semi-bold">ELIMINAR MASCOTA:</span> <span style="font-style:oblique; font-size:1.2em;">{{$mascota->nombre}} {{$mascota->raza}}</span></h4>
						<p class="p-b-10">¿Estas seguro de eliminar esta mascota registrada en el Club, no podras recuperarla luego de haber confirmado la eliminación?</p>
					</div>
					<div class="">
						<p class="p-b-10">Si es así, dale click en eliminar, sino puedes cancelar esta solicitud</p>
					</div>
					{!!Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
					{!!link_to_route('usuario.clubmascotas.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
					{!!Form::close()!!}
					<br>
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section ('footer')
@include ('layout.footer')
@stop