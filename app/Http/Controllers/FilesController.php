<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Configuracion;
use App\AdjuntoMensaje;
use App\Adjunto;
use Auth;
use DB;
use File;
use Response;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class FilesController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function link_adjunto($mensaje)
    {
        $adjunto_mensaje = AdjuntoMensaje::where('mensaje_id','=',$mensaje)->get();
        foreach($adjunto_mensaje as $adjunto){
            $id = $adjunto->adjunto_id;
        }
        if(empty($id)){
            return Redirect::back();
        }else{
            $adjunto = Adjunto::find($id);
            $file = public_path().'/uploads/'.$adjunto->nombre.'.pdf';
            if (File::isFile($file))
            {
                $file = File::get($file);
                $response = Response::make($file, 200);
                // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
                $response->header('Content-Type', 'application/pdf');
                return $response;
            }
        }
    }


    public function loadImageSource(){
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200)).'-'.time();
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = public_path().'/uploads/data/'. $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                $data = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"];
                return $data.'/uploads/data/'.$filename;//change this URL
            }
            else
            {
                return  $message = 'Lo Sentimos tu Carga de Archivos tiene errores: '.$_FILES['file']['error'];
            }
        }
    }


    public function getdategral(){
        return time();
    }

}