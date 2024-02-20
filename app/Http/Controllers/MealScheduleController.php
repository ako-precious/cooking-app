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
use App\Models\MealPhotos;
use Stripe\Climate\Order;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\NotFoundHttpException;
use Illuminate\Support\Facades\Storage;

class MealScheduleController extends Controller
{
    public function schedule()
    {
        // dd(Auth::id()) ;
        return inertia('MealSchedule/Index', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'InitialEvent' => MealSchedule::with('meal', 'user')->get()->toArray()
        ]);
    }

    public function checkout(Request $request)
    {
         $id = $request->input('meal_id');
        $meal_order =   MealSchedule::with('meal', 'user')->find($id);
        $photo = MealPhotos::where('meal_id', $meal_order->meal_id)->first();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $totalPrice = 0;
        $totalPrice += $meal_order->meal->price;
        $lineItems[] = [
            'price_data' => [
                'currency' => 'cad',
                'product_data' => [
                    'name' => $meal_order->meal->name,
                    'description' => $meal_order->meal->description
                    // 'images' => [$photo->meal_photo_path]
                ],
                'unit_amount' => $meal_order->meal->price * 100,
            ],
            'quantity' => 1,
        ];
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'ui_mode' => 'embedded',
            'return_url' => route('checkout.return', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            // 'cancel_url' => route('checkout.cancel'),
        ]);

        $order = new Orders();
        $order->meal_schedule_id = $id;
        $order->total_price = $meal_order->meal->price;
        $order->session_id = $checkout_session->id;
        $order->save();

        // return redirect($checkout_session->url);
        return json_encode(array('clientSecret' => $checkout_session->client_secret));
    }


    public function return(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                // throw new NotFoundHttpException;
                return response('', 404);
            }
            // dd(\Stripe\Object::retrieve($session->customer_details));
            $customer = $session->customer_details;

            $order = Orders::where('session_id', $sessionId)->first();

            if (!$order) {
                // throw new NotFoundHttpException();
                return response('', 404);
            }
            if ($order->status === 'unpaid') {
                $order->status = 'paid';
                $order->save();
            }
            
            if ($order->status === 'paid') {
                // Fetch the meal schedule associated with the order
                $mealSchedule = MealSchedule::find($order->meal_schedule_id);
            
                if ($mealSchedule) {
                    // Update the status of the meal schedule to 'processed'
                    $mealSchedule->status = 'processed';
                    $mealSchedule->save();
                }
            }
          

            return response()->json([$customer ]);
        } catch (\Exception $e) {
            // throw new NotFoundHttpException();
            return response('', 404);
        }
    }

    public function webhook()
    {

        $stripe = new \Stripe\StripeClient('sk_test_...');

        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response($e, 400);
            // http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response($e, 400);
            // http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Orders::where('session_id', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // Send email to customer
                }
                if ($order->status === 'paid') {
                    # code...
                    $mealSchedule = MealSchedule::where('id', $order->meal_id);
                    $mealSchedule->status = 'processed';
                    $mealSchedule->save();
                }
    

                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
    public function index()
    {
        $userId = Auth::id();
        $mealSchedules = MealSchedule::where('user_id', $userId)->with('meal', 'user')->get();
        return response()->json(MealScheduleResource::collection($mealSchedules));
    }

    public function process_order($id)
    {
        $mealSchedule = MealSchedule::find($id);
        return inertia('MealSchedule/Checkout', ['mealSchedule' => $mealSchedule]);
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
        // dd($new_MealSchedule);

        $meal_status = Meal::find($new_MealSchedule->meal_id);
        if ($meal_status->status === 'pending') {
            $new_MealSchedule->status = 'accept';
            $new_MealSchedule->save();
        }

        return response()->json([
            'data' => $new_MealSchedule,
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
