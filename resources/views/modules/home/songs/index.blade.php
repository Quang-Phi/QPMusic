@extends('modules.home.master')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/DyyzQRyD/song.jpg)"></div>
@endsection

@section('content')
<div class="under-hero container">
    <div class="section">
        <div class="section__head align-items-center">
            <span class="d-block pe-3 fs-6 fw-semi-bold">5240 Songs in the list</span>
            <div>
                <select class="form-select" aria-label="Filter song">
                    <option value="A to Z">A to Z</option>
                    <option value="Z to A">Z to A</option>
                </select>
            </div>
        </div>
        <div style="display: grid;
            grid-template-columns: repeat(2, 1fr);
            column-gap: 20px;row-gap: 0px;" class="list">
            @if ($songs->count() == 0)
            <p>no song.</p>
            @else
            @foreach ($songs as $item)
            @php
            $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
            $item->img_url : asset('img/song/' . $item->img_url);
            @endphp
            @php
            $favorite = App\Models\Favorite::where('song_id', $item->id)->first();
            @endphp
            <div class="list__item" data-song-id="{{ $item->id }}" data-song-name="{{ $item->name }}"
                data-song-artist="{{ $item->artist_name }}" data-song-album=""
                data-song-url="{{ asset('music/' . $item->url ) }}" data-song-cover="{{ $img }}">
                <div class="list__cover">
                    <img src="{{ $img }}" alt="" />
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                        data-play-id="{{ $item->id }}" aria-label="Play pause"><i class="ri-play-fill icon-play"></i>
                        <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content">
                    <a href="{{ route('home.song-details', ['id' => $item->id]) }}"
                        class="capitalize list__title text-truncate">{{ $item->name }}</a>
                    <p class="cover__subtitle text-truncate">
                        @foreach ($item->artists as $index => $artist)
                        <a class="capitalize" href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                            {{ $artist->name }}</a>
                        @if ($index !== $item->artists->count() - 1)
                        ,
                        @endif
                        @endforeach
                    </p>
                </div>
                <ul class="list__option">
                    <li><a href="javascript:void(0);" role="button" class="add-fvr add-fvr-song d-inline-flex"
                            aria-label="Favorite" data-favorite-id="{{ $item->id }}" data-type="song">
                            @if ($favorite)
                            <i class="ri-heart-fill heart-fill active"></i>
                            <i class="ri-heart-line heart-empty"></i>
                            @else
                            <i class="ri-heart-fill heart-fill"></i>
                            <i class="ri-heart-line heart-empty active"></i>
                            @endif
                        </a>
                    </li>
                    <li>{{ $item->duration }}</li>
                    <li class="dropstart d-inline-flex">
                        <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                            aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-queue-id="{{ $item->id }}">Add to queue</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-play-id="{{ $item->id }}">Play</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="mt-5 text-center">
        <a href="javascript:void(0);" class="btn btn-primary">
            <div class="btn__wrap">
                <i class="ri-loader-3-fill"></i> <span>Load more</span>
            </div>
        </a>
    </div>
</div>
@endsection