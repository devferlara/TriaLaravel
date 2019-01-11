<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Auth;
use Closure;
use Session;

class Administrador
{
      /**Handle an incoming request
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed */

    public function handle($request, Closure $next)
    {
        if(Auth::check()){
                $user = Auth::user();
                $rol = $user->rol;
                $id = $user->id;
                if($rol == "SuperAdmin"){
                    return redirect()->to('superadmin');
                }else if($rol == "ResidenteUsuario"){
                    return redirect()->to('usuarios');
                }else if($rol == "Pautante"){
                    return redirect()->to('pautante');
                }
            }
        return $next($request);
    }
}
