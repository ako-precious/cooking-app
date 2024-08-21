<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Cook;
use App\Models\Meal;
use App\Models\Account;
use App\Models\MealPhotos;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class CookController extends Controller
{
    public function index()
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code.
            $menu = Meal::where('cook_id', $user_id)->with('mealPhotos')->get();
            $account = Account::firstWhere('user_id', $user_id);
            
            return inertia('Cook/Menu/Index', ['menu' => $menu, 'account' => $account, 'cook' => $cook ]);
        } else {
            # code...
            return redirect()->route('cook.setup');
        }
    }

    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
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
    
    public function update(Request $request, $id)
    {
        $mealSchedule = Cook::find($id);
        $mealSchedule->question1 =  $request->question1;
        $mealSchedule->question2 =  $request->question2;
        $mealSchedule->question3 =  $request->question3;
        $mealSchedule->save();

        // Prepare notification message
        $message = "Your answers have been saved";
        return response()->json(['data' => $message]);
    }
    public function availability(Request $request, $id)
    {
        $mealSchedule = Cook::find($id);
        $mealSchedule->availability =   json_encode($request->selectedDays);
        $mealSchedule->save();

        // Prepare notification message
        $message = "Your availability has been saved ";
        return response()->json(['data' => $message]);
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
            return redirect()->route('cook.setup',);
        }
    }

    public function checkCook()
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        $notifications = Notification::where('user_id', $user_id)->where('status', 'unread')->orderBy('created_at', 'desc')->get();

        if ($cook !== null) {
            $checkUser =  Cook::firstWhere('user_id', $user_id)->exists();
            return response()->json(['checkUser' => $checkUser, 'notifications' => $notifications]);
        }
    }
    public function about_your_meal($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/AboutYourMeal', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function overview($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);

            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/Overview', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function region($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/MealArea', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
  
    public function cook_limit($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/CookingLimit', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function spotlight($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/StealShow', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function ingredients($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/Ingredients', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function photos($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
             $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                $mealPhotos = MealPhotos::where('meal_id', $newMealId)->orderBy('order', 'asc')->get();
                return inertia('Cook/BecomeCook/Photos', ['Meal' => $Meal, 'mealPhotos' => $mealPhotos]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup');
        }
    }
    public function title($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/Title', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function finish_up($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/LetItOut', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function ordering_preference($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/OrderingPreference', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }

    public function price($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::find($newMealId);
            if ($user_id == $Meal->cook_id) {
                return inertia('Cook/BecomeCook/PriceSetting', ['Meal' => $Meal]);
            } else {
                return redirect()->route('menu.index');
            }
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
    public function final_overview($newMealId)
    {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            $Meal = Meal::with('user')->find($newMealId);
            if ($user_id == $Meal->cook_id) {
                if ($Meal->name == Null || $Meal->region == Null || $Meal->description == Null || $Meal->price == Null || $Meal->ingredients == Null || $Meal->cooking_limit == Null || $Meal->status == Null || $Meal->ordering_preferences == Null) {
                    return redirect()->route('become-a-cook');
                }
    
                $mealData = MealResource::make($Meal);
                // dd($mealData);
                return inertia('Cook/BecomeCook/MealOverview', ['meal' => $mealData]);
            } else {
                return redirect()->route('menu.index');
            }
            // return inertia('Cook/BecomeCook/MealOverview', response()->json(['meal' => MealResource::make($Meal)]));
        } else {
            # code...
            return redirect()->route('cook.setup',);
        }
    }
}
