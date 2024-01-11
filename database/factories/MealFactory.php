<?php

namespace Database\Factories;


use App\Models\Cook;
use App\Models\User;
use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    protected $model = \App\Models\Meal::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $foods = [
            "Pizza", "Pasta", "Tacos", "Salad", "Soup", "Burger", "Sushi", "Fried Rice",
            "Steak", "Chicken", "Fish", "Fruit Salad", "Sandwich", "Wrap", "Smoothie",
            "Ice Cream", "Cake", "Cookies", "Donuts", "Pie", "Pancakes", "Waffles",
            "Oatmeal", "Cereal", "Eggs", "Bacon", "Toast", "Bagel", "Yogurt"
          ];
          $cooksIds = Cook::pluck('user_id')->all();
        return [
                       'cook_id' => $this->faker->randomElement($cooksIds),
            'name' => $this->faker->randomElement($foods),
            'description' => implode(' ', $this->faker->sentences(3)),
        ];
       
    }
}
