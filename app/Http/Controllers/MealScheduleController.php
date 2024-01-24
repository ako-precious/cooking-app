<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealScheduleResource;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\MealSchedule;

class MealScheduleController extends Controller
{
    public function index()
    {
        // dd(Players::all());
        dd((MealScheduleResource::collection(MealSchedule::with('meal')->with('user')->get()) ));
        
        return inertia('Meal-Schedule/Index', ['InitialEvent' => MealScheduleResource::collection(MealSchedule::with('meal')->with('user')->get())]);

    }
}
