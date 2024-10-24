<?php

declare(strict_types=1);

namespace App\Interfaces\Actions;

use App\DTOs\WeatherDTO;

interface ShowWeatherAction
{
    public function __invoke(): WeatherDTO;
}
