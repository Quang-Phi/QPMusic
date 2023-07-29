<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Premium;
use App\Models\UserInfo;
use DateTime;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function profile()
    {

        $user = auth()->user();
        $days_left = null;
        $premium = Premium::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();


        if ($premium) {
            $days_left = $premium ? now()->diffInDays($premium->expires_at, false) : 0;
            if ($premium->expires_at < now()) {
                $premium->delete();
                $user->is_premium = false;
                $user->save();
                Toastr::warning('Your subscription has expired !!');
            }
        }
        return view('modules.home.user.profile', [
            'days_left' => $days_left
        ]);
    }

    public function edit()
    {
        $user = auth()->user();
        $days_left = null;
        $premium = Premium::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();


        if ($premium) {
            $days_left = $premium ? now()->diffInDays($premium->expires_at, false) : 0;
            if ($premium->expires_at < now()) {
                $premium->delete();
                $user->is_premium = false;
                $user->save();
                Toastr::warning('Your subscription has expired !!');
            }
        }
        return view('modules.home.user.edit', [
            'days_left' => $days_left
        ]);
        return view('modules.home.user.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $userInfo = UserInfo::where('user_id', $user->id)->first();
        $id = $user->id;
        $info = $request->except('_token');
        $info['user_id'] = $id;
        if ($request->gender == 'Male') {
            $info['gender'] = 1;
        }
        $info['gender'] = 2;
        if ($request->avatar) {
            $file = $request->avatar;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/account'), $filename);
            $info['avatar'] = $filename;
        }
        if (!$request->name) {
            $info['name'] = $userInfo->name;
        }
        $info['created_at'] = new DateTime();

        UserInfo::where('user_id', $id)->update($info);
        Toastr::success('The account has been updated successfully.', 'Success!');
        return redirect()->route('user.profile');
    }

   
    public function premium()
    {
        $user = auth()->user();
        $days_left = null;
        $premium = Premium::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($premium) {
            $days_left = $premium ? now()->diffInDays($premium->expires_at, false) : 0;
            if ($premium->expires_at < now()) {
                $premium->delete();
                $user->is_premium = false;
                $user->save();
                Toastr::warning('Your subscription has expired !!');
            }
        }
        return view('modules.home.user.premium', [
            'days_left' => $days_left
        ]);
    }
}
