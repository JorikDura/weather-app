<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Weather;

use App\DTOs\WeatherDTO;
use App\Enums\ApiEndPoint;
use App\Enums\TemperatureType;
use App\Http\Requests\Api\V1\ShowWeatherRequest;
use App\Jobs\HistoryJob;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

final readonly class ShowWeatherAction
{
    private const int ERROR_NO_API_KEY_PROVIDED = 1002;
    private const int ERROR_NO_LOCATION_FOUND = 1006;
    private const int ITERNAL_ERROR = 9999;

    public function __construct(
        private ShowWeatherRequest $request,
    ) {
    }

    /**
     * @return WeatherDTO
     * @throws ConnectionException
     */
    public function __invoke(): WeatherDTO
    {
        $city = $this->request->validated('city');

        dispatch(new HistoryJob($this->request->ip(), $city));

        $result = Http::weather()
            ->get(
                url: ApiEndPoint::CURRENT_WEATHER->value,
                query: [
                    'q' => $city,
                    'key' => config('weather.key'),
                    'lang' => app()->getLocale()
                ]
            );

        if ($result->failed()) {
            /** @var int $errorCode */
            $errorCode = $result->json()['error']['code'];

            match ($errorCode) {
                self::ERROR_NO_API_KEY_PROVIDED => throw new ConnectionException(
                    message: __('validation.custom.no-key'),
                ),
                self::ITERNAL_ERROR => throw new ConnectionException(
                    message: __('validation.custom.internal-error'),
                ),
                self::ERROR_NO_LOCATION_FOUND => throw ValidationException::withMessages([
                    'city' => __('validation.custom.location')
                ]),
                default => throw new ConnectionException()
            };
        }

        return WeatherDTO::fromJson(
            json: $result->json(),
            temp: $this->request
            ->safe()
            ->enum('temp', TemperatureType::class) ?? TemperatureType::CELSIUS
        );
    }
}
