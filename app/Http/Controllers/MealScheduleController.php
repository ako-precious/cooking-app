<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealScheduleResource;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\MealSchedule;

class MealScheduleController extends Controller
{
    public function schedule()
    {
        return inertia('Meal-Schedule/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'InitialEvent' => MealSchedule::with('meal','user')->get()->toArray()]);

    }
    public function index()
    {
        // dd(Players::all());
        dd((MealScheduleResource::collection(MealSchedule::with('meal')->with('user')->get()) ));
        
        return MealScheduleResource::collection(MealSchedule::with('meal')->with('user')->get()) ;

    }
}
