<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\respuestasEncuestas;
use App\preguntas;
use DB;
use Storage;
use Crypt;
use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class RespuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idPregunta)
    {
        return view ('backend.administrador.encuestas.respuestas');
    }

    public function index2($idPregunta)
    {

        $user = Auth::user();
        $pregunta_nombre = DB::table('preguntas as P')
        ->join('encuestas as E', 'E.id', '=', 'P.encuesta_id')
        ->select('P.*')
        ->where('P.id', '=', $idPregunta)
        ->where('E.id_usuario', '=', $user->id)
        ->get(); 
        if (count($pregunta_nombre) != 0) {
        }else{
            return Redirect::to('/administrador/encuesta/');
        }

        //$pregunta_nombre = preguntas::where('id', '=', $idPregunta)->get();
        
        foreach($pregunta_nombre as $pregunta){
            $nombre_de_la_pregunta= $pregunta->pregunta;
        }

        $respuestas_conjuntos = respuestasEncuestas::where('id_pregunta', '=', $idPregunta)->get();
        return view ('backend.administrador.encuestas.respuestas', compact('idPregunta','respuestas_conjuntos', 'nombre_de_la_pregunta'));
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
        $respuestasEncuestas = new respuestasEncuestas();
        $respuestasEncuestas->id_pregunta = $request->id_pregunta;
        $respuestasEncuestas->respuesta = $request->respuesta;
        $respuestasEncuestas->save();
        return Redirect::to('/administrador/resp/'.$request->id_pregunta);
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
        respuestasEncuestas::where('id', '=', $id)->delete();   
        //DB::table('respuestas_encuesta')->where('id', '=', $id)->delete();
        return back();
    }
}
