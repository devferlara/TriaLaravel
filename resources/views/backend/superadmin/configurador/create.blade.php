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



<div class="container-fluid">
	<div class="row">


		@include ('errors.success')
		@include ('errors.request')
		@include ('errors.errors')			

		
		<div class="col-md-12">

			<div class="card mb-4">
				<div class="card-body ">
					<div style="text-align: center;">	
						<h1  style="text-align:center;"><span class="semi-bold">Concepto</span> Publicitario</h1>
					</div>
					
					<input type="hidden" id="body_concepto" value="{{ $concepto }}" />
					{!!Form::open(['route'=>'superadmin.conceptos.store','method'=>'POST'])!!}
					<div class="form-inline">
						<div class="col-md-12" style="margin-top:10px;">
							<textarea name="concepto" id="ckEditorClassic"></textarea>
						</div>
					</div>
					<br><br>
					
					{!!Form::submit('Crear', ['class'=>'btn btn-primary'])!!}
					
					{!!Form::close()!!}
					
				</div>
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




