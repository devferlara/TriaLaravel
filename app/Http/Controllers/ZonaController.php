<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ZonaCrearRequest;
use App\Http\Requests\ZonaUpdateRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Administrador;
use App\Conjunto;
use App\Zona;
use App\AdministradorConjunto;
use App\Apartamento;
use Auth;
use DB;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin
            $conjunto = $request->conjunto;
            $conjuntos = Conjunto::lists('nombre', 'id');
            $zonas = DB::table('zonas as zona')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('zona.id','zona.tipo','zona.zona', 'conjunto.nombre','conjunto.tipo')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('zona.id')
            ->get();
            $count = new Zona();
            return view ('backend.superadmin.zonas.index', compact('conjuntos', 'zonas','count', 'conjunto'));
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjunto = $adminConjunto->conjunto_id;
            $zonas = Zona::with('conjuntos')->where('conjunto_id',$conjunto)->paginate(20);
            $count = new Zona();
            return view ('backend.administrador.zonas.index', compact('zonas','count'));
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin
                $conjuntos= Conjunto::lists('nombre', 'id');
                return view('backend.superadmin.zonas.create' , compact('conjuntos'));
            }else if($user->rol == "Administrador"){
                $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
                $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
                $conjuntos = Conjunto::where('id',$adminConjunto->conjunto_id)->lists('nombre', 'id');
                    //Genera Redireccion si es super adminadministrador
                return view('backend.administrador.zonas.create',  compact('conjuntos'));
        }
    }
     /* Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store (ZonaCrearRequest $request) 
    {
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
                $conjunto = $request->conjunto;
                $zona = Zona::where('tipo','=', $request->tipo)
                ->where('zona','=',$request->zona)
                ->where('conjunto_id','=', $conjunto)->count();

                if($zona <= 0){
                // Crear Zona
                $zona = new Zona();
                $zona->conjunto_id = $conjunto;
                $zona->tipo = $request->tipo;
                $zona->zona = $request->zona;
                $zona->save();
                Session::flash('message','Zona Creada con éxito');
                return Redirect::to('/superadmin/zonas');
                }else{
                    Session::flash('message-error', 'No se ha podido crear la unidad, ya existe una Igual');
                    return Redirect::to('/superadmin/zonas');
                }

            }else if($user->rol == "Administrador"){

                $conjunto = $request->conjunto;
                 $zona = Zona::where('tipo','=', $request->tipo)
                ->where('zona','=',$request->zona)
                ->where('conjunto_id','=', $conjunto)->count();

                if($zona <= 0){
                // Crear Zona
                $zona = new Zona();
                $zona->conjunto_id = $conjunto;
                $zona->tipo = $request->tipo;
                $zona->zona = $request->zona;
                $zona->save();
                Session::flash('message','Zona Creada con éxito');
                return Redirect::to('/administrador/zonas');
                }else{
                    Session::flash('message-error', 'No se ha podido crear la unidad, ya existe una Igual');
                    return Redirect::to('/administrador/zonas');
                }           
        }
    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin
                $zona = Zona::find($id);
                $data= [ 
                            'zona' =>$zona,
                            'conjuntos' =>Conjunto::lists('nombre', 'id'),
                        ];
                return view('backend.superadmin.zonas.edit', $data);
            }else if($user->rol == "Administrador"){
                    //Genera Redireccion si es super adminadministrador
                $zona = Zona::find($id);
                $data= [ 
                            'zona'=>$zona,
                            'conjuntos' =>Conjunto::lists('nombre', 'id'),
                        ];
                return view('backend.administrador.zonas.edit',$data);
            }
    }
    /**Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ZonaUpdateRequest $request, $id)
    {
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
                $conjunto = $request->conjunto;
                $zona = Zona::where('tipo','=', $request->tipo)
                ->where('zona','=',$request->zona)
                ->where('conjunto_id','=', $conjunto)->count();

                if($zona <= 0){
                // Actualizar Zona
                $zona = Zona::find($id);
                $zona->fill($request->all());
                $zona->save();
                Session::flash('message','Zona Actualizada con éxito');
                return Redirect::to('/superadmin/zonas');
                }else{
                    Session::flash('message-error', 'No se ha podido actualizar la unidad, ya existe una Igual');
                    return Redirect::to('/superadmin/zonas');
                }

            }else if($user->rol == "Administrador"){
                $conjunto = $request->conjunto;
                 $zona = Zona::where('tipo','=', $request->tipo)
                ->where('zona','=',$request->zona)
                ->where('conjunto_id','=', $conjunto)->count();

                if($zona <= 0){
                // Actualizars
                $zona = Zona::find($id);
                $zona->fill($request->all());
                $zona->save();
                Session::flash('message','Zona Actualizada con éxito');
                return Redirect::to('/administrador/zonas');
                }else{
                    Session::flash('message-error', 'No se ha podido actualizar la unidad, ya existe una igual');
                    return Redirect::to('/administrador/zonas');
                }              
        }
    }
     /* Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $zona=Zona::destroy($id);
            Session::flash('message','Zona Eliminada Correctamente');
            return Redirect::to('/superadmin/zonas');
        }else if ($user->rol == "Administrador"){
            $zona=Zona::destroy($id);
            Session::flash('message','Zona Eliminada Correctamente');
            return Redirect::to('/administrador/zonas');
        }
    }

    public function deletesuper($id)
    {
        //Genera Redireccion si es super admin
        $zona = Zona::find($id);
        return view('backend.superadmin.zonas.delete', ['zona'=>$zona]);
    }

    public function delete($id)
    {
        //Genera Redireccion si es super admin
        $zona = Zona::find($id);
        return view('backend.administrador.zonas.delete', ['zona'=>$zona]);
    }

     public function buscarzona (Request $request)
    {
        $conjunto = $request->conjunto;
        $conjuntos = Conjunto::lists('nombre', 'id');
        $zonas = DB::table('zonas as zona')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('zona.id','zona.tipo','zona.zona', 'zona.descripcion','conjunto.nombre')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('zona.id')
            ->get();
        $count = new Zona();   
        return view ('backend.superadmin.zonas.index' , compact ('zonas', 'conjuntos', 'count', 'conjunto'));
    }
}
