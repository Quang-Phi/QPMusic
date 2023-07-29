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
                    <h2>Forgot Password</h2>
                    <p>Get access to your music, playlists and account</p>

                    <div class="alert alert-danger alert-empty" id="output-errors"></div>


                    <form method="POST" action="{{ route('auth.password.update') }}" id="login-form">
                        @csrf
                        <div class="form-group mat_input">
                            {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-key"></i> --}}
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    id="password">
                                {{--
                            </div> --}}
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mat_input">
                            {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-key"></i> --}}
                                <input wire:model.lazy="password_confirmation" type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm Password">
                                {{--
                            </div> --}}
                            @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mat_input">
                                <input type="number" name="authentication_code"
                                    class="form-control @error('authentication-code') is-invalid @enderror" placeholder="Authentication code"
                                    id="authentication_code">
                            @error('authentication-code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        <button data-bs-toggle="modal" data-bs-target="#success-modal" type="submit"
                            class="btn btn-primary btn-mat" id="btn-singup-submit">Reset Password</button>
                    </form>

                </div>
                <div class="left_combo" style="background-image: url({{ asset('/img/vocalno/auth/forgot.jpg') }});">
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