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
use App\Paises;
use App\Ciudades;
use App\Zona;
use App\Valores;
use DB;
use Storage;
use Crypt;
use Auth;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class ConjuntoController extends Controller
{
    /** Display a listing of the resource.
     * @return \Illuminate\Http\Response  */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('verificarPago',['except' => ['create','store']]);

    }

    public function index(Request $request)
    {

        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin 
                $conjuntos= Conjunto::has('administrador.usuarios')->paginate(20);
                $count = new Conjunto();
                return view ('backend.superadmin.conjuntos.index', compact('conjuntos','count'));
            }else if($user->rol == "Administrador"){
                //Genera Redireccion si es adminadministrador
                $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();
                $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

                $valorconjunto = $adminConjunto->conjunto_id;
                $conjunto= Conjunto::where('id',$valorconjunto)->get();
                $nuevousuario = new User();
                $usuarios = $nuevousuario->obtenerUsuariosConjunto($valorconjunto);

                $count = new Conjunto();
                return view ('backend.administrador.conjunto.index' , compact('conjunto', 'admin', 'usuarios', 'count'));
            }
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response  */
    public function create()
    {
        $user = Auth::user();

        //Obtener paises

        $paises = Paises::all();

        if ($user->rol == "SuperAdmin"){

            //Genera Redireccion si es super admin

            return view('backend.superadmin.conjuntos.create',compact("paises"));

        }else if($user->rol == "Administrador"){

            //Verificar si el administrador posee un conjunto

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->get();
         
            if(count($adminConjunto) == 0)
            {
               return view('backend.superadmin.conjuntos.create',compact("paises"));
            }
            else
            {
                //Genera Redireccion si es un administrador
                return Redirect::to('/administrador/conjuntos');

            }
          
        }
        else if($user->rol =="Socio"){
            //Genera Redireccion si es socio
            return Redirect::to('socio/');
        }
    }
    /**Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response  */
    public function store(ConjuntoCrearRequest $request)
    {
        //Obtener pais

        $pais = Paises::where('Codigo',$request->pais)->firstOrFail();

        $requestData = $request->all();

        $requestData['pais'] = $pais->Pais;
        
        //Crear conjunto

        $id_conjunto = Conjunto::create($requestData);

        $user = Auth::user();

        //Colocar como administrador al mismo usuario

        if($user->rol == "Administrador")
        {
            //Colocar como administrador de conjunto

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = new AdministradorConjunto();
            $adminConjunto->administrador_id = $admin->id;
            $adminConjunto->conjunto_id = $id_conjunto->id;
            $adminConjunto->save();

            Session::flash('message','Conjunto Creado Correctamente.');
            return Redirect::to('/administrador/conjuntos');

        }

        Session::flash('message','Conjunto Creado Correctamente');
        return Redirect::to('/superadmin/conjuntos');
    }
    /*** Display the specified resource.  */

    public function detalles(Request $request, $id)
    {   
        $user = Auth::user();
        if ($user->rol =="SuperAdmin"){
            //Genera Redireccion si es super admin
            $conjunto = Conjunto::find($id);
            $adminconjunto = AdministradorConjunto::where('conjunto_id', '=', $conjunto->id)->firstOrFail();
            $administrador = Administrador::with('usuarios')->where('id', $adminconjunto->id)->get();
            $nuevousuario = new User();
            $count = new Conjunto();
            $usuarios = $nuevousuario->obtenerUsuariosConjunto($conjunto->id);
            $zonas= Zona::with('apartamentos.usuarios')->where('conjunto_id', $conjunto->id)->paginate(10);
            return view ('backend.superadmin.conjuntos.details' , compact('conjunto', 'administrador', 'usuarios', 'count', 'zonas'));
        }else if($user->rol =="Administrador"){
            //Genera Redireccion si es super adminadministrador
            Session::flash('message','Usuario No tiene Privilegios para esta operación- Ya se notifico al administrador');
            return Redirect::to('administrador/');
        }
    }

    public function show($id)
    {   
     //       
    }

    /*** editar conjuntos */
    public function edit($id)
    {
       $user = Auth::user();

       //Obtener paises

        $paises = Paises::all();

        $conjunto = Conjunto::find($id);

        //Obtener ciudades

        $pais = Paises::where('Pais',$conjunto->pais)->firstOrFail();

        $ciudades = Ciudades::where('Paises_Codigo',$pais->Codigo)->get();

            if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin
                return view('backend.superadmin.conjuntos.edit', ['conjunto'=>$conjunto,'paises' => $paises,'ciudades' => $ciudades]);
            }else if($user->rol == "Administrador"){
                    //Genera Redireccion si es super adminadministrador
                return view('backend.administrador.conjunto.edit', ['conjunto'=>$conjunto,'paises' => $paises,'ciudades' => $ciudades]);
            }
    }
    /*** Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response */
    public function update(ConjuntoUpdateRequest $request, $id)
    {
        $user = Auth::user();

        //Obtener pais

        $pais = Paises::where('Codigo',$request->pais)->firstOrFail();

        $requestData = $request->all();

        $requestData['pais'] = $pais->Pais;

        if($user->rol == "SuperAdmin"){
            $conjunto= Conjunto::find($id);
            $conjunto->fill($requestData);
            $conjunto->save();
            Session::flash('message','Conjunto Actualizado Correctamente');
            return Redirect::to('superadmin/conjuntos');
        }else if($user->rol == "Administrador"){
            $conjunto= Conjunto::find($id);
            $conjunto->fill($requestData);
            $conjunto->save();
            Session::flash('message','Conjunto Actualizado Correctamente');
            return Redirect::to('administrador/conjuntos');
        }       
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response */
    public function destroy($id)
    {
        $conjunto=Conjunto::destroy($id);
        Session::flash('message','Conjunto Eliminado Correctamente');
        return Redirect::to('superadmin/conjuntos');
    }

    public function delete($id)
    {
        $conjunto = Conjunto::find($id);
        $user = Auth::user();
        if ($user->rol=="SuperAdmin"){
            //Genera Redireccion si es super admin
            return view('backend.superadmin.conjuntos.delete', ['conjunto'=>$conjunto]);
        }else if($user->rol== "Administrador"){
            Session::flash('message','Usuario No tiene Privilegios para esta operación- Ya se notifico al administrador');
            return Redirect::to('administradores/');
        }
    }

    public function buscarconjunto(Request $request)
    {
        $conjuntos = Conjunto::nombreconjunto($request-> get('nomconjunto'))-> has('administrador.usuarios')->orderBy('id', 'DESC')->paginate(20);
        $count = new Conjunto();
        return view ('backend.superadmin.conjuntos.index', compact('conjuntos', 'count'));
    }
	
	public function conjuntos_lugar_json()
	{
		$user = Auth::user();
		$conjuntos = Conjunto::groupBy('pais','ciudad')->select('pais', 'ciudad',DB::raw('count(*) as total'))->get();
		$data = [];
		foreach ($conjuntos as $c) {
			$record = array(
				'pais' => $c->pais,
				'ciudad' => $c->ciudad,
				'conjuntos' => $c->total
			);
			array_push($data, $record);
		}
		$total = count($data);
		return response()->json(['data' => $data, 'draw' => 1, "recordsTotal" => $total, "recordsFiltered" => $total]);  
	}
	
	
	public function conjuntos_json()
	{
		$user = Auth::user();
		$conjuntos = Conjunto::groupBy('pais')->select('pais', DB::raw('count(*) as total'))->get();
		$data = [];

        //Obtener valor

        $valores = Valores::where('modulo','conjuntos')->get();
            
        $valor = 250;

        if(count($valores) > 0)
        {
            $valor = $valores->first()->valor;
        }

		foreach ($conjuntos as $c) {
			$record = array(
				'pais' => $c->pais,
				'conjuntos' => $c->total,
				'total' => "$".($c->total * $valor) . " USD"
			);
			array_push($data, $record);
		}
		$total = count($data);
		return response()->json(['data' => $data, 'draw' => 1, "recordsTotal" => $total, "recordsFiltered" => $total]);  
	}
	
}