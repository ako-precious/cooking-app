<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountTableController extends Controller
{
    public function index(){
        
    }
    public function show(){

    }
    public function create(){


        // Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_51OjplDL2JFKeogL47JexLjMx2GxrJel3c40Y0wZheAQE0IgyTRtC4Pcgd2PjdAx0qfW1WCxAcWyhj3JjvsbcD4iA00tlw5Kn3n');

$stripe->accounts->create([
  'country' => 'US',
  'type' => 'express',
  'capabilities' => [
    'card_payments' => ['requested' => true],
    'transfers' => ['requested' => true],
  ],
  'business_type' => 'individual',
  'business_profile' => ['url' => 'https://example.com'],
]);
    }
    
}
