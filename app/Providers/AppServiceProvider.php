<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

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
    public function boot(): void
    {
        Paginator::useBootstrap();

        //Policy untuk akses admin ke laravel
        Gate::define('delete', function($user){
            return $user->role === 'admin';
        });
        Gate::define('edit', function($user){
            return $user->role === 'admin';
        });
        Gate::define('create', function($user){
            return $user->role === 'admin';
        });
    }

}
