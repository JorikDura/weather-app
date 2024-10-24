<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Weather;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WeatherResource;
use App\Interfaces\Actions\ShowWeatherAction;

class ShowWeatherController extends Controller
{
    /**
     * @param  ShowWeatherAction  $action
     * @return WeatherResource
     */
    public function __invoke(ShowWeatherAction $action)
    {
        $weatherDTO = $action();

        return WeatherResource::make($weatherDTO);
    }
}
