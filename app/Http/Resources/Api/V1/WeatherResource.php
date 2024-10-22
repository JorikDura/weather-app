<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\DTOs\WeatherDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin WeatherDTO
 */
class WeatherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'city' => $this->city,
            'country' => $this->country,
            'condition' => $this->condition,
            'cloud' => $this->cloud,
            'temp_celsius' => $this->whenNotNull($this->tempCelsius),
            'temp_fahrenheit' => $this->whenNotNull($this->tempFahrenheit),
            'feels_like_celsius' => $this->whenNotNull($this->feelsLikeCelsius),
            'feels_like_fahrenheit' => $this->whenNotNull($this->feelsLikeFahrenheit),
            'wind_mph' => $this->whenNotNull($this->windMph),
            'wind_kph' => $this->whenNotNull($this->windKph),
            'gust_mph' => $this->whenNotNull($this->gustMph),
            'gust_kph' => $this->whenNotNull($this->gustKph),
        ];
    }
}
