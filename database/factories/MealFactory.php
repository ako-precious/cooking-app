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
            'Pizza', 'Pasta', 'Tacos', 'Salad', 'Sushi', 'Fried Rice','Cake', 'Toast and egg',
            'Sushi', 'Pizza Margherita', 'Pad Thai', 'Tacos', 'Croissant', 'Hamburger', 'Paella', 
            'Miso Soup', 'Goulash', 'Churros', 'Kimchi', 'Poutine', 'Ceviche', 'Dim Sum', 'Bruschetta', 
            'Steak', 'Chicken', 'Fish', 'Fruit Salad', 'Sandwich and Yogurt', 'Wrap', 'Smoothie and Donuts',
            'Moussaka', 'Empanadas', 'Samosa', 'Peking Duck', 'Tiramisu', 'Wiener Schnitzel', 'Borscht', 'Croque Monsieur',
            'Jollof Rice', 'Fish and Chips', 'Pierogi', 'Falafel', 'Pho', 'Rendang', 'Pasta Carbonara', 'Burger and Ice Cream', 
        ];
       
//   "", , "Cookies", "", "Pie", "Pancakes", "Waffles",
//   "Oatmeal", "Cereal", "", "Bacon", , "Bagel", ""
        $cooksIds = Cook::pluck('user_id')->all();
        return [
            'cook_id' => $this->faker->randomElement($cooksIds),
            'name' => $this->faker->randomElement($foods),
            'description' => implode(' ', $this->faker->sentences(3)),
        ];
    }
}
