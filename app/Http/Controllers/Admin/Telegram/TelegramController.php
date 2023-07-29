<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Http\Controllers\Controller;
use App\Models\User;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function sendMassage($data, $type)
    {
        if ($type == 'create-account' || $type == 'create-account-client') {
            $user = User::find($data);
            $text = "A new account create\n"
            . "<b>ID: </b>\n"
            . "$user->id\n"
            . "<b>Email Address: </b>\n"
            . "$user->email\n";
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode' => 'HTML',
                'text' => $text
            ]);
            if ($type === 'create-account') {
                return redirect()->route('admin.accounts.all');
            }
            if ($type === 'create-account-client') {
                return view('modules.auth.login');
            }
        }
    }
}
