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
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\MealScheduleResource;
use App\Models\MealPhotos;
use App\Models\Notification;
use Stripe\Climate\Order;
class OrdersController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            $orders = []; // Initialize an empty array to store all orders
            $menu = Meal::where('cook_id', $user_id)->get();
            foreach ($menu as $meal) {
                // Fetch orders for each meal and add them to the $orders array 
                $mealSchedules = MealSchedule::where('meal_id', $meal->id)->with('order', 'meal', 'user')->get();
                $pendingOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'pending')->with('order', 'meal', 'user')->get();
                $rejectOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'reject')->with('order', 'meal', 'user')->get();
                $acceptOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'accept')->with('order', 'meal', 'user')->get();
                $processedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'processed')->with('order', 'meal', 'user')->get();
                $readyOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'ready')->with('order', 'meal', 'user')->get();
                $deliveredOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'delivered')->with('order', 'meal', 'user')->get();
                $confirmedOrders = MealSchedule::where('meal_id', $meal->id)->where('status', 'confirmed')->with('order', 'meal', 'user')->get();
                if ($mealSchedules->isNotEmpty()) {
                    // Append the meal schedules to the $orders array
                    $orders[] = $mealSchedules;
                    $pending[] = $pendingOrders;
                    $reject[] = $rejectOrders;
                    $accept[] = $acceptOrders;
                    $processed[] = $processedOrders;
                    $ready[] = $readyOrders;
                    $delivered[] = $deliveredOrders;
                    $confirmed[] = $confirmedOrders;
                }
            }
            // dd($accept);
            return inertia('Cook/Order/Index', ['meal_orders' => $orders, 'pending' => $pending, 'reject' => $reject, 'accept' => $accept , 'processed' => $processed , 'ready' => $ready, 'delivered' => $delivered, 'confirmed' =>$confirmed]);
        }
         else {
            # code...
            return redirect()->route('welcome');
        }
    }
    public function order()
    {
        $user_id = Auth::id();
        
                $orders = MealSchedule::where('user_id', $user_id)->with('order', 'meal', 'user')->get(); 
                $pending = MealSchedule::where('user_id', $user_id)->where('status', 'pending')->with('order', 'meal', 'user')->get(); 
                $reject = MealSchedule::where('user_id', $user_id)->where('status', 'reject')->with('order', 'meal', 'user')->get(); 
                $accept = MealSchedule::where('user_id', $user_id)->where('status', 'accept')->with('order', 'meal', 'user')->get();
                $processed = MealSchedule::where('user_id', $user_id)->where('status', 'processed')->with('order', 'meal', 'user')->get();
                $ready = MealSchedule::where('user_id', $user_id)->where('status', 'ready')->with('order', 'meal', 'user')->get();
                $delivered = MealSchedule::where('user_id', $user_id)->where('status', 'delivered')->with('order', 'meal', 'user')->get();
                $confirmed = MealSchedule::where('user_id', $user_id)->where('status', 'confirmed')->with('order', 'meal', 'user')->get();
        return inertia('Order/Index', ['meal_orders' => $orders, 'pending' => $pending, 'reject' => $reject, 'accept' => $accept , 'processed' => $processed , 'ready' => $ready, 'delivered' => $delivered, 'confirmed' =>$confirmed]);
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
