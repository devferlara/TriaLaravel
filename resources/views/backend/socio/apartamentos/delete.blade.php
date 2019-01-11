@extends ('layout.admin')

@section ('meta')
    <meta name="viewport" content="width=device-width, initial-scale=1">
@stop

@section ('sidebar')
@include('backend.menu.administrador')
@stop

@section ('head')
	@include ('layout.head')
@stop

@section ('content')

<div class="page-content-wrapper">
    <div class="content">			
		<div class="col-md-1"></div>

			<div class="panel-group col-md-10">
				<div class="panel panel-info">
					<div class="panel-heading">
                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Eliminar</span> Apartamentos</h3>
                		</br>
                		<p class="text-info">Desde el siguiente formulario podras eliminar los apartamentos, sin embargo recuerda, que este proceso solo puede hacer un administrador.! </p>
            		</div>
            		<div class="panel panel-body" style="padding:20px;">
						{!!Form::model($apartamento,['route'=> ['administrador.apartamentos.destroy',$apartamento->id],'method'=>'DELETE'])!!}
							<div class="">
        						<h4><span class="semi-bold">ELIMINAR APARTAMENTO:</span> <span style="font-style:oblique; font-size:1.2em;">{{$apartamento->apartamento}}</span></h4>
        						<h5 class="p-b-10">¿Estas seguro de eliminar este apartamento, no podras recuperarlo luego de haber confirmado la eliminación?, además se borraran tambien los enlaces con los usuarios y apartamentos</h5>
    						</div>
   			 		<div class="">
    					<p class="p-b-10">Si es así, dale click en eliminar, sino puedes cancelar esta solicitud</p>
    				</div>
					{!!Form::submit('Eliminar', ['class'=>'btn btn-danger'])!!}
					{!!link_to_route('administrador.apartamentos.index', $title = 'Cancelar', $parameters = null, $attributes = ['class'=>'btn btn-primary'])!!}
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