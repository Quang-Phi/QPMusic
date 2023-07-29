<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Premium;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayController extends Controller
{
    public function requestPayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $amount = $request->input('amount');
        $package = $request->input('package');
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success', ['package' => $package]),
                "cancel_url" => route('payment.cancel',['package' => $package]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect($link['href']);
                }
            }
            Toastr::error('Payment Failed');
            return redirect()->route('user.premium');
        } else {
            Toastr::error('Payment Failed');
            return redirect()->route('user.premium');
        }
    }

    public function paymentSuccess(Request $request, $package)
    {
        $user = auth()->user();
        $user->is_premium = $package;
        $user->save();
        Premium::create([
            'user_id' => $user->id,
            'registration_time' => new DateTime(),
            'expires_at' => Carbon::now()->addDays(30),
            'package_type' => $package,
            'status' => 'done',
            'created_at' => new DateTime(),
        ]);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->input('token'));

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            Toastr::success('Payment Success');
            return redirect()->route('home.index');
        } else {
            Toastr::error('Payment Failed');
            return redirect()->route('user.premium');
        }
    }


    public function paymentCancel($package)
    {
        $user = auth()->user();
        Premium::create([
            'user_id' => $user->id,
            'registration_time' => new DateTime(),
            'expires_at' => Carbon::now()->addDays(30),
            'package_type' => $package,
            'status' => 'cancelled',
            'created_at' => new DateTime(),
        ]);
        Toastr::error('Payment Failed.');
        return redirect()->route('user.premium');
    }
}
