<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UsuarioCrearRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\ConceptoPublicitario;
use Auth;
use DB;
use Input;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class ConceptoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // vista principal de acceso de admin y usuario
    public function index()
    {
      /*$user = Auth::user();
	  $conceptos = ConceptoPublicitario::paginate(20);
      return view ('backend.superadmin.configurador.index',['conceptos' => $conceptos]);*/
	  $conceptos = ConceptoPublicitario::all();
	  $concepto = "";
	  if(count($conceptos)>0){
		  $concepto = $conceptos->first()->concepto;
	  }
	  $user = Auth::user();
      return view('backend.superadmin.configurador.create',['concepto' => $concepto]);
      
    }
   /** crear usuarios */
    public function create()
    {
        
    }
    /* guardado de datos en la bd */
    public function store(Request $request)
    {
        $existe = ConceptoPublicitario::all();
		if(count($existe) > 0){
			$concepto = $existe->first();
		}else{
			$concepto = new ConceptoPublicitario();
		}
        $concepto->concepto = $request->concepto;
        $concepto->save();
		
		Session::flash('message','Concepto Guardado Correctamente');
		return Redirect::to('/superadmin/conceptos');
		
    }
    
    
    
    public function show($id)
    {
        
    }
    
    public function edit($id)
    {

    }
    
    public function update(Request $request, $id)
    {
      
    }
	
	public function deleteconcepto($id){
		/*$concepto = ConceptoPublicitario::find($id);
        return view('backend.superadmin.configurador.delete', ['concepto'=>$concepto]);*/
	}
    
    public function destroy($id)
    {
        /*$user = Auth::user();
		$concepto=ConceptoPublicitario::destroy($id);
		Session::flash('message','Concepto Eliminado Correctamente');
		return Redirect::to('/superadmin/conceptos');*/
    }
	
}