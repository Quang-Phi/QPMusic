@extends('modules.home.master')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/Pr35SKCq/home.jpg)">
</div>
@endsection

@section('li_1')
active
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">New to listen</span>
                <h3 class="mb-0">
                    New <span class="text-primary">Releases</span>
                </h3>
            </div>
            {{-- <a href="{{ route('home.songs') }}" class="btn btn-link">View All</a> --}}
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($songs->isEmpty())
                        <p class="empty">No Song Available</p>
                    @else
                    @foreach ($songs as $item)
                    @php
                        $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                        $item->img_url : 
                        asset('img/song/' . $item->img_url);
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
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-download-id="{{ $item->id }}">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{route('home.song-details',['id'=>$item->id])}}"
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
    <div class="row">
        <div class="section col-xl-6">
            <div class="section__head">
                <div class="flex-grow-1">
                    <span class="section__subtitle">Best choice</span>
                    <h3 class="mb-0">
                        Upcoming <span class="text-primary">Songs </span>
                    </h3>
                </div>

            </div>
            <div class="swiper-carousel">
                <div class="swiper" data-swiper-slides="2" data-swiper-autoplay="true">
                    <div class="swiper-wrapper">
                        @if ($comingsongs->isEmpty())
                        <p class="empty">No Song Available</p>
                        @else
                        @foreach ($comingsongs as $item)
                        @php
                        $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                        $item->img_url : asset('img/song/' . $item->img_url);
                        @endphp
                        @php
                        $favorite = App\Models\Favorite::where('song_id', $item->id)->where('user_id',$user
                        ->id)->first();
                        @endphp
                        <div class="swiper-slide">
                            <div class="cover cover--round">
                                <div class="cover__image">
                                    <img src="{{ $img }}" alt="Unknown" />
                                </div>
                                <div class="cover__foot">
                                    <p class="cover__title text-truncate capitalize">{{ $item->name }}</p>
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
                                    <p>Release on: {{ $item->release_date?$item->release_date:'Coming soon.' }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-1"></div>
        <div class="section col-xl-5">
            <div class="mat-tabs">
                <ul class="nav nav-tabs" id="songs_list" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active capitalize" id="4u" data-tab-nav="1">
                            Song suggestions
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link capitalize" id="played" data-tab-nav="2">
                            Freshly heard tracks
                        </button>
                    </li>

                </ul>
            </div>
            <div class="tab-content mt-4" id="songs_list_content">
                <div class="tab-pane fade active show" data-tab-content="1">
                    <div style="display:block;" class="list">
                        @if ($songSuggests->isEmpty())
                        <p class="empty">No Song Available</p>
                        @else
                        @foreach ($songSuggests->take(6) as $item)
                        @php
                        $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                        $item->img_url : asset('img/song/' . $item->img_url);
                        @endphp
                        @php
                        $favorite = App\Models\Favorite::where('song_id', $item->id)->where('user_id',$user
                        ->id)->first();
                        @endphp
                        <div class="list__item" data-song-id="{{ $item->id }}" data-song-name="{{ $item->name }}"
                            data-song-artist="{{ implode(', ', $item->artists->pluck('name')->toArray()) }}"
                            data-song-album="{{ $item->album_id }}" data-song-url="{{ asset('music/' . $item->url ) }}"
                            data-song-cover="{{ $img }}">
                            <div class="list__cover"><img src="{{ $img }}" alt="Shack your butty">
                                <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                    data-play-id="{{ $item->id }}" aria-label="Play pause"><i
                                        class="ri-play-fill icon-play"></i> <i
                                        class="ri-pause-fill icon-pause"></i></button>
                            </div>
                            <div class="list__content"><a href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                    class="list__title text-truncate">{{ $item->name }}</a>
                                <p class="cover__subtitle text-truncate">
                                    @foreach ($item->artists->take(3) as $index => $artist)
                                    <a class="capitalize text-dark"
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
                            <ul class="list__option">
                                <li class="icon-fvr">
                                    <label class="add-fvr" data-type="song" data-favorite-id="{{ $item->id }}"
                                        for="song[{{ $item->id }}]">
                                        <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                            class="like" id="song[{{ $item->id }}]">
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
                                <li>{{ $item->duration }}</li>
                                <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);"
                                        role="button" data-bs-toggle="dropdown" aria-label="Cover options"
                                        aria-expanded="false"><i class="ri-more-fill"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-play-id="{{  $item->id }}">Play</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-queue-id="2">
                                                Add to queue
                                            </a>
                                        </li>
                                        <li class="item-playlist">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-song-id="{{ $item->id }}">Add to
                                                Playlist</a>
                                            <div class="sub-menu-2">
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
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-download-id="{{ $item->id }}">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                                role="button">View details</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="recent_pane" data-tab-content="2">
                    <div style="display:block;" class="list">
                        @if ($playedSongs->isEmpty())
                        <p class="empty">No Song Available</p>
                        @else
                        @foreach ($playedSongs->take(6) as $item)
                        @php
                        $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                        $item->img_url : asset('img/song/' . $item->img_url);
                        @endphp
                        @php
                        $favorite = App\Models\Favorite::where('song_id', $item->id)->where('user_id',$user
                        ->id)->first();
                        @endphp
                        <div class="list__item" data-song-id="{{ $item->id }}" data-song-name="{{ $item->name }}"
                            data-song-artist="{{ implode(', ', $item->artists->pluck('name')->toArray()) }}"
                            data-song-album="{{ $item->album_id }}" data-song-url="{{ asset('music/' . $item->url ) }}"
                            data-song-cover="{{ $img }}">
                            <div class="list__cover"><img src="{{ $img }}" alt="{{ $item->name }}">
                                <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                    data-play-id="{{ $item->id }}" aria-label="Play pause"><i
                                        class="ri-play-fill icon-play"></i> <i
                                        class="ri-pause-fill icon-pause"></i></button>
                            </div>
                            <div class="list__content"><a href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                    class="list__title text-truncate">{{ $item->name }}</a>
                                <p class="cover__subtitle text-truncate">
                                    @foreach ($item->artists->take(3) as $index => $artist)
                                    <a class="capitalize text-dark text-truncate"
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
                            <ul class="list__option">
                                <li class="icon-fvr">
                                    <label class="add-fvr" data-type="song" data-favorite-id="{{ $item->id }}"
                                        for="song[{{ $item->id }}]">
                                        <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                            class="like" id="song[{{ $item->id }}]">
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
                                <li>{{ $item->duration }}</li>
                                <li class="dropstart d-inline-flex"><a class="dropdown-link" href="javascript:void(0);"
                                        role="button" data-bs-toggle="dropdown" aria-label="Cover options"
                                        aria-expanded="false"><i class="ri-more-fill"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-sm">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-play-id="{{  $item->id }}">Play</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-queue-id="2">
                                                Addto queue
                                            </a>
                                        </li>
                                        <li class="item-playlist">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-song-id="{{ $item->id }}">Add to
                                                Playlist</a>
                                            <div class="sub-menu-2">
                                                <span class="create"><a data-change="false"
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
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-download-id="{{ $item->id }}">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('home.song-details', ['id' => $item->id]) }}"
                                                role="button">View details</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                            $('button.nav-link').click(function() {
                                $idTab = $(this).data('tab-nav');
                                $panes = $('.tab-pane');
                                $tabPane = $('.tab-pane[data-tab-content="' + $idTab + '"]');
                                $panes.removeClass('active show');
                                $tabPane.addClass('active show');
                            })
                        })
                </script>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">Best to listen</span>
                <h3 class="mb-0">
                    Most liked <span class="text-primary">Songs</span> of the <span
                        class="text-primary">Month</span>
                </h3>
            </div>
        </div>

        {{-- carousell --}}
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($songsOrderbyLike->isEmpty())
                    <p class="empty">No Song Available</p>
                    @else
                    @foreach ($songsOrderbyLike as $song)
                    @php
                    $img = $song->img_url == null || !file_exists(public_path('img/song/' .
                    $song->img_url)) ?
                    $song->img_url : asset('img/song/' . $song->img_url);
                    @endphp
                    @php
                    $favorite = App\Models\Favorite::where('song_id', $song->id)->where('user_id',$user
                    ->id)->first();
                    @endphp
                    <div class="swiper-slide">
                        <div class="cover cover--round" data-song-id="{{ $song->id }}"
                            data-song-name="{{ $song->name }}"
                            data-song-artist="{{ implode(', ', $song->artists->pluck('name')->toArray()) }}"
                            data-song-album="{{ $song->album_id }}" data-song-url="{{ asset('music/' . $song->url)}}"
                            data-song-cover="{{ $img }}">
                            <div class="cover__head">
                                <ul class="cover__label d-flex">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $song->id }}"
                                            for="song[{{ $song->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                                class="like" id="song[{{ $song->id }}]">
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
                                                data-play-id="{{  $song->id }}">Play</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-queue-id="{{ $song->id }}">Add to
                                                queue</a>
                                        </li>
                                        <li class="item-playlist">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-song-id="{{ $song->id }}">Add to
                                                Playlist</a>
                                            <div class="sub-menu">
                                                <span class="create"><a {{$playlists->isEmpty()?'':'style=border-bottom:
                                                        1px solid #dbdbdb;'}} data-change="false"
                                                        data-song-id-item={{$song->id}}
                                                        class="dropdown-item" href="javascript:void(0)">Create New
                                                        Playlist</a></span>
                                                <ul>
                                                    @foreach ($playlists as $playlist)
                                                    <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                                        {{$song->id}} class="dropdown-item"><a
                                                            href="javascript:void(0)">{{
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
                                                href="{{ route('home.song-details', ['id' => $song->id]) }}"
                                                role="button">View details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cover__image">
                                <img src="{{ $img }}" alt="Unknown" />
                                <button type="button" class="btn btn-play btn-default btn-icon rounded-pill btn-play"
                                    data-play-id="{{ $song->id }}">
                                    <i class="ri-play-fill icon-play"></i>
                                    <i class="ri-pause-fill icon-pause"></i>
                                </button>
                            </div>
                            <div class="cover__foot">
                                <a href="{{ route('home.song-details', ['id' => $song->id]) }}"
                                    class="cover__title text-truncate capitalize">{{ $song->name }}</a>

                                <p class="cover__subtitle text-truncate">
                                    @foreach ($song->artists->take(3) as $index => $artist)
                                    <a class="capitalize"
                                        href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                                        {{ $artist->name }}</a>
                                    @if ($index !== $song->artists->count() - 1)
                                    ,
                                    @endif
                                    @if ($song->artists->count() >= 3 && $index == 2)
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

    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">Best to listen</span>
                <h3 class="mb-0">
                    Most rated <span class="text-primary">Songs</span> of the <span
                        class="text-primary">Month</span>
                </h3>
            </div>
        </div>

        {{-- carousell --}}
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="5" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($songsOrderbyRate->isEmpty())
                    <p class="empty">No Song Available</p>
                    @else
                    @foreach ($songsOrderbyRate as $songRate)
                    @php
                    $img = $songRate->img_url == null || !file_exists(public_path('img/song/' .
                    $songRate->img_url)) ?
                    $songRate->img_url : asset('img/song/' . $songRate->img_url);
                    @endphp
                    @php
                    $favorite = App\Models\Favorite::where('song_id', $songRate->id)->where('user_id',$user
                    ->id)->first();
                    @endphp
                    <div class="swiper-slide">
                        <div class="cover cover--round" data-song-id="{{ $songRate->id }}"
                            data-song-name="{{ $songRate->name }}"
                            data-song-artist="{{ implode(', ', $songRate->artists->pluck('name')->toArray()) }}"
                            data-song-album="{{ $songRate->album_id }}"
                            data-song-url="{{ asset('music/' . $songRate->url)}}" data-song-cover="{{ $img }}">
                            <div class="cover__head">
                                <ul class="cover__label d-flex">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $songRate->id }}"
                                            for="song[{{ $songRate->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox"
                                                class="like" id="song[{{ $songRate->id }}]">
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
                                                data-play-id="{{  $songRate->id }}">Play</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-queue-id="{{ $songRate->id }}">Add to
                                                queue</a>
                                        </li>
                                        <li class="item-playlist">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-song-id="{{ $songRate->id }}">Add to
                                                Playlist</a>
                                            <div class="sub-menu">
                                                <span class="create"><a {{$playlists->isEmpty()?'':'style=border-bottom:
                                                        1px solid #dbdbdb;'}} data-change="false"
                                                        data-song-id-item={{$songRate->id}}
                                                        class="dropdown-item" href="javascript:void(0)">Create New
                                                        Playlist</a></span>
                                                <ul>
                                                    @foreach ($playlists as $playlist)
                                                    <li data-playlist-id={{ $playlist->id }} data-song-id-item =
                                                        {{$songRate->id}} class="dropdown-item"><a
                                                            href="javascript:void(0)">{{
                                                            $playlist->name }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="item-download">
                                            <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                data-download-id="{{ $songRate->id }}">Download</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('home.song-details', ['id' => $songRate->id]) }}"
                                                role="button">View details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="cover__image">
                                <img src="{{ $img }}" alt="Unknown" />
                                <button type="button" class="btn btn-play btn-default btn-icon rounded-pill btn-play"
                                    data-play-id="{{ $songRate->id }}">
                                    <i class="ri-play-fill icon-play"></i>
                                    <i class="ri-pause-fill icon-pause"></i>
                                </button>
                            </div>
                            <div class="cover__foot">
                                <a href="{{ route('home.song-details', ['id' => $songRate->id]) }}"
                                    class="cover__title text-truncate capitalize">{{ $songRate->name }}</a>

                                <p class="cover__subtitle text-truncate">
                                    @foreach ($songRate->artists->take(3) as $index => $artist)
                                    <a class="capitalize"
                                        href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                                        {{ $artist->name }}</a>
                                    @if ($index !== $songRate->artists->count() - 1)
                                    ,
                                    @endif
                                    @if ($songRate->artists->count() >= 3 && $index == 2)
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

    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">Best to listen</span>
                <h3 class="mb-0">
                    Featured <span class="text-primary">Artists</span>
                </h3>
            </div>
            <a href="{{ route('home.artists') }}" class="btn btn-link">View All</a>
        </div>
        <div class="swiper-carousel swiper-carousel-button">
            <div class="swiper" data-swiper-slides="6" data-swiper-autoplay="true">
                <div class="swiper-wrapper">
                    @if ($artistsOrderbyRate->isEmpty())
                    <p class="empty">No Artist Available</p>
                    @else
                    @foreach ($artistsOrderbyRate as $item)
                    @php
                    $img = $item->img_url == null || !file_exists(public_path('img/artist/' . $item->img_url)) ?
                    $item->img_url : asset('img/artist/' . $item->img_url);
                    @endphp
                    <div class="swiper-slide">
                        <div class="avatar avatar--xxl d-block text-center">
                            <div class="avatar__image">
                                <a href="{{ route('home.artist-details', ['id' => $item->id]) }}"><img src="{{ $img }}"
                                        alt="IMG Artist" /></a>
                            </div>
                            <a href="{{ route('home.artist-details', ['id' => $item->id]) }}"
                                class="avatar__title mt-3 capitalize">{{ $item->name }}</a>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="section">
        <div class="section__head">
            <div class="flex-grow-1">
                <span class="section__subtitle">COLLECTION TO LISTEN</span>
                <h3 class="mb-0">
                    Top <span class="text-primary">Albums</span>
                </h3>
            </div>
            <a href="{{ route('home.albums') }}" class="btn btn-link">View All</a>
        </div>
        <div class="list list--lg list--order">
            @if ($albumsOrderbyRate->isEmpty())
            <p class="empty">No Album Available</p>
            @else
            @foreach ($albumsOrderbyRate as $album)
            @php
            $img = $album->img_url == null || !file_exists(public_path('img/album/' . $album->img_url)) ?
            $album->img_url : asset('img/album/' . $album->img_url);
            @endphp
            @php
            $favorite = App\Models\Favorite::where('album_id', $album->id)->where('user_id',$user ->id)->first();
            @endphp
            <div class="list__item">
                <a href="{{ route('home.album-details', ['id' => $album->id]) }}" class="list__cover"><img
                        src="{{ $img }}" alt="" /></a>
                <div class="list__content">
                    <a href="{{ route('home.album-details', ['id' => $album->id]) }}"
                        class="list__title text-truncate">{{ $album->name }}</a>
                    <p class="cover__subtitle text-truncate">
                        @php
                        $artists = [];
                        $artistNames = [];
                        foreach ($album->songs as $song) {
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
    </div>
</div>
@endsection