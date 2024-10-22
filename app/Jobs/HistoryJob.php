<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\History;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HistoryJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private readonly ?string $ip,
        private readonly string $search
    ) {
    }

    public function handle(): void
    {
        History::firstOrCreate([
            'ip' => $this->ip,
            'search' => $this->search
        ])->touch();
    }
}
