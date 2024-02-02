<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MealResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MealSchedule;
use App\Models\Meal;
class WelcomeController extends Controller
{
    public function index() {
     
          return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function meals()
    {
        $mealSchedules = Meal::with('user')->latest()->paginate(12);
        
        return response()->json(MealResource::collection($mealSchedules));
    }
//   dd(Auth::check()) ;
    public function filtered_meals(){

        $searchText = request('query');
        $query = Meal::query();
        if ($searchText) {
            $query->where('name', 'like', "%$searchText%")
                  ->orWhere('description', 'like', "%$searchText%");
        }
      
        $mealSchedules =  $query->with('user')->latest()->paginate(12);
        return response()->json(MealResource::collection($mealSchedules));
    }

}
