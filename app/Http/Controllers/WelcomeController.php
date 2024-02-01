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
//   dd(Auth::check()) ;
    public function meals(){
      
        $mealSchedules = Meal::with('user')->latest()->get();
        return response()->json(MealResource::collection($mealSchedules));
    }

}
