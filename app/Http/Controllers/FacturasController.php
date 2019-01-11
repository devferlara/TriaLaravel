<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FacturaRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Redirect;
use File;
use Storage;
use Input;
use App\Factura;
use App\Conjunto;
use App\CsvFactura;
use App\Administrador;
use App\AdministradorConjunto;
use DB;
use App\Zona;
use App\Http\Requests\ManualFacturaRequest;

class FacturasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $recibos = CsvFactura::where('administrador_id',$admin->id)->get();

            return view('backend.administrador.facturas.index',compact("recibos"));
        }

        if($user->rol == 'ResidenteUsuario')
        {
            //Obtener recibos

            $recibos = DB::table('facturas_conjuntos as fc')
            ->join('apartamentos as apto', 'apto.matricula_inmobiliaria', '=', 'fc.matricula_inmobiliaria')
            ->join('usuario_apartamentos as ua', 'ua.apartamento_id', '=', 'apto.id')
            ->select('fc.*')
            ->where('ua.usuario_id', '=', $user->id)
            ->get();

            //Obtener banco

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->get();

            $banco = [];

            if(count($adminConjunto) > 0)
            {
                $banco = DB::table('bancos as b')
                ->join('bancos_conjuntos as bc', 'bc.banco_id', '=', 'b.id')
                ->select('b.*','bc.tipo_cuenta','bc.id as id_bc','bc.No_cuenta','bc.No_convenio')
                ->where(['bc.conjunto_id' => $adminConjunto[0]->conjunto_id])
                ->get();
            }
            
            return view ('backend.usuario.recibos.index', compact('recibos','banco'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            return view('backend.administrador.facturas.create');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacturaRequest $request)
    {
        //

        $user = Auth::user();

        $archivo = $request->file('archivo');

        $name = explode('.', $archivo->getClientOriginalName());

        $nombre_original = $user->id."/".$name[0].'-'.date('YmdHis').'.'.end($name);

        $r1 = Storage::disk('facturas')->put($nombre_original,\File::get($archivo));

        $ruta = "../public_html/uploads/facturas/conjunto/". $nombre_original;

        //Registrar subida del csv

        $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

        $csvFactura =  new CsvFactura();

        $csvFactura->name = $request->name;

        $csvFactura->file_name = $nombre_original;

        $csvFactura->administrador_id = $admin->id;

        $csvFactura->save();

        //Leer archivo para guardar datos

        $archivo_csv = fopen ($ruta , "r");

        while($datos = fgetcsv($archivo_csv,1000,";"))
        {
            //Buscar conjunto por NIT

            $conjunto = Conjunto::where('nit',$datos[1])->get();

            if(count($conjunto) == 0)
            {
                continue;
            }

            //Evaluar que sea mi conjunto

            $miconjunto = AdministradorConjunto::where(['administrador_id' => $admin->id, 'conjunto_id' => $conjunto[0]->id])->get();

            if(count($miconjunto) == 0)
            {
                continue;
            }

            $factura = new Factura();
            $factura->conjunto_id               = $conjunto[0]->id;
            $factura->csv_id                    = $csvFactura->id;
            $factura->fecha_corte               = $datos[4];
            $factura->nombre_propietaria        = $datos[5];
            $factura->valor_adeudado            = $datos[7];
            $factura->matricula_inmobiliaria    = $datos[8];
            $factura->coeficiente_inmueble      = $datos[9];
            $factura->concepto_pago             = $datos[10];
            $factura->saldo_mes_anterior        = $datos[11];
            $factura->saldo_anterior            = $datos[12];
            $factura->nuevo_saldo               = $datos[13];
            $factura->total_mes                 = $datos[14];
            $factura->correo_conjunto           = $datos[15];

            $factura->save();
        }

        Session::flash('message','Se han registrado las facturas exitosamente.');
        return redirect()->to('administrador/facturas');


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

        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Obtener datos de la factura

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $factura = CsvFactura::where(['id' => $id,'administrador_id' => $admin->id])->firstOrFail();

            return view('backend.administrador.facturas.edit',compact("factura"));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacturaRequest $request, $id)
    {
        //

        $user = Auth::user();

        //Verificar que sea mi factura

        $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

        $factura = CsvFactura::where(['id' => $id,'administrador_id' => $admin->id])->firstOrFail();

        //Guardar archivo

        $archivo = $request->file('archivo');

        $name = explode('.', $archivo->getClientOriginalName());

        $nombre_original = $user->id."/".$name[0].'-'.date('YmdHis').'.'.end($name);

        $r1 = Storage::disk('facturas')->put($nombre_original,\File::get($archivo));

        $ruta = "../public_html/uploads/facturas/conjunto/". $nombre_original;

        //Actualizar el csv

        CsvFactura::findOrFail($id)->update(['name' => $request->name,'file_name' => $nombre_original]);

        //Elimiar las facturas anteriores

        unlink("../public_html/uploads/facturas/conjunto/". $factura->file_name);

        Factura::where('csv_id', '=', $id)->delete();

        //Leer archivo para guardar datos

        $archivo_csv = fopen ($ruta , "r");

        while($datos = fgetcsv($archivo_csv,1000,";"))
        {
            //Buscar conjunto por NIT

            $conjunto = Conjunto::where('nit',$datos[1])->get();

            if(count($conjunto) == 0)
            {
                continue;
            }

            //Evaluar que sea mi conjunto

            $miconjunto = AdministradorConjunto::where(['administrador_id' => $admin->id, 'conjunto_id' => $conjunto[0]->id])->get();

            if(count($miconjunto) == 0)
            {
                continue;
            }

            $factura = new Factura();
            $factura->conjunto_id               = $conjunto[0]->id;
            $factura->csv_id                    = $id;
            $factura->fecha_corte               = $datos[4];
            $factura->nombre_propietaria        = $datos[5];
            $factura->valor_adeudado            = $datos[7];
            $factura->matricula_inmobiliaria    = $datos[8];
            $factura->coeficiente_inmueble      = $datos[9];
            $factura->concepto_pago             = $datos[10];
            $factura->saldo_mes_anterior        = $datos[11];
            $factura->saldo_anterior            = $datos[12];
            $factura->nuevo_saldo               = $datos[13];
            $factura->total_mes                 = $datos[14];
            $factura->correo_conjunto           = $datos[15];

            $factura->save();
        }

        Session::flash('message','Se han editado las facturas exitosamente.');
        return redirect()->to('administrador/facturas');
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
        $user = Auth::user();

        //Verificar que sea mi factura

        $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

        $factura = CsvFactura::where(['id' => $id,'administrador_id' => $admin->id])->firstOrFail();

        //Elimiar las facturas anteriores

        //unlink("../public/uploads/facturas/conjunto/". $factura->file_name);

        CsvFactura::where('id', '=', $id)->delete();

        Factura::where('csv_id', '=', $id)->delete();

        Session::flash('message','Se han eliminado las facturas exitosamente.');
        return redirect()->to('administrador/facturas');


    }

    public function detalles($id)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Verificar que sea mi csv

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $recibos = CsvFactura::where(['administrador_id' => $admin->id,'id' => $id])->firstOrFail();

            //Obtener facturas

            $facturas = Factura::where('csv_id',$id)->get();

            return view('backend.administrador.facturas.detalles',compact("facturas","recibos"));
        }
    }

    public function getDetalles(Request $request)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Buscar detalles de la factura

            $datos = DB::table('facturas_conjuntos as fc')
            ->join('apartamentos as apto', 'fc.matricula_inmobiliaria', '=', 'apto.matricula_inmobiliaria')
            ->select('fc.*','apto.descripcion')
            ->where('fc.id', '=', $request->id)
            ->get();
        }
        
        if($user->rol == 'ResidenteUsuario')
        {
            //Buscar detalles de la factura

            $datos = DB::table('facturas_conjuntos as fc')
            ->join('apartamentos as apto', 'fc.matricula_inmobiliaria', '=', 'apto.matricula_inmobiliaria')
            ->join('usuario_apartamentos as ua', 'ua.apartamento_id', '=', 'apto.id')
            ->select('fc.*','apto.descripcion')
            ->where(['fc.id' => $request->id,'ua.usuario_id' => $user->id])
            ->get();
        }

        if(count($datos) > 0)
        {
            //Formatear fechas

            $date = date_create($datos[0]->created_at);

            $datos[0]->created_at = date_format($date, 'd-m-Y');

            $date = date_create($datos[0]->fecha_corte);

            $datos[0]->fecha_corte = date_format($date, 'd-m-Y');

            return response()->json(array('res' => 'success','datos' => $datos));
        }

        return response()->json(array('res' => 'error'));
        
    }

    public function changeStatus(Request $request)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Verificar que sea mi factura

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $datos = DB::table('facturas_conjuntos as fc')
            ->join('administrador_conjuntos as ac', 'ac.conjunto_id', '=', 'fc.conjunto_id')
            ->select('fc.id')
            ->where(['fc.id' =>$request->id,'ac.administrador_id' => $admin->id])
            ->get();

            if(count($datos) > 0)
            {
                //Actualizar registro

                Factura::findOrFail($datos[0]->id)->update(['estado' => $request->status]);

                Session::flash('message','Se ha cambiado el estado de la factura con exito.');
                return redirect()->route('administrador.facturas.detalles', ['id' => $request->id_csv]);
            }
            else
            {
                Session::flash('message','Ha ocurrido un error durate el proceso.');
                return redirect()->to('administrador/facturas');
            }
        }
    }

    public function crearFactura($id)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Verificar que sea mi csv

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->get();

            $recibos = CsvFactura::where(['administrador_id' => $admin->id,'id' => $id])->firstOrFail();

            //Obtener conjunto

            $conjunto = Conjunto::where('id',$adminConjunto[0]->conjunto_id)->firstOrFail();

            //Obtener zonas para extraer apartamentos

            $zonas = Zona::where('conjunto_id',$conjunto->id)->get();

            if(count($zonas) == 0)
            {
                return redirect()->to('administrador/facturas');
            }

            $condition = [];

            foreach ($zonas as $z) {
                $condition[] = $z->id;
            }

            //Obtener apartamentos

            $apartamentos = DB::table('apartamentos as apto')
            ->select('apto.*')
            ->whereIn('zona_id',$condition)
            ->get();

            //Mostrar formulario

            return view('backend.administrador.facturas.crearfactura',compact("apartamentos","id"));
        }
    }

    public function storefactura(ManualFacturaRequest $request)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            //Verificar que sea mio el csv

            $id = $request->id_csv;

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->get();

            $csv = CsvFactura::where(['administrador_id' => $admin->id,'id' => $id])->firstOrFail();

            //Insertar datos de la factura

            $factura = new Factura();
            $factura->conjunto_id               = $adminConjunto[0]->conjunto_id;
            $factura->csv_id                    = $id;
            $factura->fecha_corte               = $request->fecha_corte;
            $factura->nombre_propietaria        = $request->nombre_propietaria;
            $factura->valor_adeudado            = $request->valor_adeudado;
            $factura->matricula_inmobiliaria    = $request->matricula_inmobiliaria;
            $factura->coeficiente_inmueble      = $request->coeficiente_inmueble;
            $factura->concepto_pago             = $request->concepto_pago;
            $factura->saldo_mes_anterior        = $request->saldo_mes_anterior;
            $factura->saldo_anterior            = $request->saldo_anterior;
            $factura->nuevo_saldo               = $request->nuevo_saldo;
            $factura->total_mes                 = $request->total_mes;
            $factura->correo_conjunto           = $request->correo_conjunto;
            $factura->estado                    = $request->estado;

            $factura->save();

            Session::flash('message','Se ha creado la factura exitosamente.');
            return redirect()->to('administrador/facturas/'.$id.'/detalles');
        }
    }

    function editfactura($id)
    {
       $user = Auth::user();

        if($user->rol == 'Administrador')
        {
            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->get();

            //Verificar que sea mi factura

            $factura = Factura::where('id',$id)->firstOrFail();
            
            $recibos = CsvFactura::where(['administrador_id' => $admin->id,'id' => $factura->csv_id])->firstOrFail();

            $id_csv = $recibos->id;

            //Obtener conjunto

            $conjunto = Conjunto::where('id',$adminConjunto[0]->conjunto_id)->firstOrFail();

            //Obtener zonas para extraer apartamentos

            $zonas = Zona::where('conjunto_id',$conjunto->id)->get();

            if(count($zonas) == 0)
            {
                return redirect()->to('administrador/facturas');
            }

            $condition = [];

            foreach ($zonas as $z) {
                $condition[] = $z->id;
            }

            //Obtener apartamentos

            $apartamentos = DB::table('apartamentos as apto')
            ->select('apto.*')
            ->whereIn('zona_id',$condition)
            ->get();

            //Mostrar formulario

            return view('backend.administrador.facturas.editfactura',compact("apartamentos","id_csv","factura"));

        }
    }

    public function updatefactura(ManualFacturaRequest $request, $id)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        {   

            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

           //Verificar que sea mi factura

            $factura = Factura::where('id',$id)->firstOrFail();
            
            $recibos = CsvFactura::where(['administrador_id' => $admin->id,'id' => $factura->csv_id])->firstOrFail();

            //Insertar datos de la factura

            $datos = [
                'fecha_corte'               => $request->fecha_corte,
                'nombre_propietaria'        => $request->nombre_propietaria,
                'valor_adeudado'            => $request->valor_adeudado,
                'matricula_inmobiliaria'    => $request->matricula_inmobiliaria,
                'coeficiente_inmueble'      => $request->coeficiente_inmueble,
                'concepto_pago'             => $request->concepto_pago,
                'saldo_mes_anterior'        => $request->saldo_mes_anterior,
                'saldo_anterior'            => $request->saldo_anterior,
                'nuevo_saldo'               => $request->nuevo_saldo,
                'total_mes'                 => $request->total_mes,
                'correo_conjunto'           => $request->correo_conjunto,
                'estado'                    =>$request->estado

            ];

            Factura::where('id',$id)->update($datos);

            Session::flash('message','Se ha editado la factura exitosamente.');
            return redirect()->to('administrador/facturas/'.$factura->csv_id.'/detalles');
        }
    }

    public function destroyfactura($id)
    {
        $user = Auth::user();

        if($user->rol == 'Administrador')
        { 
            $admin = Administrador::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

            //Verificar que sea mi factura

            $factura = Factura::where('id',$id)->firstOrFail();

            $recibos = CsvFactura::where(['administrador_id' => $admin->id,'id' => $factura->csv_id])->firstOrFail();

            //Eliminar factura

            Factura::where('id', '=', $id)->delete();

            Session::flash('message','Se ha eliminado la factura exitosamente.');
            return redirect()->to('administrador/facturas/'.$factura->csv_id.'/detalles');
        }

        
    }

}
