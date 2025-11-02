<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::define('manage-products', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-categories', function ($user) {
            return $user->role === 'admin';
        });
    }
}
