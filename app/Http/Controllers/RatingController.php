<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $rating = Rating::create($request->all());
        // dd($rating);

      
        return response()->json([
            'data' => $rating,
            'message' => 'Successfully added a new Meal Schedule!',
           
        ]);
    }
}
