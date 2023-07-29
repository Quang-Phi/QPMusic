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


                    <form method="POST" action="{{ route('auth.password.email') }}" id="login-form">
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
                       
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                        <button type="submit" class="btn btn-primary btn-mat" id="btn-submit">Next</button>
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