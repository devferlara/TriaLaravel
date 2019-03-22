<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class WebserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function index2($idUser)
    {

        $date = date('Y-m-d H:i:s');
        $datos = DB::table('usuario_apartamentos as u_apartamento')
        ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
        ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
        ->select('zona.conjunto_id as id')
        ->where('u_apartamento.usuario_id', '=', $idUser)
        ->get();   

        foreach($datos as $dato){
            $id = $dato->id;
        }

        if (count($datos) != 0) {
        }else{
            return ['status' => 'error'];
            exit();
        }

        $encuesta = DB::table('encuestas as E')
        ->select('*')
        ->where('E.id_conjunto', '=', $id)
        ->where('E.fecha_limite', '>=', $date)
        ->where('E.Active', '=', 1)
        ->get();

        $padre = array();

        foreach($encuesta as $item){
            $encuesta_respondidas = DB::table('encuestas_respuestas as ER')
            ->join('preguntas as P', 'P.id', '=', 'ER.id_pregunta')
            ->select('*')
            ->where('ER.id_usuario', '=', $idUser)
            ->where('P.encuesta_id', '=', $item->id)
            ->where('P.Active', '=', 1)
            ->get();
            if (count($encuesta_respondidas) != 0) {
                
            }else{
              $preguntas = DB::table('preguntas as P')
              ->select('*')
              ->where('P.encuesta_id', '=', $item->id)
              ->where('P.Active', '=', 1)
              ->get();

              $preguntas_array = array();

              foreach($preguntas as $pregunta){

                $respuestas_array = array();

                $respuestas = DB::table('respuestas_encuesta as R')
                ->select('*')
                ->where('R.id_pregunta', '=', $pregunta->id)
                ->get();

                foreach($respuestas as $respuesta){
                    array_push($respuestas_array, array(
                        'id' => $respuesta->id,
                        'respuesta' => $respuesta->respuesta,
                    ));
                }

                array_push($preguntas_array, array(
                    'id' => $pregunta->id,
                    'pregunta' => $pregunta->pregunta,
                    'respuestas' => $respuestas_array
                ));
            }


            array_push($padre, array(
                'id' => $item->id,
                'nombre' => $item->Nombre,
                'descripcion' => $item->Descripcion,
                'fecha' => $item->fecha_limite,
                'preguntas' =>$preguntas_array,

            ));  
        }


    }

    return response()->json($padre, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],JSON_UNESCAPED_UNICODE);

    //return ['status' => 'ok', 'data' => $padre]; 
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
