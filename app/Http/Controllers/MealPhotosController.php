<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\MealPhotos;
class MealPhotosController extends Controller
{
    public function store(Request $request)
{
    // Validate request data...

        $imageOrder = $request->all();
        $meal_id = $request->meal_id;
        foreach ($imageOrder as $index => $image) {
            // Store the image order along with the meal ID
            MealPhotos::create([
                'meal_id' => $meal_id,
                'meal_photo_path' => $image,
                'order' => (int)$index + 1, // Assuming order starts from 1
            ]);
        
    }

    // Return success response...
}
}
