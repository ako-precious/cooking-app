<?php

namespace Database\Factories;
use App\Models\Cook;
use App\Models\User;
use App\Models\Meal;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MealSchedule>
 */
class MealScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mealIds = Meal::pluck('id')->all();
        $meal_time = [ 'Breakfast', 'Lunch', 'Dinner',  ];
        
        return [
            //
        ];
    }
}
