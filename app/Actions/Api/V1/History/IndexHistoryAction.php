<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\History;

use App\Models\History;
use Illuminate\Database\Eloquent\Collection;

final readonly class IndexHistoryAction
{
    /**
     * @return Collection<History>
     */
    public function __invoke(): Collection
    {
        return History::where('ip', request()->ip())
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
    }
}
