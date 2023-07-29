@extends('modules.auth.master')
@section('content')
    <div class="close">
        <a href="/" class="close-mod"><i class="fa-solid fa-xmark"></i></a>
    </div>
    <div class="fade auth_box_prnt show">
        <div class="modal-signup">
            <div class="modal-dialog auth_box" role="document">
                <div class="modal-content">
                    <div class="right_combo">
                        <h2>Signup</h2>
                        <p>Get access to your music, playlists and account</p>

                        <div class="alert alert-danger alert-empty" id="output-singup-errors"></div>
                        <form action="{{ route('auth.store') }}" method="post" id="signup-form">
                            @csrf
                            <div class="form-group mat_input">
                                {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-envelope"></i> --}}
                                <input autofocus type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                {{-- </div> --}}
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mat_input">
                                {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-key"></i> --}}
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    id="password">
                                {{-- </div> --}}
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mat_input">
                                {{-- <div class="input_group"> --}}
                                {{-- <i class="fa-solid fa-key"></i> --}}
                                <input wire:model.lazy="password_confirmation" type="password" name="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    placeholder="Confirm Password">
                                {{-- </div> --}}
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                            <button data-bs-toggle="modal" data-bs-target="#success-modal" type="submit"
                                class="btn btn-primary btn-mat" id="btn-singup-submit">Signup</button>
                        </form>
                        <div class="signup_">
                            <span>Already have an account?</span>

                            <a href="{{ route('auth.login') }}">Login</a>
                        </div>
                    </div>
                    <div class="left_combo register"
                        style="background-image: url({{ asset('/img/vocalno/auth/register.png);') }}">
                        <h3>Over million songs to suit every mood & occasion</h3>
                        <div class="row">
                            <div class="col-3">
                                <svg class="top" xmlns="http://www.w3.org/2000/svg" width="51.633" height="51.682"
                                    viewBox="0 0 51.633 51.682">
                                    <g id="Group_9888" data-name="Group 9888" transform="translate(-1109 -695.318)">
                                        <g transform="translate(10.051 -42.949)">
                                            <g id="Rectangle_3432" data-name="Rectangle 3432"
                                                transform="translate(1098.949 749.949)" fill="none" stroke="#fff"
                                                stroke-width="1">
                                                <rect width="40" height="40" rx="6" stroke="none" />
                                                <rect x="0.5" y="0.5" width="39" height="39"
                                                    rx="5.5" fill="none" />
                                            </g>
                                            <g id="Group_9318" data-name="Group 9318"
                                                transform="translate(1108.972 761.968)">
                                                <path id="Subtraction_45" data-name="Subtraction 45"
                                                    d="M9.464,15.535H0V14.164H9.464v1.37Zm4.048-7.082H0V7.082H13.512v1.37Zm6.069-7.082H0V0H19.581V1.37Z"
                                                    transform="translate(0 0)" fill="#fff" />
                                                <path id="Path_7235" data-name="Path 7235"
                                                    d="M81.74,1.6a3.463,3.463,0,0,1-1.685-.4C79.7.993,79.491.732,79.491.486V.467a.473.473,0,0,0-.946,0V6.459a2.551,2.551,0,1,0,.946,1.974s0-.009,0-.014,0,0,0-.007V1.953a4.27,4.27,0,0,0,2.249.58.467.467,0,1,0,0-.933ZM76.9,10.059a1.625,1.625,0,1,1,1.648-1.625A1.639,1.639,0,0,1,76.9,10.059Z"
                                                    transform="translate(-62.306 4.869)" fill="#fff" />
                                            </g>
                                        </g>
                                        <path id="Subtraction_46" data-name="Subtraction 46"
                                            d="M10856.77,1580.2h0a13.591,13.591,0,0,0-4.876-5.964l.494-1.774a15.166,15.166,0,0,1,6.233,7.628l-1.851.111Zm6.592-.363h0a19.572,19.572,0,0,0-3.637-6.947,19.283,19.283,0,0,0-6.1-4.976l.473-1.752a21.064,21.064,0,0,1,7.01,5.622,21.318,21.318,0,0,1,4.082,7.959l-1.824.1Z"
                                            transform="translate(-9704.555 -870.846)" fill="#fff" />
                                    </g>
                                </svg>
                                <p>Create your own playlist</p>
                            </div>
                            <div class="col-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                    <g transform="translate(-1098.949 -749.949)">
                                        <g id="Rectangle_3432" data-name="Rectangle 3432"
                                            transform="translate(1098.949 749.949)" fill="none" stroke="#fff"
                                            stroke-width="1">
                                            <rect width="40" height="40" rx="6" stroke="none" />
                                            <rect x="0.5" y="0.5" width="39" height="39"
                                                rx="5.5" fill="none" />
                                        </g>
                                        <path id="Subtraction_47" data-name="Subtraction 47"
                                            d="M10709.106,1626.985a3.671,3.671,0,0,1-1.342-.249,3.749,3.749,0,0,1-2.247-4.4l.085-.342-4.99-2.734-.238.257a3.647,3.647,0,0,1-1.892,1.091l0,0a3.753,3.753,0,0,1-.823.093,3.619,3.619,0,0,1-1.358-.264,3.659,3.659,0,0,1-1.708-1.372,3.765,3.765,0,0,1,0-4.2,3.646,3.646,0,0,1,1.708-1.372,3.75,3.75,0,0,1,1.373-.262,3.576,3.576,0,0,1,.808.091l.007,0a3.614,3.614,0,0,1,1.89,1.091l.238.257,4.99-2.734-.085-.342a3.745,3.745,0,0,1,2.247-4.4,3.679,3.679,0,0,1,1.342-.252,3.734,3.734,0,0,1,.01,7.468,3.353,3.353,0,0,1-.35-.017,3.72,3.72,0,0,1-2.359-1.169l-.238-.254-4.987,2.734.083.342a3.774,3.774,0,0,1,0,1.832l-.083.342,4.99,2.734.238-.257a3.651,3.651,0,0,1,2.356-1.166c.113-.011.229-.016.343-.016a3.749,3.749,0,0,1,2.184.706,3.73,3.73,0,0,1-2.187,6.759Zm.013-6.282a2.557,2.557,0,0,0-2.534,2.548,2.543,2.543,0,0,0,.747,1.8,2.512,2.512,0,0,0,3.577,0,2.541,2.541,0,0,0,0-3.6A2.513,2.513,0,0,0,10709.119,1620.7Zm-11.457-6.284a2.509,2.509,0,0,0-1.787.751,2.541,2.541,0,0,0,0,3.6,2.506,2.506,0,0,0,3.577,0,2.538,2.538,0,0,0,0-3.6A2.511,2.511,0,0,0,10697.662,1614.419Zm11.457-6.284a2.507,2.507,0,0,0-1.787.751,2.538,2.538,0,0,0,0,3.6,2.506,2.506,0,0,0,3.577,0,2.549,2.549,0,0,0-1.79-4.348Z"
                                            transform="translate(-9584.443 -847.019)" fill="#fff" />
                                    </g>
                                </svg>
                                <p>Download your favorite songs</p>
                            </div>
                            <div class="col-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                    viewBox="0 0 40 40">
                                    <g transform="translate(-1098.949 -749.949)">
                                        <g id="Rectangle_3432" data-name="Rectangle 3432"
                                            transform="translate(1098.949 749.949)" fill="none" stroke="#fff"
                                            stroke-width="1">
                                            <rect width="40" height="40" rx="6" stroke="none" />
                                            <rect x="0.5" y="0.5" width="39" height="39"
                                                rx="5.5" fill="none" />
                                        </g>
                                        <path id="Path_6728" data-name="Path 6728"
                                            d="M3535.636,7856.374l-7.81-7.811.029-.059a5.6,5.6,0,0,1,4.3-8.935c.069,0,.138,0,.207,0a5.607,5.607,0,0,0,6.54,0c.069,0,.138,0,.207,0a5.6,5.6,0,0,1,4.312,8.924l.031.059Zm-6.5-8.184,6.5,6.5,6.5-6.5.132-.153a4.417,4.417,0,0,0-6.24-6.217l-.388.335-.388-.335a4.412,4.412,0,0,0-2.882-1.07c-.054,0-.109,0-.163,0a4.414,4.414,0,0,0-3.2,7.284Z"
                                            transform="translate(-2417.124 -7077.917)" fill="#fff" />
                                    </g>
                                </svg>
                                <p>Save your favourites</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
