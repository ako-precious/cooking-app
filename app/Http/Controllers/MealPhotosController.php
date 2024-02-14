<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\MealPhotos;
use Illuminate\Support\Facades\Storage;

class MealPhotosController extends Controller
{



    public function store(Request $request)
    {


        $meal_id = $request->input('meal_id');
        foreach ($request->file('images') as $index => $image) {


            //     // If you want to store in public directory directly
            $path = $image->store('public/images'); // This will store in public/storage/images

            $meal = MealPhotos::create([
                'meal_id' => $meal_id,
                'meal_photo_path' => $path,
                'order' => (int)$index + 1, // Assuming order starts from 1
            ]);
            // Save the file path or identifier in an array

        }
        return response()->json(['image' => $meal]);
    }

    public function update(Request $request, $id)
    {
    
            $photo = MealPhotos::find($id);           
            
            $photo->update($request->all());
          
                return response()->json([
                    'data' =>   $photo,
                    'message' => 'Successfully updated Meal Schedule!',
                   
                ]);
           
        
    }

    public function destroy($id)
    {

        $MealSchedule = MealPhotos::find($id);
        $photoPath = $MealSchedule->meal_photo_path;

        if (Storage::exists($photoPath)) {
            // Delete the photo from storage
            Storage::delete($photoPath);

            $MealSchedule->delete();
            return response()->json([
                'message' => 'Meal removed successfully!'
            ]);
        }
    }
}
