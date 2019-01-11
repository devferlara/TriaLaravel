<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

use App\PagosPublicidad;

class PagoPautaMotor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){

            $user = Auth::user();

            $rol = $user->rol;

            if($rol == "Pautante")
            {
                //Validar que exista un pago realizado al momento de ir a crear una pauta

                $condicion = [
                    'usuario_id'        => $user->id,
                    'publicidad_tipo'   => 3, //id de las publicidades de motores
                    'payment_status'    => 'APPROVED',
                    'utilizado'         => 0,
                    'status'            => 1
                ];

                $pago = PagosPublicidad::where($condicion)->get();
                
                if(count($pago) == 0)
                {
                    //Enviar al pago

                    Session::flash('message','Es necesario realizar el pago de la publicidad.');
                    return redirect()->to('pautante/pagospublicidad/crearpago/motor');
                }
                
            }
                
        }

        return $next($request);
    }
}
