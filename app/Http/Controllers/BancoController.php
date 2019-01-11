<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BancoCrearRequest;
use App\Http\Requests\BancoUpdateRequest;
use Auth;
use DB;
use Input;
use Session;
use Redirect;
use App\User;
use App\Administrador;
use App\Conjunto;
use App\Banco;
use App\BancoConjunto;
use App\AdministradorConjunto;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
class BancoController extends Controller
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
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin 
            $bancos= Banco::all();
            return view ('backend.superadmin.bancos.index', compact('bancos'));
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es adminadministrador
            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        
            $bancos = DB::table('bancos as b')
            ->join('bancos_conjuntos as bc', 'bc.banco_id', '=', 'b.id')
            ->select('b.*')
            ->where('bc.conjunto_id', '=', $adminConjunto->conjunto_id)
            ->get();

            return view ('backend.administrador.bancos.index' , compact('admin', 'bancos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
        //Genera Redireccion si es super admin 
            $conjuntos = Conjunto::lists('nombre', 'id'); 
            return view('backend.superadmin.bancos.create', compact('conjuntos'));
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es super adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            //Chequear si ya tiene banco creado

            $bancos = BancoConjunto::where("conjunto_id", $adminConjunto->conjunto_id)->get();

            if(count($bancos) > 0)
            {
                Session::flash('message','Ha ocurrido un erorr durante el proceso');
                return Redirect::to('/administrador/bancos');
            }
            //cargar vista

            $conjuntos = Conjunto::where('id',$adminConjunto->conjunto_id)->lists('nombre', 'id');
            return view('backend.administrador.bancos.create', compact('conjuntos'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BancoCrearRequest $request)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $banco = new Banco();
            $banco->nombre = $request->nombre;
            $banco->pais = $request->pais;
            $banco->link = $request->link;
            if ($request->enabled == 1 ) {
                $banco->enabled = $request->enabled;
            }else{
                $banco->enabled = 0;
            }
            if ($request->img_banco == null) {
                 $banco->img_banco = "notiene.png";
            }else{

                //Submir imagen

                $archivo = $request->file('img_banco');

                $name = explode('.', $archivo->getClientOriginalName());

                $nombre_original = $user->id."/".$name[0].'-'.date('YmdHis').'.'.end($name);

                Storage::disk('bancos')->put($nombre_original,\File::get($archivo));

                $banco->img_banco = $nombre_original;
            }

            $banco->save();

            $banconjunto = new BancoConjunto();
            $banconjunto->banco_id = $banco->id;
            $banconjunto->conjunto_id = $request->$conjunto;
            $banconjunto->tipo_cuenta = $request->tipo_cuenta;
            $banconjunto->No_cuenta = $request->No_cuenta;
            $banconjunto->No_convenio = $request->No_convenio;
            if ($request->enabled == 1 ) {
                $banconjunto->habilitado = $request->enabled;
            }else{
                $banconjunto->habilitado = 0;
            }
            $banconjunto->save();
            Session::flash('message','Entidad Bancaria creada con Exito');
            return Redirect::to('/superadmin/bancos');
        }
        else if ($user->rol == "Administrador") 
        {
            //Verificar que no tenga un banco creado

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $bancos = BancoConjunto::where("conjunto_id", $adminConjunto->conjunto_id)->get();

            if(count($bancos) > 0)
            {
                Session::flash('message','Ha ocurrido un erorr durante el proceso');
                return Redirect::to('/administrador/bancos');
            }

            //Crear banco

            $banco = new Banco();
            $banco->nombre = $request->nombre;
            $banco->pais = $request->pais;
            $banco->link = $request->link;
            if ($request->enabled == 1 ) {
                $banco->enabled = $request->enabled;
            }else{
                $banco->enabled = 0;
            }
            if ($request->img_banco == null) {
                 $banco->img_banco = "notiene.png";
            }else{
               
                //Submir imagen

                $archivo = $request->file('img_banco');

                $name = explode('.', $archivo->getClientOriginalName());

                $nombre_original = $user->id."/".$name[0].'-'.date('YmdHis').'.'.end($name);

                Storage::disk('bancos')->put($nombre_original,\File::get($archivo));

                $banco->img_banco = $nombre_original;

            }


            $banco->save();

            //Guardar banco conjunto

            $banconjunto = new BancoConjunto();
            $banconjunto->banco_id = $banco->id;
            $banconjunto->conjunto_id = $adminConjunto->conjunto_id;
            $banconjunto->tipo_cuenta = $request->tipo_cuenta;
            $banconjunto->No_cuenta = $request->No_cuenta;
            $banconjunto->No_convenio = $request->No_convenio;
            if ($request->enabled == 1 ) 
            {
                $banconjunto->habilitado = $request->enabled;
            }
            else
            {
                $banconjunto->habilitado = 0;
            }

            $banconjunto->save();

            Session::flash('message','Convenio Creado con Exito');
            return Redirect::to('/administrador/bancos');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $banco = Banco::find($id);
            return view ('backend.superadmin.bancos.edit', ['banco'=>$banco]);
        }

        if($user->rol == 'Administrador')
        {
            //Validar que sea mi banco

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $banco = DB::table('bancos as b')
            ->join('bancos_conjuntos as bc', 'bc.banco_id', '=', 'b.id')
            ->select('b.*','bc.tipo_cuenta','bc.No_cuenta','bc.No_convenio')
            ->where(['bc.conjunto_id' => $adminConjunto->conjunto_id,'b.id' => $id])
            ->get();

            //Mostrar vista

            return view ('backend.administrador.bancos.edit', ['banco'=> $banco]);
        }
    }


    public function deletesuper($id)
    {
        $banco = Banco::find($id);
        return view ('backend.superadmin.bancos.delete', ['banco'=>$banco]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BancoUpdateRequest $request, $id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $banco= Banco::find($id);
            $banco->fill($request->all());
            $banco->save();
            Session::flash('message','Entidad Bancaria Actualizada Correctamente');
            return Redirect::to('superadmin/bancos');
        }
        else if ($user->rol == "Administrador") 
        {
            //Verificar que sea mi banco

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $banco = DB::table('bancos as b')
            ->join('bancos_conjuntos as bc', 'bc.banco_id', '=', 'b.id')
            ->select('b.*','bc.tipo_cuenta','bc.id as id_bc','bc.No_cuenta','bc.No_convenio')
            ->where(['bc.conjunto_id' => $adminConjunto->conjunto_id,'b.id' => $id])
            ->get();

            if(count($banco) == 0)
            {
                Session::flash('message','Ha ocurrido un error durante el proceso');
                return Redirect::to('administrador/bancos');
            }

            //Actualizar banco

            $datos_banco = ['nombre' => $request->nombre,'pais' => $request->pais,'link' => $request->link];

            if ($request->enabled == 1 ) {
                $datos_banco['enabled'] = $request->enabled;
            }else{
                $datos_banco['enabled'] = 0;
            }

            if ($request->img_banco == null) {
                $datos_banco['img_banco'] = $banco[0]->img_banco;
            }else{
                //Submir imagen

                $archivo = $request->file('img_banco');

                $name = explode('.', $archivo->getClientOriginalName());

                $nombre_original = $user->id."/".$name[0].'-'.date('YmdHis').'.'.end($name);

                Storage::disk('bancos')->put($nombre_original,\File::get($archivo));

                $datos_banco['img_banco'] = $nombre_original;

                //Eliminar anterior

                unlink('../public/uploads/bancos/'.$banco[0]->img_banco);
            }

            Banco::findOrFail($id)->update($datos_banco);

            //Actualizar banco conjunto

            $datos_bc = ['tipo_cuenta' => $request->tipo_cuenta,'No_cuenta' => $request->No_cuenta,'No_convenio' => $request->No_convenio];

            BancoConjunto::findOrFail($banco[0]->id_bc)->update($datos_bc);


            Session::flash('message','Entidad Bancaria Actualizada Correctamente');
            return Redirect::to('administrador/bancos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            $banco = Banco::destroy($id);
            Session::flash('message','Entidad Bancaria Eliminada Correctamente del sistema');
            return Redirect::to('superadmin/bancos');
        }

        if($user->rol == 'Administrador')
        {
            //Verificar que sea mi banco


            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $banco = DB::table('bancos as b')
            ->join('bancos_conjuntos as bc', 'bc.banco_id', '=', 'b.id')
            ->select('b.*','bc.tipo_cuenta','bc.id as id_bc','bc.No_cuenta','bc.No_convenio')
            ->where(['bc.conjunto_id' => $adminConjunto->conjunto_id,'b.id' => $id])
            ->get();

            if(count($banco) == 0)
            {
                Session::flash('message','Ha ocurrido un error durante el proceso');
                return Redirect::to('administrador/bancos');
            }


            //Eliminar banco y banco conjunto

            Banco::where('id', '=', $id)->delete();

            BancoConjunto::where('banco_id', '=', $id)->delete();

            Session::flash('message','Se ha eliminado el banco exitosamente.');
            return redirect()->to('administrador/bancos');

        }
        
    }
}
