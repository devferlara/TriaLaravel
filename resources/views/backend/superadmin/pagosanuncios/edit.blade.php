@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.superadmin')
@stop

<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header -->
@include('layout.head')

@stop

@section('css')
{!!Html::style('build/assets/plugins/multiple-select/multiple-select.css')!!}

@stop

@section('content')

<div class="page-content-wrapper">
    <div class="content">
    @include ('errors.success')
    @include ('errors.request')
    @include ('errors.errors')          
        <div class="col-md-1"></div>

            <div class="panel-group col-md-10">

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Nuevo</span> Pago</h3>
                        </br>
                        <h4 class="text-info">Podrás crear nuevos pagos de anuncios de tipo manual o Payu.  </h4>
                    </div>
                    <div class="panel panel-body" style="padding:20px;">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    {!!Form::model(null,['route'=> ['superadmin.pagosanuncios.update',$pago->id],'method'=>'PUT'])!!}
                                    <div class="form-inline">
                                        <div class="col-md-12">
                                        	<div class="col-md-4 form-group">
                                            	<label for="tipo_pago">Tipo de pago</label>
                                                <select class="full-width" data-init-plugin="select2" id="tipo_pago" name="tipo_pago">
                                                <optgroup label="Seleccione un tipo de pago">
                                                	<option value="1">PAYU</option>
                                                	<option value="2" <?= $pago->tipo_pago == 2?'selected':''?>>Manual</option>
                                                </optgroup>
                                            </select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                            	<label for="usuario_id">Pautante</label>
                                                <select class="full-width" data-init-plugin="select2" id="usuario_id" name="usuario_id">
	                                                <optgroup label="Seleccione un administrador">
	                                                	@foreach($pautantes as $admin)
	                                                		<option value="{{$admin->id}}" <?= $pago->usuario_id == $admin->id?'selected':''?>>{{$admin->nombres}} {{$admin->apellidos}}</option>
	                                                	@endforeach
	                                                </optgroup>
                                            	</select>
                                            </div>
                                            <div class="col-md-4 form-group">
                                            	<label for="publicidad_tipo">Tipo de auncio</label>
                                                <select class="full-width" data-init-plugin="select2" id="publicidad_tipo" name="publicidad_tipo">
	                                                <optgroup label="Elija el tipo de anuncio">
	                                                	<option value="1">Bono de descuento</option>
	                                                	<option value="2" <?= $pago->tipo_pago == 2?'selected':''?>>Club de mascotas</option>
	                                                	<option value="3" <?= $pago->tipo_pago == 3?'selected':''?>>Club de motores</option>
	                                                </optgroup>
                                            	</select>
                                            </div>
                                            
                                            
                                        </div>                                            
                                    </div>

                                    <div class="form-inline">
                                    	<div class="col-md-4 form-group">
                                                {!!Form::label('reference', 'Referencia', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                                                {!!Form::text ('reference', $pago->reference, ['class'=>'form-control', 'placeholder'=>'Número de referencia del pago 0000000', 'style'=>'width:100%'])!!}
                                            </div>
                                    	<div class="col-md-4 form-group">
                                                {!!Form::label('total', 'Total', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                                                {!!Form::text ('total', $pago->total, ['class'=>'form-control', 'placeholder'=>'Total del pago (USD)', 'style'=>'width:100%'])!!}
                                            </div>
                                        <div class="col-md-4 form-group" style="margin-top:10px;">
                                            {!!Form::label('payment_status', 'Estado del pago', ['class'=>'form-label'])!!}
                                            <select class="full-width" data-init-plugin="select2" id="payment_status" name="payment_status">
                                                <optgroup label="Seleccione un estado">
                                                    <option value="1">Aprobado</option>
                                                   	<option value="0" <?= $pago->payment_status == 'Pending'?'selected':''?>>Pendiente</option>
                                                   	<option value="2" <?= $pago->payment_status == 'Vencido'?'selected':''?>>Vencido</option>
                                                </optgroup>
                                            </select>
                                        </div>

                                        
                                    </div>

                                    <div class="form-inline">
                                    	<div class="col-md-4 form-group" style="margin-top:10px;">
                                            {!!Form::label('transaction_id', 'ID de la transacción', ['class'=>'form-label'])!!}
                                            {!!Form::text ('transaction_id', $pago->transaction_id, ['class'=>'form-control', 'placeholder'=>'ID de la transacción en caso de ser Payu', 'style'=>'width:100%'])!!}
                                        </div>

                                        <div class="col-md-4 form-group" style="margin-top:10px;">
                                            {!!Form::label('buyer_email', 'Correo electrónico', ['class'=>'form-label'])!!}
                                            {!!Form::email ('buyer_email', $pago->buyer_email, ['class'=>'form-control', 'placeholder'=>'comprador@comprador.com', 'style'=>'width:100%'])!!}
                                        </div>
                                       

                                        <div class="col-md-4 form-group" style="margin-top:10px;">
                                            {!!Form::label('payment_method', 'Metodo de pago', ['class'=>'form-label'])!!}
                                            {!!Form::text ('payment_method', $pago->payment_method, ['class'=>'form-control', 'placeholder'=>'MASTERCARD, Efectivo', 'style'=>'width:100%'])!!}
                                        </div>
                                    </div>
                                        <div class="col-md-6 form-group" style="margin-top:20px;">
                                        <div style="float:none;">
                                        {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
                                        {!!link_to_route('superadmin.pagosanuncios.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                                        </div>
                                        </div>
                                        <div class="col-md-6 form-group"></div>
                                    {!!Form::close()!!}
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@stop

@section ('footer')
    @include('layout.footer')
@stop
