@extends('modules.admin.master')
@section('songs', 'open')
@section('content')
<section class="wrapper main-wrapper" style=''>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Song Details</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.songs.all') }}">Songs</a>
                    </li>
                    <li class="active">
                        <strong>Song Details</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12">
        <div class="section">
            @php
            $img = $song->img_url == null || !file_exists(public_path('img/song/' . $song->img_url)) ? $song->img_url :
            asset('img/song/' . $song->img_url);
            $favorite = App\Models\Favorite::where('song_id', $song->id)->where('user_id',$user ->id)->first();
            @endphp
            <div class="row" data-song-id="{{ $song->id }}" data-song-name="{{ $song->name }}" data-song-artist=""
                data-song-album="" data-song-url="{{ asset('music/' . $song->url) }}" data-song-cover="{{ $img }}">

                <div class="col-xl-3 col-md-4">
                    <div class="cover cover--round">
                        <div class="cover__image">
                            <img src="{{ $img }}" alt="{{ $song->name }}" />
                        </div>
                        <div style="text-align:center;" class="cover__info">
                            @if ($song->description)
                            <p class="text-center text-profile mt-3">
                                {{ $song->description }}</p>
                            <div>
                                <a class="read-more" href="javascript:void(0)">See more</a>
                            </div>
                            @else
                            <p class="text-center text-profile mt-3">No description.</p>
                            @endif
                            <a style="margin: auto;" class="btn my-3 button"
                                href="{{ route('admin.songs.edit', ['id' => $song->id]) }}">
                                <span class="button_lg">
                                    <span class="edit-btn button_sl"></span>
                                    <span class="button_text">Edit</span>
                                </span>
                            </a>;
                        </div>
                    </div>
                </div>
                <div class="col-1 d-none d-xl-block"></div>
                <div class="col-md-8 mt-5 mt-md-0">
                    <div class="d-flex flex-wrap mb-2">
                        <span class="text-dark fs-4 fw-semi-bold pe-2 capitalize">{{ $song->name }}</span>

                    </div>
                    <ul class="info-list info-list--dotted mb-3">
                        <li class="capitalize">
                            @if ($song->genres -> isEmpty() )
                            <p>null</p>
                            @else
                            @foreach ($song->genres as $index => $item)
                            <a href="{{ route('admin.genres.details', ['id' => $item->id]) }}">
                                {{ $item->name }}
                                @if ($index !== $song->genres->count() - 1)
                                ,&nbsp
                                @endif
                            </a>
                            @endforeach
                            @endif
                        </li>
                        <li>{{ $song->duration }}</li>
                        {{-- <li>Apr 14, 2019</li> --}}
                        {{-- <li>Travers Music Company</li> --}}
                    </ul>
                    <div class="mb-4">
                        <p class="mb-2">
                            Musician:
                            <span class="text-dark fw-medium capitalize">{{ $song->musician }}</span>
                        </p>
                        <p class="mb-2">
                            Artist:
                            @if ($song->artists -> isEmpty() )
                            &nbsp;Null
                            @else
                            @foreach ($song->artists as $index => $artist)
                            <a class="capitalize" href="{{ route('admin.artists.details', ['id' => $artist->id]) }}">
                                {{ $artist->name }}</a>
                            @if ($index !== $song->artists->count() - 1)
                            ,&nbsp
                            @else
                            .
                            @endif
                            @endforeach
                            @endif
                        </p>
                        <p class="mb-2">
                            Album:
                            @if ($song->albums -> isEmpty() )
                            &nbsp;Null
                            @else
                            @foreach ($song->albums as $index => $album)
                            <a class="capitalize" href="{{ route('admin.albums.details', ['id' => $album->id]) }}">
                                {{ $album->name }}</a>
                            @if ($index !== $song->albums->count() - 1)
                            ,&nbsp
                            @else
                            .
                            @endif
                            @endforeach
                            @endif
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
                        <li id="downloads">
                            <a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-end"
                                aria-label="Download"><i class="ri-download-2-line"></i>
                                <span class="ps-2 fw-medium">{{$songDownloads}}</span></a>
                        </li>
                    </ul>
                    <div class="mt-2">
                        <span class=" d-block text-dark fs-6 fw-semi-bold mb-3">Lyrics</span>
                        <span class="text-lyric">
                            {!! nl2br(e($song->lyric)) !!}
                        </span>
                        <a class="lyric-more" href="javascript:void(0)">See more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection