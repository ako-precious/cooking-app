<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meal;
class MealController extends Controller
{
    public function create()
    {
        // Create a new row in your table
        $newRow = Meal::create([
            // Add any necessary attributes here
        ]);

        // Return the ID of the newly created row
        return response()->json(['id' => $newRow->id]);
    }
}
