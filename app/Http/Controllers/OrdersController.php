<?php

namespace App\Http\Controllers;
use App\Models\Meal;
use App\Models\Cook;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\MealSchedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Resources\MealScheduleResource;
use App\Models\MealPhotos;
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
                $orders[$meal->id] = MealSchedule::where('meal_id', $meal->id)->get();
            }
            dd($orders);
             // You can uncomment this line for debugging
            return inertia('Cook/Order/Index', ['orders' => $orders]);
        }
         else {
            # code...
            return redirect()->route('welcome');
        }
    }
}
