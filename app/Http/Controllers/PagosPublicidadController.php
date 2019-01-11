<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use DB;

use App\Valores;
use App\PagosPublicidad;
use Carbon\Carbon;

class PagosPublicidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Redirect::to('/pautante');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function CrearPago($tipo)
    {

        $valor = 250;

        if($tipo == 'bonos')
        {
            //Buscar valor de la publicidad

            $valores = Valores::where('modulo','publicidad')->get();

            $valor = $valores->first()->valor;

            $tipo_pago = 1;

        }
        else if($tipo == 'mascotas')
        {
            //Buscar valor de la publicidad

            $valores = Valores::where('modulo','publicidad_mascotas')->get();

            $valor = $valores->first()->valor;

            $tipo_pago = 2;

        }
        else if($tipo == 'motor')
        {
            //Buscar valor de la publicidad

            $valores = Valores::where('modulo','publicidad_motor')->get();

            $valor = $valores->first()->valor;

            $tipo_pago = 3;

        }
        else
        {
            return Redirect::to('/pautante');
        }
        
        return View('backend.pautante.pagospublicidad.crearpago',compact("valor","tipo_pago"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Realizar pago del conjunto

        $user = Auth::user();

        if($user->rol == 'Pautante')
        {
            //Buscar tipo de pago

            $publicidad_tipo = $request->publicidad_tipo;

            $valor = 250;

            if($publicidad_tipo == 1)
            {
                //Obtener valor 

                $valores = Valores::where('modulo','publicidad')->get();

                $valor = $valores->first()->valor;
            }
            else if($publicidad_tipo == 2)
            {
                //Obtener valor 

                $valores = Valores::where('modulo','publicidad_mascotas')->get();

                $valor = $valores->first()->valor;
            }
            else if($publicidad_tipo == 3)
            {
                //Obtener valor 

                $valores = Valores::where('modulo','publicidad_motor')->get();

                $valor = $valores->first()->valor;
            }
            else
            {
                return Redirect::to('/pautante');
            }

            $reference = date("YmdHis");

            $total = number_format($valor,2,".","");

            $token = md5('4Vj8eK4rloUd272L48hsrarnUA'.'~'.'508029'.'~'.$reference.'~'.$total.'~'.'USD');

            $responseUrl = $request->url().'/returnpayu';

            //Guardar datos de pago

            $pago = new PagosPublicidad();

            $pago->usuario_id       = $user->id;
            $pago->publicidad_tipo  = $publicidad_tipo;
            $pago->reference        = $reference;
            $pago->total            = $total;
            $pago->status           = 0;

            $pago->save();

            return view('backend.pautante.pagospublicidad.send',compact("reference","total","token","responseUrl"));

        }
    }

    public function returnpayu()
    {
        //Obtener variables

        $ApiKey = "4Vj8eK4rloUd272L48hsrarnUA";
        $merchant_id = $_REQUEST['merchantId'];
        $referenceCode = $_REQUEST['referenceCode'];
        $TX_VALUE = $_REQUEST['TX_VALUE'];
        $New_value = number_format($TX_VALUE, 1, '.', '');
        $currency = $_REQUEST['currency'];
        $transactionState = $_REQUEST['transactionState'];
        $payment_status = $_REQUEST['lapTransactionState'];
        $firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
        $firmacreada = md5($firma_cadena);
        $firma = $_REQUEST['signature'];
        $reference_pol = $_REQUEST['reference_pol'];
        $cus = $_REQUEST['cus'];
        $extra1 = $_REQUEST['description'];
        $pseBank = $_REQUEST['pseBank'];
        $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
        $transactionId = $_REQUEST['transactionId'];

        //Validar datos

        $data = [];

        $data['error'] = '';

        $act = true;

        if(strtoupper($firma) != strtoupper($firmacreada))
        {
            $act = false;
        }

        //Obtener pago de la base de datos

        $pago = Pagospublicidad::where('reference',$referenceCode)->firstOrFail();

        //Verificar estado del pago

        if($pago->payment_status == $payment_status)
        {
            $act = false;
        }

        //Verificar monto

        if($TX_VALUE < $pago->total)
        {
            $act = false;
        }

        //Verificar que no exista el transaction id por seguridad

        $check = Pagospublicidad::where('transaction_id',$transactionId)->get();

        if(count($check) > 0 AND $check[0]->id != $pago->id)
        {
            $act = false;
        }

        //Actualizar pago

        if($act == true)
        {
            //Actualizar pago
            $datos = [
                'estado_transaccion'    => $transactionState,
                'mensaje'               => $_REQUEST['message'],
                'transaction_id'        => $transactionId,
                'payment_method'        => $lapPaymentMethod,
                'buyer_email'           => $_REQUEST['buyerEmail'],
                'payment_status'        => $payment_status
            ];

            $date = Carbon::now();

            //Chequear si el pago viene aprobado

            if($payment_status == 'APPROVED')
            {
                $datos['status'] = 1;
            }

            Pagospublicidad::findOrFail($pago->id)->update($datos);

        }

        //Mostrar vista

        if ($_REQUEST['transactionState'] == 4 ) {
            $data['estado'] = "Transacción aprobada";
        }

        else if ($_REQUEST['transactionState'] == 6 ) {
            $data['estado'] = "Transacción rechazada";
        }

        else if ($_REQUEST['transactionState'] == 104 ) {
            $data['estado'] = "Error";
        }

        else if ($_REQUEST['transactionState'] == 7 ) {
            $data['estado'] = "Transacción pendiente";
        }

        else {
            $data['estado'] = $_REQUEST['message'];
        }

        $data['transactionId'] = $transactionId;
        $data['reference_pol'] = $reference_pol;
        $data['referenceCode'] = $referenceCode;
        $data['cus'] = $cus;
        $data['pseBank'] = $pseBank;
        $data['TX_VALUE'] = $TX_VALUE;
        $data['currency'] = $currency;
        $data['extra1'] = $extra1;
        $data['lapPaymentMethod'] = $lapPaymentMethod;
        $data['publicidad_tipo'] = $pago->publicidad_tipo;

        return view('backend.pautante.pagospublicidad.returnpayu',['datos' => $data]);
    }

    public function listenerpayu(Request $request) //Listener de payu
    {
        //Ordenar variables

        file_put_contents("../post.log", 'Si ha llegado la peticion de payu de compra de PUBLICIDAD del '.$request->reference_sale.' el dia '.date('Y-m-d H:i:s'), FILE_APPEND | LOCK_EX);

        $merchant_id = $request->merchant_id;

        $estado_tran = $request->state_pol;

        $payment_status = $request->response_message_pol;

        $mensaje = $request->description;

        $reference = $request->reference_sale;

        $transaction_id = $request->transaction_id;

        $payment_method = $request->payment_method_name;

        $amount = $request->value;

        $currency = $request->currency;

        $buyer_email = $request->email_buyer;

        //Verificar merchant id

        if($merchant_id != "508029")
        {
            return response('error merchant id', 401); 
        }

        //Verificar moneda

        if($currency != 'USD')
        {
            return response('error currency', 401);
        }

        //Obtener pago de la base de datos

        $pago = Pagospublicidad::where('reference',$reference)->firstOrFail();

        //Verificar estado del pago

        if($pago->payment_status == $payment_status)
        {
            return response('error payment status', 401);
        }

        //Verificar monto

        if($amount < $pago->total)
        {
            return response('error total', 401);
        }

        //Verificar que no exista el transaction id por seguridad

        $check = Pagospublicidad::where('transaction_id',$transaction_id)->get();

        if(count($check) > 0 AND $check[0]->id != $pago->id)
        {
            return response('error transaction id', 401);
        }

        //Actualizar pago

        $datos = [
            'estado_transaccion'    => $estado_tran,
            'mensaje'               => $mensaje,
            'transaction_id'        => $transaction_id,
            'payment_method'        => $payment_method,
            'buyer_email'           => $buyer_email,
            'payment_status'        => $payment_status
        ];

        $date = Carbon::now();

        //Chequear si el pago viene aprobado

        if($payment_status == 'APPROVED')
        {
            $datos['status'] = 1;
        }

        Pagospublicidad::findOrFail($pago->id)->update($datos);

        return response('success', 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
