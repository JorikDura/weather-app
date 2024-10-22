<?php

use function Pest\Laravel\getJson;

describe('weather test', function () {
    it('get weather data', function () {
        Http::fake(function () {
            return Http::response([
                "location" => [
                    "name" => "Rome",
                    "region" => "Lazio",
                    "country" => "Italy",
                    "lat" => 41.9,
                    "lon" => 12.4833,
                    "tz_id" => "Europe/Rome",
                    "localtime_epoch" => 1729627712,
                    "localtime" => "2024-10-22 22 =>08"
                ],
                "current" => [
                    "last_updated_epoch" => 1729627200,
                    "last_updated" => "2024-10-22 22 =>00",
                    "temp_c" => 19.4,
                    "temp_f" => 66.8,
                    "is_day" => 0,
                    "condition" => [
                        "text" => "Good",
                        "icon" => "//cdn.weatherapi.com/weather/64x64/night/113.png",
                        "code" => 1000
                    ],
                    "wind_mph" => 2.5,
                    "wind_kph" => 4.0,
                    "wind_degree" => 61,
                    "wind_dir" => "ENE",
                    "pressure_mb" => 1027.0,
                    "pressure_in" => 30.33,
                    "precip_mm" => 0.0,
                    "precip_in" => 0.0,
                    "humidity" => 86,
                    "cloud" => 22,
                    "feelslike_c" => 19.4,
                    "feelslike_f" => 66.8,
                    "windchill_c" => 19.4,
                    "windchill_f" => 66.8,
                    "heatindex_c" => 19.4,
                    "heatindex_f" => 66.8,
                    "dewpoint_c" => 16.9,
                    "dewpoint_f" => 62.4,
                    "vis_km" => 10.0,
                    "vis_miles" => 6.0,
                    "uv" => 0.0,
                    "gust_mph" => 4.3,
                    "gust_kph" => 6.9
                ]
            ]);
        });

        getJson('api/v1/weather?city=Rome&key=fake&temp=celsius')
            ->assertSuccessful()
            ->assertSee([
                "city" => "Rome",
                "country" => "Italy",
                "condition" => "Good",
                "cloud" => 22,
                "temp_celsius" => 19.4,
                "feels_like_celsius" => 19.4,
                "wind_mph" => 2.5,
                "wind_kph" => 4,
                "gust_mph" => 4.3,
                "gust_kph" => 6.9
            ]);
    });
});
