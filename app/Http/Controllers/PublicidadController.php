<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\BonosCrearRequest;
use App\Http\Requests\BonosUpdateRequest;
use App\Http\Controllers\Controller;
use App\Conjunto;
use App\Administrador;
use App\AdministradorConjunto;
use App\Publicidad;
use App\PublicidadConjunto;
use Auth;
use DB;
use Input;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;
use App\Pagospublicidad;
use Storage;
use App\PublicidadSegmentos;

class PublicidadController extends Controller
{   
    protected $publicidad;
 
    public function __construct(Publicidad $publicidad)
    {
        $this->publicidad = $publicidad;

        $this->middleware('pagopautadescuento',['only' => ['create','store']]);
    }
    /**Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            $publicidades = Publicidad::orderBy('fecha', 'DESC')->paginate(300000);
        return view ('backend.superadmin.publicidad.bonos.index', compact ('publicidades'));
        } else if ($user->rol == "Administrador") {

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $conjunto = Conjunto::where('id',$adminConjunto->conjunto_id)->firstOrFail();

            $publicidades = DB::table('publicidad as pub')
            ->select('pub.*')
            ->join('segmentos_conjuntos as sc', 'sc.publicidad_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais])
            ->groupBy('sc.publicidad_id')
            ->paginate(30000);
            
            return View('backend.administrador.publicidad.bonos.index', compact('publicidades'));

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

            $publicidades = DB::table('publicidad as pub')
            ->select('pub.*')
            ->join('segmentos_conjuntos as sc', 'sc.publicidad_id', '=', 'pub.id')
            ->where(['sc.localidad' => $conjunto->localidad,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => $conjunto->ciudad,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->orWhere(['sc.localidad' => NULL,'sc.ciudad' => NULL,'sc.pais' => $conjunto->pais,'enabled' => 1])
            ->groupBy('sc.publicidad_id')
            ->get();

            return View('backend.usuario.publicidad.index', compact('publicidades'));
        }else if($user->rol == 'Pautante')
        {
            $publicidades= Publicidad::where('usuario_id',$user->id)->orderBy('fecha', 'DESC')->paginate(30000);
            return View('backend.pautante.publicidad.bonos.index', compact('publicidades'));
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
            return view('backend.pautante.publicidad.bonos.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
        }

        //Genera Redireccion si es super admin
        return view('backend.superadmin.publicidad.bonos.create', compact('paises', 'localidades', 'ciudades','conjuntos'));
            
    }
    /**Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BonosCrearRequest $request)
    {
        $user = Auth::user();

        $segmentos = array_reverse($request->envio);

        //Guardar datos
        
        $publicidad = new Publicidad();

        //Si es pautante guardar el id de usuario
            
        if($user->rol == 'Pautante')
        {
            $date = Carbon::now();

            $publicidad->usuario_id = $user->id;
            $publicidad->fecha_desde = date('Y-m-d');
            $publicidad->fecha_hasta = $date->addYear(1);

            //Buscar pago para asociar 

            $condicion = ['usuario_id' => $user->id,'publicidad_tipo' => 1,'payment_status' => 'APPROVED','utilizado' => 0,'status' => 1];

            $pago = PagosPublicidad::where($condicion)->firstOrFail();

            $publicidad->pago_publicidad_id = $pago->id;

        }
        else
        {
            $publicidad->fecha_desde = $request->fecha_desde;
            $publicidad->fecha_hasta = $request->fecha_hasta;
        }

        $publicidad->titulo = $request->titulo;
        $publicidad->fecha = Carbon::now();
        $publicidad->img_publicidad = $request->img_publicidad;
        $publicidad->logo = $request->logo;
        $publicidad->local = $request->local;
        $publicidad->tienda = $request->tienda;
        $publicidad->valor = $request->valor;
        $publicidad->link = $request->link;
        $publicidad->categoria = $request->categoria;
        if ($request->enabled == 1 ) {
                $publicidad->enabled = $request->enabled;
        }else{$publicidad->enabled = 0;}
        $publicidad->descripcion = $request->descripcion;
        $publicidad->save();

        //Guardar segmentacion
        // foreach ($conjuntos as $conjunto) {
        //     $publiconjunto= new PublicidadSegmentos();
        //     $publiconjunto->conjunto_id = $conjunto;
        //     $publiconjunto->publicidad_id = $publicidad->id;
        //     //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
        //     $publiconjunto->save();
        // }

        foreach ($segmentos as $segmento) {
            
            $publiconjunto = new PublicidadSegmentos();
            
            $publiconjunto->publicidad_id = $publicidad->id;

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

                $buscar = PublicidadSegmentos::where(['localidad' => $zona_busqueda[0]->localidad,'publicidad_id' => $publicidad->id])->get();

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

                $buscar = PublicidadSegmentos::where(['ciudad' => $zona_busqueda[0]->ciudad,'publicidad_id' => $publicidad->id])->get();

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

                $buscar = PublicidadSegmentos::where(['pais' => $zona_busqueda[0]->pais,'publicidad_id' => $publicidad->id])->get();

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

        $redirect_to = '/superadmin/publicidad/bonos';

        if($user->rol == 'Pautante')
        {
            $redirect_to = '/pautante/publicidad/bonos';

            PagosPublicidad::findOrFail($pago->id)->update(['utilizado' => 1]);
        }

        Session::flash('message','Bono Creado con Exito');
        return Redirect::to($redirect_to);
    }
    /**Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publicidad = $this->publicidad->findOrFail($id);
        $user= Auth::user();
        if ($user->rol == "SuperAdmin") {
            return view('backend.superadmin.publicidad.bonos.show', compact('publicidad'));
        }else if ($user->rol == "Administrador") {
            return view('backend.administrador.publicidad.bonos.show', compact('publicidad'));
        }else if ($user->rol == "ResidenteUsuario") {
            return view('backend.usuario.publicidad.show', compact('publicidad'));
        }else if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publicidad = Publicidad::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();

            return view('backend.pautante.publicidad.show', compact('publicidad'));

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

        $segmentos = PublicidadSegmentos::where('publicidad_id',$id)->get();

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
            //Verificar si es mi publicidad

            $publicidad = Publicidad::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();

            return view('backend.pautante.publicidad.bonos.edit',compact('arreglo_segmentos','paises', 'localidades', 'ciudades','conjuntos'), ['publicidad'=>$publicidad]);
        }
        else
        {
            $publicidad = Publicidad::find($id);

            return view('backend.superadmin.publicidad.bonos.edit',compact('arreglo_segmentos','paises', 'localidades', 'ciudades','conjuntos'), ['publicidad'=>$publicidad]);
        }
        
    }
    /**Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BonosUpdateRequest $request, $id)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            $publicidad = Publicidad::where(['id' => $id,'usuario_id' => $user->id])->firstOrFail();
            $redirect_to = '/pautante/publicidad/bonos';
        }
        else
        {
            $publicidad = Publicidad::find($id);
            $redirect_to = '/superadmin/publicidad/bonos';
        }

        $publicidad->fill($request->all());

        $publicidad->save();

        //Guardar segmentacion

        $segmentos = array_reverse($request->envio);

        //Eliminar anteriores

        PublicidadSegmentos::where('publicidad_id',$publicidad->id)->delete();

        foreach ($segmentos as $segmento) {
            
            $publiconjunto = new PublicidadSegmentos();
                
            $publiconjunto->publicidad_id = $publicidad->id;

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

                $buscar = PublicidadSegmentos::where(['localidad' => $zona_busqueda[0]->localidad,'publicidad_id' => $publicidad->id])->get();

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

                $buscar = PublicidadSegmentos::where(['ciudad' => $zona_busqueda[0]->ciudad,'publicidad_id' => $publicidad->id])->get();

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

                $buscar = PublicidadSegmentos::where(['pais' => $zona_busqueda[0]->pais,'publicidad_id' => $publicidad->id])->get();

                if(count($buscar) == 0)
                {
                    //Guardar busqueda
                    $publiconjunto->pais        = $zona_busqueda[0]->pais;
                    //$response = $publicidad->guardarPublicidadpush($publicidad->id, $publiconjunto->conjunto_id);
                    $publiconjunto->save();

                }
            } 
        }

        Session::flash('message','Bono de Descuento Actualizado con Exito');
        return Redirect::to($redirect_to);
        
    }
    /**Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publicidad=Publicidad::destroy($id);
        Session::flash('message','Bono de Descuento Eliminado Correctamente');
        return Redirect::to('/superadmin/publicidad/bonos');
    }

    public function delete($id)
    {
        $publicidad = Publicidad::find($id);
        return view('backend.superadmin.publicidad.bonos.delete', ['publicidad'=>$publicidad]);
    }

    public function borramasivos(Request $request)
    {
        $publicidad=Publicidad::destroy(Input::get('checkbox'));
        Session::flash('message','Bonos de Descuento Eliminados Correctamente');
        return Redirect::to('/superadmin/publicidad/bonos');
    }

    public function changeStatus(Request $request)
    {
        $user= Auth::user();

        if($user->rol == 'Pautante')
        {
            //Verificar si es mi publicidad

            $publicidad = Publicidad::where(['id' => $request->id,'usuario_id' => $user->id])->firstOrFail();

            //Actualizar

            $estado = $request->status == 1?1:0;

            Publicidad::where('id',$request->id)->update(['enabled' => $estado]);

            Session::flash('message','El estado del bono ha sido actualizado correctamente.');
            return Redirect::to('/pautante/publicidad/bonos');
        }

    }
}
