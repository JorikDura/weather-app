<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\History;

use App\Actions\Api\V1\History\IndexHistoryAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\HistoryResource;

class IndexHistoryController extends Controller
{
    public function __invoke(IndexHistoryAction $action)
    {
        $histories = $action();

        return HistoryResource::collection($histories);
    }
}
