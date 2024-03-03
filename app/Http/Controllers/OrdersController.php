<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\Cook;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\MealSchedule;
use App\Events\MealStatusUpdated;
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
                if ($mealSchedules->isNotEmpty()) {
                    // Append the meal schedules to the $orders array
                    $orders[] = $mealSchedules;
                }
            }
        
            // dd($orders);
            // You can uncomment this line for debugging
            return inertia('Cook/Order/Index', ['orders' => $orders]);
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
        return inertia('Order/Index', ['orders' => $orders]);
    }

    public function update(Request $request, $id){

        $mealSchedule = MealSchedule::find($id); 
        $mealSchedule->status =  $request->status;
        $mealSchedule->save();
        // Hi [Customer Name], your order # [order number] placed on December 19th, 2023 has been delivered.
        $cook = Meal::find($mealSchedule->meal_id);
        $message = "Your order #". $mealSchedule->id . " status has been updated to " . $mealSchedule->status;
        
        $notification = new Notification();
        if ($mealSchedule->status = 'confirmed') {
            # code...
            $notification->user_id = $cook->id;
        }else{

            $notification->user_id = $mealSchedule->user_id;
        }
        $notification->meal_schedule_id = $mealSchedule->id;
        $notification->message = $message;
        $notification->status = 'unread';
        $notification->save();

     (event(new MealStatusUpdated($message)));

        return response()->json(['order' => $mealSchedule]);
    }

}
