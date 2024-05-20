<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Stripe\Account as StripeAccount;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Exception;

class AccountController extends Controller
{



    public function return(Request $request)
    {
        return Socialite::driver("google")->redirect();
    }
    public function callback(Request $request)
    {

        $googleUser = Socialite::driver("google")->user();
        $find_user = User::firstWhere('google_id', $googleUser->id);
        if ($find_user) {
            Auth::login($find_user);
            // echo '<script>opener.window.close();</script>';
            //   return redirect('/user/profile');
            return redirect()->route('login');
        } else {

            $user = User::updateOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(12)),
                    'profile_photo_path' => $googleUser->avatar,
                    'email_verified_at' => now()
                ]
            );

            Auth::login($user);
            return redirect('/user/profile');
        }
        //  dd($googleUser);

    }

    public function azure_return(Request $request)
    {
        return Socialite::driver("azure")->redirect();
    }
    public function azure_callback(Request $request)
    {
        // $azure = Socialite::driver('azure')->user();
        // dd($azure);
        $azure = Socialite::driver('azure')->user();

        // Log::info('Azure User Info:', $azure->toArray());


        // $azure =  Socialite::driver('microsoft')->user();
        // $find_user = User::firstWhere('google_id', $googleUser->id);
        // if($find_user){
        //     Auth::login($find_user);
        //     return redirect('/');
        // }else{

        //     $user = User::updateOrCreate(['email' => $googleUser->email],
        //     ['name' => $googleUser->name,
        //     'google_id' => $googleUser->id,
        //       'password'=> Hash::make(Str::random(12)) ,
        //     'profile_photo_path' => $googleUser->avatar,
        //     'email_verified_at' => now()]);

        //     Auth::login($user);
        //     return redirect('/user/profile');
        // }
        //  dd($azure);

    }
    public function fb_return(Request $request)
    {
        return Socialite::driver("facebook")->redirect();
    }
    public function fb_callback(Request $request)
    {

        $facebookUser = Socialite::driver("facebook")->user();
        // $find_user = User::firstWhere('facebook_id', $facebookUser->id);
        // if($find_user){
        //     Auth::login($find_user);
        // }else{

        //     $user = User::updateOrCreate(['email' => $facebookUser->email],
        //     ['name' => $facebookUser->name,
        //     'facebook_id' => $facebookUser->id,
        //     //   'password'=> Hash::make(Str::random(12)) ,
        //     'profile_photo_path' => $facebookUser->avatar,
        //     'email_verified_at' => now()]);

        //     Auth::login($user);
        // }
        dd($facebookUser);
    }
    public function index()
    {
        $user = Auth::user();
        $accounts = Account::where('user_id', $user->id)->get();
        //    dd($accounts);
        return inertia('Cook/Account/Index', ['accounts' => $accounts]);
    }
    public function show()
    {
    }
    public function account_link($id)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $link = $stripe->accountLinks->create([
            'account' => $id,
            'refresh_url' => route('account.index', [], true),
            'return_url' => route('account.index', [], true),
            'type' => 'account_onboarding',
            'collect' => 'eventually_due'
        ]);

        return response()->json(['url' => $link->url]);
    }

    public function account_session($id)
    {

        return inertia('Cook/Account/Sessions', ['account' => $id]);
    }

    public function dashboard_link($id)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
            // $link = $stripe->Account->create_login_link([
            //     'account' => $id,
            //     'refresh_url' => route('account.index', [], true) ,
            //     'return_url' => route('account.index', [], true) ,
            //     'type' => 'account_onboarding',
            //     'collect' => 'eventually_due'
            // ]);
            $account_session = $stripe->accountSessions->create([
                'account' => $id,
                'components' => [
                    'payments' => [
                        'enabled' => true,
                        'features' => [
                            'refund_management' => true,
                            'dispute_management' => true,
                            'capture_payments' => true,
                        ],
                    ],
                    "balances" => [
                        "enabled" => true,
                        "features" => [
                            "edit_payout_schedule" => true,
                            "instant_payouts" => true,
                            "standard_payouts" => true
                        ]

                    ],
                    'account_management' => [
                        'enabled' => true,
                        'features' => ['external_account_collection' => true],
                      ],

                    // 'payouts' => ['enabled' => true],
                ],
            ]);

            return response()->json(['client_secret' => $account_session->client_secret]);
        } catch (Exception $e) {
            error_log("An error occurred when calling the Stripe API to create an account session: {$e->getMessage()}");
            http_response_code(500);
            return response()->json(['error' => $e->getMessage()]);
        }
    }



    public function create()
    {
        return inertia('Cook/Account/Create',);
    }
    public function store()
    {
        $user = Auth::user();

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        $account = $stripe->accounts->create([
            'type' => 'express',
            'country' => 'CA',
            'email' => $user->email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'business_profile' => [
                'mcc' => '5814',
                'name' => $user->name,
                'product_description' => 'Meal from ' . $user->name,
                'url' =>  env('APP_URL')
            ]
        ]);

        $link = $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => route('account.index', [], true),
            'return_url' => route('account.index', [], true),
            'type' => 'account_onboarding',
            'collect' => 'eventually_due'
        ]);

        $accountModel = new Account();
        $accountModel->user_id = $user->id;
        $accountModel->stripe_account_id = $account->id;
        $accountModel->charges_enabled = false;
        $accountModel->transfer_enabled = false;
        $accountModel->detailed_submitted = false;
        $accountModel->save();

        return response()->json(['url' => $link->url]);
        // return redirect($link->url);


    }
}
