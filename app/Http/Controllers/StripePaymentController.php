<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe\Stripe as StripeStripe;
class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        $myamount = 2000;
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
                "address" => [
                    "line1" => "Virani Chowk",
                    "postal_code" => "390008",
                    "city" => "Vadodara",
                    "state" => "GJ",
                    "country" => "IN",
                ],
                "email" => "demo@gmail.com",
                "name" => "Nitin Pujari",
                "source" => $request->stripeToken
            ));
        Stripe\Charge::create ([
                "amount" => $myamount,
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => "Test payment from LaravelTus.com.",
                "shipping" => [
                    "name" => "Jenny Rosen",
                    "address" => [
                        "line1" => "510 Townsend St",
                        "postal_code" => "98140",
                        "city" => "San Francisco",
                        "state" => "CA",
                        "country" => "US",
                    ],
                ]
        ]);
        return $request->stripeToken;
        Session::flash('success', 'Payment successful!');
        return back();
    }
}
