<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\MensajeCrearRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\Configuracion;
use App\UsuarioApartamento;
use App\Conjunto;
use App\MensajeUsuario;
use App\Mensaje;
use App\Respuesta;
use App\Adjunto;
use App\AdjuntoMensaje;
use App\Administrador;
use App\AdministradorConjunto;
use App\Zona;
use App\Apartamento;
use Auth;
use Input;
use Carbon\Carbon;
use DB;
use Hash;
use PDF;
use Crypt;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class MensajeController extends Controller {

	/* Display a listing of the resource.
	 * @return Response
	 */
    private $fileSave;
    private $isAttachment;
    private $response;
    private $adjuntoMensaje;

    public function listarMensajes(){
        $user = Auth::user();
        /*$datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_user', 'mensaje.id', '=', 'msg_user.mensaje_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'msg_user.from_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apartamento', 'userapto.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.mensaje','mensaje.fecha','mensaje.importancia','mensaje.respuesta','msg_user.from_id','msg_user.leido', 'usuario.nombres', 'usuario.apellidos', 'apartamento.apartamento','zona.zona')
            ->where('msg_user.to_id', '=', $user->id)
            ->orderBy('mensaje.id', 'DESC')
            ->get();*/
        if($user->rol == 'Administrador')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where('m_u.to_id', '=', $user->id)
            ->orWhere('r.to_id', '=', $user->id)
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('mensaje.id','r.mensaje_id')
            ->get();
            $emails = array("emails"=>$datos);
            return $emails;

        }

       $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where('m_u.to_id', '=', $user->id)
            ->orWhere('r.to_id', '=', $user->id)
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('mensaje.id','r.mensaje_id')
            ->get();
        $emails = array("emails"=>$datos);
        return $emails;
    }

    public function listarEnviados(){
        $user = Auth::user();
        $lista = new Mensaje();
        $enviados= $lista->mostrarEnviados($user->id);
        $emails = array("emails"=>$enviados);
        return $emails;
    }

    public function listarImportantes(){
        $user = Auth::user();
        $lista = new Mensaje();
        $importantes= $lista->mostrarImportantes($user->id);
        $emails = array("emails"=>$importantes);
        return $emails;
    }

    public function listarRelevantes(){
        $user = Auth::user();
        $lista = new Mensaje();
        $relevantes= $lista->mostrarRelevantes($user->id);
        $emails = array("emails"=>$relevantes);
        return $emails;
    }

    public function listarNormales(){
        $user = Auth::user();
        $lista = new Mensaje();
        $normales = $lista->mostrarNormales($user->id);
        $emails = array("emails"=>$normales);
        return $emails;
    }

    public function mostrarBadges()
    {
        $user = Auth::user();
        $count = new Mensaje();
        $badges= $count->mostrarBadges($user->id);
        return \Response::json($badges);
    }

    public function index ()
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin"){
            return view ('backend.superadmin.mensajes.index');         
        }else if ($user->rol == "Administrador"){
            return view ('backend.administrador.mensajes.index');
        }else if ($user->rol == "ResidenteUsuario"){
            return View('backend.usuario.mensajes.index');
        }else if ($user->rol == "Socio"){
			return View('backend.socio.mensajes.index');
		}
    }

     public function sent()
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin"){
            return view ('backend.superadmin.mensajes.sent');         
        }else if ($user->rol == "Administrador"){
            return view ('backend.administrador.mensajes.sent');
        }else if ($user->rol == "ResidenteUsuario"){
            return View('backend.usuario.mensajes.sent');
        }else if ($user->rol == "Socio"){
			return View('backend.socio.mensajes.sent');
		}
    }
    public function importantes()
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin"){
            return view ('backend.superadmin.mensajes.importantes');         
        }else if ($user->rol == "Administrador"){
            return view ('backend.administrador.mensajes.importantes');
        }else if ($user->rol == "ResidenteUsuario"){
            return View('backend.usuario.mensajes.importantes');
        }else if ($user->rol == "Socio"){
			return View('backend.socio.mensajes.importantes');
		}
    }
    public function relevantes()
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin"){
            return view ('backend.superadmin.mensajes.relevantes');         
        }else if ($user->rol == "Administrador"){
            return view ('backend.administrador.mensajes.relevantes');
        }else if ($user->rol == "ResidenteUsuario"){
            return View('backend.usuario.mensajes.relevantes');
        }else if ($user->rol == "Socio"){
			return View('backend.socio.mensajes.relevantes');
		}
    }
    public function normales()
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin"){
            return view ('backend.superadmin.mensajes.normal');         
        }else if ($user->rol == "Administrador"){
            return view ('backend.administrador.mensajes.normal');
        }else if ($user->rol == "ResidenteUsuario"){
            return View('backend.usuario.mensajes.normal');
        }else if ($user->rol == "Socio"){
			return View('backend.socio.mensajes.normal');
		}
    }

    public function create()
    {
        $user = Auth::user();

        if ($user->rol == "SuperAdmin")
        {
            //OBtener usuarios administradores

            $administradores = DB::table('usuarios as u')
            ->select('u.id', 'u.nombres','u.apellidos')
            ->join('administradores as admin', 'admin.usuario_id', '=', 'u.id')
            ->where('admin.rol','Administrador')
            ->get();

            return view('backend.superadmin.mensajes.create', compact('administradores')); 

        }

        else if ($user->rol == "Administrador")
        {
            $admin = Administrador::where('usuario_id', '=', $user->id)->firstOrFail();

            $adminConjunto = AdministradorConjunto::where('administrador_id', '=', $admin->id)->firstOrFail();

            $conjunto = $adminConjunto->conjunto_id;

            $usuarios = DB::table('usuarios as usuario')
            ->join('usuario_apartamentos as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('usuario.id','usuario.nombres','usuario.apellidos','zona.zona','apartamento.apartamento')
            ->where('conjunto.id', '=', $conjunto)
            ->where('usuario.active', '=', 1)
            ->get();

            $zonas = DB::table('zonas as zona')
            ->select('zona.*')
            ->where('zona.conjunto_id', '=', $conjunto)
            ->whereNull('deleted_at')
            ->get();

            return View('backend.administrador.mensajes.create', compact('usuarios','zonas'));

        }
        else if ($user->rol == "ResidenteUsuario")
        {

            $datos = DB::table('usuario_apartamentos as u_apartamento')
            ->join('apartamentos as apto', 'u_apartamento.apartamento_id', '=', 'apto.id')
            ->join('zonas as zona', 'apto.zona_id', '=', 'zona.id')
            ->select('zona.conjunto_id as id')
            ->where('u_apartamento.usuario_id', '=', $user->id)
            ->get();

            //Obtener administrador del conjunto

            $adminconjunto = AdministradorConjunto::where('conjunto_id',$datos[0]->id)->firstOrFail();

            $admin = Administrador::with('usuarios')->where('id',$adminconjunto->administrador_id)->firstOrFail();

            return View('backend.usuario.mensajes.create', compact('admin'));
        }
  //       else if($user->rol == "Socio"){
		// 	$admin = User::whereIn('rol',['SuperAdmin','Administrador'])->get();
		// 	return View('backend.socio.mensajes.create', ['usuarios' => $admin]);
		// }
    }
    
    public function verMensajes($mensajeid){
        $user = Auth::user();
        $datos = DB::table('mensaje_usuarios as msg_user')
            ->join('mensajes as mensaje', 'mensaje.id', '=', 'msg_user.mensaje_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'msg_user.from_id')
            ->select('mensaje.asunto', 'mensaje.fecha', 'mensaje.adjunto', 'mensaje.respuesta','mensaje.mensaje','msg_user.*','usuario.nombres', 'usuario.apellidos')
            ->where('msg_user.mensaje_id', '=', $mensajeid)
            ->where('msg_user.to_id', '=', $user->id)
            ->orderBy('msg_user.mensaje_id', 'DESC')
            ->get();
        $email = array("email"=>$datos);
        return $email;
    }

    public function verEnviados($mensajeid){
        $user = Auth::user();
        $datos = DB::table('mensaje_usuarios as msg_user')
            ->join('mensajes as mensaje', 'mensaje.id', '=', 'msg_user.mensaje_id')
            ->select('msg_user.*','mensaje.asunto', 'mensaje.fecha', 'mensaje.adjunto', 'mensaje.respuesta','mensaje.mensaje')
            ->where('msg_user.mensaje_id', '=', $mensajeid)
            ->where('msg_user.from_id', '=', $user->id)
            ->orderBy('msg_user.mensaje_id', 'DESC')
            ->get();

        //Colocar remitente

        $datos[0]->remitente = 'Usuario';

        if($user->rol == 'Administrador')
        {
            $datos[0]->remitente = 'Administrador';
        }

        if($user->rol == 'SuperAdmin')
        {
            $datos[0]->remitente = 'Super Administrador';
        }
        
        $email = array("email"=>$datos);
        return $email;
    }


    public function marcarLeidos($id){
        $user = Auth::user();
        $mensajes = DB::table('mensaje_usuarios as mensaje')
        ->select('mensaje.id', 'mensaje.leido')
        ->where('mensaje.to_id', '=', $user->id)
        ->where('mensaje.mensaje_id', '=', $id)
        ->get();

        if(count($mensajes) > 0)
        {
            foreach ($mensajes as $idmensaje) {
                $mensajeupdate = $idmensaje->id;
            }
            $update = MensajeUsuario::find($mensajeupdate);
            $update->leido = 1;
            $update->fecha_leido = Carbon::now();
            $update->save();
        }
        

        //Actualizar respeustas

        $respuestas = DB::table('respuestas as r')
        ->select('r.id')
        ->where('r.mensaje_id', '=', $id)
        ->where('r.to_id', '=', $user->id)
        ->get();

        if(count($respuestas) > 0)
        {
            foreach ($respuestas as $r) {
                Respuesta::where('id',$r->id)->update(['leido' => 1,'fecha_leido' => date('Y-m-d')]);
            }
        }

        return json_encode(array('res' => true));
    }

    public function listarAdjuntos($mensajeid){
        $adjuntos = DB::table('adjuntos as adjunto')
            ->join('adjunto_mensajes as adj_msg', 'adjunto.id', '=', 'adj_msg.adjunto_id')
            ->select('adjunto.id','adjunto.nombre', 'adjunto.ruta', 'adjunto.tipo', 'adjunto.fecha', 'adj_msg.id', 'adj_msg.mensaje_id')
            ->where('adj_msg.mensaje_id', '=',$mensajeid)
            ->get();
        return $adjuntos;
    }

    public function responderMensaje(){
        $user = Auth::user();

        $mensajeid = Input::get('idmensaje');
        $respuestacont = Input::get('mensaje');
        $idmensajeusuario = Input::get('idmensajeusuario');

        //Obtener datos del mensaje usuario para from_id y to_id

        $mensaje_usuario = MensajeUsuario::where('id',$idmensajeusuario)->firstOrFail();

        $respuesta = new Respuesta();

        $respuesta->mensaje_id = $mensajeid;
        $respuesta->usuario_id = $user->id;
        $respuesta->mensaje = $respuestacont;
        $respuesta->fecha = Carbon::now();
        $respuesta->leido = 0;
        $respuesta->from_id = $user->id;
        $respuesta->to_id = $mensaje_usuario->to_id;

        if($mensaje_usuario->from_id != $user->id)
        {
            $respuesta->to_id = $mensaje_usuario->from_id;
        }
        $response = $respuesta->guardarRespuestaUsuario($respuesta->mensaje_id,$user->id);
        $respuesta->save();

       

        if ($user->rol == "SuperAdmin") 
        {
            Session::flash('message','Respuesta Enviada con Exito');
            return Redirect::to('/superadmin/mensajes');
        }

        else if ($user->rol == "Administrador") 
        {   
            Session::flash('message','Respuesta Enviada con Exito');
            return Redirect::to('/administrador/mensajes');
        }

        else if ($user->rol == "ResidenteUsuario") 
        {   
            Session::flash('message','Respuesta Enviada con Exito');
            return Redirect::to('/usuario/mensajes');
        }

    }

    public function listarRespuestas($mensaje,$idmensajeusuario){

        $user = Auth::user();

        $usuario = $user->id;

        if($user->rol == 'SuperAdmin' OR $user->rol == 'Administrador' OR $user->rol == 'ResidenteUsuario')
        {
            $mensaje_usuario = MensajeUsuario::where('id',$idmensajeusuario)->firstOrFail();

            $recibidor = $mensaje_usuario->to_id;

            if($mensaje_usuario->from_id != $user->id)
            {
                $recibidor = $mensaje_usuario->from_id;
            }

            $respuestas = DB::table('respuestas as respuesta')
                ->join('usuarios as usuario','usuario.id','=','respuesta.from_id')
                ->select('respuesta.*','usuario.nombres', 'usuario.apellidos')
                ->where('respuesta.mensaje_id', '=', $mensaje)
                ->where(function($query) use($usuario,$recibidor){
                        return $query
                        ->Where(['respuesta.from_id' => $usuario,'respuesta.to_id' => $recibidor])
                        ->orWhere(['respuesta.from_id' => $recibidor,'respuesta.to_id' => $usuario]);
                })
                
                ->groupBy('respuesta.id')
                ->orderBy('respuesta.created_at','DESC')
                ->get();
            return $respuestas;

        }

        // $respuestas = DB::table('respuestas as respuesta')
        //     ->join('usuarios as usuario', function($join)
        //         {
        //             $join->on('usuario.id', '=', 'respuesta.to_id')
        //             ->orOn('usuario.id', '=', 'respuesta.from_id');
        //         })
        //     ->select('respuesta.*','usuario.nombres', 'usuario.apellidos')
        //     ->where('respuesta.mensaje_id', '=', $mensaje)
        //      ->where(function($query) use($usuario){
        //             return $query
        //             ->orWhere('respuesta.from_id', '=', $usuario)
        //             ->orWhere('respuesta.to_id', '=', $usuario);
        //         })
        //     ->groupBy('respuesta.id')
        //     ->get();
        // return $respuestas;
    }

    /*public function listarUsuariosRespuesta($mensajeId){

        $query = DB::table('respuestas as respuesta')
            ->join('usuarios as usuario', function($join)
                {
                $join->on('usuario.id', '=', 'respuesta.to_id')
                ->orOn('usuario.id', '=', 'respuesta.from_id');
                })
            ->join('usuario_apartamento as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->select('usuario.id as u_id','respuesta.mensaje_id as id','usuario.nombres','usuario.apellidos','zona.tipo','zona.zona','apartamento.apartamento')
            ->where('respuesta.mensaje_id', '=',Crypt::decrypt($mensajeId))
            ->groupBy('usuario.id')
            ->get();

        return $query;
    }*/

    public function pdfReporte($id){

        $data = DB::table('mensajes as mensaje')
            ->join('mensaje_usuario as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as usuario', 'm_u.to_id', '=', 'usuario.id')
            ->select('mensaje.id','m_u.fecha_leido','usuario.id as u_id','usuario.nombres','usuario.apellidos','mensaje.asunto','mensaje.mensaje','mensaje.fecha')
            ->where('m_u.id', '=', $id)
            ->get();

        foreach($data as $result){
            $asunto = $result->asunto;
            $mensaje = $result->mensaje;
            $fecha  = $result->fecha;
            $fecha_leido = $result->fecha_leido;
            $nombres = $result->nombres;
            $apellidos = $result->apellidos;
            $id = $result->u_id;
        }

        $conjunto = DB::table('usuarios as usuario')
            ->join('usuario_apartamento as u_a', 'usuario.id', '=', 'u_a.usuario_id')
            ->join('apartamentos as apartamento', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('conjuntos as conjunto', 'zona.conjunto_id', '=', 'conjunto.id')
            ->select('conjunto.id','conjunto.nombre','conjunto.img_perfil','zona.tipo','zona.zona','apartamento.apartamento')
            ->where('usuario.id', '=',$id)
            ->get();

        foreach($conjunto as $c){
            $conjunto_nombre = $c->nombre;
            $zona_tipo = $c->tipo;
            $zona_value  = $c->value;
            $apartamento = $c->apartamento;
            $img = $c->img_perfil;
        }

        $parameterr = array();
        $parameter['nombres'] = $nombres;
        $parameter['apellidos'] = $apellidos;
        $parameter['asunto'] = $asunto;
        $parameter['mensaje'] = $mensaje;
        $parameter['fecha'] = $fecha;
        $parameter['fecha_leido'] = $fecha_leido;
        $parameter['c_nombre'] = $conjunto_nombre;
        $parameter['c_tipo'] = $zona_tipo;
        $parameter['c_zona'] = $zona_value;
        $parameter['c_apartamento'] = $apartamento;
        $parameter['img'] = $img;
        $pdf = PDF::loadView('backend.administradores.mensajes.pdf', $parameter);
        return $pdf->stream('invoice.pdf');
    }

	/**Store a newly created resource in storage.
	 * @return Response
	 */
	public function store(MensajeCrearRequest $request)
	{  
        $user = Auth::user();
        $mensaje = new Mensaje();
        $mensaje->asunto = $request->asunto;
        $mensaje->fecha = Carbon::now();
        $mensaje->importancia = $request->importancia;
        if ($request->adjuntar == 1){
                $mensaje->adjunto = '1';
            }else{
                $mensaje->adjunto = '0';
            }
        $mensaje->mensaje = $request->mensaje;
        $mensaje->leido = 0;
        $mensaje->respuesta = 1;
        $mensaje->save();
        //envio general del mensaje a remitentes por usuario    
        $envioarray = $request->enviar_a;

        $usuarios = array_values(array_unique($envioarray));

        if($user->rol == 'Administrador')
        {
            $usuarios = array_reverse($usuarios);

            $apartamentos_array = array();

            foreach($usuarios as $usuario) 
            {
                $apto = explode('_', $usuario);

                if(!isset($apto[1]))
                {
                    //Solo guardar apartamento

                    $mensajeusuario = new MensajeUsuario();
                    $mensajeusuario->from_id = $user->id;
                    $mensajeusuario->to_id = $usuario;
                    $mensajeusuario->mensaje_id =$mensaje->id;
                    $mensajeusuario->leido =$mensaje->leido;
                    $mensajeusuario->fecha_leido="0000-00-00";
                    $response = $mensaje->guardarMensajeUsuario($mensaje->id,$mensajeusuario->to_id);
                    $mensajeusuario->save();

                    array_push($apartamentos_array, $usuario);
                }
                else
                {
                    //buscar apartamentos en la zona

                    $apartamentos = Apartamento::where('zona_id',$apto[1])->get();

                    if(count($apartamentos) > 0)
                    {
                        foreach ($apartamentos as $apt) {
                            
                            //Buscar usuarios del apartamento

                            $usuarios_apto = UsuarioApartamento::where('apartamento_id',$apt->id)->get();

                            if(count($usuarios_apto) > 0)
                            {
                                foreach ($usuarios_apto as $user_apt) {
                                    
                                    //si no ha sido guardado 

                                    if(!in_array($user_apt->usuario_id, $apartamentos_array))
                                    {
                                        //Solo guardar apartamento
                    
                                        $mensajeusuario = new MensajeUsuario();
                                        $mensajeusuario->from_id = $user->id;
                                        $mensajeusuario->to_id = $user_apt->usuario_id;
                                        $mensajeusuario->mensaje_id =$mensaje->id;
                                        $mensajeusuario->leido =$mensaje->leido;
                                        $mensajeusuario->fecha_leido="0000-00-00";
                                        $response = $mensaje->guardarMensajeUsuario($mensaje->id,$mensajeusuario->to_id);
                                        $mensajeusuario->save();

                                        array_push($apartamentos_array, $usuario);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        else
        {
            foreach($usuarios as $usuario) {
                $mensajeusuario = new MensajeUsuario();
                $mensajeusuario->from_id = $user->id;
                $mensajeusuario->to_id = $usuario;
                $mensajeusuario->mensaje_id =$mensaje->id;
                $mensajeusuario->leido =$mensaje->leido;
                $mensajeusuario->fecha_leido="0000-00-00";
                $response = $mensaje->guardarMensajeUsuario($mensaje->id,$mensajeusuario->to_id);
                $mensajeusuario->save();
            }
        }
        
        // procesamiento de archivos del mensaje
        $valoradjuntos= $mensaje->adjunto;
        if($valoradjuntos == 1) {   
            $archivos = array_values(array_unique($request->adjuntos));
            foreach($archivos as $archivo){
            $adjunto = new Adjunto();
            $adjunto->nombre = md5($archivo->getClientOriginalName());
            $extension = $archivo->getClientOriginalExtension();
            $adjunto->tipo = $extension;
            $adjunto->ruta = '/home/triagroup/public_html/uploads/data/';
            $adjunto->peso = $archivo->getClientSize();
            $adjunto->fecha = Carbon::now();
            if ($archivo->move($adjunto->ruta,$adjunto->nombre.'.'.$extension)){
                $adjunto->save();
            }
            $adjuntoMensaje = new AdjuntoMensaje();
            $adjuntoMensaje->adjunto_id = $adjunto->id;
            $adjuntoMensaje->mensaje_id = $mensaje->id;
            $adjuntoMensaje->save();
            }
        }
        //redireccionamiento segun perfil
        if ($user->rol == "SuperAdmin") {
             Session::flash('message','Mensaje Enviado con Exito');
            return Redirect::to('/superadmin/mensajes');
        }else if ($user->rol == "Administrador") {
            Session::flash('message','Mensaje Creado con Exito');
            return Redirect::to('/administrador/mensajes');
        }else if ($user->rol == "ResidenteUsuario") {
            Session::flash('message','Mensaje Creado con Exito');
            return Redirect::to('/usuario/mensajes');
        }else if ($user->rol == "Socio") {
            Session::flash('message','Mensaje Creado con Exito');
            return Redirect::to('/mensajes');
        }
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $mensaje=MensajeUsuario::destroy(Input::get('borrarmsg'));
            Session::flash('message','Mensaje eliminado para este usuario');
            return Redirect::to('/superadmin/mensajes');
        }else if ($user->rol == "Administrador") {
            $mensaje=MensajeUsuario::destroy(Input::get('borrarmsg'));
            Session::flash('message','Mensaje eliminado para este usuario');
            return Redirect::to('/administrador/mensajes');
        }
    }

    public function destroyEnviados(Request $request)
    {
        $user = Auth::user();
        if ($user->rol == "SuperAdmin") {
            $mensaje=MensajeUsuario::destroy(Input::get('borrarenviado'));
            Session::flash('message','Mensaje eliminado para este usuario');
            return Redirect::to('/superadmin/enviados');
        }else if ($user->rol == "Administrador") {
            $mensaje=MensajeUsuario::destroy(Input::get('borrarenviado'));
            Session::flash('message','Mensaje eliminado para este usuario');
            return Redirect::to('/administrador/enviados');
        }
    }

}
