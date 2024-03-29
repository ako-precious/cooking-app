<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
   
public function rating($mealId)
{ 
    // Retrieve ratings for the given mealId
    $ratings = Rating::where('meal_id', $mealId)->get();
  
    
    
    // Return ratings as JSON response
    return response()->json([
        'data' => $ratings,
       'taste' => $taste = $ratings->pluck('taste')->sum()/$ratings->pluck('taste')->count(),  
       'value' => $value = $ratings->pluck('value')->sum()/$ratings->pluck('value')->count(),  
       'total' => $total = $ratings->pluck('total')->sum()/$ratings->pluck('total')->count(),  
       'nutrition' => $nutrition = $ratings->pluck('nutrition')->sum()/$ratings->pluck('nutrition')->count(),  
       'freshness' => $freshness = $ratings->pluck('freshness')->sum()/$ratings->pluck('freshness')->count(),  
       'presentation' => $presentation = $ratings->pluck('presentation')->sum()/$ratings->pluck('presentation')->count(),  
       'portion_size' => $portion_size = $ratings->pluck('portion_size')->sum()/$ratings->pluck('portion_size')->count(),  
        // Add any additional data or messages as needed
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
