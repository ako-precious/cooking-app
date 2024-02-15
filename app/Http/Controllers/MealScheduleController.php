<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Meal;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\MealSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\MealScheduleResource;
use Stripe\Climate\Order;
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

    public function checkout()
    {
      $meal_order =   MealSchedule::with('meal', 'user')->find(1);
        //   dd($meal_order);
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $totalPrice = 0;
        $totalPrice += $meal_order->meal->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'cad',
                    'product_data' => [
                        'name' => $meal_order->meal->name,
                        'description' => $meal_order->meal->description
                        // 'images' => [$product->image]
                    ],
                    'unit_amount' => $meal_order->meal->price * 100,
                ],
                'quantity' => 1,
            ];
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        $order = new Orders();
        $order->meal_id = 1;
        $order->total_price = 1000.00;
        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect($checkout_session->url);
    }


    public function success()
    {
    }

    public function cancel()
    {
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
