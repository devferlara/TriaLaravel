<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\NoticiaCrearRequest;
use App\Http\Requests\NoticiaUpdateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Anuncios;
use App\UsuarioApartamento;
use App\Conjunto;
use App\Administrador;
use App\Apartamento;
use App\AdministradorConjunto;
use App\Zona;
use Auth;
use DB;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class AnunciosController extends Controller
{ 
    protected $anuncios;
 
    public function __construct(Anuncios $anuncios)
    {
        $this->anuncios = $anuncios;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            $anuncios = Anuncios::with('conjuntos')->orderBy('fecha', 'DESC')->paginate(20);
            return View('backend.superadmin.anuncios.index', compact('anuncios'));
        } else if ($user->rol == "Administrador") {
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjunto = Conjunto::where('id',$adminConjunto->conjunto_id)->firstOrFail();
            $anuncios = Anuncios::with('conjuntos')->where('conjunto_id',$conjunto->id)->paginate(20);
            return View('backend.administrador.anuncios.index', compact('anuncios'));
        } else if ($user->rol == "ResidenteUsuario") {
            $datos = DB::table('usuario_apartamentos as u_apartamento')
            ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
            ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
            ->select('zona.conjunto_id as id')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->get();
            foreach($datos as $dato){
                $id = $dato->id;

            }
            $anuncios = Anuncios::where('conjunto_id',$id)->where('enabled',1)->orderBy('id', 'DESC')->get();
            //dd($anuncios);
            return View('backend.usuario.anuncios.index', compact('anuncios'));
        }
    }
    /**Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {   
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
            
        $conjuntos =  Conjunto::all();

        $barrios = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.barrio','conjunto.ciudad')
            ->groupBy('conjunto.barrio')
            ->get();

        $localidades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.localidad','conjunto.ciudad')
            ->groupBy('conjunto.localidad')
            ->get();

        $ciudades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.ciudad')
            ->groupBy('conjunto.ciudad')
            ->get();
            //Genera Redireccion si es super admin
                return view('backend.superadmin.anuncios.create', compact('conjuntos', 'barrios', 'localidades', 'ciudades'));
            }else if($user->rol == "Administrador"){
            //Genera Redireccion si es super adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjunto = $adminConjunto->conjunto_id;
            $valoresconjunto= Conjunto::where('id', $conjunto)->firstOrFail();
            return view('backend.administrador.anuncios.create', compact('valoresconjunto'));
        }
    }
    /**
     * Store a newly created resource in storage
     * @return Response
     */
    public function store(NoticiaCrearRequest $request)
    {   
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
                $conjuntosarray= $request->envio;
                $conjuntos = array_values(array_unique($conjuntosarray));
                foreach ($conjuntos as $conjunto) {
                $anuncio = new Anuncios();
                $anuncio->nombre = $request->nombre;
                $anuncio->fecha = Carbon::now();
                $anuncio->autor = $user->username;
                $anuncio->img_perfil = $user->img_perfil;
                $anuncio->img_banner = $request->img_banner;
                $anuncio->valoracion = $request->valoracion;
                $anuncio->conjunto_id = $conjunto;
                $anuncio->categoria = $request->categoria;
                if ($request->enabled == 1 ) {
                    $anuncio->enabled = $request->enabled;
                }
                $anuncio->descripcion = $request->descripcion;
                $anuncio->save();
                $response = $anuncio->guardarAnunciopush($anuncio->id, $anuncio->conjunto_id);
                }
            Session::flash('message','Anuncio Creado con Exito');
            return Redirect::to('/superadmin/anuncios');
        }else if ($user->rol == "Administrador") {
                $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
                $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
                $conjunto = $adminConjunto->conjunto_id;
                $anuncio = new Anuncios();
                $anuncio->nombre = $request->nombre;
                $anuncio->fecha = Carbon::now();
                $anuncio->autor = $user->username;
                $anuncio->img_perfil = $user->img_perfil;
                $anuncio->img_banner = $request->img_banner;
                $anuncio->valoracion = $request->valoracion;
                $anuncio->conjunto_id = $conjunto;
                $anuncio->categoria = $request->categoria;
                if ($request->enabled == 1 ) {
                    $anuncio->enabled = $request->enabled;
                }
                $anuncio->descripcion = $request->descripcion;
                $anuncio->save(); 
                $response = $anuncio->guardarAnunciopush($anuncio->id, $anuncio->conjunto_id);
            Session::flash('message','Anuncio Creado con Exito');
            return Redirect::to('/administrador/anuncios');
        }
    }
 
    /**Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {   
        $anuncio = $this->anuncios->findOrFail($id);
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            return view('backend.superadmin.anuncios.show', compact('anuncio'));
        }else if ($user->rol == "Administrador") {
            return view('backend.administrador.anuncios.show', compact('anuncio'));
        }else if ($user->rol == "ResidenteUsuario") {
            return view('backend.usuario.anuncios.show', compact('anuncio'));
        }
    }
    /**Show the form for editing the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $anuncio = Anuncios::find($id);
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            $conjunto= Conjunto::where('id',$anuncio->conjunto_id)->get();
            return view('backend.superadmin.anuncios.edit',compact('conjunto'), ['anuncio'=>$anuncio]);
        }else if ($user->rol == "Administrador") {
            $conjunto= Conjunto::where('id',$anuncio->conjunto_id)->get();
            return view('backend.administrador.anuncios.edit', compact('conjunto') , ['anuncio'=>$anuncio]);
        }
    }
    /**Update the specified resource in storage.
     * @param  int  $id
     * @return Response
     */
    public function update(NoticiaUpdateRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
                $anuncio = Anuncios::find($id);
                $anuncio->fill($request->all());
                $anuncio->save();
            Session::flash('message','Anuncio Actualizado con Exito');
            return Redirect::to('/superadmin/anuncios');
        }else if ($user->rol == "Administrador") {
                $anuncio = Anuncios::find($id);
                $anuncio->fill($request->all());
                $anuncio->save();
            Session::flash('message','Anuncio Actualizado con Exito');
            return Redirect::to('/administrador/anuncios');
        }
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $anuncio=Anuncios::destroy($id);
            Session::flash('message','Anuncio Eliminado Correctamente');
            return Redirect::to('/superadmin/anuncios');
        }else if ($user->rol == "Administrador"){
            $anuncio=Anuncios::destroy($id);
            Session::flash('message','Anuncio Eliminado Correctamente');
            return Redirect::to('/administrador/anuncios');
        }
    }
    
    public function deletesuper($id)
    {
        //Genera Redireccion si es super adminadministrador
        $anuncio = Anuncios::find($id);
        return view('backend.superadmin.anuncios.delete', ['anuncio'=>$anuncio]);
    }

    public function delete($id)
    {
        //Genera Redireccion si es administrador
        $anuncio = Anuncios::find($id);
        return view('backend.administrador.anuncios.delete', ['anuncio'=>$anuncio]);
    }

    public function getContarAnuncios(){

        $user= Auth::user();
        if ($user->rol == "ResidenteUsuario") {
            $sin_leer = DB::table('usuario_apartamentos as u_apartamento')
            ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
            ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
            ->select('zona.conjunto_id as id')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->count();
            foreach($sin_leer as $noleido){
                $id = $noleido->id;
            }
            $anuncios = Anuncios::where('conjunto_id',$id)->where('leido',1)->orderBy('id', 'DESC')->get();
            return View('backend.usuario.anuncios.index', compact('anuncios'));
        }
        $sin_leer = DB::table('noticias as noticia')
            ->join('conjuntos as conjunto', 'conjunto.id', '=', 'noticia.conjunto_id')
            ->select('noticia.*')
            ->where('noticia.conjunto_id', '=', $id[1])
            ->where('m_u.leido', '=', '0')
            ->count();
        return Response::json(array('s_l'=>$sin_leer));
    }
}
