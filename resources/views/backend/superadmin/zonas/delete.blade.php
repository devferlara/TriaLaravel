@extends ('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section ('sidebar')
@include('backend.menu.superadmin')
@stop

@section ('head')
	@include ('layout.head')
@stop

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
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Eliminar</span> Zonas</h3>
                		</br>
                		<p class="text-info">Desde el siguiente formulario podras eliminar los zonas correspondientes a su conjunto, sin embargo recuerda, que este proceso solo puede hacer un administrador.! </p>
            		</div>
            		<div class="panel panel-body" style="padding:20px;">
						{!!Form::model($zona,['route'=> ['superadmin.zonas.destroy',$zona->id],'method'=>'DELETE'])!!}
							<div class="">
        						<h4><span class="semi-bold">ELIMINAR ZONA:</span> <span style="font-style:oblique; font-size:1.2em;">{{$zona->tipo}} {{$zona->zona}}</span></h4>
        						<p class="p-b-10">¿Estas seguro de eliminar este usuario, no podras recuperarlo luego de haber confirmado la eliminación?</p>
    						</div>
   			 		<div class="">
    					<p class="p-b-10">Si es así, dale click en eliminar, sino puedes cancelar esta solicitud</p>
    				</div>
					{!!Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
					{!!link_to_route('superadmin.zonas.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
					{!!Form::close()!!}
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section ('footer')
	@include ('layout.footer')
@stop