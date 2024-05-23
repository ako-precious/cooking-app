<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Cook;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Events\MealStatusUpdated;
use App\Models\MealSchedule;
use App\Notifications\MealScheduleStatusUpdated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\Notification;
use Stripe\Climate\Order;
use Stripe\Transfer;

use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            $orders = []; // Initialize an empty array to store all orders
            $pending = [];
            $rejected = [];
            $accepted = [];
            $processed = [];
            $ready = [];
            $transit = [];
            $delivered = [];
            $confirmed = [];
            $menu = Meal::where('cook_id', $user_id)->get();
            foreach ($menu as $meal) {
                // Fetch orders for each meal and add them to the $orders array 
                $mealSchedules = MealSchedule::where('meal_id', $meal->id)->with('order', 'meal', 'user')->orderBy('created_at', 'desc')->get();
                $pendingOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'pending')->with('order', 'meal', 'user')->get();
                $rejectedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'rejected')->with('order', 'meal', 'user')->get();
                $acceptedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'accepted')->with('order', 'meal', 'user')->get();
                $processedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'processed')->with('order', 'meal', 'user')->get();
                $readyOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'ready')->with('order', 'meal', 'user')->get();
                $transitOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'in transit')->with('order', 'meal', 'user')->get();
                $deliveredOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'delivered')->with('order', 'meal', 'user')->get();
                $confirmedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'confirmed')->with('order', 'meal', 'user')->get();
                if ($mealSchedules->isNotEmpty()) {
                    // Append the meal schedules to the $orders array
                    $orders[] = $mealSchedules;
                    $pending[] = $pendingOrders;
                    $rejected[] = $rejectedOrders;
                    $accepted[] = $acceptedOrders;
                    $processed[] = $processedOrders;
                    $ready[] = $readyOrders;
                    $transit[] = $transitOrders;
                    $delivered[] = $deliveredOrders;
                    $confirmed[] = $confirmedOrders;
                }
            }
            // dd($accepted);
            return inertia('Cook/Order/Index', ['meal_orders' => $orders, 'pending' => $pending, 'rejected' => $rejected, 'accepted' => $accepted, 'processed' => $processed, 'ready' => $ready, 'transit' => $transit, 'delivered' => $delivered, 'confirmed' => $confirmed]);
        } else {
            # code...
            return redirect()->route('welcome');
        }
    }

    public function order(Request $request)

    {
        $user_id = Auth::id();
        $filters = $request->only([
            'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        ]);


        $query = MealSchedule::where('user_id', $user_id)
            ->with('order', 'meal', 'user')
            // ->join('meals', 'meal_schedules.meal_id', '=', 'meals.id')
            ->select('meal_schedules.*')
            ->leftJoin('meals', 'meal_schedules.meal_id', '=', 'meals.id')

            ->when($filters['name'] ?? false, function ($query) use ($filters) {
                $query->where('meals.name', 'like', '%' . $filters['name'] . '%'); // Search in meals table
            })
            ->when($filters['status'] ?? false, function ($query) use ($filters) {
                $query->where('meal_schedules.status', $filters['status']);
            })
            ->when($filters['meal_time'] ?? false, function ($query) use ($filters) {
                $query->where('meal_schedules.meal_time', $filters['meal_time']);
            })
            ->when($filters['delivery_date_from'] ?? false, function ($query) use ($filters) {
                $query->where('meal_schedules.start_date', '>=', $filters['delivery_date_from']);
            })
            ->when($filters['delivery_date_to'] ?? false, function ($query) use ($filters) {
                $query->where('meal_schedules.end_date', '<=', $filters['delivery_date_to']);
            })
            ->paginate(15)
            ->withQueryString();

        // if (array_key_exists('name', $request->only([
        //     'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        // ])) ||
        //     array_key_exists('status', $request->only([
        //     'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        // ])) ||
        //     array_key_exists('meal_time', $request->only([
        //     'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        // ])) ||
        //     array_key_exists('delivery_date_from', $request->only([
        //     'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        // ])) ||
        //     array_key_exists('delivery_date_to', $request->only([
        //     'name', 'status', 'meal_time', 'delivery_date_from', 'delivery_date_to'
        // ]))) {
        //     response()->json([
        //         'filters' => $filters,
        //         'meal_orders' => $query
        //     ]);
        //     // All keys exist in the request data
        // }



        // if ($request->ajax()) {
        //     // dd($query);
        //   return   response()->json(['meal_order' => $query]);
        // }
        return inertia('Order/Index', [
            'filters' => $filters,
            'meal_orders' => $query

        ]);
    }


    public function sort(Request $request)
    {
        // dd($request->all);

        $query = MealSchedule::where('user_id',  $request->query('user') )
            ->with('order', 'meal', 'user')
            // ->join('meals', 'meal_schedules.meal_id', '=', 'meals.id')
            ->select('meal_schedules.*')
            ->leftJoin('meals', 'meal_schedules.meal_id', '=', 'meals.id')
            ->orderBy( $request->query('column'),  $request->query('sort'))
            
            ->paginate(15)
            ->withQueryString();
            return   response()->json(['meal_orders' => $query]);
    }

    public function calendar()
    {
        $user_id = Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            $orders = []; // Initialize an empty array to store all orders
            $menu = Meal::where('cook_id', $user_id)->get();
            foreach ($menu as $meal) {
                // Fetch orders for each meal and add them to the $orders array 
                $mealSchedules = MealSchedule::where('meal_id', $meal->id)->with('order', 'meal', 'user')->get();
                if ($mealSchedules->isNotEmpty()) {
                    // Append the meal schedules to the $orders array
                    $orders[] = $mealSchedules;
                }
            }
            // dd($orders);
            // dd($accepted);
            return inertia('Cook/Order/Calendar', ['orders' => $orders]);
        } else {
            # code...
            return redirect()->route('welcome');
        }
        // return inertia('Cook/Menu/Calendar', [

        //     => MealSchedule::where('user_id',$cook)->with('meal', 'user')->get()
        // ]);
    }
    // public function update(Request $request, $id){

    //     $mealSchedule = MealSchedule::find($id); 
    //     $mealSchedule->status =  $request->status;
    //     $mealSchedule->save();
    //     // Hi [Customer Name], your order # [order number] placed on December 19th, 2023 has been delivered.
    //     $cook = Meal::find($mealSchedule->meal_id);
    //     $message = "Your meal order #". $mealSchedule->id . " status has been updated to " . $mealSchedule->status;

    //     $notification = new Notification();
    //     if ($mealSchedule->status = 'confirmed') {
    //         # code...
    //         $notification->user_id = $cook->cook_id;
    //         $notification->message = "The meal order #". $mealSchedule->id . " delivery as been " . $mealSchedule->status;
    //     }else{

    //         $notification->user_id = $mealSchedule->user_id;
    //         $notification->message = $message;
    //     }
    //     $notification->meal_schedule_id = $mealSchedule->id;
    //     $notification->status = 'unread';
    //     $notification->save();

    //     $recipient = User::find($recipientId);
    //     if ($recipient) {
    //         $recipient->notify(new MealScheduleStatusUpdated($notificationMessage));
    //     }

    //     return response()->json(['order' => $mealSchedule]);
    // }

    public function update(Request $request, $id)
    {
        $mealSchedule = MealSchedule::find($id);
        $mealSchedule->status =  $request->status;
        $mealSchedule->save();

        // Prepare notification message
        $message = "Your meal order #" . $mealSchedule->id . " status has been updated to " . $mealSchedule->status;

        // Determine recipient and notification message based on status
        if ($mealSchedule->status === 'confirmed') {
            $recipientId = $mealSchedule->meal->cook_id; // Assuming cook_id is the user ID of the cook
            $notificationMessage = "The meal order #" . $mealSchedule->id . " delivery has been " . $mealSchedule->status;

            // See your keys here: https://dashboard.stripe.com/apikeys
            $connected_account = Account::where('user_id', $recipientId)->first();

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            $transfer = 'ORDER_' . mt_rand(100, 999999);
            $amount = intval(round((85 / 100) * $mealSchedule->meal->price * 100)); // Convert dollars to cents
            $stripe->transfers->create([
                'amount' => $amount,
                'currency' => 'cad',
                'destination' => $connected_account->stripe_account_id,
                'transfer_group' => $transfer,
            ]);
        } else {
            $recipientId = $mealSchedule->user_id;
            $notificationMessage = $message;
        }

        // Save notification
        $notification = new Notification();
        $notification->user_id = $recipientId;
        $notification->meal_schedule_id = $mealSchedule->id;
        $notification->message = $notificationMessage;
        $notification->status = 'unread';
        $notification->save();

        // Send email notification
        $recipient = User::find($recipientId);
        if ($recipient) {
            $recipient->notify(new MealScheduleStatusUpdated($notificationMessage));
        }

        return response()->json(['order' => $mealSchedule]);
    }
}
