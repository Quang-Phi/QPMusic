<?php

namespace App\Http\Controllers\Admin\SendNotify;

use App\Http\Controllers\Controller;
use App\Mail\SendNotify;
use App\Models\SendNotify as ModelsSendNotify;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class SenNotifyController extends Controller
{
   
    public function sendNotify()
    {
        
        $email = 'xx.g.impact@gmail.com';
        $subscriber = ModelsSendNotify::create([
            'email' => $email
        ]);
        if ($subscriber) {
            Mail::to($email)->send(new SendNotify($email));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ],
                200
            );
        }
    }
}
