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

    <div class="content">

    @include ('errors.success')

	@include ('errors.request')

	@include ('errors.errors')			

		<div class="col-md-1"></div>



			<div class="panel-group col-md-10">

				<div class="panel panel-info">

					<div class="panel-heading">

                		<h3 class="p-b-5 text-primary" style="text-align:center;"><span class="semi-bold">Concepto</span> Publicitario</h3>

            			</br>


            		</div>

					<div class="panel panel-body" style="padding:20px;">
						<input type="hidden" id="body_concepto" value="{{ $concepto }}" />
						{!!Form::open(['route'=>'superadmin.conceptos.store','method'=>'POST'])!!}

						<div class="form-inline">
							<div class="col-md-12" style="margin-top:10px;">
								<textarea class="ckeditor" name="concepto" id="concepto" rows="10" cols="80"></textarea>
							</div>
						</div>
						<br><br>
						{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}
						
						{!!Form::close()!!}

					</div>

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
@section('js_library')
    {!!Html::script('vendor/ckeditor/ckeditor.js')!!}
  
@stop


@section('specific_js')

	{!!Html::script('build/assets/js/script/listaraptos.js')!!}
	{!!Html::script('build/assets/js/script/conceptos.js')!!}

@stop