<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
          $middleware->redirectGuestsTo(fn () => route('login'));
    $middleware->redirectUsersTo(fn () => route('user.home'));

     $middleware->alias([
        'company.auth' => \App\Http\Middleware\Companyauth::class,
        'company.guest' => \App\Http\Middleware\ifcompanyautheticated::class,

         'admin.auth' => \App\Http\Middleware\Adminauth::class,
        'admin.guest'=> \App\Http\Middleware\Adminguest::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
