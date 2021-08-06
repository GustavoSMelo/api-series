<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {

        $this->app['auth']->viaRequest('api', function (Request $request) {
            if (!$request->header('Authorization')) {
                return null;
            }

            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);

            $dataUsuario = JWT::decode($token, env('JWT_KEY'), ['HS256']);

            return User::query()->where('email', $dataUsuario->email)->first();
        });
    }
}
