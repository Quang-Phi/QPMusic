@extends('modules.home.master')

@section('li_3','active')


@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/L8G6pXBK/analytics.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">Trending <span class="text-primary">Albums</span></h3>
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($albums->isEmpty())
                    <p class="empty">No Album Available</p>
                    @else
                    @foreach ($albums as $album)
                    @php
                    $img = $album->img_url == null || !file_exists(public_path('img/album/' . $album->img_url))
                    ?$album->img_url : asset('img/album/' . $album->img_url);
                    @endphp
                    @php
                    $favorite = App\Models\Favorite::where('album_id', $album->id)->where('user_id',$user
                    ->id)->first();
                    @endphp
                    <div class="swiper-slide">
                        <div class="cover cover--round">
                            <div class="cover__head">
                                <ul class="cover__label d-flex">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="album" data-favorite-id="{{ $album->id }}"
                                            for="album[{{ $album->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                                class="like" id="album[{{ $album->id }}]">
                                            <div class="checkmark">
                                                <svg viewBox="0 0 24 24" class="outline"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                    </path>
                                                </svg>
                                                <svg viewBox="0 0 24 24" class="filled"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                    </path>
                                                </svg>
                                                <svg class="celebrate" width="100" height="100"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon points="10,10 20,20" class="poly"></polygon>
                                                    <polygon points="10,50 20,50" class="poly"></polygon>
                                                    <polygon points="20,80 30,70" class="poly"></polygon>
                                                    <polygon points="90,10 80,20" class="poly"></polygon>
                                                    <polygon points="90,50 80,50" class="poly"></polygon>
                                                    <polygon points="80,80 70,70" class="poly"></polygon>
                                                </svg>
                                            </div>
                                        </label>
                                    </li>
                                </ul>
                                <div class="cover__options dropstart d-inline-flex ms-auto"><a class="dropdown-link"
                                        href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                        aria-label="Cover options" aria-expanded="false"><i
                                            class="ri-more-2-fill"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                            data-collection-play-id="{{ $album->id }}" 
                                            data-type="album" 
                                            data-id="{{ $album->id }}">Play</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('home.album-details', ['id' => $album->id]) }}">View
                                                details</a></li>
                                    </ul>
                                </div>
                            </div><a href="{{ route('home.album-details', ['id' => $album->id]) }}"
                                class="cover__image"><img src="{{ $img }}" alt=""></a>
                            <div class="cover__foot"><a href="{{ route('home.album-details', ['id' => $album->id]) }}"
                                    class="cover__title text-truncate">{{ $album->name }}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

            </div>
            <div class="swiper-button-prev btn-default rounded-pill"></div>
            <div class="swiper-button-next btn-default rounded-pill"></div>
        </div>
    </div>
    <div class="section">
        <div class="section__head align-items-center"><span class="d-block pe-3 fs-6 fw-semi-bold">{{count($albums)}}
                Albums in the list</span>
        </div>
        <div class="list list--lg album-list">
            @if ($albums->isEmpty())
            <p class="empty">No Album Available</p>
            @else
            @foreach ($albums ->take(10) as $album)
            @php
            $img = $album->img_url == null || !file_exists(public_path('img/album/' . $album->img_url)) ?
            $album->img_url : asset('img/album/' . $album->img_url);
            $favorite = App\Models\Favorite::where('album_id', $album->id)->where('user_id',$user ->id)->first();
            $album = App\Models\Album::find($album->id);
            $songs = $album
            ->songs()
            ->where('status', '<>', '3')
                ->get();
                @endphp
                <div class="list__item">
                    <a href="{{ route('home.album-details', ['id' => $album->id]) }}" class="list__cover"><img
                            src="{{ $img }}" alt="" /></a>
                    <div class="list__content">
                        <a href="{{ route('home.album-details', ['id' => $album->id]) }}"
                            class="list__title text-truncate">{{ $album->name }}</a>
                        <p class="mb-3">
                            @php
                            $artists = [];
                            $artistNames = [];
                            foreach ($songs as $song) {
                            foreach ($song->artists->take(3) as $item) {
                            if (!in_array($item->name, $artistNames)) {
                            $artistNames[] = $item->name;
                            $artists[] = $item;
                            }
                            }
                            }
                            foreach (collect($artists)->take(3) as $key => $item) {
                            echo '<a href="' . route('home.artist-details', ['id' => $item->id]) . '"
                                class="capitalize text-dark fw-medium">' . $item->name . '</a>';
                            if ($key != count($artists) - 1) {
                            echo ', ';
                            }
                            if (count($artists) >= 3 && $key == 2) {
                            echo '...';
                            }
                            }
                            @endphp
                        </p>
                    </div>
                    <ul class="list__option">
                        <li class="icon-fvr">
                            <label class="add-fvr" data-type="album" data-favorite-id="{{ $album->id }}"
                                for="album[{{ $album->id }}]">
                                <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                    id="album[{{ $album->id }}]">
                                <div class="checkmark">
                                    <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                        </path>
                                    </svg>
                                    <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                        </path>
                                    </svg>
                                    <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                        <polygon points="10,10 20,20" class="poly"></polygon>
                                        <polygon points="10,50 20,50" class="poly"></polygon>
                                        <polygon points="20,80 30,70" class="poly"></polygon>
                                        <polygon points="90,10 80,20" class="poly"></polygon>
                                        <polygon points="90,50 80,50" class="poly"></polygon>
                                        <polygon points="80,80 70,70" class="poly"></polygon>
                                    </svg>
                                </div>
                            </label>
                        </li>
                        <li class="dropstart d-inline-flex">
                            <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-collection-play-id="{{ $album->id }}" 
                                    data-type="album" 
                                    data-id="{{ $album->id }}">Play</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('home.album-details', ['id' => $album->id]) }}">View
                                        details</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
                @endforeach
                @endif

        </div>
        @if ($albums->count() > 10)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="album" data-limit="20" data-quantity="10" data-load="album"
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