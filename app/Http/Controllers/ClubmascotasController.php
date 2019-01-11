<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Input;
use Session;
use Redirect;
use App\User;
use App\AdministradorConjunto;
use App\Administrador;
use App\Conjunto;
use App\Mascota;
use App\MascotaConjunto;
use Storage;
use App\Http\Requests;
use App\Http\Requests\MascotasCrearRequest;
use App\Http\Requests\MascotasUpdateRequest;
use App\Http\Controllers\Controller;

class ClubmascotasController extends Controller
{   
    
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user=Auth::user();
        $usermascota=User::with('mascotas')->where('id', $user->id)->get();
        if (count($usermascota->first()->mascotas)>0) {
            if ($usermascota->first()->mascotas->first()->registrado == 1) {
            $mascotas=Mascota::where('usuario_id',$user->id)->get();
            return view ('backend.usuario.clubmascotas.show', compact('mascotas'));
            }
        }
        else {
            return view ('backend.usuario.clubmascotas.index');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('backend.usuario.clubmascotas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MascotasCrearRequest $request)
    {   
        $user=Auth::user();
        
        $mascota = new Mascota();
        $mascota->usuario_id = $user->id;
        $mascota->tipo = $request->tipo;
        $mascota->nombre = $request->nombre;
        $mascota->raza = $request->raza;
        $mascota->edad = $request->edad;
        $mascota->genero = $request->genero;
        $mascota->vacunas = $request->vacunas;
        $mascota->registrado = $request->registrado;
        $mascota->img_mascota = $request->img_mascota;
        $mascota->save();
        $datos = DB::table('usuario_apartamentos as u_apartamento')
            ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
            ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
            ->select('zona.conjunto_id as id')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->get();
            foreach($datos as $dato){
                $id = $dato->id;
            }

        $mascotaconjunto = new MascotaConjunto();
        $mascotaconjunto->mascota_id =$mascota->id;
        $mascotaconjunto->conjunto_id =$id;
        $mascotaconjunto->save();

        Session::flash('message','Mascota Creada Correctamente - Bienvenido a Club Mascotas');
        return Redirect::to('usuario/clubmascotas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $user= Auth::user();
        $mascotas=Mascota::where('usuario_id',$user->id)->get();
        return view ('backend.usuario.clubmascotas.show', compact ('mascotas'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $mascota = Mascota::find($id);
        return view ('backend.usuario.clubmascotas.edit', ['mascota'=>$mascota]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MascotasUpdateRequest $request, $id)
    {   
        $mascota= Mascota::find($id);
        $mascota->fill($request->all());
        $mascota->save();
        Session::flash('message','Mascota Actualizada Correctamente');
        return Redirect::to('usuario/clubmascotas');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $mascota=Mascota::destroy($id);
        Session::flash('message','Mascota Eliminada Correctamente del sistema');
        return Redirect::to('usuario/clubmascotas');
    }

    public function delete($id)
    {
        $mascota = Mascota::find($id);
        return view('backend.usuario.clubmascotas.delete', ['mascota'=>$mascota]);
    }

    public function mascotasConjunto()
    {
       $user= Auth::user();
       if($user->rol == "Administrador"){
        $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
        $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        $conjunto = $adminConjunto->conjunto_id;

        $mascotasconjunto = DB::table('mascotas_conjuntos as masconjuntos')
            ->join('mascotas as mascota', 'mascota.id', '=', 'masconjuntos.mascota_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'mascota.usuario_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apto', 'apto.id', '=', 'userapto.apartamento_id')
            ->join('zonas as zona', 'zona.id', '=', 'apto.zona_id')
            ->select('mascota.*','apto.apartamento','zona.zona','usuario.nombres', 'usuario.apellidos')
            ->where('masconjuntos.conjunto_id', '=', $conjunto)
            ->orderBy('apto.id', 'DESC')
            ->paginate(50);
        return View('backend.administrador.censos.mascotas.index', compact('mascotasconjunto'));
       }
    }
}
