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


        $foodsAndIngredients = [
            "Sushi" => ["seafood", "rice", "vinegar", "sugar", "salt", "wasabi", "ginger", "soy sauce"],
            "Chocolate Fondue" => ["chocolate", "cream", "milk", "sugar", "fruit"],
            "Pizza" => ["dough", "tomato sauce", "cheese", "toppings"],
            "Caviar" => ["fish eggs", "salt", "onion", "lemon", "cream fraiche"],
            "Croissant" => ["dough", "butter", "sugar", "salt", "yeast"],
            "Dim Sum" => ["dumplings", "fillings", "sauce"],
            "Escargot" => ["snails", "garlic", "butter", "parsley", "wine"],
            "Tiramisu" => ["ladyfingers", "mascarpone cheese", "eggs", "sugar", "cocoa powder"],
            "Peking Duck" => ["duck", "pancakes", "scallions", "hoisin sauce"],
            "Gelato" => ["milk", "cream", "sugar", "flavorings"],
            "Pasta Carbonara" => ["pasta", "eggs", "cheese", "pancetta", "black pepper"],
            "Lobster Bisque" => ["lobster", "cream", "butter", "brandy", "vegetables"],
            "Moussaka" => ["eggplant", "ground lamb",  "bechamel sauce", "cheese"],
            "Poutine" => ["fries", "cheese curds", "gravy"],
            "Pho" => ["beef broth", "rice noodles", "meat", "vegetables", "herbs"],
            "Tapas" => ["small plates of various Spanish dishes"],
            "Churros" => ["dough", "sugar", "cinnamon"],
            "Baklava" => ["phyllo dough", "nuts", "honey", "spices"],
            "Hummus" => ["chickpeas", "tahini", "olive oil", "lemon juice", "garlic"],
            "Ramen" => ["noodles", "broth", "meat", "vegetables", "egg"],
            "Pad Thai" => ["rice noodles", "eggs", "tofu", "vegetables", "peanut sauce"],
            "Ceviche" => ["fish", "citrus juice", "onions", "peppers", "cilantro"],
            "Paella" => ["rice", "chicken", "seafood", "vegetables", "saffron"],
            "Beef Wellington" => ["beef", "duxelles", "puff pastry"],
            "Macarons" => ["almond flour", "sugar", "egg whites", "food coloring"],
            "Creme Brulee" => ["cream", "egg yolks", "sugar", "vanilla extract"],
            "Tandoori Chicken" => ["chicken", "yogurt", "tandoori masala", "lemon juice"],
            "Kaiseki" => ["multiple small, beautifully arranged courses"],
            "Gyoza" => ["dumplings", "meat", "vegetables"],
            "Fondue" => ["cheese", "wine", "cornstarch", "kirsch"],
            "Pierogi" => ["dumplings", "potato", "cheese", "onion", "bacon"],
            "Bruschetta" => ["bread", "tomatoes", "garlic", "olive oil", "basil"],
            "Tartare" => ["raw meat", "capers", "onions", "egg yolk", "spices"],
            "Jambalaya" => ["rice", "meat", "seafood", "vegetables", "spices"],
            "Smoothie and Donuts" => ["fruits", "milk", "yogurt", "ice cream", "dough", "sugar", "oil"],
            "Moussaka" => ["eggplant", "ground lamb",  "bechamel sauce", "cheese"],
            "Empanadas" => ["dough", "fillings", "meat", "vegetables"],
            "Samosa" => ["pastry", "fillings", "meat", "vegetables"],
            "Peking Duck" => ["duck", "pancakes", "scallions", "hoisin sauce"],
            "Tiramisu" => ["ladyfingers", "mascarpone cheese", "eggs", "sugar", "cocoa powder"],
            "Wiener Schnitzel" => ["veal", "breadcrumbs", "egg", "flour"],
            "Borscht" => ["beets", "cabbage", "potatoes", "meat", "sour cream"],
            "Croque Monsieur" => ["bread", "ham", "cheese", "bechamel sauce"],
        ];
          $status = ['pending', 'available' ];
          $preference = ['manual', 'automatic'];
        // $cooksIds = Cook::pluck('user_id')->all();
         $cooksIds = 1;
        return [
            // 'cook_id' => $this->faker->randomElement($cooksIds),
            'cook_id' => $cooksIds,
            'name' => $chosenFood = $this->faker->randomElement(array_keys($foodsAndIngredients)),
            'description' => implode(' ', $this->faker->sentences(3)),
            'price' => $this->faker->numberBetween(5, 50),
            'ingredients' => json_encode([$foodsAndIngredients[$chosenFood]]),              
            'cooking_limit'=> $this->faker->numberBetween(10, 20),
            'status'=>$this->faker->randomElement($status),
            'ordering_preferences'=>$this->faker->randomElement($preference),
        ];
    }
}
