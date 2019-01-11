@extends('layout.admin')

@section('sidebar')
    @include('backend.menu.usuario')
@stop


@section('head')
    @include('layout.head')
@stop

@section('css')

<style>

/* Por debajo de 1600px */
@media screen and (max-width: 1600px){
.texto{
	width: 98%;
	position:absolute;
	bottom:50%;
	text-align: center;
	font-size: 1.5em;
	font-weight: bold;
	font-family: sans-serif;
	color: orange;
}
}

/* Por debajo de 700px */
@media screen and (max-width: 700px){
.texto{
	width: 98%;
	position:absolute;
	bottom:50%;
	text-align: center;
	font-size: 1.2em;
	font-weight: bold;
	font-family: sans-serif;
	color: orange;
}
}

/* Por debajo de 400px */
@media screen and (max-width: 400px){
.texto {
	width: 98%;
	position:absolute;
	bottom:40%;
	text-align: center;
	font-size: 0.9em;
	font-weight: bold;
	font-family: sans-serif;
	color: orange;
}
}
</style>
@stop

@section('content')
<div class="col-md-12" style="margin-top:50px;"></div>
<div class="col-md-12" style="position: relative;">
	{!! Form::open() !!}
	<img alt="" class="img-responsive" src="{{ asset('build/assets/img/mascotas.jpg') }}"/>
	<div class="texto">En el club mascotas recibiras información </br> sobre consejos prácticos, promociones y eventos </br> para los apasionados por las mascotas</div>
	</br>
	{!!link_to_route('usuario.clubmascotas.create', $title = 'Registra tu Mascota', $parameters = '', $attributes = ['class'=>'btn btn-success btn-block'])!!}
	{!! Form::close() !!}
</div>
<div class="col-md-12" style="margin-top:50px;"></div>

@stop

@section('footer')
    @include ('layout.footer')
@stop