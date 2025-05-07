<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DiscordService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
public function register()
{
    // Registreer de DiscordService als een singleton zodat het maar één keer wordt aangemaakt.
    $this->app->singleton(DiscordService::class, function ($app) {
        return new DiscordService();
    });
}
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
