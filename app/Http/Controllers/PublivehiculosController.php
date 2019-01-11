<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublivehiculosCrearRequest;
use App\Http\Requests\PublivehiculosUpdateRequest;
use App\Administrador;
use App\AdministradorConjunto;
use App\Conjunto;
use App\PublicidadVehiculos;
use App\Vehiculo;
use App\VehiculoConjunto;
use App\PublicacionVehiculos;
use Auth;
use DB;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use App\Pagospublicidad;
use App\SegmentosMotores;

class PublivehiculosController extends Controller
{
    protected $publivehiculos;
 
    public function __construct(PublicacionVehiculos $publivehiculos)
    {
        $this->publivehiculos = $publivehiculos;

        $this->middleware('pagopautamotor',['only' => ['create','store']]);
    }
    /**Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            $publicaciones = PublicacionVehiculos::orderBy('fecha', 'DESC')->paginate(20);
            return view ('backend.superadmin.publicidad.clubmotor.index', compact ('publicaciones'));
        } else if ($user->rol == "Administrador") {
            
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
         
            $conjunto = Conjunto::where('id',$adminConjunto->conjunto_id)->firstOrFail();
            
            $publicaciones = DB::table('publivehiculos as pub')
            ->select('pub.*')
            ->join('segmentos_vehiculos as sc', 'sc.publivehiculo_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais])
            ->groupBy('sc.publivehiculo_id')
            ->paginate(20);

            return View('backend.administrador.publicidad.clubmotor.index', compact('publicaciones'));

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

            $publicidades = DB::table('publivehiculos as pub')
            ->select('pub.*')
            ->join('segmentos_vehiculos as sc', 'sc.publivehiculo_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->groupBy('sc.publivehiculo_id')
            ->get();

            return View('backend.usuario.publicidad.clubmotor.index', compact('publicidades'));
        }
        else if($user->rol == 'Pautante')
        {
            $publicaciones= PublicacionVehiculos::where('usuario_id',$user->id)->orderBy('fecha', 'DESC')->paginate(20);
            return View('backend.pautante.publicidad.clubmotor.index', compact('publicaciones'));
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
           return view('backend.pautante.publicidad.clubmotor.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
        }

        //Genera Redireccion si es super admin
        return view('backend.superadmin.publicidad.clubmotor.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
        
        
            //Genera Redireccion si es super admin
        
    }
    /**Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublivehiculosCrearRequest $request)
    {
        $user = Auth::user();

        $segmentos = array_reverse($request->envio);

        $publivehiculos = new PublicacionVehiculos();

        //Si es pautante guardar el id de usuario
            
        if($user->rol == 'Pautante')
        {
            $date = Carbon::now();

            $publivehiculos->usuario_id = $user->id;
            $publivehiculos->fecha_desde = date('Y-m-d');
            $publivehiculos->fecha_hasta = $date->addYear(1);

            //Buscar pago para asociar 

            $condicion = ['usuario_id' => $user->id,'publicidad_tipo' => 3,'payment_status' => 'APPROVED','utilizado' => 0,'status' => 1];

            $pago = PagosPublicidad::where($condicion)->firstOrFail();

            $publivehiculos->pago_publicidad_id = $pago->id;
        }
        else
        {
            $publivehiculos->fecha_desde = $request->fecha_desde;
            $publivehiculos->fecha_hasta = $request->fecha_hasta;
        }

        $publivehiculos->titulo = $request->titulo;
        $publivehiculos->fecha = Carbon::now();
        $publivehiculos->img_banner = $request->img_banner;
        $publivehiculos->emisor = $request->emisor;
        $publivehiculos->valor = $request->valor;
        $publivehiculos->link = $request->link;
        $publivehiculos->categoria = $request->categoria;
        if ($request->enabled == 1 ) {
            $publivehiculos->enabled = $request->enabled;
        }else{ $publivehiculos->enabled = 0;}
        $publivehiculos->descripcion = $request->descripcion;
        $publivehiculos->save();

        // foreach ($conjuntos as $conjunto) {
        //     $publicacionVehiculos= new PublicidadVehiculos();
        //     $publicacionVehiculos->conjunto_id = $conjunto;
        //     $publicacionVehiculos->publivehiculo_id = $publivehiculos->id;
        //     $publicacionVehiculos->fecha =Carbon::now();
        //     $publicacionVehiculos->save();
        // }

        foreach ($segmentos as $segmento) {


            $publiconjunto = new SegmentosMotores();

            $publiconjunto->publivehiculo_id = $publivehiculos->id;

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

                $buscar = SegmentosMotores::where(['localidad' => $zona_busqueda[0]->localidad,'publivehiculo_id' => $publivehiculos->id])->get();

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

                $buscar = SegmentosMotores::where(['ciudad' => $zona_busqueda[0]->ciudad,'publivehiculo_id' => $publivehiculos->id])->get();

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

                $buscar = SegmentosMotores::where(['pais' => $zona_busqueda[0]->pais,'publivehiculo_id' => $publivehiculos->id])->get();

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

        $redirect_to = '/superadmin/publicidad/clubmotor';

        if($user->rol == 'Pautante')
        {
            $redirect_to = '/pautante/publicidad/clubmotor';

            PagosPublicidad::findOrFail($pago->id)->update(['utilizado' => 1]);
        }

        Session::flash('message','Bono Club Motor Creado con Exito');
        return Redirect::to($redirect_to);
    }
    /**Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publivehiculos = $this->publivehiculos->findOrFail($id);
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            return view('backend.superadmin.publicidad.clubmotor.show', compact('publivehiculos'));
        }else if ($user->rol == "Administrador") {
            return view('backend.administrador.publicidad.clubmotor.show', compact('publivehiculos'));
        }else if ($user->rol == "ResidenteUsuario") {
            return view('backend.usuario.publicidad.clubmotor.show', compact('publivehiculos'));
        }
        else if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publivehiculos = PublicacionVehiculos::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();

            return view('backend.pautante.publicidad.clubmotor.show', compact('publivehiculos'));
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

        $segmentos = SegmentosMotores::where('publivehiculo_id',$id)->get();

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

            $publivehiculos = PublicacionVehiculos::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();

            return view('backend.pautante.publicidad.clubmotor.edit',compact('arreglo_segmentos','paises','ciudades','localidades','conjuntos'), ['publivehiculos'=>$publivehiculos]);
        }
        else
        {
            $publivehiculos = PublicacionVehiculos::find($id);
            return view('backend.superadmin.publicidad.clubmotor.edit',compact('arreglo_segmentos','paises','ciudades','localidades','conjuntos'), ['publivehiculos'=>$publivehiculos]);
        }
        
    }
    /**Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublivehiculosUpdateRequest $request, $id)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            $publivehiculos = PublicacionVehiculos::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();
            $redirect_to = '/pautante/publicidad/clubmotor';
        }
        else
        {
            $publivehiculos = PublicacionVehiculos::find($id);
            $redirect_to = '/superadmin/publicidad/clubmotor';
        }

        $publivehiculos->fill($request->all());

        $publivehiculos->save();

        //Guardar segmentacion

        $segmentos = array_reverse($request->envio);

        //Eliminar anteriores

        SegmentosMotores::where('publivehiculo_id',$publivehiculos->id)->delete();


        foreach ($segmentos as $segmento) {


            $publiconjunto = new SegmentosMotores();

            $publiconjunto->publivehiculo_id = $publivehiculos->id;

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

                $buscar = SegmentosMotores::where(['localidad' => $zona_busqueda[0]->localidad,'publivehiculo_id' => $publivehiculos->id])->get();

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

                $buscar = SegmentosMotores::where(['ciudad' => $zona_busqueda[0]->ciudad,'publivehiculo_id' => $publivehiculos->id])->get();

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

                $buscar = SegmentosMotores::where(['pais' => $zona_busqueda[0]->pais,'publivehiculo_id' => $publivehiculos->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda

                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
            } 
        }

        Session::flash('message','Bono Club Motor Actualizado con Exito');
        return Redirect::to($redirect_to);
        
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publivehiculos=PublicacionVehiculos::destroy($id);
        Session::flash('message','Bono Club Motor Eliminado Correctamente');
        return Redirect::to('/superadmin/publicidad/clubmotor');
    }
    public function delete($id)
    {
        $publivehiculos = PublicacionVehiculos::find($id);
        return view('backend.superadmin.publicidad.clubmotor.delete', ['publivehiculos'=>$publivehiculos]);
    }

    public function changeStatus(Request $request)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publicidad = PublicacionVehiculos::where(['id' => $request->id,'usuario_id' => $user->id])->firstOrFail();

            //Actualizar

            $estado = $request->status == 1?1:0;

            PublicacionVehiculos::where('id',$request->id)->update(['enabled' => $estado]);

            Session::flash('message','El estado del bono Club Motor ha sido actualizado correctamente.');
            return Redirect::to('/pautante/publicidad/clubmotor');
        }

    }
}
