@extends('modules.admin.master')
@section('artists', 'open')
@section('artist-link-1', 'active')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Artist Details</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.artists.all') }}">Artists</a>
                    </li>
                    <li class="active">
                        <strong>Artist Details</strong>
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
                    $img = $artist->img_url == null || !file_exists(public_path('img/artist/' . $artist->img_url)) ?
                    $artist->img_url : asset('img/artist/' . $artist->img_url);
                    $favorite = App\Models\Favorite::where('artist_id', $artist->id)->where('user_id',$user->id)->first();
                    @endphp
                    <div class="text-center col-md-3 col-sm-4 col-xs-12">
                        <div class="uprofile-image">
                            <img src="{{ $img }}" class="img-responsive" />
                        </div>
                        <div class="uprofile-name">
                            <h3>
                                <a href="#">{{ $artist->name }}</a>
                                <span class="uprofile-status online"></span>
                            </h3>
                            <ul class="info-list">
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

                        @if ($artist->bio)
                        <p class="text-center text-profile">
                            {{ $artist->bio }}
                        </p>
                        <div>
                            <a class="read-more" href="javascript:void(0)">See more</a>
                        </div>
                        @else
                        <p class="text-center text-profile">
                            No description
                        </p>
                        @endif
                        <a style="margin: auto;" class="btn my-3 button"
                            href="{{ route('admin.artists.edit', ['id' => $artist->id]) }}">
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
                                    <th>Album</th>
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
                ajax: '{{ route('admin.artists.data-artist-details', ['id' => $artist->id]) }}',
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
                                let imgSrc = "{{ asset('img/artist') }}/" + data;
                                let http = new XMLHttpRequest();
                                http.open('HEAD', imgSrc, false);
                                http.send();
                                if (data === null || http.status == 404) {
                                return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                            } else {
                                return '<img src="' + "{{ asset('img/artist') }}/" + data +
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
                                    genreHtml += '<a href = "{{route("admin.genres.details", ["id" => ':id'])}}">:name</a>, '
                                    .replace(':id',genre)
                                    .replace(':name',data[genre]);
                                })
                                return genreHtml.slice(0, -2);
                            } else {
                                return '';
                            }
                        }
                    },
                    {
                        data: 'albums',
                        name: 'albums',
                        render: function(data) {
                            if (data) {
                                let albumHtml = '';
                                Object.keys(data).forEach(function(album) {
                                    albumHtml += '<a href = "{{route("admin.albums.details", ["id" => ':id'])}}">:name</a>, '
                                    .replace(':id',album)
                                    .replace(':name',data[album]);
                                })
                                return albumHtml.slice(0, -2);
                                
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

            $(document).on('click', '.delete-song-btn', function(event) {
                event.preventDefault();
                let deleteUrl = $(this).data('url');
                let songID = $(this).data('id');
                let artistID = $(this).data('artist-id');
                confirmDelete(deleteUrl, artistID, songID);
            });

            function confirmDelete(deleteUrl, artistID, songID) {
                if (confirm("Do you want to remove the Song from the Artist?")) {
                    const dialog = $('<dialog>');
                    dialog.html(`
                        <form method="dialog">
                            <p>Select change with this Song:</p>
                            <label>
                                <input type="radio" name="relatedSongs" value="1"> Remove this Song from the Artist.
                            </label>
                            <label>
                                <input type="radio" name="relatedSongs" value="2"> Change the Artist of this Song.
                            </label>
                            <menu>
                                <button class = "btn btn-success" value="confirm">Confirm</button>
                                <button class = "btn btn-primary" value="cancel">Cancel</button>
                            </menu>
                        </form>
                    `);
                    dialog.find('form').on('submit', (event) => {
                        event.preventDefault();
                    });

                    dialog.find('button[value="confirm"]').on('click', () => {
                        const formData = new FormData(dialog.find('form')[0]);
                        const relatedSongs = formData.get('relatedSongs');
                        if (relatedSongs === '1') {
                            if (confirm(
                                    "Are you sure you want to remove the Song from this Artist? If the Song does not belong to any other Artist, it will be completely deleted!"
                                )) {
                                window.location.href = deleteUrl;
                            }
                        } else if (relatedSongs === '2') {
                            const newDialog = $('<dialog>');
                            const contentArtist = $('<div>').attr({
                                style: 'display:flex;flex-direction: column;justify-content: center;'
                            });
                            let checkedArtists = [];
                            $.ajax({
                                url: "{{ route('admin.artists.change-song-artist', ['id' => ':artistID']) }}"
                                    .replace(':artistID', artistID),
                                success: function(data) {
                                    let p = $('<p>').text(
                                        'Choose new Artist for this song:');
                                    $(data).each(function(index, item) {
                                        const inputArtist = $('<input>').attr({
                                            type: 'checkbox',
                                            name: "artist",
                                            id: `artist[${item.id}]`,
                                            value: `${item.id}`,
                                        }).change(function() {
                                            let inputName = $(this).attr(
                                                'name');
                                            let inputId = $(this).val();
                                            if ($(this).is(':checked')) {
                                                if (!checkedArtists.find(
                                                        artist => artist ===
                                                        inputId)) {
                                                    checkedArtists.push(
                                                        inputId);
                                                }
                                            } else {
                                                checkedArtists = checkedArtists
                                                    .filter(item => item !==
                                                        inputId);
                                            }
                                        });
                                        const label = $('<label>').attr({
                                            for: `artist[${item.id}]`,
                                        }).text(`${item.name}`);
                                        const checkboxDiv = $('<div>').append(
                                            inputArtist, label);

                                        contentArtist.append(checkboxDiv);
                                    });
                                    const menu = $('<menu>');
                                    const btnConfirm = $('<button>').attr({
                                        value: 'confirm',
                                        class: "btn btn-success"
                                    }).text('Confirm');
                                    const btnCancel = $('<button>').attr({
                                        value: 'cancel',
                                        class: "btn btn-primary ms-1"
                                    }).text('Cancel');
                                    menu.append(btnConfirm, btnCancel);
                                    contentArtist.append(menu);


                                    const newDialog = $('<dialog>');
                                    newDialog.append(p, contentArtist);

                                    newDialog.find('form').on('submit', (event) => {
                                        event.preventDefault();
                                    });
                                    newDialog.find('button[value="confirm"]').on('click',
                                        () => {
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ route('admin.artists.update-one-song-artist', ['artist_id' => ':artistID', 'song_id' => ':songID']) }}"
                                                    .replace(':artistID', artistID)
                                                    .replace(':songID', songID),
                                                data: {
                                                    checkedArtists: checkedArtists,
                                                    _token: '{{ csrf_token() }}'

                                                },
                                                success: function() {
                                                    window.location.href =
                                                        "{{ route('admin.artists.details', ['id' => ':artistID']) }}"
                                                        .replace(':artistID',
                                                            artistID);
                                                }

                                            });


                                            newDialog.get(0).close();
                                        });

                                    newDialog.find('button[value="cancel"]').on('click', () => {
                                        newDialog.get(0).close();
                                    });

                                    $('body').append(newDialog);
                                    newDialog.get(0).showModal();
                                },
                                error: function(error) {
                                    console.error(error);
                                }
                            });
                            newDialog.append(contentArtist);
                        } else {}
                        dialog.get(0).close();
                    });

                    dialog.find('button[value="cancel"]').on('click', () => {
                        dialog.get(0).close();
                    });

                    $('body').append(dialog);
                    dialog.get(0).showModal();
                } else {
                    // Không xóa thể loại
                }
            }
        })
</script>
@endsection