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

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $encuestas_conjuntos = preguntas::where('encuesta_id', '=', $id)->get();
        $id_ = $id;
        return view ('backend.administrador.encuestas.preguntas' , compact('id_','encuestas_conjuntos'));
    }

    public function index2($idEncuesta)
    {   
        $user = Auth::user();
        $encuestas_conjuntos = preguntas::where('encuesta_id', '=', $idEncuesta)
        ->where('Active', '=', 1)
        ->get();
        $encuestas_nombre = encuestas::where('id', '=', $idEncuesta)
        ->where('id_usuario', '=', $user->id)
        ->get();
        $id_ = $idEncuesta;

        if (count($encuestas_nombre) != 0) {
        }else{
            return Redirect::to('/administrador/encuesta/');
        }


        foreach($encuestas_nombre as $encuesta){
            $nombre_de_la_encuesta = $encuesta->Nombre;
        }

        return view ('backend.administrador.encuestas.preguntas' , compact('id_','encuestas_conjuntos','nombre_de_la_encuesta'));
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
        
        $preguntas = new preguntas();
        $preguntas->encuesta_id = $request->id_encuesta;
        $preguntas->pregunta = $request->pregunta;
        $preguntas->Active = 1;
        $preguntas->save();
        return Redirect::to('/administrador/preg/'.$request->id_encuesta);
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
    public function editarEstado($id)
    {
        DB::table('preguntas')->where('id', '=',$id)->update(['Active' => 0]);
        return back();
    }

}
