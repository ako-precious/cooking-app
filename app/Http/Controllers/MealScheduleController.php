<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Meal;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\MealSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\MealScheduleResource;
use App\Notifications\PushNotification;
use App\Models\Account;
use App\Models\MealPhotos;
use App\Models\Notification;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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

    public function checkMealStatus(Request $request)
    {
        $mealId = $request->input('meal_id');
        // Check the status of the meal
        $meal = MealSchedule::findOrFail($mealId);
        return response()->json(['status' => $meal->status]);
    }
    public function checkMealSt(Request $request)
    {
        $userId = auth()->id(); // Get the authenticated user's ID

        // Count the number of times the user's ID appears in the mealschedule table
        $userMealScheduleCount = MealSchedule::where('user_id', $userId)->count();

        // dd($userId, $userMealScheduleCount);
        
        return response()->json(['special_count' => $userMealScheduleCount]);
    }

    public function payment(Request $request)
    {

        return inertia('MealSchedule/Payment', []);
    }
    public function checkout(Request $request)
    {
        $id = $request->input('schedule_id');
        $meal_order =   MealSchedule::with('meal', 'user')->find($id);
        $photo = MealPhotos::where('meal_id', $meal_order->meal_id)->first();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $totalPrice = 0;

        $totalPrice += $request->input('amount');
        $lineItems[] = [
            'price_data' => [
                'currency' => 'cad',
                'product_data' => [
                    'name' => $meal_order->meal->name,
                    'description' => $meal_order->meal->description
                    // 'image' => $photo->meal_photo_path
                ],
                'unit_amount' => $totalPrice * 100,
            ],
            'quantity' => 1,
        ];


        $payment_intent = PaymentIntent::create([
            'amount' => $totalPrice * 100,
            'currency' => 'cad',
            'payment_method_types' => ['card'],
            'setup_future_usage' => 'off_session',
            'description' => 'Payment for meal order',
            'metadata' => [
                'schedule_id' => $id,
                'user_id' => $meal_order->user->id,
                // Add more metadata as needed
            ],
            // 'return_url' => route('checkout.return') ,
            // 'confirm' => true,
            // 'line_items' => $lineItems,
        ]);

        $order = new Orders();
        $order->meal_schedule_id = $id;
        $order->total_price = $meal_order->meal->price;
        $order->session_id = $payment_intent->id;
        $order->save();

        // return redirect($checkout_session->url);
        return [
            'token' => (string) Str::uuid(),
            'client_secret' => $payment_intent->client_secret
        ];
        // return json_encode(array('clientSecret' => $payment_intent->client_secret));
    }


    public function return(Request $request)
    {
        $clientSecret = $request->query('payment_intent');
        $order = Orders::where('session_id',  $clientSecret)->first();
        $mealSchedule = MealSchedule::with('user')->with('meal')->find($order->meal_schedule_id);
        // dd($mealSchedule);
        return inertia('MealSchedule/Status', ['mealSchedule' => $mealSchedule]);
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
                    $mealSchedule = MealSchedule::find($order->meal_id);
                    $mealSchedule->status = 'processed';
                    $mealSchedule->save();
                }

            case 'payment_intent.succeeded':

                $payment_intent = $event->data->object;
                $order = Orders::where('session_id', $payment_intent->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                    // $recipient = User::find($notification->user_id);
                    // if ($recipient) {
                    //     $recipient->notify(new MealScheduleStatusUpdated($notification->message));
                    // }
                    // Send email to customer
                }
                if ($order->status === 'paid') {
                    # code...
                    $mealSchedule = MealSchedule::find($order->meal_schedule_id);
                    $mealSchedule->status = 'processed';
                    $mealSchedule->save();
                }


            case 'account.updated':
                $account = $event->data->object;
                $accountModel = Account::where('stripe_account_id', $account->id)->first();
                $accountModel->charges_enabled = $account->charges_enabled;
                $accountModel->transfer_enabled = $account->payouts_enabled;
                $accountModel->detailed_submitted = $account->details_submitted;
                $accountModel->save();
                // ... handle other event types
                return response()->json([$account]);
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }
    public function index()
    {
        $userId = Auth::id();
        $mealSchedules = MealSchedule::where('user_id', $userId)->with('meal', 'user', 'order')->get();
        return response()->json(MealScheduleResource::collection($mealSchedules));
    }

    public function process_order($id)
    {
        $mealSchedule = MealSchedule::find($id);
        $meal = Meal::find($mealSchedule->meal_id);
        $firstPhoto = MealPhotos::where('meal_id', $meal->id)->orderBy('order', 'asc')->first();
        // dd( $mealSchedule);
        return inertia('MealSchedule/Checkout', ['mealSchedule' => $mealSchedule, 'meal' => $meal, 'firstPhoto' => $firstPhoto]);
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

        $meal_status = Meal::find($new_MealSchedule->meal_id);
        if ($meal_status->ordering_preferences === 'automatic') {
            $new_MealSchedule->status = 'accepted';
            $new_MealSchedule->save();
        }

        $cook = Meal::find($new_MealSchedule->meal_id)->user; // Assuming Meal has a relationship with User
        $user = User::find($new_MealSchedule->user_id);

        if (!$cook) {
            return response()->json(['error' => 'Cook not found'], 404);
        }

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Log the URL being sent
        // $url = env('APP_URL') . '/cook/order/' . $new_MealSchedule->id;
        // Log::info("Notification URL: " . $url);

        // $cook = User::find($cook->id);
        // $cook->notify(new PushNotification("You have a meal order #" . $new_MealSchedule->id . " from " . $user->name, $new_MealSchedule->id));

        // $notification = new Notification();
        // $notification->user_id = $cook->id;
        // $notification->meal_schedule_id = $new_MealSchedule->id;
        // $notification->message = "You have a meal order #" . $new_MealSchedule->id . " from " . $user->name;
        // $notification->status = 'unread';
        // $notification->save();


        // $user = User::find($user->id);
        // $user->notify(new PushNotification("Your meal schedule #" . $new_MealSchedule->id . " has been saved", $new_MealSchedule->id));

        // $notification = new Notification();
        // $notification->user_id = $user->id;
        // $notification->meal_schedule_id = $new_MealSchedule->id;
        // $notification->message = "Your meal schedule #" . $new_MealSchedule->id . " has been saved";
        // $notification->status = 'unread';
        // $notification->save();


        return response()->json([
            'data' => $new_MealSchedule,
            'message' => 'Successfully added to your new Meal Schedule!',
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


        return response()->json([
            'data' => new MealScheduleResource($MealSchedule),
            'message' => 'Successfully updated Meal Schedule!',
            // 'status' => Response::HTTP_ACCEPTED
            'status' => Response::HTTP_OK
        ]);
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


        // function calculate_delivery_fee($distance, $weight, $urgency) {
        //     $base_fee = 5; // Base delivery fee
        //     $cost_per_mile = 1.5; // Cost per mile
        //     $cost_per_kg = 0.5; // Cost per kilogram
        //     $urgent_fee = 3; // Additional fee for urgent deliveries
        
        //     // Distance-based fee
        //     $distance_fee = $distance * $cost_per_mile;
        
        //     // Weight-based fee
        //     $weight_fee = $weight * $cost_per_kg;
        
        //     // Urgency fee
        //     if ($urgency == "express") {
        //         $urgency_fee = $urgent_fee;
        //     } else {
        //         $urgency_fee = 0;
        //     }
        
        //     // Total fee calculation
        //     $total_fee = $base_fee + $distance_fee + $weight_fee + $urgency_fee;
        
        //     return $total_fee;
        // }
        
        // // Example usage
        // $distance = 10; // miles
        // $weight = 2; // kilograms
        // $urgency = "standard";
        // $delivery_fee = calculate_delivery_fee($distance, $weight, $urgency);
        // echo "Delivery Fee: " . $delivery_fee;
