<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Models\Navigation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $navbars = Navigation::orderBy('ordering')->get();
            $view->with('navbars', $navbars);
        });
    }
}
