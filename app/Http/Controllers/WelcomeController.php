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
use App\Models\Meal;
use Illuminate\Support\Facades\Http;
class WelcomeController extends Controller
{
    public function index() {
        
       
          return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function meals()
    {
        $mealSchedules = Meal::with('user')->where('status', 'available')->latest()->paginate(12);
        
        return response()->json(MealResource::collection($mealSchedules));
    }
    public function filtered_meals(){

        $searchText = request('query');
        $query = Meal::where('status', 'available')->query();
        if ($searchText) {
            $query->where('name', 'like', "%$searchText%")
                  ->orWhere('description', 'like', "%$searchText%");
        }
      
        $mealSchedules =  $query->with('user')->latest()->paginate(12);
        return response()->json(MealResource::collection($mealSchedules));
    }
     
    public function users($id){
        $user = User::find($id)->cook;
        // dd($user);
        return Inertia::render('Profile/Index',['users' => $user] );
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
