<?php

namespace App\Http\Middleware;


use Closure;
use Auth;
use Session;

use App\Administrador as Adminm;
use App\AdministradorConjunto as AdminC;
use App\PagoConjunto;

use App\Conjunto as Con;

class NoConjuntoAdmin
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

            if($rol == "Administrador"){

                //verificar que tenga un conjunto

                $admin = Adminm::with('usuarios')->where('usuario_id', '=', $user->id)->firstOrFail();

                $adminConjunto = AdminC::where('administrador_id', '=', $admin->id)->get();

                if(count($adminConjunto) == 0)
                {
                    Session::flash('message','Debe Crear un conjunto.');
                    return redirect()->to('administrador/conjuntos/create');
                }

                //Verificar que halla pagado la membresia

                $pago = PagoConjunto::where(['administrador_id' => $admin->id,'payment_status' => 'APPROVED','status' => 1])->get();
                
                if(count($pago) == 0)
                {
                    //Enviar al pago

                    Session::flash('message','Es necesario pagar su membresia.');
                    return redirect()->to('administrador/pagos/create');
                }

                //Verificar fecha de vencimiento

                if($pago[0]->fecha_fin < date('Y-m-d H:i:s'))
                {
                    ///Actualizar el pago para colocar como vencido

                    //Enviar al pago

                    Session::flash('message','Es necesario pagar su membresia.');
                    return redirect()->to('administrador/pagos/create');
                }

            }
                
        }

        return $next($request);
    }
}
