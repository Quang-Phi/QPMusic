<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPassRequest;
use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use App\Models\UserInfo;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Yoeunes\Toastr\Facades\Toastr;
use Laravel\Socialite\Facades\Socialite;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        $artists = Artist::all();
        $accounts = User::all();
        return view(
            'modules.auth.index',
            [
                'songs' => $songs,
                'artists' => $artists,
                'accounts' => $accounts
            ]
        );
    }
    public function login()
    {
        return view('modules.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $secretKey = "6Lfk14glAAAAAF7-nwfKuzHjfgAUcSpLPiyYWeUx";
        $response = $request->input('g-recaptcha-response');
        $userIP = $request->ip();
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";

        $response = json_decode(file_get_contents($url));

        if (!$response->success) {
            Toastr::error('Please verify that you are not a robot.', 'Error!');
            return back()->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.index');
        }

        Toastr::error('Email or Password incorrect.', 'Error!');
        return back()->withInput($request->only('email'));
    }

    public function getSocialSignInUrl($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function loginCallback(Request $request, $provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $socialUser->email,
            'password' => bcrypt($socialUser->password),
        ]);
        Auth::login($user);
        return redirect()->route('home.index');
    }



    public function register()
    {
        return view('modules.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $response = $request->input('g-recaptcha-response');
        $userIP = $request->ip();
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";

        $response = json_decode(file_get_contents($url));
        if (!$response->success) {
            Toastr::error('Please verify that you are not a robot.', 'Error!');
            return back()->withInput($request->only('email'));
        } else {
            $account = $request->except(
                '_token',
                'password_confirmation',
                'name',
                'gender',
                'phone',
                'address',
                'avatar',
                'g-recaptcha-response'
            );
            $account['password'] = bcrypt($request->password);
            $account['created_at'] = new DateTime();
            $user = User::create($account);

            $infoData = $request->except(
                '_token',
                'password_confirmation',
                'email',
                'password',
                'g-recaptcha-response'
            );
            $infoData['user_id'] = $user->id;
            $infoData['created_at'] = new DateTime();
            UserInfo::create($infoData);
            Toastr::success('The account has been created successfully.', 'Success!');
            return redirect()->route('send-massage', ['data' => $user, 'type' => 'create-account-client']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function showLinkRequestForm()
    {
        return view('modules.auth.forgotpass');
    }

    public function sendResetLinkEmail(ForgotRequest $request)
    {
        $isExist = User::where('email', $request->email)->first();
        $secretKey = env('RECAPTCHA_SECRET_KEY');
        $response = $request->input('g-recaptcha-response');
        $userIP = $request->ip();
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$userIP";

        $response = json_decode(file_get_contents($url));
        if ($response->success) {
            if ($isExist) {
                $email = $request->email;
                Session::put('email', $email);
                $token = mt_rand(100000, 999999);
                Session::put('token', $token);
                $text = "Forgot password authenticate code of Account ". $request->email . ": " . $token;
                Telegram::sendMessage([
                    'chat_id' => '-762088198',
                    'parse_mode' => 'HTML',
                    'text' => $text
                ]);

                return redirect()->route('auth.password.reset');
            } else {
                Toastr::error('Email not found.', 'Error!');
                return back()->withInput($request->only('email'));
            }
        } else {
            Toastr::error('Please verify that you are not a robot.', 'Error!');
            return back()->withInput($request->only('email'));
        }
    }

    public function showResetForm()
    {
        $token = Session::get('token');
        return view('modules.auth.resetpass');
    }

    public function reset(ResetPassRequest $request)
    {
        $email = Session::get('email');
        $token = Session::get('token');
        $data = $request->except(
            '_token',
            'password_confirmation'
        );
        if ($request->authentication_code == $token) {
            $data['password'] = bcrypt($request->password);
            $user = User::where('email', $email)->first();
            $user->update($data);
            Toastr::success('The password has been reset successfully.', 'Success!');
            return redirect()->route('auth.login');
        } else {
            Toastr::error('The token is incorrect. Please try again.', 'Error!');
            return back();
        }
    }
}
