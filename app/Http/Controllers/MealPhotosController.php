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
    public function show_photo(Request $request){
        $meal_id = $request->input('meal_id');
          $mealPhoto = MealPhotos::where('meal_id', $meal_id)->orderBy('order', 'asc')->first();   
          return response()->json(['imagePhoto' => $mealPhoto]);
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

    public function reorder(Request $request)
    {
        $mealPhotos = $request->input('mealPhotos');
        foreach ($mealPhotos as $mealPhoto) {
            $photo = MealPhotos::findOrFail($mealPhoto['id']);
            $photo->update(['order' => $mealPhoto['index']]);
        }
        return response()->json(['message' => $mealPhotos]);
        // return response()->json(['message' => 'Meal photos reordered successfully']);
    }

    // public function update(Request $request, $id)
    // {

    //     $photo = MealPhotos::find($id);

    //     $photo->update($request->all());

    //     return response()->json([
    //         'data' =>   $photo,
    //         'message' => 'Successfully updated Meal Schedule!',

    //     ]);
    // }

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
