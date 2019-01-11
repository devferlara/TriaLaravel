@extends('layout.mensajes')

<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
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
                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Editar</span> Factura para un propietario</h3>
                        </br>
                        <h4 class="text-info">Podrá actualizar una factura para el propietario de forma manual. </h4>
                    </div>
                    <div class="panel panel-body" style="padding:20px;">
                            <div class="row column-seperation">
                                <div class="col-md-12">
                                    {!!Form::open(['route'=>['administrador.facturas.updatefactura',$factura->id],'method'=>'PUT'])!!}
                                    <div class="form-inline">
                                        <div class="col-md-12">
                                            <div class="col-md-6 form-group">
                                                {!!Form::label('fecha_corte', 'Fecha de corte', ['class'=>'form-label'])!!}
                                            {!!Form::date('fecha_corte', $factura->fecha_corte ,['class' => 'form-control'])!!}
                                            </div>
                                            <div class="col-md-6 form-group">
                                                {!!Form::label('nombre_propietaria', 'Nombre del propietario', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                                                {!!Form::text ('nombre_propietaria', $factura->nombre_propietaria, ['class'=>'form-control', 'placeholder'=>'Nombre del propietario(a)', 'style'=>'width:100%'])!!}
                                            </div>
                                            <div class="col-md-6 form-group">
                                              	{!!Form::label('valor_adeudado', 'Valor Adeudado', ['class'=>'form-label'])!!}
                                            	{!!Form::text ('valor_adeudado', $factura->valor_adeudado, ['class'=>'form-control', 'placeholder'=>'$ valor adeudado', 'style'=>'width:100%'])!!}
                                            </div>
                                            <div class="col-md-6 form-group">
                                            	{!!Form::label('matricula_inmobiliaria', 'Apartamento', ['class'=>'form-label'])!!}
                                              	<select name="matricula_inmobiliaria" id="matricula_inmobiliaria" class="form-control" style="width:100%">
                                              		@if(count($apartamentos) > 0)
	                                              		@foreach($apartamentos as $apto)
	                                              		<option value="{{$apto->matricula_inmobiliaria}}" <?= $factura->matricula_inmobiliaria == $apto->matricula_inmobiliaria?'selected':''?> >{{$apto->descripcion}}</option>
	                                              		@endforeach
	                                              	@endif
                                              	</select>
                                            </div>
                                        </div>                                            
                                    </div>

                                    <div class="col-md-12" style="margin-top:10px">

                                    	<div class="col-md-6 form-group">
                                            {!!Form::label('coeficiente_inmueble', 'Coeficiente inmueble', ['class'=>'form-label'])!!}
                                            {!!Form::text ('coeficiente_inmueble', $factura->coeficiente_inmueble, ['class'=>'form-control', 'placeholder'=>'Coeficiente del inmueble', 'style'=>'width:100%'])!!}
                                        </div>

                                        <div class="col-md-6 form-group">
                                            {!!Form::label('concepto_pago', 'Concepto de pago', ['class'=>'form-label'])!!}
                                           	{!!Form::text ('concepto_pago', $factura->concepto_pago, ['class'=>'form-control', 'placeholder'=>'Concepto de pago de la factura', 'style'=>'width:100%'])!!}
                                        </div>
                                   </div>

                                   <div class="col-md-12" style="margin-top:10px">

                                    	<div class="col-md-6 form-group">
                                            {!!Form::label('saldo_mes_anterior', 'Saldo del mes anterior', ['class'=>'form-label'])!!}
                                            {!!Form::text ('saldo_mes_anterior', $factura->saldo_mes_anterior, ['class'=>'form-control', 'placeholder'=>'Saldo del mes anterior', 'style'=>'width:100%'])!!}
                                        </div>

                                        <div class="col-md-6 form-group">
                                            {!!Form::label('saldo_anterior', 'Saldo anterior', ['class'=>'form-label'])!!}
                                           	{!!Form::text ('saldo_anterior', $factura->saldo_anterior, ['class'=>'form-control', 'placeholder'=>'Saldo anterior', 'style'=>'width:100%'])!!}
                                        </div>
                                   </div>

                                   <div class="col-md-12" style="margin-top:10px">

                                    	<div class="col-md-6 form-group">
                                            {!!Form::label('nuevo_saldo', 'Nuevo saldo', ['class'=>'form-label'])!!}
                                            {!!Form::text ('nuevo_saldo', $factura->nuevo_saldo, ['class'=>'form-control', 'placeholder'=>'Nuevo saldo', 'style'=>'width:100%'])!!}
                                        </div>

                                        <div class="col-md-6 form-group">
                                            {!!Form::label('total_mes', 'Total mes', ['class'=>'form-label'])!!}
                                           	{!!Form::text ('total_mes', $factura->total_mes, ['class'=>'form-control', 'placeholder'=>'Total del mes', 'style'=>'width:100%'])!!}
                                        </div>
                                   </div>

                                   <div class="col-md-12" style="margin-top:10px">

                                        <div class="col-md-6 form-group">
                                            {!!Form::label('correo_conjunto', 'Correo electrónico del conjunto', ['class'=>'form-label'])!!}
                                           	{!!Form::email ('correo_conjunto', $factura->correo_conjunto, ['class'=>'form-control', 'placeholder'=>'ejemplo@conjunto.om', 'style'=>'width:100%'])!!}
                                        </div>

                                        <div class="col-md-6 form-group">
                                            	{!!Form::label('estado', 'Estado', ['class'=>'form-label'])!!}
                                              	<select name="estado" id="estado" class="form-control" style="width:100%">
                                              		<option value="1" <?= $factura->estado == 1?'selected':''?>>Por pagar</option>
                                              		<option value="2" <?= $factura->estado == 2?'selected':''?>>Pagado</option>
                                              		<option value="3" <?= $factura->estado == 3?'selected':''?>>Anulado</option>
                                              	</select>
                                            </div>
                                   </div>

                                   <input type="hidden" name="id_csv" value="{{$id_csv}}">

                                        <div class="col-md-6 form-group" style="margin-top:20px;">
                                          
                                        <div style="float:none;">
                                        {!!Form::submit('Guardar y Enviar', ['class'=>'btn btn-primary'])!!}
                                        {!!link_to_route('administrador.facturas.index',  $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
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


@section('js_library')
{!!Html::script('vendor/ckeditor/ckeditor.js')!!}
@stop

@section('specific_js')
<script>

    CKEDITOR.replace('descripcion');

    CKEDITOR.replace( 'descripcion', {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
  });
</script>

@stop