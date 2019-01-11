<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApartamentoCrearRequest;
use App\Http\Requests\ApartamentoUpdateRequest;
use App\Http\Requests\ApartamentoCrearmultipleRequest;
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

class ApartamentoController extends Controller
{
/** @return Response
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
            $apartamentos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('apartamento.id','apartamento.apartamento','apartamento.zona_id','zona.tipo','zona.zona', 'conjunto.nombre','conjunto.tipo','usuario.nombres', 'usuario.apellidos', 'u_a.propietario')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('apartamento.id')
            ->get();
            $count = new Apartamento();
            return view ('backend.superadmin.apartamentos.index' , compact ('apartamentos', 'conjuntos', 'count', 'conjunto'));

        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjuntoadmin = $adminConjunto->conjunto_id;
            $conjunto= Conjunto::where('id', '=',$conjuntoadmin)->get();
            $zonas = Zona::with('apartamentos.usuarios')->where ('conjunto_id',$conjunto->first()->id)->get();
            $count = new apartamento();
            return view ('backend.administrador.apartamentos.index', compact('conjunto', 'zonas', 'count'));
        }
    }

    public function create()
    {   
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin  
                $conjuntos= Conjunto::lists('nombre', 'id');
                return view('backend.superadmin.apartamentos.create', compact('conjuntos'));
            }else if($user->rol == "Administrador"){
                    //Genera Redireccion si es super adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjunto = Conjunto::where('id',$adminConjunto->conjunto_id)->lists('nombre', 'id');
            return view('backend.administrador.apartamentos.create', compact('conjunto','zonas'));
        }
    }
    /*** @return Response
     */
    public function store(ApartamentoCrearRequest $request)
    {
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
                $conjunto= $request->conjunto;
                $apto = DB::table('apartamentos as apartamento')
                ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                ->select('apartamento.id')
                ->where('apartamento.apartamento', '=',$request->apartamento)
                ->where('apartamento.zona_id', '=',$request->zona)
                ->where('conjunto.id', '=',$conjunto)
                ->count();

                if ($apto <= 0) {
                    $apartamento = new Apartamento();
                    $apartamento->apartamento = $request->apartamento;
                    $apartamento->descripcion = $request->descripcion;
                    $apartamento->matricula_inmobiliaria = $request->matricula_inmobiliaria;
                    $apartamento->zona_id = $request->zona;
                    $apartamento->save();
                    Session::flash('message','Apartamento creado exitosamente');
                    return Redirect::to('/superadmin/apartamentos');

                }else{
                    Session::flash('message-error', 'No se ha podido crear el apartamento, ya existe uno en nuestra base de datos');
                    return Redirect::to('superadmin/apartamentos');
                }

        }else if($user->rol == "Administrador"){
                $conjunto= $request->conjunto;
                $apto = DB::table('apartamentos as apartamento')
                ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                ->select('apartamento.id')
                ->where('apartamento.apartamento', '=',$request->apartamento)
                ->where('apartamento.zona_id', '=',$request->zona)
                ->where('conjunto.id', '=',$conjunto)
                ->count();

                if ($apto <= 0) {
                    $apartamento = new Apartamento();
                    $apartamento->apartamento = $request->apartamento;
                    $apartamento->descripcion = $request->descripcion;
                    $apartamento->zona_id = $request->zona;
                    $apartamento->matricula_inmobiliaria = $request->matricula_inmobiliaria;
                    $apartamento->save();
                    Session::flash('message','Apartamento creado exitosamente');
                    return Redirect::to('/administrador/apartamentos');

                }else{
                    Session::flash('message-error', 'No se ha podido crear el apartamento, ya existe uno en nuestra base de datos');
                    return Redirect::to('administrador/apartamentos');
                }
        }
    }

    public function storemultiple1(ApartamentoCrearMultipleRequest $request)
    {

            $conjunto= $request->conjunto_m;
            $zona = $request->zona_m;
            $apartamento= $request->apartamento_m;

            $explode = explode("-", $apartamento);
            $count =  count($explode);
            if($count == 2){
                $initial = $explode[0];
                $final = $explode[1];
                if($initial < $final){
                    $aptos_count = ($final - $initial) + 1 ;
                    if($aptos_count <= 10){

                        $success = array();
                        $error = array();
                        $i=0;
                        for($x=$initial;$x<=$final;$x++){

                            $apto = DB::table('apartamentos as apartamento')
                            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                            ->select('apartamento.id')
                            ->where('apartamento.apartamento', '=',$x)
                            ->where('apartamento.zona_id', '=',$zona)
                            ->where('conjunto.id', '=',$conjunto)
                            ->count();

                            if($apto <= 0){
                                // store
                                $apartamento = new Apartamento();
                                $apartamento->apartamento = $x;
                                $apartamento->descripcion = '';
                                $apartamento->zona_id = $zona;
                                $apartamento->matricula_inmobiliaria = '';
                                $apartamento->save();
                                $success[$i] = $x;

                            }else{
                                $error[$i] = $x;
                            }

                            $i++;
                        }
                        $aptos_success = implode("-",$success);
                        if(!empty($error)){
                            $aptos_error = implode("-",$error);
                           $msg = "Apartamentos Creados: ".$aptos_success."  /  Apartamentos Existentes: <b>".$aptos_error."</b>";
                        }else{
                           $msg = "Apartamentos Creados: ".$aptos_success."</b>";
                        }
                        Session::flash('message', $msg);
                        return Redirect::to('/superadmin/apartamentos');
                    }else{
                        Session::flash('message-error', "Solo se permiten crear 10 apartamentos por unidad, Intentelo Nuevamente!");
                        return Redirect::to('/superadmin/apartamentos');
                    }
                }else{
                    Session::flash('message-error', "Se ha tratado de crear apartamentos con valores incorrectos");
                    return Redirect::to('/superadmin/apartamentos');
                }
            }else{
                Session::flash('message-error', "Debes crear multiples apartamentos. Ejemplo: 101-107");
                return Redirect::to('/superadmin/apartamentos');
            }
        }

        public function storemultiple(ApartamentoCrearMultipleRequest $request)
        {
            $conjunto= $request->conjunto_m;
            $zona = $request->zona_m;
            $apartamento= $request->apartamento_m;

            $explode = explode("-", $apartamento);
            $count =  count($explode);
            if($count == 2){
                $initial = $explode[0];
                $final = $explode[1];
                if($initial < $final){
                    $aptos_count = ($final - $initial) + 1 ;
                    if($aptos_count <= 10){

                        $success = array();
                        $error = array();
                        $i=0;
                        for($x=$initial;$x<=$final;$x++){

                            $apto = DB::table('apartamentos as apartamento')
                            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                            ->select('apartamento.id')
                            ->where('apartamento.apartamento', '=',$x)
                            ->where('apartamento.zona_id', '=',$zona)
                            ->where('conjunto.id', '=',$conjunto)
                            ->count();

                            if($apto <= 0){
                                // store
                                $apartamento = new Apartamento();
                                $apartamento->apartamento = $x;
                                $apartamento->descripcion = '';
                                $apartamento->zona_id = $zona;
                                $apartamento->matricula_inmobiliaria = '';
                                $apartamento->save();
                                $success[$i] = $x;

                            }else{
                                $error[$i] = $x;
                            }
                            $i++;
                        }
                        $aptos_success = implode("-",$success);
                        if(!empty($error)){
                            $aptos_error = implode("-",$error);
                           $msg = "Apartamentos Creados: <b>".$aptos_success."</b>  /  Apartamentos Existentes: <b>".$aptos_error."</b>";
                        }else{
                           $msg = "Apartamentos Creados: <b>".$aptos_success."</b>";
                        }
                        Session::flash('message', $msg);
                        return Redirect::to('/administrador/apartamentos');
                    }else{
                        Session::flash('message-error', "Solo se permiten crear 10 apartamentos por unidad, Intentelo Nuevamente!");
                        return Redirect::to('/administrador/apartamentos');
                    }
                }else{
                    Session::flash('message-error', "Se ha tratado de crear apartamentos con valores incorrectos");
                    return Redirect::to('/administrador/apartamentos');
                }
            }else{
                Session::flash('message-error', "Debes crear multiples apartamentos. Ejemplo: 101-107");
                return Redirect::to('/administrador/apartamentos');
            }
        }      

    public function show($id)
    {
        //Apartamento ID
    }

    /*** @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $apartamento = Apartamento::find($id);
        $zona = Zona::where('id',$apartamento->zona_id)->get();
                $data= [ 
                            'apartamento'  => $apartamento,
                            'zonas' => $zona->lists('zona', 'id'),
                            'conjuntos' =>Conjunto::where('id', $zona->first()->conjunto_id)->lists('nombre', 'id'),
                        ];
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
        return view ('backend.superadmin.apartamentos.edit', $data);
        }else if ($user->rol == "Administrador") {
         return view ('backend.administrador.apartamentos.edit', $data);
        }
    }
    /** @param  int  $id
     * @return Response
     */
    public function update(ApartamentoUpdateRequest $request, $id)
    {
         $user = Auth::user();
            if($user->rol == "SuperAdmin"){

                $conjunto= $request->conjunto;
                $apto = DB::table('apartamentos as apartamento')
                            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                            ->select('apartamento.id')
                            ->where('apartamento.apartamento', '=',$request->apartamento)
                            ->where('apartamento.zona_id', '=',$request->zona)
                            ->where('conjunto.id', '=',$conjunto)
                            ->count();

                if ($apto <= 0) {
                    $apartamento = Apartamento::find($id);
                    $apartamento->fill($request->all());
                    $apartamento->save();
                    Session::flash('message','Apartamento Actualizado Exitosamente');
                    return Redirect::to('/superadmin/apartamentos');

                }else{
                    Session::flash('message-error', 'No se ha podido crear el apartamento, ya existe uno en nuestra base de datos');
                    return Redirect::to('superadmin/apartamentos');
                }
            }else if($user->rol == "Administrador"){

            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $conjunto = $adminConjunto->conjunto_id;

                $apto = DB::table('apartamentos as apartamento')
                            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                            ->select('apartamento.id')
                            ->where('apartamento.apartamento', '=',$request->apartamento)
                            ->where('apartamento.zona_id', '=',$request->zona)
                            ->where('conjunto.id', '=',$conjunto)
                            ->count();

                if ($apto <= 0) {
                    $apartamento = Apartamento::find($id);
                    $apartamento->fill($request->all());
                    $apartamento->save();
                    Session::flash('message','Apartamento Actualizado Correctamente');
                    return Redirect::to('/administrador/apartamentos');

                }else{
                    Session::flash('message-error', 'No se ha podido crear el apartamento, ya existe uno en nuestra base de datos');
                    return Redirect::to('administrador/apartamentos');
                }
        }
    }

    public function deletesuper($id)
    {
        //Genera Redireccion si es super adminadministrador
        $apartamento = Apartamento::find($id);
        return view('backend.superadmin.apartamentos.delete', ['apartamento'=>$apartamento]);
    }

    public function delete($id)
    {
        //Genera Redireccion si es administrador
        $apartamento = Apartamento::find($id);
        return view('backend.administrador.apartamentos.delete', ['apartamento'=>$apartamento]);
    }
    /*** @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $apartamento=Apartamento::destroy($id);
            Session::flash('message','Apartamento Eliminado Correctamente');
            return Redirect::to('/superadmin/apartamentos');
        }else if ($user->rol == "Administrador"){
            $apartamento=Apartamento::destroy($id);
            Session::flash('message','Apartamento Eliminado Correctamente');
            return Redirect::to('/administrador/apartamentos');
        }
    }

    public function buscar (Request $request)
    {
        $conjunto = $request->conjunto;
        $conjuntos = Conjunto::lists('nombre', 'id');
        $apartamentos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('apartamento.id','apartamento.apartamento','apartamento.zona_id','zona.tipo','zona.zona', 'conjunto.nombre','usuario.nombres', 'usuario.apellidos', 'u_a.propietario')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('apartamento.id')
            ->get();
        $count = new Apartamento();
        return view ('backend.superadmin.apartamentos.index' , compact ('apartamentos', 'conjuntos', 'conjunto', 'count'));

    }
}