<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('mailer', function ($app) { 
            $app->configure('services'); 
            return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer'); 
          });
    }

    public function boot()
    {
    
        Schema::defaultStringLength(191);

    }

}
