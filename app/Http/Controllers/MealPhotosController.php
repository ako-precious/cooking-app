<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\MealPhotos;
use Illuminate\Support\Facades\Storage;

class MealPhotosController extends Controller
{
   
    

    // public function index()
    // {
    //     $mealPhoto = MealPhotos::where('meal_id', $meal->id)->orderBy('order', 'asc')->get();   
    // }
    

    
    public function show($id){
       
          $firstPhoto = MealPhotos::where('meal_id', $id)->orderBy('order', 'asc')->first();   
          $otherPhotos = MealPhotos::where('meal_id', $id)->orderBy('order', 'asc')->get();
          return response()->json(['firstPhoto' => $firstPhoto, 'otherPhotos' =>$otherPhotos]);
      }

    public function store(Request $request)
    {
        $meal_id = $request->input('meal_id');
        foreach ($request->file('images') as $index => $image) {
            $path = $image->store('public/images');

            $meal = MealPhotos::create([
                'meal_id' => $meal_id,
                'meal_photo_path' => $path,
                'order' => $request->input('indexes')[$index], // Set the order column
            ]);
        }
        return response()->json(['image' => $meal]);
    }

    

    public function update(Request $request, $id)
    {

        $mealPhotos = $request->input('mealPhotos');
        foreach ($mealPhotos as $mealPhoto) {
            $photo = MealPhotos::findOrFail($mealPhoto['id']);
            $photo->update(['order' => $mealPhoto['index']]);
        }
        return response()->json(['message' => $mealPhotos]);
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
