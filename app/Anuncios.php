<?php

namespace App;
use Conjunto;
use DB;
use PushNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Anuncios extends model {

    protected $dates = ['deleted_at'];
    protected $table = 'noticias';
    protected $fillable = [
    	'nombre', 
    	'mini_descripcion', 
    	'descripcion', 
    	'fecha', 
    	'autor', 
    	'img_perfil',
    	'img_banner', 
    	'valoracion',
        'conjunto_id',
        'categoria',
        'enabled'];
    private $devices_android;
    private $devices_ios;
    
    public function conjuntos(){
        return $this->belongsTo('App\Conjunto', 'conjunto_id');
    }

    public function setImgbannerAttribute($img_banner){
        if (!empty($img_banner)) {
        $this->attributes['img_banner']= carbon::now()->second.$img_banner->getClientOriginalName();
        $nombrefile=carbon::now()->second.$img_banner->getClientOriginalName();
        \Storage::disk('anuncios')->put($nombrefile,\File::get($img_banner));
        }
    }

    public function guardarAnunciopush($AnuncioId, $conjunto){

        //Buscar Conjunto Residencial
        $query = DB::table('conjuntos as conjunto')
            ->select('conjunto.id')
            ->where('conjunto.id', '=', $conjunto)
            ->get();

        $data = array();
        $x = 0;
        foreach($query as $d){
            $id = ucwords(strtolower($d->id));

            $data[$x]=
                array("id" => $AnuncioId, "conjunto_id" => $id);
            $x++;
        }

        $this->pushNotification($conjunto);
        return true;
        
    }

     public function pushNotification($conjuntoid){

        $datos = DB::table('conjuntos as conjunto')
            ->join('zonas as zona', 'zona.conjunto_id', '=', 'conjunto.id')
            ->join('apartamentos as apartamento', 'apartamento.zona_id', '=', 'zona.id')
            ->join('usuario_apartamentos as u_a', 'u_a.apartamento_id', '=', 'apartamento.id')
            ->join('usuarios as usuario', 'u_a.usuario_id', '=', 'usuario.id')
            ->join('configuraciones as config', 'usuario.id', '=', 'config.usuario_id')
            ->select('usuario.id','config.token','config.device_type', 'conjunto.id')
            ->where('conjunto.id', '=', $conjuntoid)
            ->where('usuario.active', '=', 1)
            ->where('config.token', '!=', "")
            ->get();
        $device_android = array();
        $device_ios = array();
        $x = 0;
        foreach($datos as $dato){
           if($dato->token != ""){
                if($dato->device_type == "android"){
                    $device_android[$x] = PushNotification::Device($dato->token, array('badge' => 0));
                }else if($dato->device_type == "iOS"){
                    $device_ios[$x] = PushNotification::Device($dato->token, array('badge' => 0));
                }
            $x++;
            }
        }
        $this->devices_android = PushNotification::DeviceCollection($device_android);
        $this->devices_ios = PushNotification::DeviceCollection($device_ios);

        $message = PushNotification::Message('Nuevo Anuncio para tu Conjunto',array(
        'badge' => 1,
        'sound' => 'example.aiff',
        'title' => 'Comunicando - Anuncio',
        'actionLocKey' => 'Nuevo Anuncio del Conjunto',
        'locKey' => 'Nuevo Anuncio del Conjunto',
        'locArgs' => array(
        'localized args',
        'localized args',
        ),
        'custom' => array('custom data' => array(
            'we' => 'want', 'send to app'
            ))
        ));

        PushNotification::app([
        'environment' => env('IOS_PUSH_ENV', 'production'),
        'certificate' => env('IOS_PUSH_CERT', app_path().'/ck.pem'), 
        'passPhrase'  => env('IOS_PUSH_PASSWORD', 'comunicando2015'),
        'service'     => 'apns'])->to($this->devices_ios)->send($message);
           /* DB::table('push_notifications')->insert(
                array('type' => 'ios', 'response' => $collection_android)
            );*/
        PushNotification::app(['environment' => env('ANDROID_PUSH_ENV', 'production'),
        'apiKey'      => env('ANDROID_PUSH_API_KEY', 'AIzaSyCq_I-OSwEZxKVja5nz8cK-jfis_Mtb0P4'),
        'service'     => 'gcm'])->to($this->devices_android)->send($message);
            /*DB::table('push_notifications')->insert(
                array('type' => 'android', 'response' => $collection_ios)
            );*/
        return true;
    }

}