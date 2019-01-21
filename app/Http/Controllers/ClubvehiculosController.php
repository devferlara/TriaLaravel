<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Input;
use DB;
use Session;
use Redirect;
use App\User;
use App\Conjunto;
use App\Administrador;
use App\AdministradorConjunto;
use App\Vehiculo;
use App\VehiculoConjunto;
use Storage;
use App\Http\Requests;
use App\Http\Requests\VehiculosCrearRequest;
use App\Http\Requests\VehiculosUpdateRequest;
use App\Http\Controllers\Controller;

class ClubvehiculosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $uservehiculo=User::with('vehiculos')->where('id', $user->id)->get();
        if (count($uservehiculo->first()->vehiculos)>0) {
            if ($uservehiculo->first()->vehiculos->first()->registrado == 1) {
            $vehiculos=Vehiculo::where('usuario_id',$user->id)->get();
            return view ('backend.usuario.clubmotor.show', compact('vehiculos'));
            }
        }
        else {
            return view ('backend.usuario.clubmotor.index');
        }
    }

    /**Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('backend.usuario.clubmotor.create');
    }

    /**Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculosCrearRequest $request)
    {   
        $user=Auth::user();
        $vehiculo = new Vehiculo();
        $vehiculo->usuario_id = $user->id;
        $vehiculo->tipo = $request->tipo;
        $vehiculo->placa = $request->placa;
        $vehiculo->cantidad = $request->cantidad;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->color = $request->color;
        $vehiculo->parqueadero = $request->parqueadero;
        $vehiculo->tipo_parqueadero = $request->tipo_parqueadero;
        $vehiculo->numero_parqueadero = $request->numero_parqueadero;
        $vehiculo->registrado = $request->registrado;
        $vehiculo->save();

        $datos = DB::table('usuario_apartamentos as u_apartamento')
            ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
            ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
            ->select('zona.conjunto_id as id')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->get();
            foreach($datos as $dato){
                $id = $dato->id;
            }

        $vehiculoconjunto = new VehiculoConjunto();
        $vehiculoconjunto->vehiculo_id =$vehiculo->id;
        $vehiculoconjunto->conjunto_id =$id;
        $vehiculoconjunto->save();

        Session::flash('message','Vehiculo Creado Correctamente - Bienvenido a Club Motor');
        return Redirect::to('usuario/clubmotor');
    }
    /**Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user= Auth::user();
        $vehiculos=Vehiculo::where('usuario_id',$user->id)->get();
        return view ('backend.usuario.clubmascotas.show', compact ('vehiculos'));
    }
    /**Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehiculo = Vehiculo::find($id);
        return view ('backend.usuario.clubmotor.edit', ['vehiculo'=>$vehiculo]);
    }
    /* Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehiculo= Vehiculo::find($id);
        $vehiculo->fill($request->all());
        $vehiculo->save();
        Session::flash('message','Vehiculo Actualizado Correctamente');
        return Redirect::to('usuario/clubmotor');
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $vehiculo=Vehiculo::destroy($id);
        Session::flash('message','Vehiculo Eliminado Correctamente del sistema');
        return Redirect::to('usuario/clubmotor');
    }

    public function delete($id)
    {
        $vehiculo = Vehiculo::find($id);
        return view('backend.usuario.clubmotor.delete', ['vehiculo'=>$vehiculo]);
    }

     public function vehiculosConjunto()
    {
       $user= Auth::user();
       if($user->rol == "Administrador"){
        $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
        $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        $conjunto = $adminConjunto->conjunto_id;

        $vehiculosconjunto = DB::table('vehiculos_conjuntos as vehiconjuntos')
            ->join('vehiculos as vehiculo', 'vehiculo.id', '=', 'vehiconjuntos.vehiculo_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'vehiculo.usuario_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apto', 'apto.id', '=', 'userapto.apartamento_id')
            ->join('zonas as zona', 'zona.id', '=', 'apto.zona_id')
            ->select('vehiculo.*','apto.apartamento','zona.zona','usuario.nombres', 'usuario.apellidos')
            ->where('vehiconjuntos.conjunto_id', '=', $conjunto)
            ->orderBy('apto.id', 'DESC')
            ->paginate(30000);
        return View('backend.administrador.censos.vehiculos.index', compact('vehiculosconjunto'));
       }
    }
}
