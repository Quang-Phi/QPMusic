@extends('modules.home.master')

@section('li_2','active')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/2S18MvW7/event.jpg)"></div>
@endsection

@section('content')
@php
$img = $genre->img_url == null || !file_exists(public_path('img/genre/' . $genre->img_url)) ?
$genre->img_url : asset('img/genre/' . $genre->img_url);
@endphp
<div class="under-hero container">
    <div class="section">
        <div class="row align-items-center">
            <div class="col-xl-3 col-md-4">
                <div class="cover cover--round">
                    <div class="cover__image">
                        <img src="{{ $img }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="col-1 d-none d-xl-block"></div>
            <div class="col-md-8 mt-5 mt-md-0">
                <div class="d-flex flex-wrap mb-2">
                    <span class="text-dark fs-4 fw-semi-bold pe-2 capitalize">{{ $genre->name }}</span>

                </div>
                <ul class="info-list info-list--dotted mb-3">
                    <li>Genre</li>
                    <li>{{ $songs->count() }} Songs</li>
                </ul>
                <p class="mb-3">
                    Artist:
                    @php
                    $artists = [];
                    $artistNames = [];
                    foreach ($songs as $song) {
                    foreach ($song->artists as $item) {
                    if (!in_array($item->name, $artistNames)) {
                    $artistNames[] = $item->name;
                    $artists[] = $item;
                    }
                    }
                    }
                    $showArtist = collect($artists)->take(5);
                    if (count($artists)) {
                    foreach ($showArtist as $key => $item) {
                    echo '<a href="' . route('home.artist-details', ['id' => $item->id]) . '"
                        class="text-dark fw-medium capitalize">' . $item->name . '</a>';
                    if ($key != count($showArtist) - 1) {
                    echo ', ';
                    } elseif (count($artists) >= 5 && $key == 4) {
                    echo ' & many other Artists.';
                    }
                    }
                    } else {
                    echo 'No Artist Found.';
                    }
                    @endphp
                </p>

                <p>Desctiption: {{ $genre->description }}</p>

                <ul class="info-list">
                    <li>
                        <div class="d-flex align-items-center">
                            <button type="button" data-collection-play-id="{{$genre->id}}" 
                                id="play_all"
                                class="btn btn-icon btn-primary rounded-pill" 
                                data-type="genre"
                                data-id="{{ $genre->id }}" 
                                {{ !$songs->count() ? 'disabled' : '' }}
                                >
                                <i class="ri-play-fill icon-play"></i>
                                <i class="ri-pause-fill icon-pause"></i>
                            </button>
                            <label for="play_all" class="ps-2 fw-semi-bold text-primary mb-0"
                                style="cursor: pointer">Play</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="section__head capitalize">
            <h3 class="mb-0">{{ $genre->name }}</h3>
        </div>
        <div style="display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        column-gap: 20px;row-gap: 0px;" class="list list-genre-songs"
            data-collection-song-id="{{ $genre->id }}">
            @if ($songs->isEmpty())
            <p class="empty">No Song Available</p>
            @else
            @foreach ($songs->take(20) as $song)
            @php
            $img = $song->img_url == null || !file_exists(public_path('img/song/' . $song->img_url)) ?
            $song->img_url : asset('img/song/' . $song->img_url);
            @endphp
            @php
            $favorite = App\Models\Favorite::where('song_id', $song->id)->first();
            @endphp
            <div class="list__item" data-song-id="{{  $song->id }}" data-song-name="{{  $song->name }}"
                data-song-artist="{{ implode(', ', $song->artists->pluck('name')->toArray()) }}" data-song-album=""
                data-song-url="{{ asset('music/' .  $song->url) }}" data-song-cover="{{ $img }}">
                <div class="list__cover">
                    <img src="{{ $img }}" alt="" />
                    <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                        data-play-id="{{  $song->id }}" aria-label="Play pause"><i class="ri-play-fill icon-play"></i>
                        <i class="ri-pause-fill icon-pause"></i></button>
                </div>
                <div class="list__content">
                    <a href="{{ route('home.song-details', ['id' =>  $song->id]) }}"
                        class="capitalize list__title text-truncate">{{ $song->name }}</a>
                    <p class="cover__subtitle text-truncate">
                        @foreach ( $song->artists->take(3) as $index => $artist)
                        <a class="capitalize text-dark"
                            href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                            {{ $artist->name }}</a>
                        @if ($index !== $song->artists->count() - 1)
                        ,
                        @endif
                        @if ( $song->artists->count() > 3 && $index == 2)
                        ...
                        @endif
                        @endforeach
                    </p>
                </div>
                <ul class="list__option">
                    <li class="icon-fvr">
                        <label class="add-fvr" data-type="song" data-favorite-id="{{  $song->id }}"
                            for="song[{{  $song->id }}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                id="song[{{  $song->id }}]">
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
                                    data-play-id="{{  $song->id }}">Play</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-queue-id="{{  $song->id }}">Add to queue</a>
                            </li>
                            <li class="item-playlist">
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-song-id-item="{{  $song->id }}">Add to
                                    Playlist</a>
                                <div class="sub-menu-2">
                                    <span class="create"><a data-change="false" data-song-id-item={{ $song->id}}
                                            class="dropdown-item" href="javascript:void(0)">Create New
                                            Playlist</a></span>
                                    <ul>
                                        @foreach ($playlists as $playlist)
                                        <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                            {{ $song->id}} class="dropdown-item"><a href="javascript:void(0)">{{
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
                                <a class="dropdown-item" href="{{route('home.song-details',['id'=>$song->id])}}"
                                    role="button">View details</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
        @if ($genre->songs->count() > 20)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="genre" data-limit="20" data-quantity="20"
                data-id="{{ $genre->id }}" data-load="song" class="btn btn-primary btn-load-more">
                <div class="btn__wrap">
                    <i class="ri-loader-3-fill"></i> <span>Load more</span>
                </div>
            </a>
        </div>
        @endif
    </div>
    <div class="section">
        <div class="section__head">
            <h3 class="mb-0">
                Discover <span class="text-primary">Genres</span>
            </h3>
        </div>
        <div class="swiper-carousel">
            <div class="swiper" data-swiper-slides="4" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($otherGenres->isEmpty())
                    <p>No Genre Available</p>
                    @else
                    @foreach ($otherGenres as $item)
                    @php
                    $img = $item->img_url == null || !file_exists(public_path('img/genre/' . $item->img_url)) ?
                    $item->img_url : asset('img/genre/' . $item->img_url);
                    @endphp
                    <div class="swiper-slide">
                        <div class="cover cover--round">
                            <a href="{{ route('home.genre-details', ['id' => $item->id]) }}" class="cover__image"><img
                                    src="{{ $img }}" alt="" />
                                <div class="cover__image__content">
                                    <span class="cover__title mb-1 fs-6 text-truncate">{{ $item->name }}</span>
                                </div>
                            </a>
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