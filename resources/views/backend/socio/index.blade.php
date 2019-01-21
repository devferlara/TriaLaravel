@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.socio')
@stop 

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
@include('layout.head2')
@stop

@section('content')
@include ('errors.success')
@include ('errors.request')
@include ('errors.errors')
<div class="page-content-wrapper" style="padding-bottom:0px !important; min-height:0px !important;">	
	<div class="content" style="padding-bottom:0px !important">

		<ul class="nav nav-tabs">
			<li class="active">
				<a  href="#home" data-toggle="tab">Inicio</a>
			</li>
			<li>
				<a href="#profile" data-toggle="tab">Editar Perfil</a>				
			</li>
			<li>
				<a href="#estadisticas" data-toggle="tab">Estadisticas</a>				
			</li>
		</ul>

		
		<div class="tab-content ">
			<div class="tab-pane active" id="home">
				<div class="jumbotron" >
					<div class="container-fluid container-fixed-lg" style="padding-bottom:0px !important">
						<div class="inner">
							



							<div class="container-md-height m-b-20">
								<div class="row row-md-height">
									<div class="col-lg-7 col-md-6 col-md-height col-middle bg-white">
										<!-- START PANEL -->
										<div class="full-height">
											<div class="panel-body text-center">
												<img src="{{ asset('home/images/LogoTria.png') }}" alt="" width="280">
											</div>
										</div>
										<!-- END PANEL -->
									</div>
									<div class="col-lg-5 col-md-height col-md-6 col-top">
										<!-- START PANEL -->
										<div class="panel panel-transparent">
											<div class="panel-heading">
												<div class="panel-title">Bienvenido(a): <span class="arvin-highlight-text">{{ Auth::user()->nombres }}</span>
												</div>
											</div>
											<div class="panel-body">
												<h3>Plataforma de gestion de Socio! </h3>
												<p>Bienvenido! En esta seccion podra observar y gestionar sus bienes! </p>
												<br>
											</div>
										</div>

										<div class="row">
											<div class="col-lg-6">
												<div class="panel panel-default">
													<div class="panel-heading">Tipo</div>
													<div class="panel-body">
														{{ ucfirst($socio->tipo) }}
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="panel panel-default">
													<div class="panel-heading">Numero de cuotas pagadas</div>
													<div class="panel-body" style="text-align:center;">
														{{ $socio->cuotas }}
													</div>
												</div>
											</div>
										</div>
										<div style="clear:both"></div>
										<div class="row">

											<div class="col-lg-12">
												<div class="panel panel-default">
													<div class="panel-heading">Contrato de licencia del aplicativo</div>
													<div class="panel-body" style="">
														<div class="row">
															<div class="col-lg-3">
																<a href="/uploads/Modelo_Contrato_Conjuntos.doc" target="_blank" class="btn btn-primary">Descargar</a>
															</div>
															<div class="col-lg-9">
															</div>
														</div>


													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="panel panel-default">
													<div class="panel-heading">Contrato de participacion</div>
													<div class="panel-body" style="">
														<div class="row">
															<div class="col-lg-3">
																@if(!$participacion)
																<a href="/uploads/CONTRATO_DE_CUENTAS_EN_PARTICIPACION.pdf" target="_blank" class="btn btn-primary">Descargar</a>
																@else
																<a href="{{asset('documents')}}/{{$participacion->path}}" target="_blank" class="btn btn-primary">Ver Documento Cargado</a>
																@endif
															</div>
															<div class="col-lg-9">
																@if($participacion)
																@else
																<small>Cargar Documento Firmado</small>
																<form method="post" action="{{ url('/socio/documento') }}" enctype="multipart/form-data">
																	<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
																	<input type="hidden" name="tipo" value="participacion" class="">
																	<div class="row">
																		<div class="col-lg-5">
																			<input type="file" name="documento" class="" style="color: transparent;">
																		</div>
																		<div class="col-lg-5">
																			<input type="submit" class="btn btn-success" value="Subir" style="margin-top:-10px;">
																		</div>
																	</div>
																</form>
																@endif
															</div>
														</div>
													</div>
												</div>
											</div>

										</div>
										<div class="col-lg-12">
											<div class="col-lg-6">
											</div>
											<div class="col-lg-6">
												<br><br>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>




			</div>
			<div class="tab-pane" id="profile">
				<div class="jumbotron" >
					<div class="container-fluid container-fixed-lg" style="padding-bottom:0px !important">
						<div class="inner">
							<div class="col-md-1"></div>
							<div class="panel-group col-md-10">
								<br><br>
								<div class="panel panel-info">
									<div class="panel panel-body" style="padding:20px;">

										{!!Form::model($usuario,['url'=> ['/socio/'.$usuario->id.'/update'],'method'=>'PUT', 'enctype'=>'multipart/form-data' ,'novalidate'])!!}
										<div class="row">
											<div class="col-lg-8 col-md-5">
												<div class="form-inline">
													<div class="form-group">
														{!!Form::label('identificacion', 'Identificación', ['class'=>'form-control'])!!}
														{!!Form::text ('identificacion', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
													</div>
												</div>
												<div class="form-group">
													{!!Form::label('nombres', 'Nombres', ['class'=>'form-control'])!!}
													{!!Form::text ('nombres', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
												</div>
												<div class="form-group">
													{!!Form::label('apellidos', 'Apellidos', ['class'=>'form-control'])!!}
													{!!Form::text ('apellidos', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
												</div>
											</div>
											<div class="col-lg-4 col-md-5 foto_perfil">
												@if($usuario->img_perfil)
												<img src="{{asset('img_perfil')}}/{{$usuario->img_perfil}}" alt="Imagen de perfil!" class="img-fluid" width="100">
												@else
												<img src="data:image/png;base64,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" alt="Imagen de perfil!" class="img-fluid" width="100">
												@endif
												{!!Form::file('img_profile')!!}
											</div>

										</div>
										<div class="form-inline">
											<div class="form-group">
												{!!Form::label('email', 'Correo Electrónico', ['class'=>'form-control'])!!}
												{!!Form::email ('email', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
											</div>
										</div>
										<div class="form-group">
											{!!Form::label('telefono','Teléfono', ['class'=>'form-control'])!!}
											{!!Form::text('telefono', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
										</div>

										<div class="form-group">
											{!!Form::label('celular', 'Celular', ['class'=>'form-control'])!!}
											{!!Form::text('celular', null, ['class'=>'form-control','style'=>'margin-top:-5px;'])!!}
										</div>

										{!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
										{!!Form::close()!!}
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="tab-pane" id="estadisticas">
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
									<td class="v-align-middle">${{$valor}} USD</td>
									<td class="v-align-middle">${{$total_conjuntos * $valor }} USD</td>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="panel panel-default col-lg-12x">
						<div class="panel-heading"><div class="panel-title">Proyecto Publicitario</div></div>
						<div class="panel-body" style="padding-bottom:0px !important">
							@if($concepto_texto != "")
							{!! $concepto_texto !!}

							@endif
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>   


@stop

@section('footer')
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

{!!Html::script('build/assets/js/init.js')!!}
{!!Html::script('build/assets/js/datatables.js')!!}
{!!Html::script('build/assets/js/perfil_socio.js')!!}
@stop