<?php

namespace App\Providers;

use App\Actions\Api\V1\Weather\ShowWeatherApiAction;
use App\Interfaces\Actions\ShowWeatherAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShowWeatherAction::class, ShowWeatherApiAction::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(app()->isLocal());
        Http::macro('weather', fn () => Http::acceptJson()
            ->baseUrl(config('weather.url')));
    }
}
