@extends('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
    <!-- Include the menu -->
    @include('backend.menu.usuario')
@endsection
        <!-- Create General Section Header -->
@section('head')
    <!-- Include the profile header--> 
    @include ('layout.head')
@endsection

@section ('content')
<div class="page-content-wrapper">
    <div class="content">
    @include ('errors.success')
	@include ('errors.request')
	@include ('errors.errors')			
		<div class="col-md-1"></div>

			<div class="panel-group col-md-10">
				<div class="panel panel-info">
					<div class="panel-heading">
                        <i class="fa fa-car" style="font-size: 50px;"></i>
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Actualizar tu </span> Vehiculo</h3>
            			</br>
                		<h5 class="text-info">Ahora que ya tienes vehiculos registrados en el Club Motor, solo debes actualizarlos cuantas veces quieras. Recuerda que todos los campos son requeridos *.! </h5>
            		</div>
            	<div class="panel panel-body" style="padding:30px;">
                    {!!Form::model($vehiculo,['route'=> ['usuario.clubmotor.update', $vehiculo->id],'method'=>'PUT'])!!}
                    <div class="form-inline">
                        <div class="col-md-4 form-group">
                            {!!Form::label('tipo', 'Tipo de Vehiculo' , ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::select('tipo',[
                            'Automovil'=>'Automóvil', 
                            'Bicicleta'=>'Bicicleta',
                            'Bicimotor'=>'Bicicleta a Motor',
                            'Camioneta'=>'Camioneta',
                            'Motocicleta'=>'Motocicleta',
                            ],null, ['class'=>'form-group','style'=>'width:100%'])!!}
                        </div>
                        <div class="col-md-4 form-group">
                            {!!Form::label('placa', 'Placa del Vehiculo', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::text ('placa', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Ingresa la placa'])!!}
                        </div>
                        <div class="col-md-4 form-group">
                        {!!Form::label('cantidad', 'Selecciona la cantidad de vehiculos' , ['class'=>'form-label'])!!}
                        {!!Form::select('cantidad',['1'=>'1', '2'=>'2','3'=>'3','4'=>'4'],null, ['class'=>'form-group','style'=>'width:100%'])!!}
                        </div>
                    </div>
                    <div class="form-inline">
                    <div class="col-md-4 form-group" style="margin-top:20px; width:100%;">
                        {!!Form::label('marca', 'Selecciona la marca de tu vehiculo' , ['class'=>'form-label'])!!}
                        {!!Form::select('marca',[
                            'Vehiculos' =>[
                            'Audi'=>'Audi', 
                            'BMW'=>'BMW',
                            'Brilliance'=>'Brilliance',
                            'BYD'=>'BYD',
                            'Chana'=>'Chana',
                            'Chevrolet'=>'Chevrolet',
                            'Chrysler'=>'Chrysler',
                            'Citroen'=>'Citroen',
                            'Daewoo'=>'Daewoo',
                            'Daihatsu'=>'Daihatsu',
                            'Dodge'=>'Dodge',
                            'Fiat'=>'Fiat',
                            'Ford'=>'Ford',
                            'Great Wall'=>'Great Wall',
                            'Honda'=>'Honda',
                            'Hyundai'=>'Hyundai',
                            'Jeep'=>'Jeep',
                            'Kia'=>'Kia',
                            'Lada'=>'Lada',
                            'Land Rover'=>'Land Rover',
                            'Mahindra'=>'Mahindra',
                            'Mazda'=>'Mazda',
                            'Mercedes Benz'=>'Mercedes Benz',
                            'MG'=>'MG',
                            'Mini'=>'Mini',
                            'Mitsubishi'=>'Mitsubishi',
                            'Nissan'=>'Nissan',
                            'Peugeot'=>'Peugeot',
                            'Porsche'=>'Porsche',
                            'Renault'=>'Renault',
                            'Seat'=>'Seat',
                            'Skoda'=>'Skoda',
                            'Ssang Young'=>'Ssang Young',
                            'Subaru'=>'Subaru',
                            'Suzuki'=>'Suzuki',
                            'Toyota'=>'Toyota',
                            'Volkswagen'=>'Volkswagen',
                            'Volvo'=>'Volvo',
                            'Zotye'=>'Zotye',
                            'Otra'=>'Otra'],
                            'Motocicletas' =>[
                            'AKT'=>'AKT',
                            'Aprilia'=>'Aprilia',
                            'Auteco'=>'Auteco',
                            'Bajaj'=>'Bajaj',
                            'BMW'=>'BMW',
                            'Ducati'=>'Ducati',
                            'Harley Davidson'=>'Harley Davidson',
                            'Honda'=>'Honda',
                            'Kawasaki'=>'Kawasaki',
                            'Kymco'=>'Kymco',
                            'KTM'=>'KTM',
                            'Royal Enfield'=>'Royal Enfield',
                            'Suzuki'=>'Suzuki',
                            'Triumph'=>'Triumph',
                            'Vespa'=>'Vespa',
                            'Yamaha'=>'Yamaha',
                            'Otra'=>'Otra'],
                            'Bicicletas' =>[
                            'Bicicleta'=>'Bicicleta',
                            'Bicimotor'=>'Bicicleta a Motor'
                            ],
                            ],null, ['class'=>'form-group','style'=>'width:100%']
                            )!!}
                    </div>

                    <div class="col-md-4 form-group" style="margin-top:20px; width:100%;">
                            {!!Form::label('modelo', 'Modelo de tu Vehiculo', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::text ('modelo', null, ['class'=>'form-control', 'style'=>'width:100%', 'placeholder'=>'Modelo del Vehiculo Ej: Aveo - Mazda 3 - etc'])!!}
                    </div>

                    <div class="col-md-4 form-group" style="margin-top:20px; width:100%;">
                        {!!Form::label('color', 'Selecciona el color de tu vehiculo' , ['class'=>'form-label'])!!}
                        {!!Form::select('color',[
                            'Color del Vehiculo' =>[
                            'Amarillo'=>'Amarillo', 
                            'Azul'=>'Azul',
                            'Blanco'=>'Blanco',
                            'Beige'=>'Beige',
                            'Cafe'=>'Café',
                            'Celeste'=>'Celeste',
                            'Crema'=>'Crema',
                            'Dorado'=>'Dorado',
                            'Esmeralda'=>'Esmeralda',
                            'Fucsia'=>'Fucsia',
                            'Granate'=>'Granate',
                            'Gris'=>'Gris',
                            'Limon'=>'Limón',
                            'Marron'=>'Marron',
                            'Morado'=>'Morado',
                            'Naranja'=>'Naranja',
                            'Negro'=>'Negro',
                            'Plata'=>'Plata',
                            'Rojo'=>'Rojo',
                            'Verde'=>'Verde'
                            ],
                            ],null, ['class'=>'form-group','style'=>'width:100%']
                            )!!}
                    </div>
                </div>
                    <div class="form-inline">
                        <div class="col-md-4 form-group" style="margin-top:20px;">
                            {!!Form::label('parqueadero', 'Tiene servicio de Parqueadero?', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::select('parqueadero',['0'=>'NO', '1'=>'SI'],null, ['class'=>'form-group','style'=>'width:100%'])!!}
                        </div>
                        <div id= "mostrardatosparqueadero">
                            <div class="col-md-4 form-group" style="text-align:center; margin-top:20px;">
                            {!!Form::label('tipo_parqueadero', 'Tipo de Parqueadero', ['class'=>'form-label', 'style'=>'width:100%'])!!}
                            {!!Form::label('comunal', 'Comunal', ['class'=>'form-label'])!!}
                            {!!Form::radio('tipo_parqueadero','Comunal', ['class'=>'radio radio-success'])!!}
                            {!!Form::label('privado', 'Privado', ['class'=>'form-label'])!!}
                            {!!Form::radio('tipo_parqueadero','Privado')!!}
                            </div>
                           <div class="col-md-4 form-group" style="margin-top:20px;">
                              {!!Form::label('numero_parqueadero','Número de Parqueadero', ['class'=>'form-label'])!!}
                              {!!Form::text('numero_parqueadero', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el # de parqueadero'])!!}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" style="margin:20px;">
                    {!!Form::submit('Actualizar', ['class'=>'btn btn-primary'])!!}
                    {!!link_to_route('usuario.clubmotor.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-danger'])!!}
                    {!!Form::close()!!}
                </div>
            </div>
        <div class="col-md-1"></div>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>
@endsection

@section ('footer')
 @include ('layout.footer')
@stop

@section('specific_js')

    {!!Html::script('build/assets/js/script/parqueadero.js')!!}
@stop