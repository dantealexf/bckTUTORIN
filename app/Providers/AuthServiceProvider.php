<?php

namespace App\Providers;

use App\Models\Advisory;
use App\Policies\AdvisoryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        /*'App\Models\Advisory' => 'App\Policies\AdvisoryPolicy',*/
        Advisory::class => AdvisoryPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->admin) {
                return true;
            }
        });

    }
}
