<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cook;
use App\Models\Meal;

class CookController extends Controller
{
    public function setup()
    {
        // dd(Auth::id()) ;
        return inertia('Cook/setup',);
    }
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $user =  Cook::firstWhere('user_id', $user_id)->exists();
        if ($user) {
            // User exists
            $newCook = Cook::where('user_id', $user_id)->get();
        } else {
            // User does not exist
            $newCook = Cook::create($request->all());
        }
        // Create a new row in your table
        // Return the ID of the newly created row
        return response()->json(['data' => $newCook]);
    }

    public function about_your_meal($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/AboutYourMeal', ['Meal' => $Meal]);
    }
    public function overview($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/Overview', ['Meal' => $Meal]);
    }
    public function region($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/MealArea', ['Meal' => $Meal]);
    }
    public function cook_limit($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/CookingLimit', ['Meal' => $Meal]);
    }
    public function spotlight($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/StealShow', ['Meal' => $Meal]);
    }
    public function ingredients($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/Ingredients', ['Meal' => $Meal]);
    }
    public function photos($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/Photos', ['Meal' => $Meal]);
    }
    public function title($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/Title', ['Meal' => $Meal]);
    }
    public function finish_up($newMealId)
    {
        $Meal = Meal::find($newMealId);
        return inertia('Cook/BecomeCook/LetItOut', ['Meal' => $Meal]);
    }



}
