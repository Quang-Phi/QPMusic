@extends('modules.home.master')

@section('li_8','active')


@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/DyyzQRyD/song.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head capitalize">
            <div class="flex-grow-1">
                <span class="section__subtitle">best of listened</span>
                <h3 class="mb-0">
                    History <span class="text-primary">Song</span>
                </h3>

            </div>
        </div>
        <div style="display: grid;
                grid-template-columns: repeat(2, 1fr);
                column-gap: 20px;row-gap: 0px;" class="list list-history-songs">
            @if (!$songsWithRelativeTime)
            <p>The history Songs list is empty.</p>
            @else
            @foreach (array_slice($songsWithRelativeTime, 0, 20) as $item)
            @php
            $img = $item['song']->img_url == null || !file_exists(public_path('img/song/' . $item['song']->img_url)) ?
            $item['song']->img_url : asset('img/song/' . $item['song']->img_url);
            $favorite = App\Models\Favorite::where('song_id', $item['song']->id)->where('user_id',$user ->id)->first();
            @endphp
            <div class="list__item" data-song-id="{{ $item['song']->id }}" data-song-name="{{ $item['song']->name }}"
                data-song-artist="{{ $item['song']->artist_name }}" data-song-album=""
                data-song-url="{{ asset('music/' . $item['song']->url) }}" data-song-cover="{{ $img }}">
                <div class="list__cover">
                    <img src="{{ $img }}" alt="" />
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                        data-play-id="{{ $item['song']->id }}" aria-label="Play pause"><i
                            class="ri-play-fill icon-play"></i>
                        <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content">
                    <a href="{{ route('home.song-details', ['id' => $item['song']->id]) }}"
                        class="capitalize list__title text-truncate">{{ $item['song']->name }}</a>
                    <p class="cover__subtitle text-truncate">
                        @foreach ($item['song']->artists->take(3) as $index => $artist)
                        <a class="capitalize text-dark"
                            href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                            {{ $artist->name }}</a>
                        @if ($index !== $item['song']->artists->count() - 1)
                        ,
                        @endif
                        @if ($item['song']->artists->count() >= 3 && $index == 2)
                        ...
                        @endif
                        @endforeach
                    </p>
                </div>
                <ul class="list__option">
                    <li class="relative_time">{{ $item['relative_time'] }}</li>
                    <li class="icon-fvr">
                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $item['song']->id }}"
                            for="song[{{ $item['song']->id }}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                id="song[{{ $item['song']->id }}]">
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
                    <li>{{ $item['song']->duration }}</li>
                    <li class="dropstart d-inline-flex">
                        <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                            aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-play-id="{{ $item['song']->id }}">Play</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-queue-id="{{ $item['song']->id }}">Add to queue</a>
                            </li>
                            <li class="item-playlist">
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-song-id-item="{{ $item['song']->id }}">Add to
                                    Playlist</a>
                                <div class="sub-menu-2">
                                    <span class="create"><a data-change="false" data-song-id-item={{$item['song']->id}}
                                            class="dropdown-item" href="javascript:void(0)">Create New
                                            Playlist</a></span>
                                    <ul>
                                        @foreach ($playlists as $playlist)
                                        <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                            {{$item['song']->id}} class="dropdown-item"><a href="javascript:void(0)">{{
                                                $playlist->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="item-download">
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-download-id="{{ $item['song']->id }}">Download</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('home.song-details', ['id' => $item['song']->id]) }}"
                                    role="button">View details</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
        @if (count($songsWithRelativeTime) > 20)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="history" data-limit="20" data-quantity="20"
                data-id="{{ $user->id }}" data-load="song" class="btn btn-primary btn-load-more">
                <div class="btn__wrap">
                    <i class="ri-loader-3-fill"></i> <span>Load more</span>
                </div>
            </a>
        </div>
        @endif
    </div>
    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">best of listened</span>
                <h3 class="mb-0">
                    History <span class="text-primary">Album</span>
                </h3>

            </div>
        </div>
        <div class="swiper-carousel swiper-carousel-button album-wraper">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if (!$albumsWithRelativeTime)
                    <p> The history Albums list is empty.</p>
                    @else
                    @foreach ($albumsWithRelativeTime as $album)
                    @php
                    $img = $album['album']->img_url == null || !file_exists(public_path('img/artist/' .
                    $album['album']->img_url)) ?
                    $album['album']->img_url : asset('img/artist/' . $album['album']->img_url);
                    $favorite = App\Models\Favorite::where('album_id', $album['album']->id)->where('user_id',$user
                    ->id)->first();
                    @endphp
                    <div class="swiper-slide" data-album-id="{{ $album['album']->id }}">
                        <div class="cover cover--round">
                            <div class="cover__head">
                                <ul class="cover__label d-flex">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="album"
                                            data-favorite-id="{{ $album['album']->id }}"
                                            for="album[{{ $album['album']->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                                class="like" id="album[{{ $album['album']->id }}]">
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
                                                data-collection-play-id="{{ $album['album']->id }}" data-type="album"
                                                data-id="{{ $album['album']->id }}">Play</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('home.album-details', ['id' => $album['album']->id]) }}">View
                                                details</a></li>
                                    </ul>
                                </div>
                            </div><a href="{{ route('home.album-details', ['id' => $album['album']->id]) }}"
                                class="cover__image"><img src="{{ $img }}" alt=""></a>
                            <div class="cover__foot">
                                <a href="{{ route('home.album-details', ['id' => $album['album']->id]) }}"
                                    class="cover__title text-truncate">{{ $album['album']->name }}</a>
                                <p>{{ $album['relative_time'] }}</p>
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