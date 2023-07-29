@extends('modules.home.master')

@section('li_4','active')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/SRVxFfVD/radio.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">
                Featured <span class="text-primary">Artists</span>
            </h3>
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="6" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($artists->isEmpty())
                    <p class="empty">No Artist Available</p>
                    @else
                    @foreach ($artists as $item)
                    @php
                    $img = $item->img_url == null || !file_exists(public_path('img/artist/' . $item->img_url)) ?
                    $item->img_url : asset('img/artist/' . $item->img_url);
                    @endphp
                    <div class="swiper-slide">
                        <div class="avatar avatar--xxl d-block text-center">
                            <div class="avatar__image">
                                <a href="{{ route('home.artist-details', ['id' => $item->id]) }}"><img src="{{ $img }}"
                                        alt="Artist" /></a>
                            </div>
                            <a href="{{ route('home.artist-details', ['id' => $item->id]) }}"
                                class="avatar__title mt-3 capitalize">{{ $item->name }}</a>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">
                Top <span class="text-primary">Artists</span>
            </h3>
        </div>
        <div class="row g-4 artist-list">
            @if ($artists->isEmpty())
            <p class="empty">No Artist Available</p>
            @else
            @foreach ($artists ->take(12) as $item)
            @php
            $img = $item->img_url == null || !file_exists(public_path('img/artist/' . $item->img_url)) ?
            $item->img_url : asset('img/artist/' . $item->img_url);
            @endphp
            <div class="col-6 col-xl-2 col-md-3 col-sm-4">
                <a href="{{ route('home.artist-details', ['id' => $item->id]) }}" class="cover cover--round">
                    <div class="cover__image">
                        <img src="{{ $img }}" alt="Artist" />
                    </div>
                    <div class="cover__foot">
                        <span class="cover__title text-truncate"> {{ $item->name }}</span>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
        </div>
        @if ($artists->count() > 12)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="artist" data-limit="24" data-quantity="12" data-load="artist"
                class="btn btn-primary btn-load-more">
                <div class="btn__wrap">
                    <i class="ri-loader-3-fill"></i> <span>Load more</span>
                </div>
            </a>
        </div>
        @endif
    </div>
</div>
@endsection