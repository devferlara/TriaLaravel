<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FacturaCargarRequest;
use Auth;
use DB;
use Excel;
use PHPExcel_Settings;
use File;
use Storage;
use Input;
use Session;
use Redirect;
use App\Conjunto;
use App\Administrador;
use App\AdministradorConjunto;
use App\User;
use App\Factura;
use App\Banco;
use App\Recibo;
use App\BancoConjunto;
use App\Apartamento;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
        //Genera Redireccion si es super admin 
            $conjunto = $request->conjunto;
            $conjuntos = Conjunto::lists('nombre', 'id');
            $recibos = DB::table('factura_apartamentos as recibo')
            ->join('apartamentos as apartamento', 'recibo.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('recibo.*')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('apartamento.id')
            ->get();
            $count = new Recibo();
            return view ('backend.superadmin.facturas.index', compact('conjuntos','count','recibos','conjunto'));
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es adminadministrador
            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $valorconjunto = $adminConjunto->conjunto_id;
            $conjunto= Conjunto::where('id',$valorconjunto)->get();
            $recibo = new Recibo();
            $recibos = $recibo->obtenerRecibosConjunto($valorconjunto);
            $count = new Conjunto();
            return view ('backend.administrador.facturas.index' , compact('conjunto', 'admin', 'recibos', 'count'));
        }else if ($user->rol == "ResidenteUsuario") {
            $recibos = DB::table('factura_apartamentos as recibo')
            ->join('apartamentos as apto', 'recibo.apartamento_id', '=', 'apto.id')
            ->join('usuario_apartamentos as u_apartamento', 'apto.id', '=', 'u_apartamento.apartamento_id')
            ->select('recibo.*')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->get();
            return view ('backend.usuario.recibos.index', compact('recibos'));
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
            return view ('backend.superadmin.facturas.create',compact('conjuntos'));
        }else if($user->rol == "Administrador"){
            return view ('backend.administrador.facturas.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacturaCargarRequest $request)
    {
        $idconjunto = $request->conjunto;
        $banco = BancoConjunto::where("conjunto_id", $idconjunto)->first();
        $apartamentos = DB::table('apartamentos as apartamento')
            ->join('zonas as zona', 'zona.id', '=', 'apartamento.zona_id')
            ->join('conjuntos as conjunto', 'conjunto.id', '=', 'zona.conjunto_id')
            ->select('apartamento.*')
            ->where('conjunto.id', '=', $idconjunto)
            ->get();
        $archivo = $request->file('archivo');
        $nombre_original = $idconjunto."/".$archivo->getClientOriginalName();
        $extension = $archivo->getClientOriginalExtension();
        $r1 = Storage::disk('facturas')->put($nombre_original,\File::get($archivo));
        $ruta = "public/uploads/facturas/conjunto/". $nombre_original;
        Excel::selectSheetsByIndex(0)->load($ruta, function($hoja){
            $hoja->each(function($fila){
                    $fechacarga = Recibo::where("fecha", $fila->fecha)->first();
                    if (count($fechacarga)==0) {
                        $recibo = new Recibo();
                        $recibo->num_factura = $fila->num_factura;
                        $recibo->fecha = $fila->fecha;
                        $recibo->apartamento_id = $fila->apartamento_id;
                        $recibo->valoradmon = $fila->valoradmon;
                        $recibo->valorparqueadero = $fila->valorparqueadero;
                        $recibo->valormultadmon = $fila->valormultadmon;
                        $recibo->valormultaparqueadero = $fila->valormultaparqueadero;
                        $recibo->valorcuotaextraordinaria = $fila->valorcuotaextraordinaria;
                        $recibo->descuentoadmon = $fila->descuentoadmon;
                        $recibo->descuentoparqueadero = $fila->descuentoparqueadero;
                        $recibo->descuetocuotaextra = $fila->descuetocuotaextra;
                        $recibo->saldoparqueadero = $fila->saldoparqueadero;
                        $recibo->saldoadmon = $fila->saldoadmon;
                        $recibo->saldocuotaextra = $fila->saldocuotaextra;
                        $recibo->saldomultadmon = $fila->saldomultadmon;
                        $recibo->saldomultaparqueadero = $fila->saldomultaparqueadero;
                        $recibo->saldomultacuotaextra = $fila->saldomultacuotaextra;
                        $recibo->meses_mora = $fila->meses_mora;
                        $recibo->total_a_pagar = $fila->total_a_pagar;
                        $recibo->pago_anterior = $fila->pago_anterior;
                        $recibo->save();
                }
            });
        });
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscar(Request $request)
    {
        $conjunto = $request->conjunto;
        $conjuntos = Conjunto::lists('nombre', 'id');
        $recibos = DB::table('factura_apartamentos as recibo')
            ->join('apartamentos as apartamento', 'recibo.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('recibo.*')
            ->where('conjunto.id', '=', $conjunto)
            ->groupBy('apartamento.id')
            ->get();
        $count = new Recibo();
        return view ('backend.superadmin.facturas.index' , compact ('recibos', 'conjuntos', 'conjunto', 'count'));
    }
}
