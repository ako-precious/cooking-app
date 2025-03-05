<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MealScheduleController;
use App\Http\Controllers\PushSubscriptionController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealPhotosController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\WishlistController;
use App\Models\Cook;
use App\Models\MealSchedule;
use App\Models\Resource;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\callback;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

// Route::get('/home', [WelcomeController::class, 'homePage'])->name('Home');

Route::get('/meals', [WelcomeController::class, 'meals']);

Route::get('/special-user', [MealScheduleController::class, 'checkMealSt']);
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/bulk-meals', [WelcomeController::class, 'bulkMeal'])->name('bulk-meal');
Route::get('/special-order', [WelcomeController::class, 'specialOrder'])->name('special-order');
Route::get('resources/return-policy', [WelcomeController::class, 'return'])->name('resources.return');
Route::get('/welcomed', function () {
    return Inertia::render('Welcomed', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('user-profile/{id}', [WelcomeController::class, 'users'])->name('user.show');

// routes/web.php

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

Route::get('/maps/place/autocomplete', [WelcomeController::class, 'autocomplete']);

Route::post('/subscribe', [PushSubscriptionController::class, 'subscribe']);
Route::post('/unsubscribe', [PushSubscriptionController::class, 'unsubscribe']);

// routes/api.php
Route::post('/save-subscription', [PushSubscriptionController::class, 'store']);


// Route::get('api/meals', [WelcomeController::class, 'meals']);
Route::resource('/meal_photos', MealPhotosController::class);
Route::resource('/resources', ResourceController::class);


Route::get('/checkUser', [CookController::class, "checkCook"]);
Route::get('api/filtered-meals', [WelcomeController::class, 'filtered_meals']);

// Place your routes that require session middleware here
Route::get('/auth/google/callback', [AccountController::class, 'callback']);
Route::get('/auth/google/return', [AccountController::class, 'return'])->name('auth.google');

Route::get('/auth/facebook/callback', [AccountController::class, 'fb_callback']);
Route::get('/auth/facebook/return', [AccountController::class, 'fb_return'])->name('auth.facebook');

Route::get('/auth/microsoft/callback', [AccountController::class, 'azure_callback']);
Route::get('/auth/microsoft/return', [AccountController::class, 'azure_return'])->name('auth.microsoft');
Route::get('meals/{id}', [MealController::class, 'meals']);
Route::get('/cook/setup', [CookController::class, 'setup'])->name('cook-setup');

Route::post('/webhook', [MealScheduleController::class, 'webhook'])->name('checkout.webhook');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    Route::get('/become-a-cook/overview', function () {
        $user_id =   Auth::id();
        $cook = Cook::firstWhere('user_id', $user_id);
        if ($cook !== null) {
            # code...
            return Inertia::render('Cook/BecomeCook/Overview');
        } else {
            # code...
            return redirect()->route('welcome',);
        }
    });

    Route::resource('cook/order', OrdersController::class);
    Route::get('cook/calendar', [OrdersController::class, 'calendar']);
    Route::resource('wishlist', WishlistController::class);
    Route::get('/meal-schedule', [OrdersController::class, 'order'])->name('meal-schedule');
    Route::get('/notifications', [NotificationController::class, 'notification'])->name('notifications.index');


    Route::get('chat', [ChatController::class, 'index']);
    Route::get('messages/{id}', [ChatController::class, 'fetchMessages']);
    Route::post('messages', [ChatController::class, 'sendMessage']);


    //photo Controller
    Route::resource('/notifications-messages', NotificationController::class);
    Route::put('/notifications-messages-update-status', [NotificationController::class, 'updateStatus']);

    //Meal Schedule
    Route::resource('/schedule', MealScheduleController::class);
    Route::post('/checkout', [MealScheduleController::class, 'checkout']);
    Route::get('/calendar', [MealScheduleController::class, 'schedule']);
    Route::get('/check-meal-status', [MealScheduleController::class, 'checkMealStatus']);
    Route::get('/api/suggestions', [MealScheduleController::class, 'getSuggestions']);
    Route::get('/process_order/{id}',  [MealScheduleController::class, 'process_order']);
    Route::get('/payment',  [MealScheduleController::class, 'payment']);
    Route::get('/return', [MealScheduleController::class, 'return'])->name('checkout.return');
    
    
    //Meal Controller
    Route::resource('/meal', MealController::class);
    Route::put('meal/title/{id}', [MealController::class, 'title']);
    Route::put('meal/limit/{id}', [MealController::class, 'limit']);
    Route::put('meal/status/{id}', [MealController::class, 'status']);
    Route::put('meal/price/{id}', [MealController::class, 'price']);
    Route::put('meal/serve/{id}', [MealController::class, 'serve']);
    Route::put('meal/status/{id}', [MealController::class, 'status']);
    Route::put('meal/region/{id}', [MealController::class, 'region']);
    Route::put('meal/preference/{id}', [MealController::class, 'preference']);
    Route::put('meal/ingredients/{id}', [MealController::class, 'ingredients']);
    
    Route::resource('cook/account', AccountController::class);
    Route::resource('admin', AdminController::class);
    Route::post('account-link/{id}', [AccountController::class, 'account_link']);
    Route::post('dashboard-link/{id}', [AccountController::class, 'dashboard_link']);
    Route::get('/account-session/{id}', [AccountController::class, 'account_session']);
    Route::get('/onboarding/verify-your-account', [AccountController::class, 'verify'])->name('verify_cook');
    //cook Controller
    Route::resource('/cook/menu', CookController::class);
    Route::get('/become-a-cook/{newMealId}/price', [CookController::class, 'price']);
    Route::get('/become-a-cook/{newMealId}/photos', [CookController::class, 'photos']);
    Route::get('/become-a-cook/{newMealId}/region', [CookController::class, 'region']);
    Route::get('/become-a-cook/{newMealId}/meal-title', [CookController::class, 'title']);
    Route::get('/become-a-cook/{newMealId}/overview', [CookController::class, 'overview']);
    Route::get('/become-a-cook/{newMealId}/spotlight', [CookController::class, 'spotlight']);
    Route::get('/become-a-cook/{newMealId}/cook-limit', [CookController::class, 'cook_limit']);
    Route::get('/become-a-cook/{newMealId}/finishing-up', [CookController::class, 'finish_up']);
    Route::get('/become-a-cook', [CookController::class, 'pending_meal'])->name('become-a-cook');
    Route::get('/become-a-cook/{newMealId}/ingredients', [CookController::class, 'ingredients']);
    Route::get('/become-a-cook/{newMealId}/serving-style', [CookController::class, 'serving_style']);
    Route::get('/become-a-cook/{newMealId}/final-overview', [CookController::class, 'final_overview']);
    Route::get('/become-a-cook/{newMealId}/about-your-meal', [CookController::class, 'about_your_meal']);
    Route::get('/become-a-cook/{newMealId}/ordering-preference', [CookController::class, 'ordering_preference']);
});
