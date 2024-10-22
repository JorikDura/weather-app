<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin History
 */
class HistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'search' => $this->search,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
