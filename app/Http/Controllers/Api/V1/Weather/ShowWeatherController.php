<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Weather;

use App\Actions\Api\V1\Weather\ShowWeatherAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WeatherResource;

class ShowWeatherController extends Controller
{
    public function __invoke(ShowWeatherAction $action)
    {
        $weatherDTO = $action();

        return WeatherResource::make($weatherDTO);
    }
}
