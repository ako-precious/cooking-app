<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index(Request $request)
    {
        $mealId = $request->input('meal_id');
        $rating = Rating::where('meal_id', $mealId)->get();
    //    dd($accounts);
    return response()->json([
        'data' => $rating,
        'message' => $rating->wasRecentlyCreated ? 'Successfully added a new rating!' : 'Rating updated successfully!',
    ]);
    }

    public function store(Request $request)
    {
        // Find the rating for the user and meal, or create a new instance
        $rating = Rating::firstOrNew([
            'user_id' => $request->user_id,
            'meal_id' => $request->meal_id,
        ]);

        // Update or set the attributes with the data from the request
        $rating->fill($request->all());

        // Save the rating to the database
        $rating->save();

        return response()->json([
            'data' => $rating,
            'message' => $rating->wasRecentlyCreated ? 'Successfully added a new rating!' : 'Rating updated successfully!',
        ]);
    }
    public function show($meal_id){
        $user_id =   Auth::id();
        $rating = Rating::firstWhere([
            'meal_id' => $meal_id,
            'user_id' => $user_id
        ]);
        return response()->json(['rating' => $rating]);
    }
}
