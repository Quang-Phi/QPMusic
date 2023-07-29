@extends('modules.home.master')

@section('content')
<script>
    if($('#player').find('video').length > 0){
        $('body').find('#sidebar,#header,#player .container').css("pointer-events", "none"); 
        $('#page_content').css("pointer-events", "auto"); 
    }
</script>
    <div class="under-hero container">
        <div class="section">
            <div class="plan bg-light">
                <div class="card plan__info overflow-hidden">
                    <div class="card-body d-flex flex-column p-0">
                        <div class="p-4">
                            <h4 class="mb-3 capitalize">
                                Hello <span class="text-primary">{{ $user->name }}</span>
                            </h4>
                            @if (
                                $user->is_premium == 'none' ||
                                    ($user->is_premium != 'premium' && $user->is_premium != 'none' && $user->is_premium != 'normal'))
                                <p class="fs-6">
                                    Unlock <b>Package</b> features and take your experience to the next level - upgrade now!
                                </p>
                            @elseif ($days_left == 0)
                                <p class="fs-6">
                                    Your <b>Premium</b> package has expired, renew your subscription now.
                                </p>
                            @elseif ($days_left > 0)
                                @if ($user->is_premium == 'normal')
                                    <p class="fs-6">
                                        Your <b class="capitalize">{{ $user->is_premium }}</b> package will expire in
                                        <b>{{ $days_left }}</b>
                                        days.
                                    </p>
                                    <b style="color:red">Note:</b> If you upgrade to <b class="capitalize mt-2">Premium</b>
                                    package, your current
                                    <b class="capitalize mt-2">Normal</b> package subscription will be cancelled.
                                @elseif($user->is_premium == 'premium')
                                    <p class="fs-6">
                                        Your <b class="capitalize">{{ $user->is_premium }}</b> package will expire in
                                        <b>{{ $days_left }}</b>
                                        days.
                                    </p>
                                    <p> Wishing<b class="capitalize mt-2"> you</b> a great experience with Music !</p>
                                @endif
                            @endif
                        </div>
                        <div class="px-3 text-center mt-auto">
                            <img src="https://i.postimg.cc/ncHS4RYH/image.png" class="img-fluid" alt="" />
                        </div>
                    </div>
                </div>
                <div class="plan__data">
                    <div class="card plan__col">
                        <div class="card-body fw-medium">
                            <div class="d-flex align-items-center text-dark mb-4">
                                <i class="ri-music-2-line fs-3"></i>
                                <h4 class="mb-0 ps-3">
                                    <span class="text-primary">Normal </span>Package
                                </h4>
                            </div>
                            <p class="fs-6 opacity-50">What you'll get</p>
                            <div class="d-flex mb-3">
                                <i class="ri-checkbox-circle-fill text-primary opacity-75 fs-6"></i>
                                <span class="ps-2">No Ads between tracks</span>
                            </div>

                        </div>
                        <form method="post" action="{{ route('payment.request') }}">
                            @csrf
                            <div class="card-footer pb-4 pb-sm-0">
                                <div class="text-dark mb-3">
                                    <span class="fs-4 fw-bold">$0.99</span>/month
                                </div>
                                <input hidden type="number" name="amount" value="0.99">
                                <input hidden type="text" name="package" value="normal">
                                @if ($user->is_premium == 'none')
                                    <button class="button-premium" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 24">
                                            <path d="m18 0 8 12 10-8-4 20H4L0 4l10 8 8-12z"></path>
                                        </svg>
                                        Unlock Normal
                                    </button>
                                @else
                                    <button disabled class="button-premium unlocked" type="submit">
                                        <img src="https://i.postimg.cc/br4rwkMz/image.png" alt="">
                                        Unlocked
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="card plan__col">
                        <div class="card-body fw-medium">
                            <div class="d-flex align-items-center text-dark mb-4">
                                <i class="ri-vip-crown-line fs-3"></i>
                                <h4 class="mb-0 ps-3">
                                    <span class="text-primary">Premium </span>Package
                                </h4>
                            </div>
                            <p class="fs-6 opacity-50">What you'll get</p>
                            <div class="d-flex mb-3">
                                <i class="ri-checkbox-circle-fill text-primary opacity-75 fs-6"></i>
                                <span class="ps-2">Access all app features</span>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="ri-checkbox-circle-fill text-primary opacity-75 fs-6"></i>
                                <span class="ps-2">No Ads between tracks</span>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="ri-checkbox-circle-fill text-primary opacity-75 fs-6"></i>
                                <span class="ps-2">Create a personal playlist</span>
                            </div>
                            <div class="d-flex mb-3">
                                <i class="ri-checkbox-circle-fill text-primary opacity-75 fs-6"></i>
                                <span class="ps-2">Download music</span>
                            </div>
                        </div>
                        <form method="post" action="{{ route('payment.request') }}">
                            @csrf
                            <div class="card-footer">
                                <div class="text-dark mb-3">
                                    <span class="fs-4 fw-bold">$9.99</span>/month
                                </div>
                                <input hidden type="number" name="amount" value="9.99">
                                <input hidden type="text" name="package" value="premium">

                                @if ($user->is_premium != 'premium')
                                    <button class="button-premium" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 24">
                                            <path d="m18 0 8 12 10-8-4 20H4L0 4l10 8 8-12z"></path>
                                        </svg>
                                        Unlock Premium
                                    </button>
                                @else
                                    <button disabled class="button-premium unlocked" type="submit">
                                        <img src="https://i.postimg.cc/br4rwkMz/image.png" alt="">
                                        Unlocked
                                    </button>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('hero')
    <div class="hero" style="background-image: url(https://i.postimg.cc/L8G6pXBK/analytics.jpg)"></div>
@endsection
