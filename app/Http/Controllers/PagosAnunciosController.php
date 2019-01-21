<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use App\Http\Requests\PagosAnunciosCrearRequest;
use App\PagosPublicidad;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class PagosAnunciosController extends Controller
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
        //
            //obtener listado de pagos

            $pagos = DB::table('pagos_publicidad as pagos')
                ->select('pagos.*','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
                ->where('payment_status','!=','')
                ->whereNull('pagos.deleted_at')
                ->groupBy('pagos.id')
                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.superadmin.pagosanuncios.index',compact("pagos"));

       }

       if($user->rol == 'Pautante')
        {
        //
            //obtener listado de pagos

            $pagos = DB::table('pagos_publicidad as pagos')
                ->select('pagos.*','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
                ->where('payment_status','!=','')
                ->where('pagos.usuario_id',$user->id)
                ->whereNull('pagos.deleted_at')
                ->groupBy('pagos.id')
                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.pautante.pagosanuncios.index',compact("pagos"));

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
            //
            //obtener administradores

             $pautantes = DB::table('administradores as admin')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->where('admin.rol','Pautante')
                ->groupBy('admin.id')
                ->get();

           
            return view('backend.superadmin.pagosanuncios.create',compact('pautantes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PagosAnunciosCrearRequest $request)
    {
        //
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {

            $pagos = new PagosPublicidad();

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

            $pagos->usuario_id          = $request->usuario_id;
            $pagos->publicidad_tipo     = $request->publicidad_tipo;
            $pagos->reference           = $request->reference;
            $pagos->total               = $request->total;
            $pagos->transaction_id      = $request->transaction_id;
            $pagos->payment_method      = $request->payment_method;
            $pagos->payment_status      = $estado;
            $pagos->tipo_pago           = $request->tipo_pago;
            $pagos->buyer_email         = $request->buyer_email;
            $pagos->status              = $request->payment_status;
            $pagos->save();

            Session::flash('message','Se ha creado el pago exitosamente.');
            return Redirect::to('/superadmin/pagosanuncios');
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
            $pautantes = DB::table('administradores as admin')
                ->join('usuarios as u', 'u.id', '=', 'admin.usuario_id')
                ->where('admin.rol','Pautante')
                ->groupBy('admin.id')
                ->get();

            //Obtener pago

            $pago = PagosPublicidad::where('id',$id)->firstOrFail();

            return view('backend.superadmin.pagosanuncios.edit',compact("pautantes","pago"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagosAnunciosCrearRequest $request, $id)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {

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
                'usuario_id'          => $request->usuario_id,
                'publicidad_tipo'     => $request->publicidad_tipo,
                'reference'           => $request->reference,
                'total'               => $request->total,
                'transaction_id'      => $request->transaction_id,
                'payment_method'      => $request->payment_method,
                'payment_status'      => $estado,
                'tipo_pago'           => $request->tipo_pago,
                'buyer_email'         => $request->buyer_email,
                'status'              => $request->payment_status,
            ];
            
            PagosPublicidad::where('id',$id)->update($datos);

            Session::flash('message','Se ha editado el pago exitosamente.');
            return Redirect::to('/superadmin/pagosanuncios');
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
            //
            //eliminar pago de membresia

            PagosPublicidad::where('id',$id)->delete();

            Session::flash('message','El pago ha sido eliminado exitosamente.');
            return Redirect::to('/superadmin/pagosanuncios');
        }
    }

    public function buscarpagos(Request $request)
    {
        //obtener listado de pagos con busqueda
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {

            $search = $request->pago;

            $pagos = DB::table('pagos_publicidad as pagos')
                ->select('pagos.*','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
                ->where('payment_status','!=','')
                ->whereNull('pagos.deleted_at')
                ->where(function($query) use($search){
                    return $query
                    ->orWhere('u.nombres','LIKE','%'.$search.'%')
                    ->orWhere('u.apellidos','LIKE','%'.$search.'%')
                    ->orWhere('pagos.buyer_email','LIKE','%'.$search.'%')
                    ->orWhere('pagos.reference','LIKE','%'.$search.'%');

                })
                ->groupBy('pagos.id')

                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.superadmin.pagosanuncios.index',compact("pagos"));
       }

       if($user->rol == 'Pautante')
        {

            $search = $request->pago;

            $pagos = DB::table('pagos_publicidad as pagos')
                ->select('pagos.*','u.nombres','u.apellidos')
                ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
                ->where('payment_status','!=','')
                ->where('pagos.usuario_id',$user->id)
                ->whereNull('pagos.deleted_at')
                ->where(function($query) use($search){
                    return $query
                    ->orWhere('u.nombres','LIKE','%'.$search.'%')
                    ->orWhere('u.apellidos','LIKE','%'.$search.'%')
                    ->orWhere('pagos.buyer_email','LIKE','%'.$search.'%')
                    ->orWhere('pagos.reference','LIKE','%'.$search.'%');

                })
                ->groupBy('pagos.id')

                ->orderBy('created_at','DESC')
                ->paginate(30000);

           return view('backend.pautante.pagosanuncios.index',compact("pagos"));
       }
    }

    function getDetalles(Request $request)
    {
        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
            //Buscar detalles de la factura

            $datos = DB::table('pagos_publicidad as pagos')
            ->select('pagos.*','u.nombres','u.apellidos')
            ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
            ->where('pagos.id','=',$request->id)
            ->get();
        }

        if($user->rol == 'Pautante')
        {
            //Buscar detalles de la factura

            $datos = DB::table('pagos_publicidad as pagos')
            ->select('pagos.*','u.nombres','u.apellidos')
            ->join('usuarios as u', 'u.id', '=', 'pagos.usuario_id')
            ->where('pagos.id','=',$request->id)
            ->where('pagos.usuario_id','=',$user->id)
            ->get();
        }

        if(count($datos) > 0)
        {
            //Formatear fechas

            $date = date_create($datos[0]->created_at);

            $datos[0]->created_at = date_format($date, 'd-m-Y');

            return response()->json(array('res' => 'success','datos' => $datos));
        }

        return response()->json(array('res' => 'error'));
    }
}
