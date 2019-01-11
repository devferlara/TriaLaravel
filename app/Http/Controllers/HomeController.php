<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{ 
	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function contact()
	{
        $to_email = "triainternacional@gmail.com"; //Recipient email, Replace with own email here

        //check if its an ajax request, exit if not
        if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'XMLHttpRequest') {

            $output = json_encode(array( //create JSON data
                'type'=>'error',
                'text' => 'Sorry Request must be Ajax POST'
            ));
            die($output); //exit script outputting json data
        }

        //Sanitize input data using PHP filter_var().
        $name		= filter_var(Input::get('name'), FILTER_SANITIZE_STRING);
        $email		= filter_var(Input::get('email'), FILTER_SANITIZE_EMAIL);
        $message	= filter_var(Input::get('message'), FILTER_SANITIZE_STRING);

        //additional php validation
        if(strlen($name)<4){ // If length is less than 4 it will output JSON error.
            $output = json_encode(array('type'=>'error', 'text' => 'Su nombre es Corto o Vacio!'));
            die($output);
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //email validation
            $output = json_encode(array('type'=>'error', 'text' => 'Por favor Ingrese un email Valido!'));
            die($output);
        }
        if(strlen($message)<3){ //check emtpy message
            $output = json_encode(array('type'=>'error', 'text' => 'Mensaje muy corto! Porfavor Ingresa algo mas.'));
            die($output);
        }

        //email body
        $message_body = $message."\r\n\r\n-".$name."\r\nEmail : ".$email;

        //proceed with PHP email.
        $headers = 'From: gerencia@grupogequo.com.co' . "\r\n" .
            'Reply-To: '.$email.'' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $subject = "Contacto Pagina Web";

        $send_mail = mail($to_email, $subject, $message_body, $headers);

        if(!$send_mail)
        {
            //If mail couldn't be sent output error. Check your PHP email configuration (if it ever happens)
            $output = json_encode(array('type'=>'error', 'text' => 'Ups! Se ha presentado un error, Vuelvelo a Intentar!'));
            die($output);
        }else{
            $output = json_encode(array('type'=>'message', 'text' => 'Gracias por contactarnos, nos estaremos comunicando lo mas pronto posible.'));
            die($output);
        }
	}

}