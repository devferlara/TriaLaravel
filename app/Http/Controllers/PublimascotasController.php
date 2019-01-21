<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublimascotasCrearRequest;
use App\Http\Requests\PublimascotasUpdateRequest;
use App\Conjunto;
use App\Administrador;
use App\AdministradorConjunto;
use App\Mascota;
use App\MascotaConjunto;
use App\PublicacionMascotas;
use App\PublicidadMascotas;
use Auth;
use DB;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use App\Pagospublicidad;
use App\SegmentosMascotas;


class PublimascotasController extends Controller
{
   protected $publimascotas;
 
    public function __construct(PublicacionMascotas $publimascotas)
    {
        $this->publimascotas = $publimascotas;

        $this->middleware('pagopautamascotas',['only' => ['create','store']]);
    }
    /**Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            $publicaciones = PublicacionMascotas::orderBy('fecha', 'DESC')->paginate(30000);
            return view ('backend.superadmin.publicidad.clubmascotas.index', compact ('publicaciones'));
        } else if ($user->rol == "Administrador") {

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $conjunto = Conjunto::where('id',$adminConjunto->conjunto_id)->firstOrFail();
            
            $publicaciones = DB::table('publimascotas as pub')
            ->select('pub.*')
            ->join('segmentos_mascotas as sc', 'sc.publimascota_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais])
            ->groupBy('sc.publimascota_id')
            ->paginate(30000);

            return View('backend.administrador.publicidad.clubmascotas.index', compact('publicaciones'));
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

            $conjunto = Conjunto::where('id',$id)->firstOrFail();

            $publicidades = DB::table('publimascotas as pub')
            ->select('pub.*')
            ->join('segmentos_mascotas as sc', 'sc.publimascota_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->groupBy('sc.publimascota_id')
            ->get();

            return View('backend.usuario.publicidad.clubmascotas.index', compact('publicidades'));
        }
        else if($user->rol == 'Pautante')
        {
            $publicaciones= PublicacionMascotas::where('usuario_id',$user->id)->orderBy('fecha', 'DESC')->paginate(30000);
            return View('backend.pautante.publicidad.clubmascotas.index', compact('publicaciones'));
        }
    }
    /**Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $paises = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.pais')
            ->groupBy('conjunto.pais')
            ->get();

        $ciudades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.ciudad','conjunto.pais')
            ->groupBy('conjunto.ciudad','pais')
            ->orderBy('conjunto.pais')
            ->get();

        $localidades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.localidad','conjunto.ciudad')
            ->groupBy('conjunto.localidad')
            ->orderBy('conjunto.ciudad')
            ->get();

        $conjuntos = Conjunto::orderBy('ciudad')->get();


        if($user->rol == 'Pautante')
        {
            //Genera Redireccion si es super admin
            return view('backend.pautante.publicidad.clubmascotas.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
        }

        //Genera Redireccion si es super admin
        return view('backend.superadmin.publicidad.clubmascotas.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
        
    }
    /**Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublimascotasCrearRequest $request)
    {
        $user = Auth::user();

        $segmentos = array_reverse($request->envio);

        $publimascota = new PublicacionMascotas();

        //Si es pautante guardar el id de usuario
            
        if($user->rol == 'Pautante')
        {
            $date = Carbon::now();

            $publimascota->usuario_id = $user->id;
            $publimascota->fecha_desde = date('Y-m-d');
            $publimascota->fecha_hasta = $date->addYear(1);

            //Buscar pago para asociar 

            $condicion = ['usuario_id' => $user->id,'publicidad_tipo' => 2,'payment_status' => 'APPROVED','utilizado' => 0,'status' => 1];

            $pago = PagosPublicidad::where($condicion)->firstOrFail();

            $publimascota->pago_publicidad_id = $pago->id;
        }
        else
        {
            $publimascota->fecha_desde = $request->fecha_desde;
            $publimascota->fecha_hasta = $request->fecha_hasta;
        }

         $publimascota->titulo = $request->titulo;
        $publimascota->fecha = Carbon::now();
        $publimascota->img_banner = $request->img_banner;
        $publimascota->emisor = $request->emisor;
        $publimascota->valor = $request->valor;
        $publimascota->link = $request->link;
        $publimascota->categoria = $request->categoria;
        if ($request->enabled == 1 ) {
                $publimascota->enabled = $request->enabled;
        }else{ $publimascota->enabled = 0;}
        $publimascota->descripcion = $request->descripcion;
        $publimascota->save();

        // foreach ($conjuntos as $conjunto) {
        //     $publicacionMascota= new PublicidadMascotas();
        //     $publicacionMascota->conjunto_id = $conjunto;
        //     $publicacionMascota->publimascota_id = $publimascota->id;
        //     $publicacionMascota->fecha =Carbon::now();
        //     $publicacionMascota->save();
        // }

        foreach ($segmentos as $segmento) {

            $publiconjunto = new SegmentosMascotas();

            $publiconjunto->publimascota_id = $publimascota->id;

            //Separar tipo

             

            $zona = explode('_', $segmento);

            $zona_busqueda = Conjunto::where('id',$zona[1])->get();

            if(count($zona_busqueda) == 0)
            {
                continue;
            }

            //Si es un conjunto

            if($zona[0] == 'conjunto')
            {
                $publiconjunto->conjunto_id = $zona_busqueda[0]->id;
                $publiconjunto->localidad   = $zona_busqueda[0]->localidad;
                $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                $publiconjunto->pais        = $zona_busqueda[0]->pais;
                //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                $publiconjunto->save();

            }

            //Si es una localidad

            if($zona[0] == 'local')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['localidad' => $zona_busqueda[0]->localidad,'publimascota_id' => $publimascota->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->localidad   = $zona_busqueda[0]->localidad;
                    $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }

            }

            //Si es una ciudad



            if($zona[0] == 'ciudad')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['ciudad' => $zona_busqueda[0]->ciudad,'publimascota_id' => $publimascota->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
                
            }

            //Si es un pais

            if($zona[0] == 'pais')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['pais' => $zona_busqueda[0]->pais,'publimascota_id' => $publimascota->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
            } 
        }

        //Si es un pautante se deben actualizar el pago consumido

        $redirect_to = '/superadmin/publicidad/clubmascotas';

        if($user->rol == 'Pautante')
        {
            $redirect_to = '/pautante/publicidad/clubmascotas';

            PagosPublicidad::findOrFail($pago->id)->update(['utilizado' => 1]);
        }

        Session::flash('message','Bono Club Mascotas Creado con Exito');
        return Redirect::to($redirect_to);
    }
    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publimascotas = $this->publimascotas->findOrFail($id);
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            return view('backend.superadmin.publicidad.clubmascotas.show', compact('publimascotas'));
        }else if ($user->rol == "Administrador") {
            return view('backend.administrador.publicidad.clubmascotas.show', compact('publimascotas'));
        }else if ($user->rol == "ResidenteUsuario") {
            return view('backend.usuario.publicidad.clubmascotas.show', compact('publimascotas'));
        }
        else if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publimascotas = PublicacionMascotas::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();

            return view('backend.pautante.publicidad.clubmascotas.show', compact('publimascotas'));
        }
    }
    /**Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= Auth::user();

        $paises = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.pais')
            ->groupBy('conjunto.pais')
            ->get();

        $ciudades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.ciudad','conjunto.pais')
            ->groupBy('conjunto.ciudad','pais')
            ->orderBy('conjunto.pais')
            ->get();

        $localidades = DB::table('conjuntos as conjunto')
            ->select('conjunto.id','conjunto.localidad','conjunto.ciudad')
            ->groupBy('conjunto.localidad')
            ->orderBy('conjunto.ciudad')
            ->get();

        $conjuntos = Conjunto::orderBy('ciudad')->get();

        //Segmentos

        $segmentos = SegmentosMascotas::where('publimascota_id',$id)->get();

        $segments = [];

        if(count($segmentos) > 0)
        {
            foreach ($segmentos as $s) {
                $segments[] = $s->conjunto_id;
                $segments[] = $s->localidad;
                $segments[] = $s->ciudad;
                $segments[] = $s->pais;
            }
        }

        $arreglo_segmentos = array_values(array_unique($segments));

        if($user->rol == 'Pautante')
        {
            //Validar que sea mi publicidad

            $publimascotas = PublicacionMascotas::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();
       
            return view('backend.pautante.publicidad.clubmascotas.edit',compact('arreglo_segmentos','paises','ciudades','localidades','conjuntos'), ['publimascotas'=>$publimascotas]);
        }
        else
        {
            $publimascotas = PublicacionMascotas::find($id);

            return view('backend.superadmin.publicidad.clubmascotas.edit',compact('arreglo_segmentos','paises','ciudades','localidades','conjuntos'), ['publimascotas'=>$publimascotas]);
        }
        
    }
    /**Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublimascotasUpdateRequest $request, $id)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            $publimascotas = PublicacionMascotas::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();
            $redirect_to = '/pautante/publicidad/clubmascotas';
        }
        else
        {
            $publimascotas = PublicacionMascotas::find($id);
            $redirect_to = '/superadmin/publicidad/clubmascotas';
        }

        $publimascotas->fill($request->all());

        $publimascotas->save();

        //Guardar segmentacion

        $segmentos = array_reverse($request->envio);

        //Eliminar anteriores

        SegmentosMascotas::where('publimascota_id',$publimascotas->id)->delete();

        foreach ($segmentos as $segmento) {

            $publiconjunto = new SegmentosMascotas();

            $publiconjunto->publimascota_id = $publimascotas->id;

            //Separar tipo

            $zona = explode('_', $segmento);

            $zona_busqueda = Conjunto::where('id',$zona[1])->get();

            if(count($zona_busqueda) == 0)
            {
                continue;
            }

            //Si es un conjunto

            if($zona[0] == 'conjunto')
            {
                $publiconjunto->conjunto_id = $zona_busqueda[0]->id;
                $publiconjunto->localidad   = $zona_busqueda[0]->localidad;
                $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                $publiconjunto->pais        = $zona_busqueda[0]->pais;
                //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                $publiconjunto->save();

            }

            //Si es una localidad

            if($zona[0] == 'local')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['localidad' => $zona_busqueda[0]->localidad,'publimascota_id' => $publimascota->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->localidad   = $zona_busqueda[0]->localidad;
                    $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }

            }

            //Si es una ciudad



            if($zona[0] == 'ciudad')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['ciudad' => $zona_busqueda[0]->ciudad,'publimascota_id' => $publimascotas->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda
                    $publiconjunto->localidad   = null;
                    $publiconjunto->ciudad      = $zona_busqueda[0]->ciudad;
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
                
            }

            //Si es un pais

            if($zona[0] == 'pais')
            {
                //Buscar que no se halla guardado ningun registro de la publicidad con esta zona

                $buscar = SegmentosMascotas::where(['pais' => $zona_busqueda[0]->pais,'publimascota_id' => $publimascotas->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->localidad   = null;
                    $publiconjunto->ciudad      = null;
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
            } 
        }

        Session::flash('message','Bono Club Mascotas Actualizado con Exito');
        return Redirect::to($redirect_to);
        
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publimascotas=PublicacionMascotas::destroy($id);
        Session::flash('message','Bono Club Mascotas Eliminado Correctamente');
        return Redirect::to('/superadmin/publicidad/clubmascotas');
    }
    public function delete($id)
    {
        $publimascotas = PublicacionMascotas::find($id);
        return view('backend.superadmin.publicidad.clubmascotas.delete', ['publimascotas'=>$publimascotas]);
    }

    public function changeStatus(Request $request)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publicidad = PublicacionMascotas::where(['id' => $request->id,'usuario_id' => $user->id])->firstOrFail();

            //Actualizar

            $estado = $request->status == 1?1:0;

            PublicacionMascotas::where('id',$request->id)->update(['enabled' => $estado]);

            Session::flash('message','El estado del bono de mascotas ha sido actualizado correctamente.');
            return Redirect::to('/pautante/publicidad/clubmascotas');
        }

    }
}
