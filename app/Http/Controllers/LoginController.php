<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Auth;

use App\User;

use App\Socio;

use App\Administrador;

use App\AdministradorConjunto;
use App\ArchivosSocio;
use App\Conjunto;
use App\ConceptoPublicitario;

use Session;

use Redirect;

use App\Http\Requests;

use App\Http\Requests\LoginRequest;

use App\Http\Controllers\Controller;

use App\Configuracion;

use DB;

use Input;

use Crypt;

use Carbon\Carbon;

use Illuminate\Routing\Route;

use App\Valores;

use Mail;




class LoginController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

      if(Auth::check()){

        $user = Auth::user();
          
        $rol = $user->rol;

        if($rol == 'SuperAdmin')
        {
          return Redirect::to('/superadmin');
        }

        if($rol == 'Administrador')
        {
          return Redirect::to('/administrador');
        }

        if($rol == 'Socio')
        {
          return Redirect::to('/socio');
        }

        if($rol == 'ResidenteUsuario')
        {
          return Redirect::to('/usuario');
        }

        if($rol == 'Pautante')
        {
          return Redirect::to('/pautante');
        }
      }

      return view('home.login');
      
    }
    
    
    
    /**
     
     * Show the form for creating a new resource.
     
     *
     
     * @return \Illuminate\Http\Response
     
     */
    
    public function create()
    
    {
      
      //
      
    }
    
    
    
    /**
     
     * Store a newly created resource in storage.
     
     *
     
     * @param  \Illuminate\Http\Request  $request
     
     * @return \Illuminate\Http\Response
     
     */
    
    private $user;
    
    
    
    public function store(LoginRequest $request)
    
    {
      $this->user = ['username'=> $request['username'],'password'=> $request['password']];
    
      
      if(Auth::attempt($this->user)){
        
        if(Auth::check()){
          
          $user = Auth::user();
          
          $rol = $user->rol;
          
          $active = $user->active;



          if($rol == "SuperAdmin"){
            
            //Genera Redireccion si es super admin
            
            return Redirect::to('/superadmin');
            
          }else if($rol == "Administrador"){

           
            
            //Genera Redireccion si es administrador
            
            $admin = Administrador::where('usuario_id', "=" ,Auth::user()->id)->first();

            return view('backend.administrador.index', ['admin' => $admin]);
            
          }else if($rol == "Socio") {
           
		        return Redirect::to('/socio');
          
          }else if($rol == "ResidenteUsuario") {
            
            
            if($active == "0"){
              
              //Genera Redireccion si es usuario y no esta activo
              
              $usuario = User::find($user->id);
              
              return view('backend.usuario.edit', ['usuario'=> $usuario]);
              
            }else{

              
              //Genera Redireccion si es usuario y ya esta activo
              
              return Redirect::to('/usuario');
              
            }
            
          }
          else if($rol == "Pautante") {
            
       
            if($active == "0"){
              
              //Genera Redireccion si es usuario y no esta activo

              Auth::logout();
              
              Session::flash('message-error','Debe esperar la aprobación de un administrador.');
            
              return Redirect::to('/login');


              
            }else{

              //Genera Redireccion si es usuario y ya esta activo
              
              return Redirect::to('/pautante');
              
            }
            
          }else{
            Session::flash('message-error','Datos incorrectos, por favor valide la información');
            
            return Redirect::to('/logout');
            
          }
          
        }else{
          
          return Redirect::to('/login');
          
        }
        
        
        
      }else{
        
        Session::flash('message-error','Datos incorrectos, por favor valide la información');
        
        return Redirect::to('/login');
        
      }
      
    }
    
    
    
    public function logout(){
      
      Auth::logout();
      
      return Redirect::to('/');
      
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
    
    public function storeAdmin(Request $request) 
    {

      $usuario = new User();

      //Chequear email repetido

      $check = $usuario->checkEmail($request->email);

      if($check)
      {
        Session::flash('message-error','El correo electrónico ya existe en la base de datos.');
        return Redirect::to('/registroAdmin');
      }

      $usuario->identificacion = $request->identificacion;
      $usuario->genero = $request->genero;
      $usuario->nombres = $request->nombres;
      $usuario->apellidos = $request->apellidos;
      $usuario->fecha_nacimiento = $request->fecha_nacimiento;
      $usuario->email = $request->email;
      $usuario->telefono = $request->telefono;
      $usuario->celular = $request->celular;   
      $usuario->rol = "Administrador"; 
      $usuario->username = $request->email;
      $usuario->password = bcrypt($request->password);
      $usuario->save();
      
      $administrador = new Administrador();
      
      $administrador->usuario_id = $usuario->id;

      $administrador->rol = $usuario->rol;
      
      $administrador->save();

      $this->user = ['username' => $request->email,'password' => $request->password];
      
      Auth::attempt($this->user);

      $user = Auth::user();
          
      Session::flash('message','Admin Creado Correctamente');
      
      return Redirect::to('administrador/conjuntos/create');
    }
    public function registroAdmin()
    {

      // Mail::send('home.email', ['user' => 'Orlando'], function ($m) {
      //       $m->from('triagroupweb@triagroup.co', 'Your Application');

      //       $m->to('orlando6644@hotmail.com', 'Orlando')->subject('Your Reminder!');
      //   });
     
      if(Auth::check()){

        $user = Auth::user();
          
        $rol = $user->rol;

        if($rol == 'SuperAdmin')
        {
          return Redirect::to('/superadmin');
        }

        if($rol == 'Administrador')
        {
          return Redirect::to('/administrador');
        }

        if($rol == 'Socio')
        {
          return Redirect::to('/socio');
        }

        if($rol == 'ResidenteUsuario')
        {
          return Redirect::to('/socio');
        }

        if($rol == 'Pautante')
        {
          return Redirect::to('/pautante');
        }
      }

      return view('home.admin.create');
    }

    public function registroPautante()
    {
      

      if(Auth::check()){

        $user = Auth::user();
          
        $rol = $user->rol;

        if($rol == 'SuperAdmin')
        {
          return Redirect::to('/superadmin');
        }

        if($rol == 'Administrador')
        {
          return Redirect::to('/administrador');
        }

        if($rol == 'Socio')
        {
          return Redirect::to('/socio');
        }

        if($rol == 'ResidenteUsuario')
        {
          return Redirect::to('/socio');
        }

        if($rol == 'Pautante')
        {
          return Redirect::to('/pautante');
        }
      }

      return view('home.pautante.create');
    }
    
    public function registroSocio()
    
    {
      
      return view('home.socio.create');
      
    }
    public function socio()
    {
			$user = Auth::user();

            $socio = Socio::where('usuario_id','=',Auth::user()->id)->first();
            $conjuntos= Conjunto::all();



            $paises = [];
	    $doc = DB::table('archivossocio')->where("idsocio","=",Auth::user()->id);
	    if($doc->count()>0){
		$docA=$doc->first();
	    }
	    else
		$docA="";



            foreach($conjuntos as $conjunto) {
              // dd($ conjunto);
            }

			$archivo_aplicativo = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','aplicativo')->get();
			$archivo_participacion = ArchivosSocio::where('idsocio',$socio->id)->where('tipo','participacion')->get();
			/*$conjuntos = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('conjunto.id')
            ->where('usuario.id', '=', $user->id)
            ->get();*/
		  $conjuntos= Conjunto::all();
		  $total_conjuntos = count($conjuntos);
		  $concepto = ConceptoPublicitario::all();
		  $concepto_texto = "";
		  if($concepto->count() > 0){
			  $concepto_texto = $concepto->first()->concepto;
		  }

      //Obtener valor

      $valores = Valores::where('modulo','conjuntos')->get();
            
      $valor = 250;

      if(count($valores) > 0)
      {
          $valor = $valores->first()->valor;
      }



      return view('backend.socio.index',[
              'socio' => $socio,
              'usuario' => Auth::user(),
              'conjuntos' => $conjuntos,
			  "aplicativo" => count($archivo_aplicativo) > 0 ? $archivo_aplicativo->first() : null,
			  "participacion" => count($archivo_participacion) > 0 ? $archivo_participacion->first() : null,
			  "total_conjuntos" => $total_conjuntos,
			  "concepto_texto" => $concepto_texto,
	      'doc'=>$docA,
        'valor' => $valor
            ]);
      
    }

    
    public function storeSocio(Request $request)
    
    {
      
      // creacion del usuario desde el form de nuevo usuario //
      
      $usuario = new User();

      //Chequear email repetido

      $check = $usuario->checkEmail($request->email);

      if($check)
      {
        Session::flash('message-error','El correo electrónico ya existe en la base de datos.');
        return Redirect::to('/registroSocio');
      }
      
      $usuario->identificacion = $request->identificacion;
      
      $usuario->genero = $request->genero;
      
      $usuario->nombres = $request->nombres;
      
      $usuario->apellidos = $request->apellidos;
      
      $usuario->fecha_nacimiento = $request->fecha_nacimiento;
      
      $usuario->email = $request->email;
      
      $usuario->telefono = $request->telefono;
      
      $usuario->celular = $request->celular;
      
      $usuario->rol = "Socio";
      
      $usuario->username = $request->email;
      
      $usuario->password = $request->password;
      
      $usuario->save();

      $socio = new socio();

      $socio->cuotas = $request->coutas; 

      $socio->tipo = $request->tipo;

      $usuario->socios()->save($socio);

      
      $configuracion = new Configuracion();
      
      $configuracion->usuario_id = $usuario->id;
      
      $configuracion->save();

      
      $user = Auth::user();
      
      
      Session::flash('message','Usuario Creado Correctamente');
      
      return Redirect::to('/');
      
      
    }

    public function storePautante(Request $request)
    {
      $usuario = new User();

      //Chequear email repetido

      $check = $usuario->checkEmail($request->email);

      if($check)
      {
        Session::flash('message-error','El correo electrónico ya existe en la base de datos.');
        return Redirect::to('/registroPautante');
      }

      $usuario->identificacion = $request->identificacion;
      $usuario->genero = $request->genero;
      $usuario->nombres = $request->nombres;
      $usuario->apellidos = $request->apellidos;
      $usuario->fecha_nacimiento = $request->fecha_nacimiento;
      $usuario->email = $request->email;
      $usuario->telefono = $request->telefono;
      $usuario->celular = $request->celular;   
      $usuario->rol = "Pautante"; 
      $usuario->active = 0;
      $usuario->username = $request->email;
      $usuario->password = bcrypt($request->password);

      $usuario->save();
      
      $administrador = new Administrador();
      
      $administrador->usuario_id = $usuario->id;

      $administrador->rol = $usuario->rol;
      
      $administrador->save();
          
      Session::flash('message','Su usuario ha sido creado exitosamente, debe esperar la aprobación de un administrador.');
      
      return Redirect::to('/login');
    }
    
    
  }