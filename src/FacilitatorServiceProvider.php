<?php

namespace JeroenG\Facilitator;

use Illuminate\Support\ServiceProvider;
use JeroenG\Facilitator\Http\Middleware\BindFacilityFormRequest;

class FacilitatorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'jeroen-g');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'facilitator');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/facilitator.php', 'facilitator');

        // $this->registerRouteMacro();

        // Register the service the package provides.
        $this->app->singleton(Manager::class, function ($app) {
            return tap(new Manager(), function ($manager) {
                return $manager->setNamespace('App\Facilities');
            });
        });

        // Register middleware
        // $this->app['router']->middleware('facility.bindings', BindFacilityFormRequest::class);
    }

    // protected function registerRouteMacro()
    // {
    //     $this->app['router']->macro('facilities', function ($baseUrl = '') use ($router) {
    //         foreach (config('feed.feeds') as $name => $configuration) {
    //             $url = Path::merge($baseUrl, $configuration['url']);
    //             $router->get($url, '\\'.FeedController::class)->name("feeds.{$name}");
    //         }
    //     });
    // }
    public function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/facilitator.php' => config_path('facilitator.php'),
        ], 'facilitator.config');

        // Publishing the views.
        $this->publishes([
        __DIR__.'/../resources/views' => base_path('resources/views/vendor/jeroen-g/facilitator'),
        ], 'facilitator.views');

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/jeroen-g'),
        ], 'facilitator.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/jeroen-g'),
        ], 'facilitator.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
