<?php
namespace App;
use DB;
use Auth;
use PushNotification;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends model {

    protected $table = 'mensajes';
    protected $fillable = [];
    private $devices_android;
    private $devices_ios;


    // Many to many relationship Mensaje-Usuario Table
    public function usuarios(){
        return $this->belongsToMany('App\User','mensaje_usuarios','mensaje_id','usuario_id');
    }

    // Many to many relationship Adjunto-Mensaje Table
    public function adjuntos(){
        return $this->belongsToMany('App\Adjunto','adjunto_mensajes','mensaje_id','adjunto_id');
    }

    // Many to many relationship Respuestas Table
    public function respuestasUsuario(){
        return $this->belongsToMany('App\User','respuestas','mensaje_id','usuario_id');
    }

    public function mostrarBadges($paraid){
        $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->select('mensaje.id','mensaje.fecha','msg_usuario.leido','msg_usuario.to_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->where(['msg_usuario.to_id' => $paraid,'msg_usuario.leido' => 0])
            ->orWhere(['r.to_id' => $paraid,'r.leido' => 0])

            ->count();
        return $datos;
    }

    public function mostrarEnviados($deid){

        $user = Auth::user();

        if($user->rol == 'SuperAdmin')
        {
           $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'msg_usuario.to_id')
            ->select('mensaje.id', 'mensaje.asunto', 'mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id', 'msg_usuario.to_id', 'msg_usuario.leido', 'u.nombres','u.apellidos','msg_usuario.id as id_mensaje_usuario')
            ->where('msg_usuario.from_id', '=', $deid)
            ->orderBy('mensaje.id', 'DESC')
            ->get();

            return $datos;
    
        }

        if($user->rol == 'Administrador')
        {
           $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuario_apartamentos as usuarioapto', 'usuarioapto.usuario_id', '=', 'msg_usuario.to_id')
            ->join('apartamentos as apartamento', 'apartamento.id', '=', 'usuarioapto.apartamento_id')
            ->join('zonas as zona', 'zona.id', '=', 'apartamento.zona_id')
            ->select('mensaje.id', 'mensaje.asunto', 'mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id', 'msg_usuario.to_id', 'msg_usuario.leido', 'apartamento.apartamento', 'zona.zona', 'zona.tipo','msg_usuario.id as id_mensaje_usuario')
            ->where('msg_usuario.from_id', '=', $deid)
            ->orderBy('mensaje.id', 'DESC')
            ->get();

            return $datos;
    
        }

        if($user->rol == 'ResidenteUsuario')
        {
           $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'msg_usuario.to_id')
            ->select('mensaje.id', 'mensaje.asunto', 'mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id', 'msg_usuario.to_id', 'msg_usuario.leido','msg_usuario.id as id_mensaje_usuario','u.nombres','u.apellidos')
            ->where('msg_usuario.from_id', '=', $deid)
            ->orderBy('mensaje.id', 'DESC')
            ->get();

            return $datos;
        }

        
        /*$datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido')
            ->where('m_u.from_id', '=', $deid)
            ->orderBy('mensaje.created_at', 'desc')
            ->where('m_u.leido', '=', 1)
            ->get();*/
        
    }

    public function mostrarImportantes($paraid){

        $user = Auth::user();

        if($user->rol == 'ResidenteUsuario')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;
        }

        if($user->rol == 'Administrador')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;

        }
        $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'msg_usuario.from_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apartamento', 'userapto.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.asunto','mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id','msg_usuario.to_id', 'msg_usuario.leido', 'usuario.nombres', 'usuario.apellidos','apartamento.apartamento','zona.zona','msg_usuario.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['msg_usuario.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Importante'])
            ->orderBy('mensaje.id', 'DESC')
            ->groupBy('r.mensaje_id')
            ->get();
        return $datos;
    }

    public function mostrarRelevantes($paraid){
        
        $user = Auth::user();

        if($user->rol == 'ResidenteUsuario')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;
        }

        if($user->rol == 'Administrador')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;
        }

        $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'msg_usuario.from_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apartamento', 'userapto.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.asunto','mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id','msg_usuario.to_id', 'msg_usuario.leido', 'usuario.nombres', 'usuario.apellidos','apartamento.apartamento','zona.zona','msg_usuario.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['msg_usuario.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Relevante'])
            ->orderBy('mensaje.id', 'DESC')
            ->groupBy('r.mensaje_id')
            ->get();
        return $datos;
    }

    public function mostrarNormales($paraid){

        $user = Auth::user();

        if($user->rol == 'ResidenteUsuario')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;
        }

        if($user->rol == 'Administrador')
        {
            $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as m_u', 'mensaje.id', '=', 'm_u.mensaje_id')
            ->join('usuarios as u', 'u.id', '=', 'm_u.from_id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.enviar_a','mensaje.asunto','mensaje.fecha','mensaje.importancia','mensaje.adjunto','m_u.leido','u.nombres','u.apellidos','m_u.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['m_u.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orderBy('mensaje.created_at', 'desc')
            ->groupBy('r.mensaje_id')
            ->get();

            return $datos;
        }
        
        $datos = DB::table('mensajes as mensaje')
            ->join('mensaje_usuarios as msg_usuario', 'mensaje.id', '=', 'msg_usuario.mensaje_id')
            ->join('usuarios as usuario', 'usuario.id', '=', 'msg_usuario.from_id')
            ->join('usuario_apartamentos as userapto', 'usuario.id', '=', 'userapto.usuario_id')
            ->join('apartamentos as apartamento', 'userapto.apartamento_id', '=', 'apartamento.id')
            ->join('zonas as zona', 'apartamento.zona_id', '=', 'zona.id')
            ->join('respuestas as r', 'r.mensaje_id', '=', 'mensaje.id','left outer')
            ->select('mensaje.id','mensaje.asunto','mensaje.fecha','mensaje.mensaje','mensaje.importancia', 'msg_usuario.from_id','msg_usuario.to_id', 'msg_usuario.leido', 'usuario.nombres', 'usuario.apellidos','apartamento.apartamento','zona.zona','msg_usuario.id as id_mensaje_usuario','r.leido as resleido')
            ->where(['msg_usuario.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orWhere(['r.to_id' => $paraid,'mensaje.importancia' => 'Normal'])
            ->orderBy('mensaje.id', 'DESC')
            ->groupBy('r.mensaje_id')
            ->get();
        return $datos;
    }

    public function guardarMensajeUsuario($MensajeId,$usuario)
    {
        $user = Auth::user();
        $query = DB::table('usuarios as usuario')
            ->select('usuario.id')
            ->where('usuario.id', '=', $usuario)
            ->get();
        $data = array();
        $x = 0;
        foreach($query as $dato){
            $id = ucwords(strtolower($dato->id));

            $data[$x]=
                array("from_id" =>$user->id ,"to_id" => $id,"mensaje_id" => $MensajeId);
            $x++;
        }
        $this->pushNotification($usuario);
        return true;

    }

    /*Push Notificaciones* */
    public function pushNotification($id){

        $datos = DB::table('usuarios as usuario')
            ->join('configuraciones as config', 'usuario.id', '=', 'config.usuario_id')
            ->join('mensaje_usuarios as msg_usuario', 'usuario.id', '=', 'msg_usuario.to_id')
            ->select('usuario.id','config.tokenA','config.device_type', 'msg_usuario.to_id')
            ->where('msg_usuario.to_id', '=', $id)
            ->where('config.tokenA', '!=', "")
            ->get();
        $device_android = array();
        $device_ios = array();
        $x = 0;
        foreach($datos as $dato){
           if($dato->tokenA != ""){
                if($dato->device_type == "android"){
                    $device_android[$x] = PushNotification::Device($dato->tokenA, array('badge' => 0));
                }else if($dato->device_type == "iOS"){
                    //$device_ios[$x] = PushNotification::Device($dato->tokenA, array('badge' => 0));
                }
            $x++;
            }
        }
        $this->devices_android = PushNotification::DeviceCollection($device_android);
        //$this->devices_ios = PushNotification::DeviceCollection($device_ios);

        $message = PushNotification::Message('Nuevo mensaje del administrador',array(
        'badge' => 1,
        'sound' => 'example.aiff',
        'title' => 'Comunicando',
        'actionLocKey' => 'Nuevo mensaje del administrador',
        'locKey' => 'Nuevo mensaje del administrador',
        'locArgs' => array(
        'localized args',
        'localized args',
        ),
        'custom' => array('custom data' => array(
            'we' => 'want', 'send to app'
            ))
        ));

        // PushNotification::app([
        // 'environment' => env('IOS_PUSH_ENV', 'production'),
        // 'certificate' => env('IOS_PUSH_CERT', app_path().'/ck.pem'), 
        // 'passPhrase'  => env('IOS_PUSH_PASSWORD', 'comunicando2015'),
        // 'service'     => 'apns'])->to($this->devices_ios)->send($message);
           /* DB::table('push_notifications')->insert(
                array('type' => 'ios', 'response' => $collection_ios)
            );*/
 
        $result = PushNotification::app(['environment' => env('ANDROID_PUSH_ENV', 'production'),
        'apiKey'      => env('ANDROID_PUSH_API_KEY', 'AIzaSyAYsAtDAdwaD3bsCmDi24RbTZeXlzsxyuY'),
        'service'     => 'gcm'])->to('$this->devices_android')->send($message);
            // DB::table('push_notifications')->insert(
            //     array('type' => 'android', 'response' => $collection_android)
            // );
    
    //var_dump( $result);
      //  die();
      
      return true;
    }
}