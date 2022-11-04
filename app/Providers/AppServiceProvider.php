<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $bindings = [
        //     InterfaceClass => InterfaceImplClass,
        // ]

        // Da li je bolje registrovati jedan ServiceProvider kroz drugi ServiceProvider?
        // Ili je bolje direktno ga dodati u config/app.php u "providers" deo?
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
