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

                        <h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold"> Nueva </span> Zona </h3>

                        </br>

                        <h5 class="text-info">Crear la zona de tu conjunto completando el siguiente formulario. ¡Es fácil, recuerda que todos los campos son requeridos *.! </h5>

                    </div>

                <div class="panel panel-body" style="padding:20px;">

                   {!!Form::open(['route'=> ['superadmin.zonas.store'],'method'=>'POST'])!!}

                <div class="form-group">

                    {!!Form::label('conjunto', 'Conjunto Residencial', ['class'=>'form-control'])!!}
		
		    {{--*/ $conjuntosA[0]="Por favor seleccione una opcion"; 
			foreach($conjuntos as $key=>$con){
				
				$conjuntosA[$key]=$con;
			}
		     /*--}}
                    {!!Form::select('conjunto' , $conjuntosA,  null,  ['class' => 'form-control'])!!}

                    </div>

                <div class="form-group">

                    {!!Form::label('tipo','Tipo de Unidad',['class'=>'form-control'])!!}



                    <select class="full-width" data-init-plugin="select2" id="tipo" name="tipo">

                                <optgroup label="Seleccione el tipo de Unidad Residencial">

                                    <option value="Torre">Torre</option>

                                    <option value="Casa">Casa</option>

                                    <option value="Local">Local</option>

                                    <option value="Oficina">Oficina</option>

                                    <option value="Piso">Piso</option>

                                    <option value="Manzana">Manzana</option>

                                    <option value="Bodega">Bodega</option>

                                    <option value="Bloque">Bloque</option>

                                    <option value="Interior">Interior</option>

                                    <option value="Consejo">Consejo</option>

                                    <option value="Parqueadero">Parqueadero</option>

                                    <option value="Garaje">Garaje</option>

                                    <option value="Etapa">Etapa</option>

                                </optgroup>

                            </select>



                        <div class="form-group">

                            {!!Form::label('zona','Unidad',['class'=>'form-control'])!!}

                            {!!Form::text ('zona', null, ['class'=>'form-control' , 'placeholder'=>'# Unidad', 'id'=>'zona'])!!}

                        </div>

                </div>

                <div class="form-group">

                    {!!Form::submit('Crear Zona', ['class'=>'btn btn-primary'])!!}

                    {!!link_to_route('superadmin.zonas.index', $title = 'Cancelar', $parameters = '', $attributes = ['class'=>'btn btn-danger'])!!}       

                </div>

                {!!Form::close()!!}  

             </div>

            </div>

        </div>

        <div class="col-md-1"></div>

    </div>

</div>

@stop



@section ('footer')

 @include ('layout.footer')

@stop

