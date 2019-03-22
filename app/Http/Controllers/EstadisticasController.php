<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\preguntas;
use App\encuestas;
use DB;
use Storage;
use Crypt;
use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class EstadisticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        
    }

    public function index2($id)
    {   

        $user = Auth::user();
        $preguntas = preguntas::where('encuesta_id', '=', $id)
        ->where('Active', '=', 1)
        ->get();
        $encuestas = encuestas::where('id', '=', $id)
        ->where('id_usuario', '=', $user->id)
        ->get();
        if (count($encuestas) != 0) {
            
        }else{
            return Redirect::to('/administrador/encuesta/');
        }

        $padre = array();
        foreach($preguntas as $pregunta){
            $datos = DB::table('encuestas_respuestas as R')
            ->join('respuestas_encuesta as RES', 'R.id_respuesta', '=', 'RES.id')
            ->select('RES.respuesta', 'R.id_respuesta', 'RES.id_pregunta', DB::raw('count(*) as total'))
            ->where('R.id_pregunta', '=', $pregunta->id)
            ->groupBy('R.id_respuesta')
            ->get();
            $array_total = array('nombre_pregunta' => $pregunta->pregunta, 'id_pregunta' => $pregunta->id , 'datos' => $datos);
            array_push($padre, $array_total );

        }

        return view ('backend.administrador.encuestas.estadisticas' , compact('padre', 'encuestas'));
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
