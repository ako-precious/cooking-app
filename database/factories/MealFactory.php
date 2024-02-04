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
            "Sushi","Chocolate Fondue","Pizza","Caviar","Croissant", "Dim Sum", "Escargot", "Tiramisu", "Peking Duck", "Gelato", 
            "Pasta Carbonara", "Lobster Bisque", "Moussaka", "Poutine", "Pho", "Tapas", "Churros", "Baklava", "Hummus", "Ramen", 
            "Pad Thai", "Ceviche", "Paella", "Beef Wellington", "Macarons", "Creme Brulee", "Tandoori Chicken", "Kaiseki", "Gyoza", 
            "Fondue", "Pierogi", "Bruschetta", "Tartare", "Jambalaya", 'Smoothie and Donuts', 'Moussaka', 'Empanadas', 'Samosa',
            'Peking Duck', 'Tiramisu', 'Wiener Schnitzel', 'Borscht', 'Croque Monsieur',
            'Jollof Rice', 'Fish and Chips', 'Pierogi', 'Falafel', 'Pho', 'Rendang', 'Pasta Carbonara', 'Burger and Ice Cream',
        ];

        //   "", , "Cookies", "", "Pie", "Pancakes", "Waffles",
        //   "Oatmeal", "Cereal", "", "Bacon", , "Bagel", ""
        $cooksIds = Cook::pluck('user_id')->all();
        return [
            'cook_id' => $this->faker->randomElement($cooksIds),
            'name' => $this->faker->randomElement($foods),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'description' => implode(' ', $this->faker->sentences(3)),
        ];
    }
}
