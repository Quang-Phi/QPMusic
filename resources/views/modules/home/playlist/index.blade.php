@extends('modules.home.master')

@section('li_9','active')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/L8G6pXBK/analytics.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head align-items-center"><span
                class="d-block pe-3 fs-6 fw-semi-bold">{{$playlists->count()}}
                Playlist in the list</span>
        </div>
        <div class="list list--lg playlist-list">
            @if ($playlists->isEmpty())
            <span class="playlists-create">
                <a href="javascript:void(0);" class="nav-link d-flex align-items-center @yield('li_6')">
                    <i class="ri-mv-line"></i>
                    <span class="ps-3">Create Playlist</span>
                </a>
            </span>
            @else
            @foreach ($playlists ->take(10) as $playlist)
            @php
            $img = $playlist->img_url == null || !file_exists(public_path('img/playlist/' . $playlist->img_url)) ?
            $playlist->img_url : asset('img/playlist/' . $playlist->img_url);
            $playlist = App\Models\Playlist::find($playlist->id);
            $songs = $playlist
            ->songs()
            ->where('status', '<>', '3')
                ->get();
                @endphp
                <div class="list__item">
                    <a href="{{ route('home.playlist-details', ['id' => $playlist->id]) }}" class="list__cover"><img
                            src="{{ $img }}" alt="" /></a>
                    <div class="list__content">
                        <a href="{{ route('home.playlist-details', ['id' => $playlist->id]) }}"
                            class="list__title text-truncate">{{ $playlist->name }}</a>
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
                        <li class="dropstart d-inline-flex">
                            <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-sm">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('home.playlist-details', ['id' => $playlist->id]) }}">View
                                        details</a>
                                </li>
                                <li> <a class="dropdown-item playlist_delete"
                                        onclick="return confirm('Are you sure you want to delete this playlist?');"
                                        href="{{route('home.delete-playlist', ['id' => $playlist->id])}}"
                                        role="button">Delete</a> </li>

                            </ul>
                        </li>
                    </ul>
                </div>
                @endforeach
                @endif

        </div>
        @if ($playlists->count() > 10)
        <div class="mt-5 text-center">
            <a href="javascript:void(0);" data-type="playlist" data-limit="10" data-quantity="10" data-load="playlist"
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