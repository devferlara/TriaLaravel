<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ConjuntoCrearRequest;
use App\Http\Requests\ConjuntoUpdateRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Administrador;
use App\Conjunto;
use App\Apartamento;
use App\AdministradorConjunto;
use App\Zona;
use App\asistenciasRespuestas;
use App\Asistencias;
use App\Valores;
use DB;
use Storage;
use Crypt;
use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use App\preguntas;

class AsistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();
        $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        $valorconjunto = $adminConjunto->conjunto_id;
        $conjunto = Conjunto::where('id',$valorconjunto)->get();
        $nuevousuario = new User();
        $usuarios = $nuevousuario->obtenerUsuariosConjunto($valorconjunto);

        $asistencias_conjuntos = Asistencias::where('id_conjunto', '=', $conjunto->first()->id)
        ->where('Active', '>', 0)
        ->where('id_usuario', '=', $user->id)
        ->get();
        

        $count = new Conjunto();
        return view ('backend.administrador.asistencia.asistencia' , compact('conjunto','asistencias_conjuntos'));
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
        $user = Auth::user();
        $Asistencias = new Asistencias();
        $Asistencias->id_usuario = $user->id;
        $Asistencias->id_conjunto = $request->id_conjunto;
        $Asistencias->Nombre = $request->evento;
        $Asistencias->Active = 1;
        $Asistencias->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $user = Auth::user();
        DB::table('asistencias')->where('id', '=',$id)
        ->where('id_usuario', '=',$user->id)
        ->update(['Active' => 0]);
        return back();
    } 

    public function terminar($id)
    {   
        $user = Auth::user();
        DB::table('asistencias')->where('id', '=',$id)
        ->where('id_usuario', '=',$user->id)
        ->update(['Active' => 2]);
        return back();
    }  

    public function verasistencias($id)
    {
        $user = Auth::user();
        $datos = DB::table('asistencias_respuestas as R')
        ->join('asistencias as A', 'A.ID', '=', 'R.id_asistencia')
        ->join('usuarios as U', 'U.id', '=', 'R.id_usuario')
        ->select('U.nombres as nombres', 'U.apellidos as apellidos', 'U.email as email','U.telefono as telefono')
        ->where('A.id', '=', $id)
        ->where('A.Active', '>', 0)
        ->where('A.id_usuario', '=', $user->id)
        ->get();

        if (count($datos) != 0 ) {
        }else{
            return back();
        }
        
        $nombre_evento = DB::table('asistencias as R')
        ->select('R.Nombre as nombre')
        ->where('R.id', '=', $id)
         ->where('R.id_usuario', '=', $user->id)
        ->get();

        if (count($nombre_evento) != 0 ) {
        }else{
            return back();
        }
        


        return view ('backend.administrador.asistencia.asistencias-estadisticas', compact('datos', 'nombre_evento'));   
    }


    public function webservice($id)
    {   

        $datos = DB::table('usuario_apartamentos as u_apartamento')
        ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
        ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
        ->select('zona.conjunto_id as id')
        ->where('u_apartamento.usuario_id', '=', $id)
        ->get();

        if (count($datos) == 0) {
            return ['status' =>'error'];
        }

        foreach($datos as $dato){
            $id = $dato->id;
        }

        $eventos = DB::table('asistencias as A')
        ->select('A.id as id_evento', 'A.Nombre as nombre')
        ->where('A.id_conjunto', '=', $id)
        ->where('A.Active', '=', 1)
        ->get();

        return ['status' =>'ok', 'data' => $eventos]; ;
    } 



    public function savedata($id)
    {   
        $guardar_datos = array(
            array(
                'id_usuario' => 154,
                'id_evento' => 1,
            ),
            array(
                'id_usuario' => 154,
                'id_evento' => 2,

            ),
            array(
                'id_usuario' => 154,
                'id_evento' => 3,
            ),
        );


        foreach($guardar_datos as $guardar){
            $asistenciasRespuestas = new asistenciasRespuestas();
            $asistenciasRespuestas->id_usuario = $guardar['id_usuario'];
            $asistenciasRespuestas->id_asistencia = $guardar['id_evento'];
            $asistenciasRespuestas->save();
        }

        return ['status' => 'ok'];
    } 



}
