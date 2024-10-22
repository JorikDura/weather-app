<?php

use App\Models\History;

use function Pest\Laravel\getJson;
use function PHPUnit\Framework\assertEquals;

describe('history tests', function () {
    it('get history', function () {
        /** @var History $history */
        $history = History::factory()->create(['ip' => request()->ip()]);

        getJson('api/v1/history')
            ->assertSuccessful()
            ->assertSee([
                'id' => $history->id,
                'search' => $history->search
            ]);
    });

    it('check history count trigger', function () {
        History::factory(15)->create(['ip' => request()->ip()]);

        $count = History::where(['ip' => request()->ip()])->count();

        assertEquals($count, 5);
    });
});
