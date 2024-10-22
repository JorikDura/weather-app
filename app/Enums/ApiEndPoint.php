<?php

declare(strict_types=1);

namespace App\Enums;

enum ApiEndPoint: string
{
    case CURRENT_WEATHER = 'current.json';
}
