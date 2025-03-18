<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Responses\CustomLoginResponse;
use Laravel\Fortify\Http\Responses\LoginResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LoginResponse::class,CustomLoginResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
