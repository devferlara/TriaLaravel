@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
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
    </div>

    <div class="row">

        <div class="col-6 text-center">

            <div class="card mb-4">
                <div class="card-body ">
                    <img class="logo_index_admin"  src="{{ asset('build/assets/img/logo_login.png') }}" >
                </div>
            </div>
            
        </div>

        <div class="col-6">
            <h6 style="font-weight: bold">BIENVENIDO(A) {{ Auth::user()->nombres }}</h6>
            <h1>Plataforma HGV</h1>
            <p class="list-item-heading mb-4">Bienvenido! Desde esta sección podrás administrar todo el aplicativo HGV, donde tendras disponible herramientas para crear conjuntos, usuarios, bonos, noticias y demás funcionalidades que tiene el aplicativo. Fácil y sin complicaciones podras acceder a información detallada para que tengas un control total!</p>
        </div>


    </div>
</div>
@stop

@section('footer')
@include ('layout.footer')
@stop
