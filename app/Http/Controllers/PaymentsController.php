<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alexo\LaravelPayU\LaravelPayU;
use App\Order;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function pay(Request $request) {

      $data = [
        \PayUParameters::DESCRIPTION => 'Payment cc test',
        \PayUParameters::IP_ADDRESS => '127.0.0.1',
        \PayUParameters::CURRENCY => 'COP',
        \PayUParameters::CREDIT_CARD_NUMBER => '234234242425242132352',
        \PayUParameters::CREDIT_CARD_EXPIRATION_DATE => '2012/02',
        \PayUParameters::CREDIT_CARD_SECURITY_CODE => '1234',
        \PayUParameters::INSTALLMENTS_NUMBER => 1
    ];

    $order = new Order();

    $order->payWith($data, function($response, $order) {
      dd($response);

    },function($error) {
      dd($error);
    });

    dd($order);
  }
}
