<?php

namespace App\Http\Controllers;

use App\Http\Resources\MealScheduleResource;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Exception;
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

        $mealSchedules = MealSchedule::with('meal', 'user')->get();
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
            'data12' => $new_MealSchedule,
            'data' => new MealScheduleResource($new_MealSchedule),
            'message' => 'Successfully added new event!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function update(Request $request, $id)
    {
        try {

            $MealSchedule = mealSchedule::find($id);

            $request->validate([
                'meal_id' => 'required',
                'user_id' => 'required',
                'meal_time' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $MealSchedule->update($request->all());
            return response()->json([
                'data' => new MealScheduleResource($MealSchedule),
                'message' => 'Successfully updated Meal Schedule!',
                // 'status' => Response::HTTP_ACCEPTED
                'status' => Response::HTTP_OK
            ]);
        } catch (\Exception $e) {

            // Return a response indicating a server error
            return response()->json([
                'data' => $e,
                'message' => 'Error updating Meal Schedule. Please try again later.',
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $MealSchedule = mealSchedule::find($id);
            $MealSchedule->delete();
            return response()->json([
                'message' => 'Meal removed successfully!',
                'status' => Response::HTTP_NO_CONTENT
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e,
                'status' => Response::HTTP_NO_CONTENT
            ]);
        }
    }
}
