<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PagoConjunto;
use App\Administrador;
use DB;
use App\Http\Requests\PagosMembresiasCrearRequest;
use App\AdministradorConjunto;
use Session;
use Redirect;
use Illuminate\Routing\Route;
class PagosMembresiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            //obtener listado de pagos

            $pagos = DB::table('pagos_conjuntos as pagos')
                ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
                ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
                ->where('payment_status','!=','')
                ->whereNull('pagos.deleted_at')
                ->groupBy('pagos.id')
                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.superadmin.pagosmembresias.index',compact("pagos"));
        }

        if($user->rol == 'Administrador')
        {
            //obtener listado de pagos

            $admin = Administrador::where('usuario_id',$user->id)->firstOrFail();

            $pagos = DB::table('pagos_conjuntos as pagos')
                ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
                ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
                ->where('administrador_id',$admin->id)
                ->where('payment_status','!=','')
                ->whereNull('pagos.deleted_at')
                ->groupBy('pagos.id')
                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.administrador.pagosmembresias.index',compact("pagos"));
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

        if($user->rol == 'SuperAdmin')
        {
            //obtener administradores

             $administradores = DB::table('administradores as admin')
                ->select('admin.id','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->where('admin.rol','Administrador')
                ->groupBy('admin.id')
                ->get();

           
            return view('backend.superadmin.pagosmembresias.create',compact('administradores'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagosMembresiasCrearRequest $request)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            $pagos = new PagoConjunto();

            //Obtener conjunto del admin

            $admin = AdministradorConjunto::where('administrador_id',$request->administrador_id)->get();

            if(count($admin) == 0)
            {
                Session::flash('message','Este administrador debe crear un conjunto antes de poseer un pago.');
                return Redirect::to('/superadmin/pagosmembresias/create');
            }

            //Obtener estado del pago

            $estado = 'APPROVED';

            if($request->payment_status == 0)
            {
                $estado = 'Pending';
            }

            if($request->payment_status == 2)
            {
                $estado = 'Vencido';
            }

            $pagos->administrador_id    = $request->administrador_id;
            $pagos->conjunto_id         = $admin[0]->conjunto_id;
            $pagos->reference           = $request->reference;
            $pagos->total               = $request->total;
            $pagos->transaction_id      = $request->transaction_id;
            $pagos->payment_method      = $request->payment_method;
            $pagos->payment_status      = $estado;
            $pagos->fecha_inicio        = $request->fecha_inicio;
            $pagos->fecha_fin           = $request->fecha_fin;
            $pagos->tipo_pago           = $request->tipo_pago;
            $pagos->status              = $request->payment_status;
            $pagos->save();

            Session::flash('message','Se ha creado el pago exitosamente.');
            return Redirect::to('/superadmin/pagosmembresias');
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

        if($user->rol == 'SuperAdmin')
        {
            //

            $administradores = DB::table('administradores as admin')
                ->select('admin.id','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->where('admin.rol','Administrador')
                ->groupBy('admin.id')
                ->get();

            //Obtener pago

            $pago = PagoConjunto::where('id',$id)->firstOrFail();

            return view('backend.superadmin.pagosmembresias.edit',compact("administradores","pago"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagosMembresiasCrearRequest $request, $id)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            //
             //Obtener conjunto del admin

            $admin = AdministradorConjunto::where('administrador_id',$request->administrador_id)->get();

            if(count($admin) == 0)
            {
                Session::flash('message','Este administrador debe crear un conjunto antes de poseer un pago.');
                return Redirect::to('/superadmin/pagosmembresias/'.$id.'edit');
            }

            //Obtener estado del pago

            $estado = 'APPROVED';

            if($request->payment_status == 0)
            {
                $estado = 'Pending';
            }

            if($request->payment_status == 2)
            {
                $estado = 'Vencido';
            }

            $datos = [
                'administrador_id'    => $request->administrador_id,
                'conjunto_id'         => $admin[0]->conjunto_id,
                'reference'           => $request->reference,
                'total'               => $request->total,
                'transaction_id'      => $request->transaction_id,
                'payment_method'      => $request->payment_method,
                'payment_status'      => $estado,
                'fecha_inicio'        => $request->fecha_inicio,
                'fecha_fin'           => $request->fecha_fin,
                'tipo_pago'           => $request->tipo_pago,
                'status'              => $request->payment_status,
            ];
            
            PagoConjunto::where('id',$id)->update($datos);

            Session::flash('message','Se ha editado el pago exitosamente.');
            return Redirect::to('/superadmin/pagosmembresias');
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
            //eliminar pago de membresia

            PagoConjunto::where('id',$id)->delete();

            Session::flash('message','El pago ha sido eliminado exitosamente.');
            return Redirect::to('/superadmin/pagosmembresias');
        }
    }

    public function buscarpagos(Request $request)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            //obtener listado de pagos con busqueda

            $search = $request->pago;

            $pagos = DB::table('pagos_conjuntos as pagos')
                ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
                ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
                ->where('payment_status','!=','')
                ->whereNull('pagos.deleted_at')
                ->where(function($query) use($search){
                    return $query
                    ->orWhere('con.nombre','LIKE','%'.$search.'%')
                    ->orWhere('u.nombres','LIKE','%'.$search.'%')
                    ->orWhere('u.apellidos','LIKE','%'.$search.'%')
                    ->orWhere('pagos.reference','LIKE','%'.$search.'%');
                })
                ->groupBy('pagos.id')

                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.superadmin.pagosmembresias.index',compact("pagos"));
       }

       if($user->rol == 'Administrador')
        {
            //obtener listado de pagos con busqueda

            $search = $request->pago;

            $admin = Administrador::where('usuario_id',$user->id)->firstOrFail();

            $pagos = DB::table('pagos_conjuntos as pagos')
                ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
                ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
                ->where('payment_status','!=','')
                ->where('administrador_id',$admin->id)
                ->whereNull('pagos.deleted_at')
                ->where(function($query) use($search){
                    return $query
                    ->orWhere('con.nombre','LIKE','%'.$search.'%')
                    ->orWhere('u.nombres','LIKE','%'.$search.'%')
                    ->orWhere('u.apellidos','LIKE','%'.$search.'%')
                    ->orWhere('pagos.reference','LIKE','%'.$search.'%');
                })
                ->groupBy('pagos.id')

                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.administrador.pagosmembresias.index',compact("pagos"));
       }
    }

    function getDetalles(Request $request)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            //Buscar detalles de la factura

            $datos = DB::table('pagos_conjuntos as pagos')
            ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
            ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
            ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
            ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
            ->where('pagos.id','=',$request->id)
            ->get();
        }

        if($user->rol == 'Administrador')
        {
            $admin = Administrador::where('usuario_id',$user->id)->firstOrFail();

            //Buscar detalles de la factura

            $datos = DB::table('pagos_conjuntos as pagos')
            ->select('pagos.*','con.nombre','u.nombres','u.apellidos')
            ->join('administradores as admin', 'admin.id', '=', 'pagos.administrador_id')
            ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
            ->join('conjuntos as con', 'con.id', '=', 'pagos.conjunto_id')
            ->where('pagos.id','=',$request->id)
            ->where('administrador_id',$admin->id)
            ->get();
        }

        if(count($datos) > 0)
        {
            //Formatear fechas

            $date = date_create($datos[0]->created_at);

            $datos[0]->created_at = date_format($date, 'd-m-Y');

            $date = date_create($datos[0]->fecha_inicio);

            $datos[0]->fecha_inicio = date_format($date, 'd-m-Y');

            $date = date_create($datos[0]->fecha_fin);

            $datos[0]->fecha_fin = date_format($date, 'd-m-Y');

            return response()->json(array('res' => 'success','datos' => $datos));
        }

        return response()->json(array('res' => 'error'));
    }
}
