@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
@section('sidebar')

@include('backend.menu.administrador')

@stop

@section('head')
@include('layout.head')
@stop

@section('content')
@include ('errors.success')
@include ('errors.request')
@include ('errors.errors')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Inicio</h1>
        </div>

        <div class="col-6 text-center">

            <div class="card mb-4">
                <div class="card-body ">
                    <img class="logo_index_admin"  src="{{ asset('build/assets/img/logo_login.png') }}" >
                </div>
            </div>
            
        </div>

        <div class="col-6">
            <h6 style="font-weight: bold">BIENVENIDO(A) {{ Auth::user()->nombres }}</h6>
            <h1>Plataforma Hgv</h1>
            <p class="list-item-heading mb-4">Bienvenido! A la Plataforma de Administración HGV. Desde esta sección podras administrar tu conjunto residencial, crear usuarios, unidades y apartamentos, con el fin de comunicar información importante y publicar noticias y servicios que la comunidad residencial debe estar enterada; como tambien editar su información y hacer un control detallado de los datos del conjunto para que tengas un control total!</p>
        </div>

    </div>
</div>




@stop

@section('footer')
@include ('layout.footer')
@stop

