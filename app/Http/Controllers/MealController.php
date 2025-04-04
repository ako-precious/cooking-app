<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;
use App\Models\Cook;

class MealController extends Controller
{


    public function store(Request $request)
    {
        // Create a new row in your table
        $newRow = Meal::create([
            'cook_id' => $request->user_id,
            'name', 'region', 'description',  'price', 'ingredients', 'cooking_limit', 'status'
        ]);

        // Return the ID of the newly created row
        return response()->json(['id' => $newRow->id]);
    }
    public function region(Request $request, $id)
    {
        $user_id = Auth::id();
        $meal =  Meal::find($id);
        if ($user_id == $meal->cook_id) {
            # code...
            $meal->region = $request->region;
            $meal->save();
            return response()->json(['meal' => $meal]);
        }
    }
    public function serve(Request $request, $id)
    {
        $user_id = Auth::id();
        $meal =  Meal::find($id);
        if ($user_id == $meal->cook_id) {
            # code...
            $meal->serving_style = $request->serve;
            $meal->save();
            return response()->json(['meal' => $meal]);
        }
    }

    public function limit(Request $request, $id)
    {
        $meal =  Meal::find($id);
        $meal->cooking_limit = $request->limit;
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function ingredients(Request $request, $id)
    {
        $meal =  Meal::find($id);
        $meal->ingredients = $request->ingredients;
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function preference(Request $request, $id)
    {
        $meal =  Meal::find($id);
        $meal->ordering_preferences = $request->preference;
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function price(Request $request, $id)
    {
        $meal =  Meal::find($id);
        $meal->price = $request->price;
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function status(Request $request, $id)
    {
        $meal =  Meal::find($id);
        $meal->status = $request->status;
        $meal->save();
        return response()->json(['meal' => $meal]);
    }
    public function title(Request $request, $id)
    {
        // dd($request);
        $meal =  Meal::find($id);
        $meal->name = $request->name;
        $meal->description = $request->description;
        $meal->save();
        return response()->json(['meal' => $meal, 'request' => $request->all()]);
    }
    public function show($id)
    {
        $Meal = Meal::with('user')->find($id);
        return response()->json(['meal' => $Meal]);
    }
    public function meals($id)
    {
        $Meal = Meal::with('user', 'mealPhotos')->find($id);
        $ratings = Rating::where('meal_id', $id)->get();
      
       
         $cid = $Meal->user->id;
        // Get the reviews associated with the cook's meals
        $reviews = Rating::whereHas('meal', function ($query) use ($cid) {
            $query->where('cook_id', $cid);
        })->latest()->get();

        // Calculate the average rating
        $ratings = $reviews->count() > 0 ? $reviews->pluck('total')->sum() / $reviews->count() : 0;

        // Render the profile with the gathered data
        // return Inertia::render('Profile/Index', [
        //     'user' => $user,
        //     'cook' => $cook,
        //     'meals' => $meals,
          
        // ]);
        return inertia('Meal/Show', ['meal' => $Meal,  'reviews' => $reviews,
            'ratings' => $ratings
        ]);
    }
    public function destroy($id)
    {
        $Meal = Meal::find($id);
        $Meal->delete();

        $user_id =   Auth::id();
        $pending = Meal::where('status', 'pending')->where('cook_id', $user_id)->get();
        return response()->json(['message' => 'Meal removed successfully!', 'pending' => $pending]);
    }
}
