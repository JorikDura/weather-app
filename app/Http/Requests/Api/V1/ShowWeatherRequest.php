<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1;

use App\Enums\TemperatureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowWeatherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city' => ['required', 'string'],
            'temp' => ['nullable', Rule::enum(TemperatureType::class)]
        ];
    }
}
