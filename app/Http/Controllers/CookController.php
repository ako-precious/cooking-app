<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cook;
use App\Models\Meal;
use App\Models\MealPhotos;
use Illuminate\Support\Facades\Auth;

class CookController extends Controller
{
    public function index(){
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code.
            $menu = Meal::where('cook_id', $user_id)->with('mealPhotos')->get();
            // foreach ($menu as $meal) {
            //     # code...
            //     $mealPhoto = MealPhotos::where('meal_id', $meal->id)->orderBy('order', 'asc')->first();                
            // }
            // dd($mealPhoto);
            return inertia('Cook/Menu/Index', ['menu' => $menu]);
        } else {
            # code...
            return redirect()->route('welcome');
        }
    }

    public function setup()
    {
        // dd(Auth::id()) ;
        return inertia('Cook/setup',);
    }
    public function pending_meal()
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $pending = Meal::where('status', 'pending')->where('cook_id', $user_id)->get();
            return inertia('Cook/BecomeCook/index', ['pending' => $pending]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $user =  Cook::firstWhere('user_id', $user_id)->exists();
        if ($user) {
            // User exists
            $newCook = Cook::where('user_id', $user_id)->get();
        } else {
            // User does not exist
            $newCook = Cook::create($request->all());
        }
        // Create a new row in your table
        // Return the ID of the newly created row
        return response()->json(['data' => $newCook]);
    }

    public function checkCook()
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
        $checkUser =  Cook::firstWhere('user_id', $user_id)->exists();
        return response()->json(['checkUser' => $checkUser]);}
    }
    public function about_your_meal($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/AboutYourMeal', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function overview($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/Overview', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function region($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/MealArea', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function cook_limit($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/CookingLimit', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function spotlight($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/StealShow', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function ingredients($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/Ingredients', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function photos($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            $mealPhotos = MealPhotos::where('meal_id', $newMealId)->orderBy('order', 'asc')->get();
            return inertia('Cook/BecomeCook/Photos', ['Meal' => $Meal, 'mealPhotos' => $mealPhotos]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function title($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/Title', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function finish_up($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/LetItOut', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function ordering_preference($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/OrderingPreference', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }

    public function price($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            return inertia('Cook/BecomeCook/PriceSetting', ['Meal' => $Meal]);
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
    public function final_overview($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::with('user')->find($newMealId);
            $mealData = MealResource::make($Meal);
            // dd($mealData);
            return inertia('Cook/BecomeCook/MealOverview', ['meal' => $mealData]);
            // return inertia('Cook/BecomeCook/MealOverview', response()->json(['meal' => MealResource::make($Meal)]));
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    }
}
