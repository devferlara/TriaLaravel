<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Auth;
use Closure;
use Session;

class Pautante
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
                }else if($rol == "Administrador"){
                    return redirect()->to('administrador');
                }else if($rol == "ResidenteUsuario"){
                    return redirect()->to('usuarios');
                }
            }
        return $next($request);
    }
}