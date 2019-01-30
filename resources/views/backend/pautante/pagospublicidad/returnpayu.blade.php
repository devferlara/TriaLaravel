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

<div class="container-fluid">
	<div class="row">
		@include ('errors.success')
		@include ('errors.request')
		@include ('errors.errors')
		<div class="col-lg-12 col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Listo</span> ¡Se ha recibido su pago!</h3>
					<h5 class="text-info">El sistema esta esperando la confirmación de su pago. </h5>

					<?php if ($datos['error'] == '') {?>
				<div class="col-md-12" style="margin-top: 20px;">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<h2>Resumen Transacción</h2>
						<table>
							<tr>
								<td>Estado de la transaccion</td>
								<td><?php echo $datos['estado']; ?></td>
							</tr>
							<tr>
								<tr>
									<td>ID de la transaccion</td>
									<td><?php echo $datos['transactionId']; ?></td>
								</tr>
								<tr>
									<td>Referencia de la venta</td>
									<td><?php echo $datos['reference_pol']; ?></td>
								</tr>
								<tr>
									<td>Referencia de la transaccion</td>
									<td><?php echo $datos['referenceCode']; ?></td>
								</tr>
								<tr>
									<?php
									if($datos['pseBank'] != null) {
										?>
										<tr>
											<td>cus </td>
											<td><?php echo $datos['cus']; ?> </td>
										</tr>
										<tr>
											<td>Banco </td>
											<td><?php echo $datos['pseBank']; ?> </td>
										</tr>
										<?php
									}
									?>
									<tr>
										<td>Valor total</td>
										<td>$<?php echo number_format($datos['TX_VALUE']); ?></td>
									</tr>
									<tr>
										<td>Moneda</td>
										<td><?php echo $datos['currency']; ?></td>
									</tr>
									<tr>
										<td>Descripción</td>
										<td><?php echo ($datos['extra1']); ?></td>
									</tr>
									<tr>
										<td>Entidad:</td>
										<td><?php echo ($datos['lapPaymentMethod']); ?></td>
									</tr>
								</table>
								@if($datos['publicidad_tipo'] == 1)
								{!!link_to_route('pautante.publicidad.bonos.create', $title = 'Crear anuncio',$parameters = null,$attributes = ['class'=>'btn btn-primary','style' => 'margin-top:22px'])!!}
								@elseif($datos['publicidad_tipo'] == 2)
								{!!link_to_route('pautante.publicidad.clubmascotas.create', $title = 'Crear anuncio',$parameters = null,$attributes = ['class'=>'btn btn-primary','style' => 'margin-top:22px'])!!}
								@elseif($datos['publicidad_tipo'] == 3)
								{!!link_to_route('pautante.publicidad.clubmotor.create', $title = 'Crear anuncio',$parameters = null,$attributes = ['class'=>'btn btn-primary','style' => 'margin-top:22px'])!!}
								@endif
								
							</div>
							<div class="col-md-3"></div>
						</div>
						<?php
					}
					else
					{
						?>
						<h5>Error validando firma digital.</h5>
						<?php
					}
					?>

				</div>
			</div>
		</div>
	</div>
</div>


@endsection


@section ('footer')
@include ('layout.footer')
{!!Html::script('build/assets/js/script/listaraptos.js')!!}
@stop

