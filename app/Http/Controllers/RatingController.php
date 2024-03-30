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

        if (Rating::firstWhere('meal_id', $mealId)) {
            $ratings = Rating::where('meal_id', $mealId)->get();


            // Get all the values in the specified column (let's assume the column is 'value')
            $values = $ratings->pluck('total');

            // Count the occurrences of each value
            $counts = $values->countBy();

            // Initialize an array to store percentages
            $percentages = [];

            // Calculate the percentage for each value
            foreach ([5, 4, 3, 2, 1] as $value) {
                $count = $counts[$value] ?? 0;
                $percentage = ($count / $values->count()) * 100;
                $percentages[$value] = $percentage;
            }

            // Return ratings as JSON response
            return response()->json([
                'percentages' => $percentages,
                'review' => $ratings->count(),
                'taste' => $ratings->pluck('taste')->sum() / $ratings->pluck('taste')->count(),
                'value' => $ratings->pluck('value')->sum() / $ratings->pluck('value')->count(),
                'total' => $ratings->pluck('total')->sum() / $ratings->pluck('total')->count(),
                'nutrition' => $ratings->pluck('nutrition')->sum() / $ratings->pluck('nutrition')->count(),
                'freshness' => $ratings->pluck('freshness')->sum() / $ratings->pluck('freshness')->count(),
                'presentation' => $ratings->pluck('presentation')->sum() / $ratings->pluck('presentation')->count(),
                'portion_size' => $ratings->pluck('portion_size')->sum() / $ratings->pluck('portion_size')->count(),
                // Add any additional data or messages as needed
            ]);
        }
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
    public function show($meal_id)
    {
        $user_id =   Auth::id();
        $rating = Rating::firstWhere([
            'meal_id' => $meal_id,
            'user_id' => $user_id
        ]);
        return response()->json(['rating' => $rating]);
    }
}
