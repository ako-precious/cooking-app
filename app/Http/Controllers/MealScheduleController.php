<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MealSchedule;

class MealScheduleController extends Controller
{
    public function index()
    {
        // dd(Players::all());
        dd((MealSchedule::with('meal')->get() ));
        
        // return Inertia::render('Meal-Schedule/Index', ['InitialEvent' => MealSchedule::all()]);
        return inertia('Meal-Schedule/Index', ['InitialEvent' => MealSchedule::with('meal')->get()]);

    }
}
