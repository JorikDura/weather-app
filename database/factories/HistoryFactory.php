<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\History;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'ip' => $this->faker->ipv4(),
            'search' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
