<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UsuarioCrearRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Socio;
use App\Configuracion;
use App\UsuarioApartamento;
use App\Conjunto;
use App\Administrador;
use App\Apartamento;
use App\AdministradorConjunto;
use App\ArchivosSocio;
use App\ConceptoPublicitario;
use App\Ciudades;
use App\Zona;
use Auth;
use DB;
use Input;
use Crypt;
use Session;
use Redirect;
use Carbon\Carbon;
use Illuminate\Routing\Route;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // vista principal de acceso de admin y usuario
    public function index()
    {
      $user = Auth::user();
      if($user->rol == "SuperAdmin"){

	if(isset($_GET["docId"]) && $_GET["docId"]!="" ){
		DB::table('archivossocio')->where("id","=",$_GET["docId"])->delete();
	}
        $usuarios = User::paginate(30000);
        $count = new User();
        $nombres= '';
        $noregistrados= $count->contarNoRegistrados($nombres);
	foreach($usuarios as $key=>$value){
		$socios = DB::table('archivossocio')->where("idsocio","=",$value->id);
		$count=$socios->count();
		if($count>0){	
			$res=$socios->first();
			$usuarios[$key]->documento=$res->path;	
			$usuarios[$key]->documentoId=$res->id;
		}

	}
	
        return view ('backend.superadmin.usuarios.index', ['usuarios' => $usuarios , 'noregistrados' => $noregistrados]);
      }else if($user->rol == "Administrador"){
        $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
        $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
        $conjunto = $adminConjunto->conjunto_id;
        $nuevousuario = new User();
        $usuarios = $nuevousuario->obtenerUsuariosConjunto($conjunto);
        return view ('backend.administrador.usuarios.index', ['usuarios' => $usuarios]);
      }
      else if($user->rol == "Socio"){
                $usuario = $user;
                $socio = Socio::where("usuario_id","=",$user->id)->first();
				$archivo_aplicativo = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','aplicativo')->get();
				$archivo_participacion = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','participacion')->get();
				/*$conjuntos = DB::table('usuarios as usuario')
				->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
				->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
				->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
				->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
				->select('conjunto.id')
				->where('usuario.id', '=', $user->id)
				->get();
				$total_conjuntos = count($total_conjuntos);*/
				$conjuntos= Conjunto::all();
				$total_conjuntos = count($conjuntos);
				$concepto = ConceptoPublicitario::all();
				  $concepto_texto = "";
				  if($concepto->count() > 0){
					  $concepto_texto = $concepto->first()->concepto;
				  }
                return view('backend.socio.index', ['usuario'=> $usuario, 'socio' => $socio,"conjuntos" => $conjuntos,"total_conjuntos"=>$total_conjuntos,"aplicativo" => count($archivo_aplicativo) > 0 ? $archivo_aplicativo->first() : null,"concepto_texto"=>$concepto_texto,"participacion" => count($archivo_participacion) > 0 ? $archivo_participacion->first() : null]);
      }
      else if($user->rol == "ResidenteUsuario" and $user->active == "0"){
          //Genera Redireccion si es usuario y no esta activo
          $usuario = User::find($user->id);
          return view('backend.usuario.edit', ['usuario'=> $usuario]);
          }else{
              //Genera Redireccion si es usuario y ya esta activo
              $usuario= User::with('apartamentos')->where('id', $user->id)->firstOrFail();
              $zona= Apartamento::with('zonas')->where('zona_id', $usuario->apartamentos()->first()->zona_id)->firstOrFail();
              $conjunto= Conjunto::where('id', $zona->zonas()->first()->conjunto_id)->firstOrFail();
              $count = new Conjunto();
              return view('backend.usuario.index', compact('conjunto', 'usuario', 'zona', 'count'));
          }
    }
   /** crear usuarios */
    public function create()
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
            //Genera Redireccion si es super admin
            $conjuntos= Conjunto::lists('nombre', 'id');
            return view('backend.superadmin.usuarios.create', compact ('conjuntos'));
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es super adminadministrador
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();
            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();
            $data= Conjunto::where('id','=', $adminConjunto->conjunto_id)->with('zonas')->get();
            return view('backend.administrador.usuarios.create', compact('data'));
        }
    }
    /* guardado de datos en la bd */
    public function store(UsuarioCrearRequest $request)
    {
        // creacion del usuario desde el form de nuevo usuario //
        $usuario = new User();
  $user = Auth::user();

        //Chequear email repetido

        $check = $usuario->checkEmail($request->email);

        if($check)
        {
            if($user->rol == "SuperAdmin"){
                Session::flash('message-error','El correo electrónico ya existe en la base de datos.');
                return Redirect::to('/superadmin/usuarios');
            }else if($user->rol == "Administrador"){
                Session::flash('message-error','El correo electrónico ya existe en la base de datos.');
                return Redirect::to('/administrador/usuarios');
            }
        }

        $usuario->identificacion = $request->identificacion;
        $usuario->genero = $request->genero;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->fecha_nacimiento = $request->fecha_nacimiento;
        $usuario->email = $request->email;
        $usuario->telefono = $request->telefono;
        $usuario->celular = $request->celular;
        $usuario->rol = $request->rol;
        $usuario->username = $request->username;
        $usuario->password = bcrypt($request->password);
        $usuario->active = 0;
        $usuario->save();

        $configuracion = new Configuracion();
        $configuracion->usuario_id = $usuario->id;
        $configuracion->save();

        if ($request->rol == "Administrador" OR $request->rol == "SuperAdmin") {

            $administrador = new Administrador(); 
            $administrador->usuario_id = $usuario->id;
            $administrador->rol= $usuario->rol;
            $administrador->save();

            $conjunto = $request->conjunto;

            $adminConjunto = new AdministradorConjunto();
            $adminConjunto->administrador_id = $administrador->id;
            $adminConjunto->conjunto_id = $conjunto;
            $adminConjunto->save();

            $apartamento = $request->apartamento;
            $userapartamento= new UsuarioApartamento();
            $userapartamento->usuario_id = $usuario->id;
            $userapartamento->apartamento_id = $apartamento;
            $userapartamento->propietario = '1';
            $userapartamento->save();       
        } else {
            $apartamento = $request->apartamento;
            $userapartamento= new UsuarioApartamento();
            $userapartamento->usuario_id = $usuario->id;
            $userapartamento->apartamento_id = $apartamento;
            if ($request->propietario == "true"){
                $userapartamento->propietario = '1';
            }else{
                $userapartamento->propietario = '0';
            }
            $userapartamento->save();
        }
        $user = Auth::user();
            if($user->rol == "SuperAdmin"){
                Session::flash('message','Usuario Creado Correctamente');
                return Redirect::to('/superadmin/usuarios');
            }else if($user->rol == "Administrador"){
                Session::flash('message','Usuario Creado Correctamente');
                return Redirect::to('/administrador/usuarios');
            }
    }
    //editar tu perfil de usuario
    public function edicionPerfil() {
      $user = Auth::user();
      $id = $user->id;
      if($user->rol == "SuperAdmin") {
        $usuario = User::find($id);
        return view('backend.superadmin.edit', ['usuario' => $usuario]);
      }else if($user->rol == "Administrador") {
        $usuario = User::find($id);
        return view('backend.administrador.edit', ['usuario' => $usuario]);
      }else if($user->rol == "Socio") {
        $usuario = User::find($id);
        return view('backend.socio.edit', ['usuario' => $usuario]);
      }else if($user->rol == "ResidenteUsuario") {
          $usuario = User::find($id);
          return view('backend.usuario.edit', ['usuario' => $usuario]);
      }
      return view('home.index');      
    }
     // Mostrar datos en template
    public function show($id)
    {
        //
    }
    /* metodo para la vista de edicion de los usuarios */
    public function edit($id)
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
        //Genera Redireccion si es super admin
            $usuario = User::find($id);
            return view('backend.superadmin.usuarios.edit', ['usuario'=> $usuario]);
        }else if($user->rol == "Administrador"){
            //Genera Redireccion si es super adminadministrador
            $data = User::find($id)->apartamentos()->firstOrFail();
            $usuario = $data->usuarios()->firstOrFail();
            $valorzona = $data->zona_id;
            $zona = Zona::find($valorzona);
            $conjunto = Conjunto::with('zonas')->where('id', '=', $zona->conjunto_id)->firstOrFail();
            return view('backend.administrador.usuarios.edit', ['zona'=> $zona ,'conjunto'=> $conjunto , 'data'=> $data ,'usuario'=> $usuario]);
        }else if ($user->rol == "ResidenteUsuario"){
            $usuario = User::find($id);
            return view('backend.usuario.edit', ['usuario'=> $usuario]);
        }
    }
    /** Actualización de los usuarios en la base de datos  */
    public function update(Request $request, $id)
    {
      $user = Auth::user();

        //Chequear email repetido

        $usuario_ins = new User();

        $check = $usuario_ins->checkEmail($request->email,$id);
        
        if($check)
        {
            Session::flash('message-error','El correo electrónico ya existe en la base de datos.');

            if($user->rol == "SuperAdmin"){
                return Redirect::to('/superadmin/usuarios');
            }else if($user->rol == "Administrador"){
                return Redirect::to('/administrador/usuarios');
            }else if($user->rol == "ResidenteUsuario"){
                return Redirect::to('/usuario');
            }
        }

      if($user->rol == "SuperAdmin"){
        $usuario= User::find($id);
        $usuario->fill($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/superadmin/usuarios');
      }else if($user->rol == "Administrador"){
        $usuario= User::find($id);
        $usuario->fill($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->save();
        Session::flash('message','Usuario Actualizado Correctamente');
        return Redirect::to('/administrador/usuarios');
      }else if($user->rol == "Socio"){
          $socio = Socio::where("usuario_id","=",$user->id)->first();
          $user->fill($request->all());
          $user->save();
		  if($request->hasFile('img_profile')){
			$file = $request['img_profile'];
			$file_name = '';
            if ($file) {
				$info = pathinfo($file->getClientOriginalName());
				$file_name = preg_replace('/[^a-zA-Z0-9_ -]/s', '', str_replace(" ", "", $info["filename"])) . rand(1,1000) . "." . $info["extension"];
                $user->img_perfil = $file_name;
                $destinationPath = 'img_perfil/';
                $uploadSuccess = $request->file('img_profile')->move($destinationPath, $user->img_perfil);
				$user->save();
            }
		  }
		  $archivo_aplicativo = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','aplicativo')->get();
		  $archivo_participacion = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','participacion')->get();
          Session::flash('message','Usuario Actualizado Correctamente');
		  $conjuntos= Conjunto::all();
		  /*$conjuntos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('conjunto.id')
            ->where('usuario.id', '=', $user->id)
            ->get();*/
		  
		  $total_conjuntos = count($conjuntos);
		  $concepto = ConceptoPublicitario::all();
		  $concepto_texto = "";
		  if(count($concepto)>0){
			  $concepto_texto = $concepto->first()->concepto;
		  }
          return view('backend.socio.index', [
            "usuario" => $user,
            "socio" => $socio,
			"conjuntos" => $conjuntos,
			"aplicativo" => count($archivo_aplicativo) > 0 ? $archivo_aplicativo->first() : null,
			"participacion" => count($archivo_participacion) > 0 ? $archivo_participacion->first() : null,
			"total_conjuntos" => $total_conjuntos,
			"concepto_texto" => $concepto_texto
          ]);
        }else if($user->rol == "ResidenteUsuario"){
            $usuario= User::find($id);
            $usuario->fill($request->all());
            $usuario->active ='1';
	    $usuario->password = bcrypt($request->password);
            $usuario->save();
            Session::flash('message','Usuario Actualizado Correctamente');
            return Redirect::to('/usuario');
        }      
    }
    /** Eliminacion de usuarios en la base de datos */
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $usuario=User::destroy($id);
            Session::flash('message','Usuario Eliminado Correctamente');
            return Redirect::to('/superadmin/usuarios');
        }else if ($user->rol == "Administrador"){
            $usuario=User::destroy($id);
            Session::flash('message','Usuario Eliminado Correctamente');
            return Redirect::to('/administrador/usuarios');
        }
    }
    /*** llamado de la vista para eliminar usuarios *///
    public function deletesuper($id)
    {
        $usuario = User::find($id);
        return view('backend.superadmin.usuarios.delete', ['usuario'=>$usuario]);
    }

    public function activatesuper($id) 
    { 
      $user = User::where('id','=',$id)->first();
      $user->active = 1;
      $user->save();
      return redirect()->back();
    }
    public function desactivatesuper($id) 
    {

      $user = User::find($id);
      $user->active = 0;
      $user->save();
      return redirect()->back();
    }

     public function delete($id)
    {
        $usuario = User::find($id);
        return view('backend.administrador.usuarios.delete', ['usuario'=>$usuario]);
    }
    /* funcion para el api */
    public function apiData($token){
        $id =  substr($token,0,2);
        $response = ['id'=>$id];
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin');
        return json_encode($response);
    }

    public function buscar(Request $request)
    {
        $usuarios = User::nombres($request-> get('nombres'))-> orderBy('id', 'DESC')->paginate(30000);
        $count = new User();
        $nombres= '';
        $noregistrados= $count->contarNoRegistrados($nombres);
        return view ('backend.superadmin.usuarios.index', compact('usuarios', 'noregistrados'));
    }

    public function getAptos(Request $request, $id){
        if($request->ajax()){
            $apartamentos = Apartamento::apartamentos($id);
            return response()->json($apartamentos);
        }
    }

    public function getCiudades(Request $request, $id){
        if($request->ajax()){
            $ciudades = Ciudades::where('Paises_Codigo',$id)->get();
            return response()->json($ciudades);
        }
    }

    public function getZonas(Request $request, $id){
        if($request->ajax()){
            $zonas = Zona::zonas($id);
            return response()->json($zonas);
        }
    }
	public function profile()
    {
        $user = Auth::user();
        if($user->rol == "SuperAdmin"){
            $usuario= $user;
            return view('backend.superadmin.usuarios.edit', ['usuario'=>$usuario]);
        }else if($user->rol == "Administrador"){
            $usuario= $user;
            return view('backend.administrador.usuarios.edit', ['usuario'=>$usuario]);
        }else if($user->rol == "ResidenteUsuario"){
            $usuario= $user;
            return view('backend.usuario.edit', ['usuario'=>$usuario]);
        }
	else if($user->rol == "Socio"){
          $socio = Socio::where('usuario_id',$user->id)->first();
          $usuario = $user;
		  $archivo_aplicativo = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','aplicativo')->get();
		  $archivo_participacion = ArchivosSocio::where('idsocio',$user->id)->where('tipo','participacion')->get();
		  $conjuntos= Conjunto::all();
		  
		  /*$conjuntos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('conjunto.id')
            ->where('usuario.id', '=', $user->id)
            ->get();*/
		  
		  $total_conjuntos = count($conjuntos);
		  $concepto = ConceptoPublicitario::all();
		  $concepto_texto = "";
		  if($concepto->count() > 0){
			  $concepto_texto = $concepto->first()->concepto;
		  }
          return view('backend.socio.index', [
            "usuario" => $usuario,
            "socio" => $socio,
			"conjuntos" => $conjuntos,
			"aplicativo" => count($archivo_aplicativo) > 0 ? $archivo_aplicativo->first() : null,
			"participacion" => count($archivo_participacion) > 0 ? $archivo_participacion->first() : null,
			"total_conjuntos" => $total_conjuntos,
			"concepto_texto" => $concepto_texto
          ]);
        }     
    }
	
	
	public function savePicture(Request $request)
	{
		if($request->hasFile('photo')){
				$user = Auth::user();
				$file = $request['photo'];
                $file_name = '';
                if ($file) {
					$info = pathinfo($file->getClientOriginalName());
					$file_name = preg_replace('/[^a-zA-Z0-9_ -]/s', '', str_replace(" ", "", $info["filename"])) . rand(1,1000) . "." . $info["extension"];
                    $user->img_perfil = $file_name;
                    $destinationPath = 'img_perfil/';
                    $uploadSuccess = $request->file('photo')->move($destinationPath, $user->img_perfil);
					$user->save();
                }
        }
        
		return Redirect::to('/perfil');
	}

	public function saveDocument(Request $request){
		if($request->hasFile('documento')){
			$user = Auth::user();
			$socio = Socio::where('usuario_id',$user->id)->first();
			$file = $request['documento'];
			$file_name = '';
			if ($file) {
				$info = pathinfo($file->getClientOriginalName());
				$file_name = preg_replace('/[^a-zA-Z0-9_ -]/s', '', str_replace(" ", "", $info["filename"])) . rand(1,1000) . "." . $info["extension"];
				$archivo = new ArchivosSocio();
				$archivo->idsocio = $user->id;
				$archivo->path = $file_name;
				$archivo->tipo = $request['tipo'];
				$destinationPath = 'documents/';
				$uploadSuccess = $request->file('documento')->move($destinationPath, $archivo->path);
				$archivo->save();
            }
		}
		return Redirect::to('/perfil');
	}
	
	public function test_sql(){
		$conjuntos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('conjunto.id')
            ->where('usuario.id', '=', 48)
            ->get();
		return response()->json([$conjuntos]);  
	}

    function getUsuariosAnuncios()
    {
        $ids = array_reverse($_POST['ids']);

        $arreglo_localidad = array();

        $arreglo_ciudad = array();

        $arreglo_pais = array();

        $usuarios = 0;

        foreach ($ids as $key => $value) {
            
            $zona = explode('_', $value);

            //Obtener conjunto

            $conjunto = Conjunto::where('id',$zona[1])->firstOrFail();

            if($zona[0] == 'conjunto')
            {
                //Guardar zonas ya buscadas

                array_push($arreglo_localidad, $conjunto->localidad.'_'.$conjunto->ciudad);
                array_push($arreglo_ciudad, $conjunto->ciudad.'_'.$conjunto->pais);
                array_push($arreglo_pais, $conjunto->pais);

                ///Buscar todos los usuarios que existen en ese conjunto

                $users = DB::table('usuarios as u')
                ->select('u.id')
                ->join('usuario_apartamentos as u_a', 'u.id', '=', 'u_a.usuario_id')
                ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
                ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                ->where('conjunto.id',$conjunto->id)
                ->get();

                $usuarios += count($users);

            } 

            if($zona[0] == 'local')
            {
                //Chequear que ya no se halla buscado en esta zona



                if(!in_array($conjunto->localidad.'_'.$conjunto->ciudad, $arreglo_localidad))
                {
                    //Guardar zonas ya buscadas

                    array_push($arreglo_localidad, $conjunto->localidad.'_'.$conjunto->ciudad);
                    array_push($arreglo_ciudad, $conjunto->ciudad.'_'.$conjunto->pais);
                    array_push($arreglo_pais, $conjunto->pais);

                    ///Buscar todos los usuarios que existen en ese conjunto

                    $users = DB::table('usuarios as u')
                    ->select('u.id')
                    ->join('usuario_apartamentos as u_a', 'u.id', '=', 'u_a.usuario_id')
                    ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
                    ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                    ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                    ->where('conjunto.localidad',$conjunto->localidad)
                    ->get();

                    $usuarios += count($users);
                }
            } 

            if($zona[0] == 'ciudad')
            {
                //Chequear que ya no se halla buscado en esta zona

                if(!in_array($conjunto->ciudad.'_'.$conjunto->pais, $arreglo_ciudad))
                {
                    //Guardar zonas ya buscadas

                    array_push($arreglo_ciudad, $conjunto->ciudad.'_'.$conjunto->pais);
                    array_push($arreglo_pais, $conjunto->pais);

                    ///Buscar todos los usuarios que existen en ese conjunto

                    $users = DB::table('usuarios as u')
                    ->select('u.id')
                    ->join('usuario_apartamentos as u_a', 'u.id', '=', 'u_a.usuario_id')
                    ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
                    ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                    ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                    ->where('conjunto.ciudad',$conjunto->ciudad)
                    ->get();

                    $usuarios += count($users);
                }
            }

            if($zona[0] == 'pais')
            {
                //Chequear que ya no se halla buscado en esta zona

                if(!in_array($conjunto->pais, $arreglo_pais))
                {
                    //Guardar zonas ya buscadas
                    
                    array_push($arreglo_pais, $conjunto->pais);

                    ///Buscar todos los usuarios que existen en ese conjunto

                    $users = DB::table('usuarios as u')
                    ->select('u.id')
                    ->join('usuario_apartamentos as u_a', 'u.id', '=', 'u_a.usuario_id')
                    ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
                    ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
                    ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
                    ->where('conjunto.pais',$conjunto->pais)
                    ->get();

                    $usuarios += count($users);
                }
            }


        }
      
        return json_encode(array('res' => $usuarios));
    }
	
}