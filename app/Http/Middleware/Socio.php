<?php

namespace App\Http\Middleware;

use Auth;
use Closure;


class Socio
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
                if($rol == "Administrador"){
                    return redirect()->to('administrador');
                }else if($rol == "ResidenteUsuario"){
                    return redirect()->to('usuarios');
                }else if($rol == "Pautante"){
                    return redirect()->to('pautante');
                }
            }
        return $next($request);
    }
}