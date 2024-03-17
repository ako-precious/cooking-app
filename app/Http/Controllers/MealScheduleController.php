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
use App\Models\Account;
use App\Models\MealPhotos;
use App\Models\Notification;
use App\Models\User;
use Stripe\Climate\Order;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\NotFoundHttpException;
use Illuminate\Support\Facades\Storage;
use Stripe\StripeClient;
use Stripe\PaymentIntent;
use Illuminate\Support\Str;
use Stripe\Stripe as StripeGateway;
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

    public function checkout(Request $request)
    {
        $id = $request->input('schedule_id');
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
                    // 'image' => $photo->meal_photo_path
                ],
                'unit_amount' => $meal_order->meal->price * 100,
            ],
            'quantity' => 1,
        ];
          
        $payment_intent = \Stripe\PaymentIntent::create([
            'amount' => $totalPrice * 100,
            'currency' => 'cad',
            'payment_method_types' => [
                'card'
            ],
            'setup_future_usage' => 'off_session',
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


            return response()->json(['customer'=>$customer]);
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
                    $mealSchedule = MealSchedule::find($order->meal_id);;
                    $mealSchedule->status = 'processed';
                    $mealSchedule->save();
                }

            case 'account.updated':
                $account = $event->data->object;
                $accountModel = Account::where('stripe_account_id', $account->id)->first();
                $accountModel->charges_enabled =$account->charges_enabled;
        $accountModel->transfer_enabled =$account->payouts_enabled;
        $accountModel->detailed_submitted =$account->details_submitted;
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
        if ($meal_status->ordering_preferences === 'automatic') {
            $new_MealSchedule->status = 'accept';
            $new_MealSchedule->save();
        }
        $cook = Meal::find($new_MealSchedule->meal_id);
        $user = User::find($new_MealSchedule->user_id);

        $notification = new Notification();
        $notification->user_id = $cook->id;
        $notification->meal_schedule_id = $new_MealSchedule->id;
        $notification->message = "You have a meal order #" . $new_MealSchedule->id . " from" . $user->name;
        $notification->status = 'unread';
        $notification->save();

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
