@extends('modules.auth.master')
@section('content')
<div class="close">
    <a href="/" class="close-mod"><i class="fa-solid fa-xmark"></i></a>
</div>
<div class="fade auth_box_prnt show">
    <div class="modal-login">
        <div class="modal-dialog auth_box" role="document">
            <div class="modal-content">
                <div class="right_combo">
                    <h2>Login</h2>
                    <p>Get access to your music, playlists and account</p>

                    <div class="alert alert-danger alert-empty" id="output-errors"></div>


                    <form method="POST" action="{{ route('auth.authenticate') }}" id="login-form">
                        @csrf
                        <div class="form-group mat_input">
                            {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-envelope"></i> --}}
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Email" autofocus name="email" value="{{ old('email') }}">
                                {{--
                            </div> --}}
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mat_input">
                            {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-key"></i> --}}
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password" name="password">
                                {{--
                            </div> --}}
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if (session('loginError'))
                            <div style="" class="mt-2 alert-danger">
                                {{ session('loginError') }}
                            </div>
                            @endif
                        </div>
                        <div class="forgot_password">

                            <a href="{{route('auth.password.request')}}">Forgot your password?</a>
                        </div>
                        <input type="hidden" name="last_url" class="login_last_url">

                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        <button type="submit" class="btn btn-primary btn-mat" id="btn-submit">Login</button>
                    </form>


                    <div class="signup_">
                        <span>Don&#039;t have an account?</span>

                        <a href="{{ route('auth.register') }}">Sign
                            Up</a>
                    </div>
                    <div class="text-center">
                        <span class="u_divider">OR</span>
                    </div>
                    <div class="ma_social_login">
                        <a href="{{ route('auth.get-social-sign-in-url', ['social' => 'facebook']) }}"
                            class="btn_social btn_fb"><span><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M13.397,20.997v-8.196h2.765l0.411-3.209h-3.176V7.548c0-0.926,0.258-1.56,1.587-1.56h1.684V3.127	C15.849,3.039,15.025,2.997,14.201,3c-2.444,0-4.122,1.492-4.122,4.231v2.355H7.332v3.209h2.753v8.202H13.397z">
                                    </path>
                                </svg></span> Facebook</a>
                    </div>
                </div>
                <div class="left_combo" style="background-image: url({{ asset('/img/vocalno/auth/singing.jpg') }});">
                    <h2>Live your Day with <span>Music</span> <img src="{{ asset('/img/vocalno/icon.png') }}" /></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!auth()->check())
<script>
    localStorage.clear();
</script>
@endif
@endsection