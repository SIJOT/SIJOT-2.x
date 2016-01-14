<?php namespace App\Providers;

use Collective\Annotations\AnnotationsServiceProvider as ServiceProvider;

class AnnotationsServiceProvider extends ServiceProvider {

    /**
     * The classes to scan for event annotations.
     *
     * @var array
     */
    protected $scanEvents = [];

    /**
     * The classes to scan for route annotations.
     *
     * @var array
     */
    protected $scanRoutes = [
        App\Http\Controllers\AuthorizationController::class,
        App\Http\Controllers\CloudController::class,
        App\Http\Controllers\HomeController::class,
        App\Http\Controllers\notificationsController::class,
        App\Http\Controllers\TakkenViewController::class,
        App\Http\Controllers\UserManagement::class,
        App\Http\Controllers\VerhuurBackendController::class,
        App\Http\Controllers\VerhuurController::class, 
        App\Http\Controllers\apiController::class, 
        App\Http\Controllers\apiVerhuurController::class
    ];

    /**
     * The classes to scan for model annotations.
     *
     * @var array
     */
    protected $scanModels = [
        App\Activiteiten::class, 
        App\Groep::class, 
        App\Info::class, 
        App\Notifications::class, 
        App\Permission::class, 
        App\Sessions::class, 
        App\User::class, 
        App\Verhuring::class
    ];

    /**
     * Determines if we will auto-scan in the local environment.
     *
     * @var bool
     */
    protected $scanWhenLocal = true;

    /**
     * Determines whether or not to automatically scan the controllers
     * directory (App\Http\Controllers) for routes
     *
     * @var bool
     */
    protected $scanControllers = true;

    /**
     * Determines whether or not to automatically scan all namespaced
     * classes for event, route, and model annotations.
     *
     * @var bool
     */
    protected $scanEverything = false;

}
