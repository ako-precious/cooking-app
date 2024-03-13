<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Http\Request;
use Stripe\Account as StripeAccount;

class AccountController extends Controller
{

    public function index()
    {

    }
    public function show()
    {
    }
    public function create(){
        return inertia('Cook/Account/Create', );
    }
    public function store()
    {
        $user = Auth::user();


        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

     $account = $stripe->accounts->create([
            'country' => 'CA',
            'type' => 'express',
            'email' => $user->email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'business_profile' => ['mcc' => '5814',
             'name' => $user->name, 
            'product_description' => 'Meal from ' . $user->name, 
            // 'url' => 'http://127.0.0.1:8000/'
            ]
        ]);

      $link =  $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => 'https://example.com/reauth',
            'return_url' => 'https://example.com/return',
            'type' => 'account_onboarding',
            'collect'=> 'eventually_due'
          ]);

      $account = new  Account();
      $account->user_id = $user->id;
      $account->stripe_account_id = $account->id;
    //   return response()->json(['url' => $link->url]);
    //   return response()->json(['link' => $link]);
      return redirect($link->url); 
    // return response()->json(['url' => $link->url]);
    }
}
