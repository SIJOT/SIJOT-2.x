<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // $user is a Container injection.
        // $permission needs to be set in controller or middleware.

        $gate->define('leden-beheer', function ($user, $value) {
            // dd($query);
            // var_dump($user->id);
            // var_dump($value);

            // return $user->id === $value
            return $value === (int) 1;
        });

        $gate->define('verhuur-beheer', function ($user, $value) {
            return $value === (int) 1;
        });

        $gate->define('cloud', function ($user, $permission) {
            return $user->id === $permission->cloud;
        });

        $gate->define('media', function ($user, $permission) {
            return $user->id === $permission->media;
        });
    }
}
