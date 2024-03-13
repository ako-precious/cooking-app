<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Account;
use Illuminate\Http\Request;
use Stripe\Account as StripeAccount;

class AccountTableController extends Controller
{

    public function index()
    {
    }
    public function show()
    {
    }
    public function create()
    {
        $user = Auth::user();


        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

     $account =   $stripe->accounts->create([
            'country' => 'CAD',
            'type' => 'express',
            'email' => $user->email,
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
            'business_type' => 'individual',
            'business_profile' => ['mcc' => 5814], 'name' => $user->name, 'product_description' => 'Meal from ' . $user->name, 'url' => env('APP_URL')
        ]);

      $link =  $stripe->accountLinks->create([
            'account' => $account->id,
            'refresh_url' => 'https://example.com/reauth',
            'return_url' => 'https://example.com/return',
            'type' => 'account_onboarding',
            'collect'=> 'eventually_due'
          ]);

      $account = new  Account();
      $account->stripe_account_id = $$account->id;

      return redirect($link->url);
    }
}
