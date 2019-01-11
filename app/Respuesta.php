<?php

namespace App;

use DB;
use Auth;
use PushNotification;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends model {

    protected $table = 'respuestas';
    protected $fillable = ['mensaje_id', 'from_id', 'to_id','mensaje', 'fecha', 'leido', 'fecha_leido'];

    private $devices_android;
    private $devices_ios;

 	 public function guardarRespuestaUsuario($MensajeId,$usuario)
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
            ->join('respuestas as respuesta', 'usuario.id', '=', 'respuesta.to_id')
            ->select('usuario.id','config.tokenA','config.device_type', 'respuesta.from_id','respuesta.to_id')
            ->where('respuesta.to_id', '=', $id)
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

        $message = PushNotification::Message('Tienes Respuesta a un mensaje',array(
        'badge' => 1,
        'sound' => 'example.aiff',
        'title' => 'Comunicando',
        'actionLocKey' => 'Respuesta a un mensaje',
        'locKey' => 'Tienes respuesta a un mensaje',
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
        //    /* DB::table('push_notifications')->insert(
        //         array('type' => 'ios', 'response' => $collection_ios)
        //     );*/
        PushNotification::app(['environment' => env('ANDROID_PUSH_ENV', 'production'),
        'apiKey'      => env('ANDROID_PUSH_API_KEY', 'AIzaSyAYsAtDAdwaD3bsCmDi24RbTZeXlzsxyuY'),
        'service'     => 'gcm'])->to($this->devices_android)->send($message);
            /*DB::table('push_notifications')->insert(
                array('type' => 'android', 'response' => $collection_android)
            );*/
        return true;
    }
}