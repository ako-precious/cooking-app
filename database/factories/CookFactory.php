<?php

namespace Database\Factories;

use App\Models\Cook;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cook>
 */
class CookFactory extends Factory
{
    protected $model = \App\Models\Cook::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'user_id' => User::factory(),
            'certificate' => null,
            'means_of_id' => null,
            // 'means_of_alt' => null,
            'other_info' => implode(' ', $this->faker->sentences(5)),
        ];
    }
}
