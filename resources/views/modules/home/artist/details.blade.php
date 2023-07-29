@extends('modules.home.master')

@section('li_4','active')


@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/SRVxFfVD/radio.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="row align-items-center">
            <div class="col-xl-3 col-md-4">
                <div class="cover cover--round">
                    @php
                    $img = $artist->img_url == null || !file_exists(public_path('img/artist/' . $artist->img_url)) ?
                    $artist->img_url : asset('img/artist/' . $artist->img_url);
                    $favorite = App\Models\Favorite::where('artist_id', $artist->id)->where('user_id',$user
                    ->id)->first();
                    @endphp
                    <div class="cover__image">
                        <img style="object-fit: cover" src="{{ $img }}" alt="{{ $artist->name }}" />
                    </div>
                </div>
            </div>
            <div class="col-1 d-none d-xl-block"></div>
            <div class="col-md-8 mt-5 mt-md-0">
                <div class="d-flex flex-wrap mb-2">
                    <span class="text-dark fs-4 fw-semi-bold pe-2 capitalize">{{ $artist->name }}</span>
                </div>
                <ul class="info-list info-list--dotted mb-3">
                    <li>{{ $albums->count() }} Album</li>
                    <li>{{ $songs->count() }} Songs</li>
                </ul>
                <p class="mb-5">
                    {{ $artist->bio }}
                </p>
                <ul class="info-list">
                    <li>
                        <div class="d-flex align-items-center">
                            <button type="button" id="play_all" class=" btn btn-icon btn-primary rounded-pill"
                                data-collection-play-id="{{ $artist->id }}" data-type="artist"
                                data-id="{{ $artist->id }}" {{ !$songs->count() ? 'disabled' : '' }}
                                >
                                <i class="ri-play-fill icon-play"></i>
                                <i class="ri-pause-fill icon-pause"></i>
                            </button>
                            <label for="play_all" class="ps-2 fw-semi-bold text-primary mb-0"
                                style="cursor: pointer">Play</label>
                        </div>
                    </li>
                    <li class="icon-fvr">
                        <label class="add-fvr" data-type="artist" data-favorite-id="{{ $artist->id }}"
                            for="artist[{{ $artist->id }}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                id="artist[{{ $artist->id }}]">
                            <div style="top: -11px" class="checkmark">
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
                        <span class="ps-2 fw-medium">{{$fvrQuantity}}</span>
                        <span class="count">
                            <span class="sub-count">{{ $artistLikesStarLastMonth }} <i
                                    class="ri-heart-fill text-danger"></i> / last month
                            </span>
                        </span>
                    </li>
                    <li class="icon-rate">
                        <a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-end"
                            aria-label="rating">
                            <div class="d-flex align-items-end">
                                <i class="ri-star-fill text-warning"></i>
                                <span class="ps-2 fw-medium">{{$artistReviewsStar}}</span>
                                <span class="count"> <span>{{$artistReviewsQuantity->count()}} reviews</span>
                                    <span class="sub-count">{{ $artistReviewsStarLastMonth }} <i
                                        class="ri-star-fill text-warning"></i> / last month</span></span></span>
                            </div>
                        </a>
                        <div id="reviews">
                            <form method="post" action="{{route('home.review',['id'=>$artist->id])}}">
                                @csrf
                                <div class="rating">
                                    <input checked value="5" name="rating" id="star-1" type="radio">
                                    <label for="star-1">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"
                                                pathLength="360"></path>
                                        </svg>
                                    </label>
                                    <input value="4" name="rating" id="star-2" type="radio">
                                    <label for="star-2">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"
                                                pathLength="360"></path>
                                        </svg>
                                    </label>
                                    <input value="3" name="rating" id="star-3" type="radio">
                                    <label for="star-3">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"
                                                pathLength="360"></path>
                                        </svg>
                                    </label>
                                    <input value="2" name="rating" id="star-4" type="radio">
                                    <label for="star-4">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"
                                                pathLength="360"></path>
                                        </svg>
                                    </label>
                                    <input value="1" name="rating" id="star-5" type="radio">
                                    <label for="star-5">
                                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"
                                                pathLength="360"></path>
                                        </svg>
                                    </label>
                                </div>
                                <textarea autofocus placeholder="Your review..." name="review" id="" cols="30"
                                    rows="5"></textarea>
                                <input type="hidden" name="type" value="artist">
                                <input class="w-100" type="submit" value="send">
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column-reverse">

        <div class="section">
            <div class="section__head">
                <div class="flex-grow-1">
                    <h3 class="mb-0">Top <span class="text-primary">Albums</span></h3>
                    <span style="display:block;" class="section__subtitle">there is the appearance of -
                        {{ $artist->name }} -</span>
                </div>
            </div>
            <div class="swiper-carousel swiper-carousel-button">
                <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                    <div class="swiper-wrapper">

                        @if ($albums->isEmpty())
                        <p class="empty">No Album Available</p>
                        @else
                        @foreach ($albums as $album)
                        @php
                        $img = $album->img_url == null || !file_exists(public_path('img/album/' . $album->img_url)) ?
                        $album->img_url : asset('img/album/' . $album->img_url);
                        $favorite = App\Models\Favorite::where('song_id', $album->id)->where('user_id',$user
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
                                    <div class="cover__options dropstart d-inline-flex ms-auto">
                                        <a class="dropdown-link" href="javascript:void(0);" role="button"
                                            data-bs-toggle="dropdown" aria-label="Cover options"
                                            aria-expanded="false"><i class="ri-more-2-fill"></i></a>
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
                                    </div>
                                </div>
                                <a href="{{ route('home.album-details', ['id' => $album->id]) }}"
                                    class="cover__image"><img src="{{ $img }}" alt="Mummy" /></a>
                                <div class="cover__foot">
                                    <a href="{{ route('home.album-details', ['id' => $album->id]) }}"
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
            <div class="section__head">
                <div class="flex-grow-1">
                    <h3 class="mb-0">Top <span class="text-primary">Songs</span></h3>
                    <span style="display:block;" class="section__subtitle">of -
                        {{ $artist->name }} -</span>
                </div>
            </div>
            <div class="list list-lg list-artist-songs" style="display: grid;
                grid-template-columns: repeat(2, 1fr);
                column-gap: 20px;row-gap: 0px;" data-collection-song-id="{{ $artist->id }}">
                @if ($songs->isEmpty())
                <p class="empty">No Song Available</p>
                @else
                @foreach ($songs->take(20) as $song)
                @php
                $img = $song->img_url == null || !file_exists(public_path('img/song/' . $song->img_url)) ?
                $song->img_url : asset('img/song/' . $song->img_url);
                $favorite = App\Models\Favorite::where('song_id', $song->id)->where('user_id',$user ->id)->first();
                @endphp
                <div class="list__item" data-song-id="{{ $song->id }}" data-song-name="{{ $song->name }}"
                    data-song-artist="{{ implode(', ', $song->artists->pluck('name')->toArray()) }}" data-song-album=""
                    data-song-url="{{ asset('music/' . $song->url) }}" data-song-cover="{{ $img }}">
                    <div class="list__cover">
                        <img src="{{ $img }}" alt="" />
                        <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                            data-play-id="{{ $song->id }}" aria-label="Play pause"><i
                                class="ri-play-fill icon-play"></i>
                            <i class="ri-pause-fill icon-pause"></i></a>
                    </div>
                    <div class="list__content">
                        <a href="{{ route('home.song-details', ['id' => $song->id]) }}"
                            class="capitalize list__title text-truncate">{{ $song->name }}</a>
                        <p class="cover__subtitle text-truncate">
                            @foreach ($song->artists->take(3) as $index => $art)
                            <a class="capitalize text-dark capitalize"
                                href="{{ route('home.artist-details', ['id' => $art->id]) }}">
                                {{ $art->name }}</a>
                            @if ($index !== $song->artists->count() - 1)
                            ,
                            @endif
                            @if ($song->artists->count() >= 3 && $index == 2)
                            ...
                            @endif
                            @endforeach
                        </p>
                    </div>
                    <ul class="list__option">
                        <li class="icon-fvr">
                            <label class="add-fvr" data-type="song" data-favorite-id="{{ $song->id }}"
                                for="song[{{ $song->id }}]">
                                <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                    id="song[{{ $song->id }}]">
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
                        <li>{{ $song->duration }}</li>
                        <li class="dropstart d-inline-flex">
                            <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-play-id="{{ $song->id }}">Play</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-queue-id="{{ $song->id }}">Add to queue</a>
                                </li>
                                <li class="item-playlist">
                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-song-id-item="{{ $song->id }}">Add to
                                        Playlist</a>
                                    <div class="sub-menu-2">
                                        <span class="create"><a data-change="false" data-song-id-item={{$song->id}}
                                                class="dropdown-item" href="javascript:void(0)">Create New
                                                Playlist</a></span>
                                        <ul>
                                            @foreach ($playlists as $playlist)
                                            <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                                {{$song->id}} class="dropdown-item"><a href="javascript:void(0)">{{
                                                    $playlist->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li class="item-download">
                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                        data-download-id="{{ $song->id }}">Download</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('home.song-details', ['id' => $song->id]) }}" role="button">View
                                        details</a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </div>
                @endforeach
                @endif

            </div>
            @if ($artist->songs->count() > 20)
            <div class="mt-5 text-center">
                <a href="javascript:void(0);" data-type="artist" data-limit="20" data-quantity="20"
                    data-id="{{ $artist->id }}" data-load="song" class="btn btn-primary btn-load-more">
                    <div class="btn__wrap">
                        <i class="ri-loader-3-fill"></i> <span>Load more</span>
                    </div>
                </a>
            </div>
            @endif
        </div>
    </div>



    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">
                Related <span class="text-primary">Artists</span>
            </h3>
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="6" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($otherArtist->count() == 0)
                    <p>no artis.</p>
                    @else
                    @foreach ($otherArtist as $item)
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
            </div>
            <div class="swiper-button-prev btn-default rounded-pill"></div>
            <div class="swiper-button-next btn-default rounded-pill"></div>
        </div>
    </div>
</div>
@endsection