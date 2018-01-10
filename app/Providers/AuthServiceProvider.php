<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\UserProject;

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
        $this->app['auth']->viaRequest('api', function ($request) {


            // $user = User::first();
            // $user->projects()->first()->connectDatabase();
            
            if ($request->hasHeader('Authorization')) {
                $user =  User::where('token', $request->header('Authorization'))->first();

                if( $user )
                {
                    return $user;
                }

                $res =  UserProject::where('token', $request->header('Authorization'))->first();

                if( !$res )
                {
                    return false;
                }

                $res->project->connectDatabase();
                return $res->user;

            }

        });
    }
}
