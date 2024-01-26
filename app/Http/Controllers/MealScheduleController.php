<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealScheduleResource;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use App\Models\MealSchedule;
use App\Models\Meal;

class MealScheduleController extends Controller
{
    public function schedule()
    {
        return inertia('Meal-Schedule/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'InitialEvent' => MealSchedule::with('meal', 'user')->get()->toArray()
        ]);
    }
    public function index()
    {
        //     dd((MealScheduleResource::collection(MealSchedule::with('meal')->with('user')->get()) ));

        $mealSchedules = MealSchedule::with('meal','user')->get();
        return response()->json(MealScheduleResource::collection($mealSchedules));
    }
    
    public function getSuggestions()
    {
        $query = request('query');
        $suggestions = Meal::where('name', 'like', '%' . $query . '%')->with('user')->take(6)->get();
        return response()->json($suggestions);
    }

    public function store(Request $request)
    {
        $new_MealSchedule = MealSchedule::create($request->all());
        return response()->json([
            'data' => new MealScheduleResource($new_MealSchedule),
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function update(Request $request, MealSchedule $MealSchedule)
    {
        $MealSchedule->update($request->all());
        return response()->json([
            'data' => new MealScheduleResource($MealSchedule),
            'message' => 'Successfully updated event!',
            'status' => Response::HTTP_ACCEPTED
        ]);
    }

    public function destroy(MealSchedule $MealSchedule)
    {
        $MealSchedule->delete();
        return response('Event removed successfully!', Response::HTTP_NO_CONTENT);
    }
}
