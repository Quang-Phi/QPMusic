@extends('modules.home.master')
@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="plan bg-light">
            <div class="card plan__info overflow-hidden">
                <div class="card-body d-flex flex-column p-0">
                    <div class="p-4">
                        <h4 class="mb-3">
                            Selected <span class="text-primary">vip registration</span>
                        </h4>
                        @if (
                        $user->is_premium == 'none' ||
                        ($user->is_premium != 'premium' && $user->is_premium != 'none' && $user->is_premium !=
                        'normal'))
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
                        <br>
                        <br>
                        <a href="{{route('user.premium')}}" class="d-inline-flex align-items-center"><span
                            class="fw-semi-bold pe-1">Upgrade Now</span>
                        <i class="ri-arrow-right-line fs-6"></i></a>
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
                <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="px-4 pt-2 pe-xl-0 pt-sm-0 mt-4 mb-3 my-sm-0 w-100">
                        @php
                        $avatar = $user->avatar == null || !file_exists(public_path('img/account/' . $user->avatar)) ?
                        $user->avatar : asset('img/account/' . $user->avatar);
                        @endphp
                        <div class="d-flex align-items-center mb-4">
                            <div class="avatar avatar--xl">
                                <div class="avatar__image custom_avt">
                                    <img src="{{ $avatar }}" alt="user" />
                                </div>
                                <div class="avt-profile ps-3">
                                    <input name="avatar" type="file" id="avt-profile" class="d-none" />
                                    <label for="avt-profile" class="btn btn-danger rounded-pill">Change Avatar</label>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <label for="name" class="form-label fw-medium">Name</label>
                                <input autofocus name="name" type="text" id="name" class="form-control form-custom"
                                    value="{{ old('name', $user->name) }}" />
                            </div>
                            <div class="col-sm-6">
                                <label for="Gender" class="form-label fw-medium">Gender</label>
                                <label class="gender-status">
                                    <input type="radio" class="status-radio form-control" name="gender" {{ $user->gender
                                    == 1 ? 'checked' : ' ' }}>
                                    <span>Male</span>
                                </label>
                                <label class="gender-status">
                                    <input type="radio" class="status-radio form-control" name="gender" {{ $user->gender
                                    == 2 ? 'checked' : '' }}>
                                    <span>FeMale</span>
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label for="phone" class="form-label fw-medium">Phone Number</label>
                                <input name="phone" type="text" id="phone" class="form-control form-custom"
                                    value="{{ old('phone', $user->phone) }}" />
                            </div>
                            <div class="col-sm-12">
                                <label for="Address" class="form-label fw-medium">Address</label>
                                <input name="address" type="text" id="Address" class="form-control form-custom"
                                    value="{{ old('address', $user->address) }}" />
                            </div>

                            <div class="col-12">
                                <input class="btn btn-danger" type="submit" value="Save Change">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
            const input = $('#avt-profile');
            const image = $('.custom_avt img');

            input.change(function() {
                const file = input[0].files[0];
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    image.attr('src', reader.result);
                });

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        });
</script>
@endsection

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/L8G6pXBK/analytics.jpg)"></div>
@endsection