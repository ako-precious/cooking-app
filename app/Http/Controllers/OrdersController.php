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
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code.
            $menu = Orders::where('cook_id', $user_id)->with('mealPhotos')->get();
            // foreach ($menu as $meal) {
            //     # code...
            //     $mealPhoto = MealPhotos::where('meal_id', $meal->id)->orderBy('order', 'asc')->first();                
            // }
            // dd($mealPhoto);
            return inertia('Cook/Menu/Index', ['menu' => $menu]);
        } else {
            # code...
            return redirect()->route('welcome');
        }
    }
}
