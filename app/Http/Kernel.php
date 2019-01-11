<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        'superadmin' => \App\Http\Middleware\Superadmin::class,
        'administrador' => \App\Http\Middleware\Administrador::class,
        'residente' => \App\Http\Middleware\Residente::class,
        'socio' => \App\Http\Middleware\Socio::class,
        'verificarPago' => \App\Http\Middleware\NoConjuntoAdmin::class,
        'pautante' => \App\Http\Middleware\Pautante::class,
        'pagopautadescuento' => \App\Http\Middleware\PagoPautaDescuento::class,
        'pagopautamascotas' => \App\Http\Middleware\PagoPautaMascotas::class,
        'pagopautamotor' => \App\Http\Middleware\PagoPautaMotor::class,
    ];
}
