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
use App\encuestas;
use App\Valores;
use DB;
use Storage;
use Crypt;
use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use App\preguntas;

class EncuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    { 
    }
    public function index2()
    { 
        $user = Auth::user();
        $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();
        $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        $valorconjunto = $adminConjunto->conjunto_id;
        $conjunto = Conjunto::where('id',$valorconjunto)->get();
        $nuevousuario = new User();
        $usuarios = $nuevousuario->obtenerUsuariosConjunto($valorconjunto);

        $encuestas_conjuntos = encuestas::where('id_conjunto', '=', $conjunto->first()->id)
        ->where('Active', '=', 1)
         ->where('id_usuario', '=', $user->id)
        ->get();
        

        $count = new Conjunto();
        return view ('backend.administrador.encuestas.encuestas' , compact('conjunto','encuestas_conjuntos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

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
        $encuestas = new encuestas();
        $encuestas->id_conjunto = $request->id_conjunto;
        $encuestas->Nombre = $request->nombre;
        $encuestas->Descripcion = $request->descripcion;
        $encuestas->id_usuario = $user->id;
        $encuestas->Active = 1;
        $encuestas->fecha_limite = $request->fecha_limite.' 23:59:00';
        $encuestas->save();
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
        DB::table('encuestas')->where('id', '=',$id)->update(['Active' => 0]);
        return back();
    }


}
