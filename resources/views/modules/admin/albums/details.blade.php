@extends('modules.admin.master')
@section('albums', 'open')
@section('album-link-1', 'active')
@section('content')
    <section class="wrapper main-wrapper" style=''>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">Album Details</h1>
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.albums.all') }}">Albums</a>
                        </li>
                        <li class="active">
                            <strong>Album Details</strong>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-lg-12">
            <section class="box nobox">
                <div class="content-body">
                    <div class="row">
                        @php
                            $img = $album->img_url == null || !file_exists(public_path('img/album/' . $album->img_url)) ? $album->img_url : asset('img/album/' . $album->img_url);
                            $favorite = App\Models\Favorite::where('album_id', $album->id)->where('user_id',$user ->id)->first();
                        @endphp
                        <div class="text-center col-md-3 col-sm-4 col-xs-12">
                            <div class="uprofile-image">
                                <img src="{{ $img }}" class="img-responsive" />
                            </div>
                            <div class="uprofile-name">
                                <h3>
                                    <a href="#">{{ $album->name }}</a>
                                    <span class="uprofile-status online"></span>
                                </h3>
                                <ul class="info-list">
                                    <li class="icon-fvr">
                                        <label class="add-fvr" data-type="album" data-favorite-id="{{ $album->id }}"
                                            for="album[{{ $album->id }}]">
                                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                                id="album[{{ $album->id }}]">
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
                                            <span class="sub-count">{{ $albumLikesStarLastMonth }} <i
                                                    class="ri-heart-fill text-danger"></i> / last month
                                            </span>
                                        </span>
                                    </li>
                                    <li class="icon-rate">
                                        <a href="javascript:void(0);" role="button" class="text-dark d-flex align-items-end"
                                            aria-label="rating">
                                            <div class="d-flex align-items-end">
                                                <i class="ri-star-fill text-warning"></i>
                                                <span class="ps-2 fw-medium">{{$albumReviewsStar}}</span>
                                                <div class="sub-rating">
                                                    <span class="count"> <span>{{ $albumReviewsQuantity->count() }} reviews</span>
                                                        <span class="sub-count">{{ $albumReviewsStarLastMonth }} <i
                                                                class="ri-star-fill text-warning"></i> / last month</span></span>
                                                </div>
                                            </div>
                                        </a>
                                        <div id="reviews">
                                            <form method="post" action="{{route('home.review',['id'=>$album->id])}}">
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
                                                <input type="hidden" name="type" value="album">
                                                <input class="w-100" type="submit" value="send">
                                            </form>
                
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            @if ($album->description)
                                <p class="text-center text-profile">
                                    {{ $album->description }}
                                </p>
                            @endif
                            <div>
                                <a class="read-more" href="javascript:void(0)">See more</a>
                            </div>

                            <a style="margin: auto;" class="btn my-3 button"
                                href="{{ route('admin.albums.edit', ['id' => $album->id]) }}">
                                <span class="button_lg">
                                    <span class="edit-btn button_sl"></span>
                                    <span class="button_text">Edit</span>
                                </span>
                            </a>;
                        </div>
                        <div class="col-md-9 col-sm-8 col-xs-12">
                            <table id="my-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>IMG</th>
                                        <th>Genre</th>
                                        <th>Artist</th>
                                        <th>Description</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </section>
    <script>
        $(document).ready(function() {
            $('#my-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.albums.data-albums-details', ['id' => $album->id]) }}',
                columns: [{
                        data: 'id',
                        name: 'songs.id'
                    },
                    {
                        data: 'name',
                        name: 'songs.name'
                    },
                    {
                        data: 'img_url',
                        name: 'songs.img_url',
                        render: function(data) {
                            let isLink = data.startsWith('http');
                            if(!isLink) {
                                let imgSrc = "{{ asset('img/song') }}/" + data;
                                let http = new XMLHttpRequest();
                                http.open('HEAD', imgSrc, false);
                                http.send();
                                if (data === null || http.status == 404) {
                                return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                            } else {
                                return '<img src="' + "{{ asset('img/song') }}/" + data +
                                    '" width="75" height="75">';
                            }
                            } else {
                                return '<img src="' + data + '" width="75" height="75">';
                            }
                        }
                    },

                    {
                        data: 'genres',
                        name: 'genres',
                        render: function(data) {
                            if (data) {
                                let genreHtml = '';
                                Object.keys(data).forEach(function(genre) {
                                    genreHtml +=
                                    '<a class="" href="{{ route('admin.genres.details', ['id' => ':id']) }}">:name</a>, '
                                        .replace(':id', genre)
                                        .replace(':name', data[genre]);
                                });
                                return genreHtml.slice(0, -2);
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'artists',
                        name: 'artists',
                        render: function(data) {
                            if (data) {
                                let artistHtml = '';
                                Object.keys(data).forEach(function(artist) {
                                    artistHtml +=
                                    '<a class="" href="{{ route('admin.artists.details', ['id' => ':id']) }}">:name</a>, '
                                        .replace(':id', artist)
                                        .replace(':name', data[artist]);
                                });
                                return artistHtml.slice(0, -2);
                                
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'description',
                        name: 'songs.description'
                    },
                    {
                        data: 'delete',
                        name: ''
                    },

                ]
            });
        }).responsive.recalc();
    </script>
@endsection
