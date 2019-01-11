@extends('layout.admin')



@section ('meta')

    <meta name="viewport" content="width=device-width, initial-scale=1">

@stop

<!-- Create General Section Sidebar -->

@section('sidebar')

    <!-- Include the menu -->

    @include('backend.menu.superadmin')

@endsection

        <!-- Create General Section Header -->

@section('head')

    <!-- Include the profile header--> 

    @include ('layout.head')

@endsection



@section ('content')

<div class="page-content-wrapper">

    <div class="content" style="padding:50px;margin-top:50px;">

		@include ('errors.success')

		@include ('errors.request')

		@include ('errors.errors')			

		<div class="row">
			<div class="panel panel-default col-lg-12x">
				<div class="panel-heading"><div class="panel-title">Conjuntos activos</div></div>
				<div class="panel-body" style="padding-bottom:0px !important">
					<table class="table table-bordered" id="datos_conjuntos_ubicacion">
						<thead class="info">
							<th style="width: auto;">Pais</th>
							<th style="width: auto;">Ciudad</th>
							<th style="width: auto;">Numero de Conjuntos</th>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default col-lg-12x">
				<div class="panel-heading"><div class="panel-title">Conjuntos por Pais</div></div>
				<div class="panel-body" style="padding-bottom:0px !important">
					<table class="table table-bordered" id="datos_conjuntos">
						<thead class="info">
							<th style="width: auto;">Pais</th>
							<th style="width: auto;">Numero de Conjuntos</th>
							<th style="width: auto;">Total de ventas </th>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="panel panel-default col-lg-12x">
				<div class="panel-heading"><div class="panel-title">Total de Conjuntos</div></div>
				<div class="panel-body" style="padding-bottom:0px !important">
					<table class="table table-bordered" id="datos_total_conjuntos">
						<thead class="info">
							<th style="width: auto;">Numero de conjuntos</th>
							<th style="width: auto;">Costo del Conjunto </th>
							<th style="width: auto;">Total Costo Global </th>
						</thead>
						<tbody>
							<td class="v-align-middle">{{$total_conjuntos}}</td>
							<td class="v-align-middle">$250 USD</td>
							<td class="v-align-middle">${{$total_conjuntos * 250 }} USD</td>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>

	

</div>

@endsection



@section ('footer')

 @include ('layout.footer')

@stop
@section('js_library')

    {!!Html::script('build/assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')!!}
    {!!Html::script('build/assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/datatables.responsive.js')!!}
    {!!Html::script('build/assets/plugins/datatables-responsive/js/lodash.min.js')!!}
@stop


@section('specific_js')

	{!!Html::script('build/assets/js/script/listaraptos.js')!!}
	{!!Html::script('build/assets/js/datatables.js')!!}
	{!!Html::script('build/assets/js/perfil_socio.js')!!}
@stop