<?php

namespace App\Providers;
use App\View\Composers\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Menu::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('web.*', Menu::class);
    }
}