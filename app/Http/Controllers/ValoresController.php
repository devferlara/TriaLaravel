<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UsuarioCrearRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Valores;
use Auth;
use DB;
use Input;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class ValoresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // vista principal de acceso de admin y usuario
    public function index()
    {
      $user = Auth::user();

	  $valores = Valores::all();

	  // $valor = 0;
	  // if(count($valores)>0){
		 //  $valor = $valores->first()->valor;
	  // }
      return view ('backend.superadmin.valores.index',['valores' => $valores]);
      
    }
   /** crear usuarios */
    public function create()
    {
        
    }
    /* guardado de datos en la bd */
    public function store(Request $request)
    {
        // creacion del usuario desde el form de nuevo usuario //
		// $existe = Valores::all();
		// if(count($existe) > 0){
		// 	$valores = $existe->first();
		// }else{
		// 	$valores = new Valores();
		// 	$valores->modulo = 'conjuntos';
		// }
		// $valores->valor = $request->valor;
  //       $valores->save();

        //Guardar todos los valores

        foreach ($request->all() as $key => $value) {
            
            Valores::where('modulo',$key)->update(['valor' => $value]);
        }
		
		Session::flash('message','Valores editados Correctamente');
		return Redirect::to('/superadmin/valores');
		
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
	
	public function deletevalor($id){
		
	}
    
    public function destroy($id)
    {
    }
	
}