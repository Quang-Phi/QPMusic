@extends('modules.home.master')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/DyyzQRyD/song.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        @php
        $img = $song->img_url == null || !file_exists(public_path('img/song/' . $song->img_url)) ?
        $song->img_url : asset('img/song/' . $song->img_url);
        $favorite = App\Models\Favorite::where('song_id', $song->id)->where('user_id',$user ->id)->first();
        @endphp
        <div class="row" data-song-id="{{ $song->id }}" data-song-name="{{ $song->name }}"
            data-song-artist="{{ implode(', ', $song->artists->pluck('name')->toArray()) }}" data-song-album=""
            data-song-url="{{ asset('music/' . $song->url) }}" data-song-cover="{{ $img }}">
            <div class="col-xl-3 col-md-4">
                <div class="cover cover--round">
                    <div class="cover__image">
                        <img src="{{ $img }}" alt="{{ $song->name }}" />
                    </div>
                </div>
            </div>
            <div class="col-1 d-none d-xl-block"></div>
            <div class="col-md-8 mt-5 mt-md-0">
                <div class="d-flex flex-wrap mb-2">
                    <span class="capitalize text-dark fs-4 fw-semi-bold pe-2">{{ $song->name }}</span>
                    <div class="dropstart d-inline-flex ms-auto">
                        <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                            aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-play-id="{{  $song->id }}">Play</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="8">Add
                                    to queue</a>
                            </li>
                            <li class="item-playlist">
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-song-id="{{ $song->id }}">Add to
                                    Playlist</a>
                                <div style="left: -112%;
                                top: -38px;" class="sub-menu">
                                    <span class="create"><a {{$playlists->isEmpty()?'':'style=border-bottom:
                                            1px solid #dbdbdb;'}} data-change="false"
                                            data-song-id-item={{$song->id}}
                                            class="dropdown-item" href="javascript:void(0)">Create New
                                            Playlist</a></span>
                                    <ul>
                                        @foreach ($playlists as $p_list)
                                        <li data-playlist-id={{ $p_list->id }} data-song-id-item =
                                            {{$song->id}} class="dropdown-item"><a href="javascript:void(0)">{{
                                                $p_list->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="item-download">
                                <a class="dropdown-item" href=" javascript:void(0);" data-download-id="{{ $song->id }}"
                                    role="button">Download</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home.song-details', ['id' => $song->id]) }}"
                                    role="button">View details</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="capitalize info-list info-list--dotted mb-3">
                    <li>
                        @foreach ($song->genres->take(2) as $index => $item)
                        {{ $item->name }}
                        @if (count($song->genres) > 2 &&$index !== $song->genres->count() - 1)
                        ,
                        @endif
                        @if (count($song->genres) > 2 &&$index == 1 )
                        ...
                        @endif
                        @endforeach
                    </li>
                    <li>{{ $song->duration }}</li>
                    @if ($song->release_date)
                    <li>{{ $song->release_date }}</li>
                    @endif
                </ul>
                <div class="mb-4">
                    <p class="mb-2">
                        Musician:
                        <span class="capitalize text-dark fw-medium">{{ $song->musician }}</span>
                    </p>
                    <p class="cover__subtitle text-truncate">
                        Artist:
                        @php
                        $artists = [];
                        $artistNames = [];
                        foreach ($song->artists->take(3) as $item) {
                        if (!in_array($item->name, $artistNames)) {
                        $artistNames[] = $item->name;
                        $artists[] = $item;
                        }
                        }
                        if ($artists) {
                        foreach (collect($artists)->take(5) as $key => $item) {
                        echo '<a href="' . route('home.artist-details', ['id' => $item->id]) . '"
                            class="text-dark fw-medium capitalize">' . $item->name . '</a>';
                        if ($key != count($artists) - 1) {
                        echo ', ';
                        }
                        if (count($artists) >= 5 && $key == 4) {
                        echo ' & many other Artists.';
                        }
                        }
                        } else {
                        echo 'No Artist Found';
                        }
                        @endphp
                    </p>
                </div>
                <ul class="info-list mb-5">
                    <li>
                        <div class="d-flex align-items-center">
                            <button type="button" id="play_all" class="btn btn-icon btn-primary rounded-pill"
                                data-play-id="{{ $song->id }}">
                                <i class="ri-play-fill icon-play"></i>
                                <i class="ri-pause-fill icon-pause"></i>
                            </button>

                            <label for="play_all" class="ps-2 fw-semi-bold text-primary mb-0"
                                style="cursor: pointer">Play</label>
                        </div>
                    </li>
                    <li class="icon-fvr">
                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $song->id }}"
                            for="song[{{ $song->id }}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                id="song[{{ $song->id }}]">
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
                            <span class="sub-count">{{ $songLikesStarLastMonth }} <i
                                    class="ri-heart-fill text-danger"></i> / last month
                            </span>
                        </span>
                    </li>
                    <li class="icon-rate">
                        <a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-end"
                            aria-label="rating">
                            <div class="d-flex align-items-end">
                                <i class="ri-star-fill text-warning"></i>
                                <span class="ps-2 fw-medium">{{$songReviewsStar}}</span>
                                <span class="count">
                                    <span>{{$songReviewsQuantity->count()}} reviews</span>
                                    <span class="sub-count">{{ $songReviewsStarLastMonth }} <i
                                            class="ri-star-fill text-warning"></i> / last month
                                    </span>
                                </span>
                            </div>
                        </a>
                        <div id="reviews">
                            <form method="post" action="{{route('home.review',['id'=>$song->id])}}">
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
                                <input type="hidden" name="type" value="song">
                                <input class="w-100" type="submit" value="send">
                            </form>

                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-end"
                            aria-label="Download"><i class="ri-download-2-line"></i>
                            <span class="ps-2 fw-medium">{{$songDownloads}}</span></a>
                    </li>

                </ul>
                <div class="mt-2">
                    <span class="d-block text-dark fs-6 fw-semi-bold mb-3">Lyrics</span>
                    {{ $song->lyric }}
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">
                Related <span class="text-primary">Songs</span>
            </h3>
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($otherSongs->count() == 0)
                    <p>no song</p>
                    @else
                    @foreach ($otherSongs as $item)
                    @php
                    $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                    $item->img_url : asset('img/song/' . $item->img_url);
                    @endphp
                    @php
                    $favorite = App\Models\Favorite::where('song_id', $item->id)->where('user_id',$user ->id)->first();
                    @endphp
                    <div class="swiper-slide">
                        <div class="cover cover--round" data-song-id="{{ $item->id }}"
                            data-song-name="{{ $item->name }}"
                            data-song-artist="{{ implode(', ', $item->artists->pluck('name')->toArray()) }}"
                            data-song-album="{{ $item->album_id }}" data-song-url="{{ asset('music/' . $item->url ) }}"
                            data-song-cover="{{ $img }}">
                            <div class="cover__head">
                                <ul class="cover__label d-flex">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $item->id }}"
                                            for="song[{{ $item->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                                class="like" id="song[{{ $item->id }}]">
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
                                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                            class="ri-more-2-fill"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-play-id="{{  $item->id }}">Play</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-queue-id="{{ $item->id }}">Add to
                                                queue</a>
                                        </li>
                                        <li class="item-playlist">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-song-id="{{ $item->id }}">Add to
                                                Playlist</a>
                                            <div class="sub-menu">
                                                <span class="create"><a {{$playlists->isEmpty()?'':'style=border-bottom:
                                                        1px solid #dbdbdb;'}} data-change="false"
                                                        data-song-id-item={{$item->id}}
                                                        class="dropdown-item" href="javascript:void(0)">Create New
                                                        Playlist</a></span>
                                                <ul>
                                                    @foreach ($playlists as $playlist)
                                                    <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                                        {{$item->id}} class="dropdown-item"><a
                                                            href="javascript:void(0)">{{
                                                            $playlist->name }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="item-download">
                                            <a class="dropdown-item"
                                                href=" javascript:void(0);"
                                                data-download-id="{{ $item->id }}"
                                                role="button">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                                role="button">View details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cover__image">
                                <img src="{{ $img }}" alt="Unknown" />
                                <button type="button" class="btn btn-play btn-default btn-icon rounded-pill"
                                    data-play-id="{{ $item->id }}">
                                    <i class="ri-play-fill icon-play"></i>
                                    <i class="ri-pause-fill icon-pause"></i>
                                </button>
                            </div>
                            <div class="cover__foot">
                                <a href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                    class="cover__title text-truncate capitalize">{{ $item->name }}</a>

                                <p class="cover__subtitle text-truncate">
                                    @foreach ($item->artists->take(3) as $index => $artist)
                                    <a class="capitalize"
                                        href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                                        {{ $artist->name }}</a>
                                    @if ($index !== $item->artists->count() - 1)
                                    ,
                                    @endif
                                    @if ($item->artists->count() >= 3 && $index == 2)
                                    ...
                                    @endif
                                    @endforeach
                                </p>
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
</div>
@endsection