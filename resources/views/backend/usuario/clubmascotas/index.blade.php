@extends('layout.admin')

@section('sidebar')
@include('backend.menu.usuario')
@stop


@section('head')
@include('layout.head')
@stop

@section('content')
<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12 col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					{!! Form::open() !!}
					<img alt="" width="100%" src="{{ asset('build/assets/img/mascotas.jpg') }}"/>
					<div class="texto" style="margin-top: 20px">En el club mascotas recibiras información </br> sobre consejos prácticos, promociones y eventos </br> para los apasionados por las mascotas</div>
					<br>
					{!!link_to_route('usuario.clubmascotas.create', $title = 'Registra tu Mascota', $parameters = '', $attributes = ['class'=>'btn btn-success'])!!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>


@stop

@section('footer')
@include ('layout.footer')
@stop