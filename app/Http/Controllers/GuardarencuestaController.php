<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\encuestasRespuestas;
use Auth;
use DB;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;


class GuardarencuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guardar_datos = array(
            array(
                'id_usuario' => 154,
                'id_pregunta' => 2,
                'id_respuesta' => 4,
            ),

            array(
                'id_usuario' => 154,
                'id_pregunta' => 31,
                'id_respuesta' => 33,

            ),

            array(
                'id_usuario' => 154,
                'id_pregunta' => 5,
                'id_respuesta' => 476,

            ),
        );

        
        foreach($guardar_datos as $guardar){
            $encuestasRespuestas = new encuestasRespuestas();
            $encuestasRespuestas->id_usuario = $guardar['id_usuario'];
            $encuestasRespuestas->id_pregunta = $guardar['id_pregunta'];
            $encuestasRespuestas->id_respuesta = $guardar['id_respuesta'];
            $encuestasRespuestas->save();
        }

        return ['status' => 'ok'];
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
}
