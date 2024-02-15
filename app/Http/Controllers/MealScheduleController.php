<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Models\MealSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\MealScheduleResource;
use Symfony\Component\HttpFoundation\Response;

class MealScheduleController extends Controller
{
    public function schedule()
    {
        // dd(Auth::id()) ;
        return inertia('Meal-Schedule/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'InitialEvent' => MealSchedule::with('meal', 'user')->get()->toArray()
        ]);
    }

    public function checkout($id)
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRECT_KEY'));

         $lineItems[] = [[
              # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
              'price' => '10000',
              'quantity' => 1,
            ]];

         
        
        $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
          ]);
          return redirect($checkout_session->url);
    }
 
    public function success(){

    }

    public function cancel(){

    }
    public function index()
    {
        $userId = Auth::id();
        $mealSchedules = MealSchedule::where('user_id', $userId)->with('meal', 'user')->get();
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
            'message' => 'Successfully added a new Meal Schedule!',
            'status' => Response::HTTP_CREATED
        ]);
    }

    public function update(Request $request, $id)
    {
            $MealSchedule = mealSchedule::find($id);
            $request->validate([
                'meal_id' => 'required',
                'user_id' => 'required',
                'meal_time' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);
            $MealSchedule->update($request->all());
            if ($MealSchedule->update($request->all())) {

                return response()->json([
                    'data' => new MealScheduleResource($MealSchedule),
                    'message' => 'Successfully updated Meal Schedule!',
                    // 'status' => Response::HTTP_ACCEPTED
                    'status' => Response::HTTP_OK
                ]);
            } else {
                return response()->json([
                    // 'data' => new MealScheduleResource($MealSchedule),
                    'message' => 'Meal Schedule was not Updated!',
                    // 'status' => Response::HTTP_ACCEPTED
                    'status' => Response::HTTP_OK
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
