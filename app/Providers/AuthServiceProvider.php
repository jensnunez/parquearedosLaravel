<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('admin2-admin', function () {

            if (Auth::user()->tipo_usuarios_id === 3){
                return true;
            }
 
            return false;
 
        });

        Gate::define('student-student', function () {

            if (Auth::user()->tipo_usuarios_id === 2 or Auth::user()->tipo_usuarios_id === 3){
                return true;
            }
 
            return false;
 
        });



        //
    }
}
