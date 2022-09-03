<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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

        Gate::define('admin', function ($user) {
            return $user->tipo == 1 ? true : false;
        });

        Gate::define('vendedor', function ($user) {
            return $user->tipo == 2 ? true : false;
        });

        Gate::define('analista', function ($user) {
            return $user->tipo == 3 ? true : false;
        });

        Gate::define('estagiario', function ($user) {
            return $user->tipo == 4 ? true : false;
        });

    }
}
