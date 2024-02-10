<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meal;

class MealController extends Controller
{
    public function store(Request $request)
    {
        // Create a new row in your table
        $newRow = Meal::create([
            'cook_id' => $request->user_id,
            'name', 'region', 'description',  'price', 'ingredients', 'cooking_limit', 'status'
        ]);
          
        // Return the ID of the newly created row
        return response()->json(['id' => $newRow->id]);
    }
    public function region(Request $request, $id )
    {
      $meal =  Meal::find($id); 
        $meal->region = $request->region; 
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function limit(Request $request, $id )
    {
        $meal =  Meal::find($id);
        $meal->cooking_limit = $request->limit; 
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    
}
