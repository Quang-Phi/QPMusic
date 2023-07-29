@extends('modules.admin.master')
@section('genres', 'open')
@section('genre-link-1', 'active')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Genre Details</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.genres.all') }}">Genres</a>
                    </li>
                    <li class="active">
                        <strong>Genre Details</strong>
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
                    $img = $genre->img_url == null || !file_exists(public_path('img/genre/' . $genre->img_url))
                    ?$genre->img_url : asset('img/genre/' . $genre->img_url);
                    @endphp
                    <div class="text-center col-md-3 col-sm-4 col-xs-12">
                        <div class="uprofile-image">
                            <img src="{{ $img }}" class="img-responsive" />
                        </div>
                        <div class="uprofile-name">
                            <h3>
                                <a href="javascript:void(0)">{{ $genre->name }}</a>
                                <span class="uprofile-status online"></span>
                            </h3>
                            <p class="uprofile-title"></p>
                        </div>
                        <p class="text-center text-profile">{{ $genre->description }}
                        </p>
                        @if ($genre->description)
                        <div>
                            <a class="read-more" href="javascript:void(0)">See more</a>
                        </div>
                        @endif
                        <a style="margin: auto;" class="btn my-3 button"
                            href="{{ route('admin.genres.edit', ['id' => $genre->id]) }}">
                            <span class="button_lg">
                                <span class="edit-btn button_sl"></span>
                                <span class="button_text">Edit</span>
                            </span>
                        </a>
                    </div>
                    <div class="col-md-9 col-sm-8 col-xs-12">
                        <table id="my-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>IMG</th>
                                    <th>Artist</th>
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
                ajax: '{{ route('admin.genres.data-genre-details', ['id' => $genre->id]) }}',
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
                        data: 'albums',
                        name: 'albums',
                        render: function(data) {
                            if (data) {
                                let albumHtml = '';
                                Object.keys(data).forEach(function(album) {
                                    albumHtml +=
                                        '<a class="" href="{{ route('admin.albums.details', ['id' => ':id']) }}">:name</a>, '
                                        .replace(':id', album)
                                        .replace(':name', data[album]);
                                });
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

        })
</script>
@endsection