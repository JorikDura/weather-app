<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\TemperatureType;

final class WeatherDTO
{
    public function __construct(
        public string $city,
        public string $country,
        public string $condition,
        public float $cloud,
        public ?float $tempCelsius = null,
        public ?float $tempFahrenheit = null,
        public ?float $feelsLikeCelsius = null,
        public ?float $feelsLikeFahrenheit = null,
        public ?float $windMph = null,
        public ?float $windKph = null,
        public ?float $gustMph = null,
        public ?float $gustKph = null
    ) {
    }

    public static function fromJson(array $json, TemperatureType $temp): self
    {
        $location = $json['location'];
        $currentWeather = $json['current'];
        $weatherCondition = $currentWeather['condition'];

        $dto = new self(
            city: $location['name'],
            country: $location['country'],
            condition: $weatherCondition['text'],
            cloud: $currentWeather['cloud'],
            windMph: $currentWeather['wind_mph'],
            windKph: $currentWeather['wind_kph'],
            gustMph: $currentWeather['gust_mph'],
            gustKph: $currentWeather['gust_kph']
        );

        if ($temp == TemperatureType::CELSIUS) {
            $dto->tempCelsius = $currentWeather['temp_c'];
            $dto->feelsLikeCelsius = $currentWeather['feelslike_c'];
        } else {
            $dto->tempFahrenheit = $currentWeather['temp_f'];
            $dto->feelsLikeFahrenheit = $currentWeather['feelslike_f'];
        }

        return $dto;
    }
}
