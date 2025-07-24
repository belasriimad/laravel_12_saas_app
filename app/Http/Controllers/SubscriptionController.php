<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Plan;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\PaymentMethod;
use Illuminate\Http\Request;
use App\Models\Subscription as SubcriptionModel;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        Stripe::setApiKey('YOUR STRIPE SECRET KEY HERE');
    }

    public function showSubscriptionForm(Plan $plan)
    {
        session()->put('chosenPlan',$plan);
        return back();
    }

    public function createCheckoutSession(Request $request)
    {
        $user = auth()->user();
        $plan = session('chosenPlan');

        try {
            if(!$user->stripe_id) {
                $customer = Customer::create([
                    'email' => $user->email
                ]);

                //save the stripe id of the user
                $user->stripe_id = $customer->id;
                $user->save();
            }
            //retrieve the payment method from the request
            $paymentMethodId = $request->payment_method;

            //attach the payment method the customer
            $paymentMethod = PaymentMethod::retrieve($paymentMethodId);
            $paymentMethod->attach(['customer' => $user->stripe_id]);

            //set the payment method as the default one for this user
            Customer::update($user->stripe_id,[
                'invoice_settings' => [
                    'default_payment_method' => $paymentMethodId
                ]
            ]);

            //create the subscription
            $subscription = Subscription::create([
                'customer' => $user->stripe_id,
                'items' => [['price' => $plan['price_id']]],
                'expand' => ['latest_invoice.payment_intent'],
                'default_payment_method' => $paymentMethodId
            ]);

            //store the subscription in the local database
            SubcriptionModel::create([
                'user_id' => $user->id,
                'plan_id' => $plan['id'],
                'stripe_subscription_id' => $subscription->id,
                'stripe_status' => $subscription->status,
                'stripe_plan_id' => $plan->price_id,
                'current_period_start' => $subscription->current_period_start,
                'current_period_end' => $subscription->current_period_end,
            ]);

            //update the user number of qrcodes
            $user->number_of_qrcodes = $plan['number_of_qrcodes'];
            $user->save();
            //empty the session
            session()->forget('chosenPlan');
            //return the response
            return to_route('qrcodes.index')->with('success', 'Subscription done successfully.');

        } catch (\Exception $e) {
            return to_route('plans.index')->with('error', 'Something went wrong try again later');
        }
    }

    public function cancel(Request $request)
    {
        $user = auth()->user();

        //find the subscription that the user wants to cancel
        //in the local database
        $subscription = SubcriptionModel::where([
            'user_id' => $user->id,
            'stripe_subscription_id' => $request->stripe_subscription_id
        ])->first();

        //check if the subscription exists
        if($subscription) {
            $stripeSubscription = Subscription::retrieve($subscription->stripe_subscription_id);
            $stripeSubscription->cancel();

            //delete the subscription from the local database
            $subscription->delete();

            //update the user stripe id 
            if(!$user->subscriptions->count()) {
                $user->stripe_id = null;
                $user->save();
            }
            //return the response
            return to_route('qrcodes.index')->with('success', 'Subscription canceled successfully.');
        }else {
            return to_route('plans.index')->with('error', 'No active subscription found.');
        }
    }
}
