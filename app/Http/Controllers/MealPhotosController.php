<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\MealPhotos;

class MealPhotosController extends Controller
{


    
    public function store(Request $request)
    {
        

        $meal_id = $request->input('meal_id');
        foreach ($request->file('images') as $index => $image) {
        //     // Store the image in the storage or public directory
            $path = $image->store('images'); // This will store in storage/app/images

        //     // If you want to store in public directory directly
            // $path = $image->store('public/images'); // This will store in public/storage/images
            
           $meal = MealPhotos::create([
                'meal_id' => $meal_id,
                'meal_photo_path' => $path,
                'order' => (int)$index + 1, // Assuming order starts from 1
            ]);
            // Save the file path or identifier in an array
            
        }
        return response()->json(['image' => $meal]);
        
    }
}
