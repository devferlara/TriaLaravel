
@extends('layout.admin')

@section ('meta')
<meta name="viewport" content="width=device-width, initial-scale=1">
@stop
<!-- Create General Section Sidebar -->
@section('sidebar')
<!-- Include the menu -->
@include('backend.menu.administrador')
@endsection
<!-- Create General Section Header -->
@section('head')
<!-- Include the profile header--> 
@include ('layout.head')
@endsection

@section ('content')

<script>

	window.onload = function()
	{
		$('#payu_form').submit();  
	}

</script>

<div class="container-fluid">
	<div class="row">
		@include ('errors.success')
		@include ('errors.request')
		@include ('errors.errors')
		<div class="col-lg-12 col-md-12">
			<div class="card mb-4">
				<div class="card-body ">
					<h3>Por favor Espere...</h3>	
					<h5 class="text-info">Lo estamos redireccionando a la plataforma de pago. </h5>
				</div>
			</div>
		</div>
	</div>
</div>



<form action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu" id="payu_form" method="post">

	<input type="hidden" value="1" name="test">
	<input name="accountId" type="hidden" value="512321">
	<input type="hidden" value="508029" name="merchantId">
	<input type="hidden" value="<?php echo $reference;?>" name="referenceCode">
	<input type="hidden" value="Pago Membresia TriaGroup con Payu Ref# <?php echo $reference;?>" name="description">
	<input type="hidden" value="<?php echo $total;?>" name="amount">
	<input type="hidden" value="{{Auth::user()->email}}" name="buyerEmail">
	<input type="hidden" value="0.00" name="tax">
	<input type="hidden" value="" name="extra1">
	<input type="hidden" value="0.00" name="taxReturnBase">
	<input type="hidden" value="USD" name="currency">
	<input type="hidden" value="ES" name="lng">
	<input type="hidden" value=<?php echo $token;?> name="signature">
	<input type="hidden" value="<?php echo $responseUrl ?>" name="responseUrl">
	<input type="hidden" value="{{ action('PagosController@listenerpayu') }}" name="confirmationUrl">
	<button type="submit" value="enviar">enviar</button>
</form>


<!-- value=100.00
email_buyer=test@payulatam.com
response_message_pol=ENTITY_DECLINED
transaction_id=f5e668f1-7ecc-4b83-a4d1-0aaa68260862
payment_method_name=VISA
state_pol=6
currency=USD
merchant_id=508029
reference_sale=2015-05-27 13:04:37 -->

<!-- <form action="http://triagroup.co/pagos/listenerpayu" id="payu_form" method="post">

<input type="hidden" value="{{ action('PagosController@listenerpayu') }}" name="url">
<input type="hidden" value="1" name="test">
<input type="hidden" value="508029" name="merchant_id">
<input type="hidden" value="4" name="state_pol">
<input type="hidden" value="Este es el mensaje" name="description">
<input type="hidden" value="<?php echo $reference;?>" name="reference_sale">
<input type="hidden" value="f5e668f1-7ecc-4b83-a4d1-0aaa68220262" name="transaction_id">
<input type="hidden" value="MASTERCARD" name="payment_method_name">
<input type="hidden" value="<?php echo $total;?>" name="value">
<input type="hidden" value="APPROVED" name="response_message_pol">
<input type="hidden" value="USD" name="currency">
<input type="hidden" value="{{Auth::user()->email}}" name="email_buyer">


<button type="submit" value="enviar">enviar</button>
</form> -->

@endsection



@section ('footer')

@include ('layout.footer')
{!!Html::script('build/assets/js/script/listaraptos.js')!!}

@stop


