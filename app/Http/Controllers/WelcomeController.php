<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MealResource;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Cook;
use App\Models\User;
use App\Models\MealSchedule;
use App\Models\PushSubscription;
use App\Models\Meal;
use App\Models\Rating;
use Illuminate\Support\Facades\Http;

class WelcomeController extends Controller
{
    public function index()
    {
        $pushSub = PushSubscription::where('subscribable_id', Auth::id())->exists();

        // dd( typeOf($pushSub) );

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'pushSub' => $pushSub
        ]);
    }
    public function homePage()
    {
        $pushSub = PushSubscription::where('subscribable_id', Auth::id())->exists();

        // dd( typeOf($pushSub) );

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'pushSub' => $pushSub
        ]);
    }
    public function bulkMeal()
    {
        // $pushSub = PushSubscription::where('subscribable_id', Auth::id())->exists();

        // dd( typeOf($pushSub) );

        return Inertia::render('BulkMeal', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            // 'pushSub' => $pushSub
        ]);
    }
    public function return()
    {
        // $pushSub = PushSubscription::where('subscribable_id', Auth::id())->exists();

        // dd( typeOf($pushSub) );

        return Inertia::render('Resources/General/ReturnPolicy', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            // 'pushSub' => $pushSub
        ]);
    }
    public function specialOrder()
    {
        // $pushSub = PushSubscription::where('subscribable_id', Auth::id())->exists();

        // dd( typeOf($pushSub) );

        return Inertia::render('SpecialOrder', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            // 'pushSub' => $pushSub
        ]);
    }

    public function meals()
    {

        // dd(Auth::check());
        if (Auth::check()) {
            $userContinent = auth()->user()->continent;

            $meal = Meal::whereHas('cook', function ($query) {
                $query->where('status', 'available');
            })
                ->with('user')
                ->where('status', 'available')
                ->where('region', $userContinent); // Add continent filter
            // Check the route name and add the condition if the route is 'bulk-meal'
            if (Route::currentRouteName() === 'bulk-meal') {
                $meal->where('serving_style', 'bulk');
            }
            // if (Route::currentRouteName() === 'special-order') {
            //     $meal->where('serving_style', 'special');
            // }
            // Randomize order and paginate
            $meal = $meal->inRandomOrder()->paginate(12);
            return response()->json(MealResource::collection($meal));
        } else {
            $meal = Meal::whereHas('cook', function ($query) {
                $query->where('status', 'available');
            })
                ->with('user')
                ->where('status', 'available');
            if (Route::currentRouteName() === 'bulk-meal') {
                $meal->where('serving_style', 'bulk');
            }
            // if (Route::currentRouteName() === 'special-order') {
            //     $meal->where('serving_style', 'special');
            // }
            // Randomize order and paginate
            $meal = $meal->inRandomOrder()->paginate(12);

            return response()->json(MealResource::collection($meal));
        }
    }
    public function filtered_meals()
    {

        $searchText = request('query');
        $query = Meal::where('status', 'available');
        if ($searchText) {
            $query->where('name', 'like', "%$searchText%")
                ->orWhere('description', 'like', "%$searchText%");
        }

        $mealSchedules =  $query->with('user')->latest()->paginate(12);
        return response()->json(MealResource::collection($mealSchedules));
    }

    public function agree(Request $request, $id)
    {
        $mealSchedule = User::find($id);
        $mealSchedule->status =  $request->agreed;
        $mealSchedule->save();

        // Retrieve the updated record
        $updatedMealSchedule = User::find($id);

        // Prepare notification message
        $message = $updatedMealSchedule->status;
        return response()->json(['data' => $message]);
    }

    public function users($id)
    {
        // Find the user by ID, if not found return a 404 error
        $user = User::findOrFail($id);

        // Get the cook associated with the user
        $cook = Cook::where('user_id', $id)->first();

        // Get the meals associated with the cook and with status 'available'
        $meals = Meal::where('cook_id', $cook->id ?? 0)
            ->with('user')
            ->where('status', 'available')
            ->latest()
            ->get();

        // Get the reviews associated with the cook's meals
        $reviews = Rating::whereHas('meal', function ($query) use ($id) {
            $query->where('cook_id', $id);
        })->with('user')->latest()->get();

        // Calculate the average rating
        $ratings = $reviews->count() > 0 ? $reviews->pluck('total')->sum() / $reviews->count() : 0;

        // Render the profile with the gathered data
        return Inertia::render('Profile/Index', [
            'user' => $user,
            'cook' => $cook,
            'meals' => $meals,
            'reviews' => $reviews,
            'ratings' => $ratings,
            // 'comments' => Rating::where('meal_id', $meal)->with('user')->latest()->paginate(5),
        ]);
    }


    public function autocomplete(Request $request)
    {
        $input = $request->input('input');
        $apiKey = env('GOOGLE_API');

        $url = "https://maps.googleapis.com/maps/api/place/autocomplete/json?input=$input&key=$apiKey";

        $response = Http::get($url);

        return $response->json();
    }
}
