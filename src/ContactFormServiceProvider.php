<?php

namespace Ihjordanov\ContactForm;

use Illuminate\Support\ServiceProvider;

class ContactFormServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ihjordanov');
	    $this->loadMigrationsFrom(__DIR__.'/Database/migrations');
	    $this->loadRoutesFrom(__DIR__.'/routes/web.php');
	    $this->loadViewsFrom(__DIR__.'/resources/views', 'contactform');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/contactform.php', 'contactform');

        // Register the service the package provides.
        $this->app->singleton('contactform', function ($app) {
            return new ContactForm;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['contactform'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/contactform.php' => config_path('contactform.php'),
        ], 'contactform.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ihjordanov'),
        ], 'contactform.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ihjordanov'),
        ], 'contactform.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ihjordanov'),
        ], 'contactform.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
