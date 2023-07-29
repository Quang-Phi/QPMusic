@extends('modules.home.master')

@section('li_6','active')

@section('item-' . $playlist->id,'active')

@section('hero')
<div class="hero" style="background-image: url(https://i.postimg.cc/DyyzQRyD/song.jpg)"></div>
@endsection
@section('content') <div class="under-hero container">
    <div class="section">
        <div class="row align-items-center">
            <div class="col-xl-3 col-md-4">
                @php $imgplaylist = $playlist->img_url == null ||
                !file_exists(public_path('img/playlist/' . $playlist->img_url)) ?
                $playlist->img_url : asset('img/playlist/' . $playlist->img_url); @endphp <div
                    class="cover cover--round">
                    <div class="cover__image custom_avt"> <img src="{{ $imgplaylist }}" alt="" /> </div>
                </div>
            </div>
            <div class="col-1 d-none d-xl-block"></div>
            <div class="col-md-8 mt-5 mt-md-0">
                <div class="d-flex flex-wrap mb-2"> <span style="cursor: pointer;"
                        class="text-dark fs-4 fw-semi-bold pe-2 playlist_name">{{ $playlist->name }}</span>
                    <div class="dropstart d-inline-flex ms-auto"> <a class="dropdown-link" href="javascript:void(0);"
                            role="button" data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li> <a class="dropdown-item playlist_name" href="javascript:void(0);"
                                    role="button">Edit</a> </li>
                            <li> <a class="dropdown-item playlist_delete" onclick="return confirm('Are you sure you want to delete this playlist?');" href="{{route('home.delete-playlist', ['id' => $playlist->id])}}"
                                    role="button">Delete</a> </li>
                        </ul>
                    </div>
                </div>
                <ul class="info-list info-list--dotted mb-3">
                    <li>Playlist</li>
                    <li class="count">{{ $songs->count() }} Songs</li>
                </ul>
                <ul class="info-list list-control {{ $songs->count() == 0 ? 'd-none' : '' }}">
                    <li>
                        <button type="button" id="play_all" class="btn btn-icon btn-primary rounded-pill"
                            data-type="playlist" data-id="{{ $playlist->id }}"
                            data-collection-play-id="{{ $playlist->id }}">
                            <i class="ri-play-fill icon-play"></i>
                            <i class="ri-pause-fill icon-pause"></i>
                        </button> <label for="play_all" class="ps-2 fw-semi-bold text-primary mb-0"
                            style="cursor: pointer">Play</label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section playlist-songs">
        <div class="section__head">
            <div class="flex-grow-1">
                <h3 class="mb-0">All <span class="text-primary">Songs</span></h3> <span style="display:block;"
                    class="section__subtitle">of - {{ $playlist->name }} -</span>
            </div>
        </div>
        <div style="display: grid;
                grid-template-columns: repeat(2, 1fr);
                column-gap: 20px;row-gap: 0px;" class="list list-playlist-songs"
            data-collection-song-id="{{ $playlist->id }}">
            @if (!$songsWithRelativeTime)
            <p class="empty">No Song Available</p>
            @else
            @foreach (array_slice($songsWithRelativeTime, 0, 20) as $song)
            @php
            $img = $song['song']->img_url == null || !file_exists(public_path('img/song/' . $song['song']->img_url)) ?
            $song['song']->img_url : asset('img/song/' . $song['song']->img_url);
            $favorite = App\Models\Favorite::where('song_id', $song['song']->id)->where('user_id',$user ->id)->first();
            @endphp

            <div class="list__item" data-song-id="{{ $song['song']->id }}" data-song-name="{{ $song['song']->name }}"
                data-song-artist="{{ implode(', ', $song['song']->artists->pluck('name')->toArray()) }}"
                data-song-album="" data-song-url="{{ asset('music/' . $song['song']->url) }}"
                data-song-cover="{{ $img }}">
                <div class="list__cover">
                    <img src="{{ $img }}" alt="" />
                    <a href="javascript:void(0);" class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                        data-play-id="{{ $song['song']->id }}" aria-label="Play pause"><i
                            class="ri-play-fill icon-play"></i>
                        <i class="ri-pause-fill icon-pause"></i></a>
                </div>
                <div class="list__content">
                    <a href="{{ route('home.song-details', ['id' => $song['song']->id]) }}"
                        class="capitalize list__title text-truncate">{{ $song['song']->name }}</a>
                    <p class="cover__subtitle text-truncate">
                        @foreach ($song['song']->artists->take(3) as $index => $artist)
                        <a class="capitalize text-dark"
                            href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                            {{ $artist->name }}</a>
                        @if ($index !== $song['song']->artists->count() - 1)
                        ,
                        @endif
                        @if ($song['song']->artists->count() >= 3 && $index == 2)
                        ...
                        @endif
                        @endforeach
                    </p>
                </div>
                <ul class="list__option">
                    <li class="icon-fvr">
                        <label class="add-fvr" data-type="song" data-favorite-id="{{ $song['song']->id }}"
                            for="song[{{ $song['song']->id }}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                id="song[{{ $song['song']->id }}]">
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
                    <li>{{ $song['song']->duration }}</li>
                    <li class="dropstart d-inline-flex">
                        <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                            aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-play-id="{{  $song['song']->id }}">Play</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-queue-id="{{ $song['song']->id }}">Add to
                                    queue</a>
                            </li>
                            <li class="item-remove-playlist">
                                <a class="dropdown-item" href="javascript:void(0);"
                                    data-song-id-item={{$song['song']->id}}
                                    data-playlist-id={{ $playlist->id }}
                                    role="button">Remove from
                                    playlist</a>
                            </li>
                            <li class="item-playlist">
                                <a class="dropdown-item" href="javascript:void(0);" role="button"
                                    data-song-id-item="{{ $song['song']->id }}">Add to
                                    Playlist</a>
                                <div class="sub-menu-2">
                                    <span class="create"><a {{$playlists->isEmpty()?'':'style=border-bottom:
                                            1px solid #dbdbdb;'}} data-change="false"
                                            data-song-id-item={{$song['song']->id}}
                                            class="dropdown-item" href="javascript:void(0)">Create New
                                            Playlist</a></span>
                                    <ul>
                                        @foreach ($playlists as $p_list)
                                        <li data-playlist-id={{ $p_list->id }} data-song-id-item =
                                            {{$song['song']->id}} class="dropdown-item"><a href="javascript:void(0)">{{
                                                $p_list->name }}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="item-download">
                                <a data-download-id="{{ $song['song']->id }}" class="dropdown-item"
                                    href="javascript:void(0);" role="button">Download</a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('home.song-details', ['id' => $song['song']->id]) }}"
                                    role="button">View
                                    details</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            @endforeach
            @endif
        </div>
        @if (count($songsWithRelativeTime) > 20)
        <div class="mt-5 text-center"> <a href="javascript:void(0);" data-type="playlist" data-id="{{ $playlist->id }}"
                data-limit="20" data-quantity="20" data-load="song" class="btn btn-primary btn-load-more">
                <div class="btn__wrap"> <i class="ri-loader-3-fill"></i> <span>Load more</span> </div>
            </a> </div>
        @endif
    </div>
    @if (!$songSuggests->isEmpty())
    <section class="section suggest ">
        <div class="section__head">
            <div class="flex-grow-1">
                <h3 class="mb-0">Song <span class="text-primary">Suggest</span></h3> <span style="display:block;"
                    class="section__subtitle">for - {{ $playlist->name }} -</span>
            </div>
        </div>
        <div class="suggest-list">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); column-gap: 20px;row-gap: 0px;"
                class="list list-suggest-songs">
                @foreach ($songSuggests ->take(20) as $item)
                @php $img = $item->img_url == null || !file_exists(public_path('img/song/' . $item->img_url)) ?
                $item->img_url : asset('img/song/' . $item->img_url);
                $favorite = App\Models\Favorite::where('song_id', $item->id)->where('user_id',$user ->id)->first();
                @endphp
                <div class="list__item" data-song-id="{{ $item->id }}" data-song-name="{{ $item->name }}"
                    data-song-artist="{{ implode(', ', $item->artists->pluck('name')->toArray()) }}" data-song-album=""
                    data-song-url="{{ asset('music/' . $item->url ) }}" data-song-cover="{{ $img }}">
                    <div class="list__cover"> <img src="{{ $img }}" alt="" /> <button
                            class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="{{ $item->id }}"
                            aria-label="Play pause"><i class="ri-play-fill icon-play"></i> <i
                                class="ri-pause-fill icon-pause"></i></button> </div>
                    <div class="list__content"> <a href="{{ route('home.song-details', ['id' => $item->id]) }}"
                            class="capitalize list__title text-truncate">{{ $item->name }}</a>
                        <p class="cover__subtitle text-truncate">
                            @foreach ($item->artists->take(3) as $index => $artist)
                            <a class="capitalize text-dark"
                                href="{{ route('home.artist-details', ['id' => $artist->id]) }}">
                                {{ $artist->name }}</a>
                            @if ($index !== $item->artists->count() - 1)
                            ,
                            @endif @if ($item->artists->count() >= 3 && $index == 2)
                            ...
                            @endif
                            @endforeach
                        </p>
                    </div>
                    <ul class="list__option">
                        <li class="icon-fvr"> <label class="add-fvr" data-type="song" data-favorite-id="{{ $item->id }}"
                                for="song[{{ $item->id }}]">
                                <input {{ $favorite ? 'checked' : '' }} title="like" type="checkbox" class="like"
                                    id="song[{{ $item->id }}]">
                                <div class="checkmark"> <svg viewBox="0 0 24 24" class="outline"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                        </path>
                                    </svg> <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                        </path>
                                    </svg> <svg class="celebrate" width="100" height="100"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <polygon points="10,10 20,20" class="poly"></polygon>
                                        <polygon points="10,50 20,50" class="poly"></polygon>
                                        <polygon points="20,80 30,70" class="poly"></polygon>
                                        <polygon points="90,10 80,20" class="poly"></polygon>
                                        <polygon points="90,50 80,50" class="poly"></polygon>
                                        <polygon points="80,80 70,70" class="poly"></polygon>
                                    </svg> </div>
                            </label> </li>
                        <li>{{ $item->duration }}</li>
                        <li class="dropstart d-inline-flex"> <a class="dropdown-link" href="javascript:void(0);"
                                role="button" data-bs-toggle="dropdown" aria-label="Cover options"
                                aria-expanded="false"><i class="ri-more-fill"></i></a>
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
                                <li class="item-remove-playlist">
                                    <a class="dropdown-item" href="javascript:void(0);" data-song-id-item={{$item->id}}
                                        data-playlist-id={{ $playlist->id }}
                                        role="button">Remove from
                                        playlist</a>
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
                                            @foreach ($playlists as $p_list)
                                            <li data-playlist-id={{ $p_list->id }} data-song-id-item =
                                                {{$item->id}} class="dropdown-item"><a href="javascript:void(0)">{{
                                                    $p_list->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li class="item-download">
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        data-download-id="{{ $item->id }}" role="button">Download</a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('home.song-details', ['id' => $item->id]) }}" role="button">View
                                        details</a>
                                </li>
                            </ul>
                        </li>
                        <li><button data-id-playlist={{ $playlist->id }} data-id-suggest={{ $item->id }}
                                class="btn btn-submit btn-add-suggest">Thêm</button></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
<script>
    $(document).ready(function() {
        $('.playlist_name').on('click', function() {
            const dialog = $('<dialog>');
            dialog.html(
                ` <form action="{{ route('home.update-playlist', ['id' => $playlist->id]) }}" 
                    method="post" enctype="multipart/form-data"> @csrf <div class = "form-title"> 
                        <h3> Edit your playlist. </h3> </div> <div class="form-container"> 
                            <div class="form-photo upload-img"> <label for="img-playlist"> 
                                <span class="upload-img-title avatar__image custom_avt"> 
                                    <img src="{{ $imgplaylist }}" alt="playlist img"> </span>
                                     <input id="img-playlist" type="file" hidden name="img_url"> 
                                     </label> </div> <div class="form-content d-flex"> 
                                        <div class="form-group"> 
                                            <input class="form-control" name="name" autofocus type="text" value="{{ $playlist->name }}"> 
                                            </div> 
                                            <textarea class="form-control" name="description" id="" cols="30" rows="5" placeholder="Description.."></textarea> 
                                            <menu> <button type="submit" class="btn btn-submit">Submit</button> </menu> </div> </div> </form> `
            );
            $('body').append(dialog);
            dialog.get(0).showModal();
            dialog.find('.btn-submit').on('click', function() {
                $value = $(this).attr('value');
                $id = $(this).data('id');
                if ($value == 'confirm') {}
            });
            dialog.find('form').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let formData = new FormData(form[0]);
                $.ajax({
                    type: "post",
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        toastr.success('Update Playlist successfully', 'Success');
                        dialog.get(0).close();
                        $('.playlist_name.pe-2').text(data.name);
                        $('.nav-item.active a').text(data.name);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            let errors = JSON.parse(xhr.responseText);
                            $.each(errors.errors, function(field, messages) {
                                let inputElement = $('dialog input');
                                let formGroup = inputElement.closest(
                                    '.form-group');
                                inputElement.addClass('is-invalid');
                                formGroup.addClass('has-error');
                            });
                        }
                    }
                });
            })
        })
    });

    $('body').on('click', function() {
        const input = $('#img-playlist');
        const image = $('.custom_avt img');
        input.on('change', function() {
            const file = input[0].files[0];
            const reader = new FileReader();
            reader.addEventListener('load', function() {
                image.attr('src', reader.result);
            });
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    });
    
    $(document).ready(function() {
        let playlistSongs = $('.list-playlist-songs');
        let contentSongSuggest = $('.suggest-list');
        $(".btn-add-suggest").on("click", function() {
            let idPlaylist = $(this).data("id-playlist");
            let idSuggest = $(this).data("id-suggest");
            $.ajax({
                type: "post",
                url: "{{ route('home.add-song-to-playlist', [':idPlaylist', ':idSuggest']) }}"
                    .replace(":idPlaylist", idPlaylist)
                    .replace(":idSuggest", idSuggest),
                data: {
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(data) {
                    let listControl = $(".info-list.list-control");
                    listControl.removeClass("d-none");
                    listControl
                        .find("button#play_all")
                        .prop("disabled", false)
                        .removeClass("active");
                    let song = data.song;
                    let songsInPlaylist = data.songsInPlaylist;
                    let noSong = $(".list-playlist-songs .empty");
                    let newItem = contentSongSuggest
                        .find(
                            '.list__item[data-song-id="' +
                            song.id +
                            '"]'
                        )
                        .remove();
                    newItem.find(".btn-add-suggest").parent().remove();
                    playlistSongs.find(noSong).remove();
                    if (playlistSongs.find(".list__item").length < 20) {
                        playlistSongs.prepend(newItem);
                    } else {
                        playlistSongs.prepend(newItem);
                        playlistSongs.find(".list__item").last().remove();
                        let loadMoreBtn =
                            ` <div class="mt-5 text-center"> <a href="javascript:void(0);" data-type="playlist" data-id="{{ $playlist->id }}" data-limit="20" data-quantity="20" data-load="song" class="btn btn-primary btn-load-more"> <div class="btn__wrap"> <i class="ri-loader-3-fill"></i> <span>Load more</span> </div> </a> </div> `;
                        let wrap = $(".section.playlist-songs");
                        wrap.find(".btn-load-more").remove();
                        wrap.append(loadMoreBtn);
                        $(".btn-load-more").on("click", function() {
                            $(this).addClass("loading");
                            $(this)
                                .prop("disabled", true)
                                .find("span")
                                .text("Loading...");
                            let dataType = $(this).data("type");
                            let limit = $(this).data("limit");
                            let quantity =
                                $(this).attr("data-quantity");
                            let dataId = $(this).data("id");
                            let dataLoad = $(this).data("load");
                            let csrfToken = $(
                                'meta[name="csrf-token"]'
                            ).attr("content");
                            let quantityLoad =
                                parseInt(quantity) + parseInt(limit);
                            $.ajax({
                                type: "get",
                                url: "/home/load-more",
                                data: {
                                    dataType: dataType,
                                    quantityLoad: quantityLoad,
                                    dataId: dataId,
                                    dataLoad: dataLoad,
                                    _token: csrfToken,
                                },
                                dataType: "json",
                                success: function(response) {
                                    let data = response.data;
                                    let publicFile =
                                        window.location.origin;

                                    function checkFileExists(fileUrl) {
                                        var http = new XMLHttpRequest();
                                        http.open(
                                            "HEAD",
                                            fileUrl,
                                            false
                                        );
                                        http.send();
                                        return http.status != 404;
                                    }
                                    if (!dataId) {
                                        if (dataType == "genre") {
                                            let list = $(".genre-list");
                                            $.each(
                                                data,
                                                function(
                                                    index,
                                                    element
                                                ) {
                                                    let imgUrl =
                                                        publicFile +
                                                        "/img/" +
                                                        dataLoad +
                                                        "/" +
                                                        element
                                                        .img_url;
                                                    let imgSrc =
                                                        checkFileExists(
                                                            imgUrl
                                                        ) ?
                                                        imgUrl :
                                                        "https://i.postimg.cc/KzY53psb/image.png";
                                                    if (
                                                        index >=
                                                        quantity &&
                                                        index <=
                                                        quantityLoad
                                                    ) {
                                                        list.append(
                                                            ` <div class="col-xl-3 col-sm-6 genre-item"> <div class="cover cover--round"> <a href="/home/genre-details/${element.id}" class="cover__image"> <img src="${img src}" alt="Remix"> <div class="cover__image__content"> <span class="capitalize cover__title mb-1 fs-6 text-truncate">${element.name}</span> </div> </a> </div> </div> `
                                                        );
                                                    }
                                                }
                                            );
                                            $(".btn-load-more").attr(
                                                "data-quantity",
                                                quantityLoad
                                            );
                                            $(".btn-load-more")
                                                .removeClass("loading")
                                                .find("span")
                                                .text("Load more");
                                        } else if (
                                            dataType == "album"
                                        ) {
                                            let list =
                                                $(".list.album-list");
                                            $.each(
                                                data,
                                                function(
                                                    index,
                                                    element
                                                ) {
                                                    let imgUrl =
                                                        publicFile +
                                                        "/img/" +
                                                        dataLoad +
                                                        "/" +
                                                        element
                                                        .img_url;
                                                    let imgSrc =
                                                        checkFileExists(
                                                            imgUrl
                                                        ) ?
                                                        imgUrl :
                                                        "https://i.postimg.cc/mrg9mz3N/image.png";
                                                    if (
                                                        index >=
                                                        quantity &&
                                                        index <=
                                                        quantityLoad
                                                    ) {
                                                        list.append(
                                                            ` <div class="list__item"> <a href="/home/album-details/${element.id}" class="list__cover"><img src="${img src}" alt="" /></a> <div class="list__content"> <a href="/home/album-details/${element.id}" class="list__title text-truncate">${element.name}</a> // </div> <ul class="list__option"> <li class="icon-fvr"> <label class="add-fvr" data-type="album" data-favorite-id="${element.id}" for="album[${element.id}]"> <input title="like" type="checkbox" class="like" id="album[${element.id}]"> <div class="checkmark"> <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"> </path> </svg> <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"> </path> </svg> <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg"> <polygon points="10,10 20,20" class="poly"></polygon> <polygon points="10,50 20,50" class="poly"></polygon> <polygon points="20,80 30,70" class="poly"></polygon> <polygon points="90,10 80,20" class="poly"></polygon> <polygon points="90,50 80,50" class="poly"></polygon> <polygon points="80,80 70,70" class="poly"></polygon> </svg> </div> </label> </li> <li class="dropstart d-inline-flex"> <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a> <ul class="dropdown-menu dropdown-menu-sm"> <li> <a class="dropdown-item" href="#" download>Download</a> </li> </ul> </li> </ul> </div> `
                                                        );
                                                    }
                                                }
                                            );
                                            $(".btn-load-more").attr(
                                                "data-quantity",
                                                quantityLoad
                                            );
                                            $(".btn-load-more")
                                                .removeClass("loading")
                                                .find("span")
                                                .text("Load more");
                                        } else if (
                                            dataType == "artist"
                                        ) {
                                            let list =
                                                $(".artist-list");
                                            $.each(
                                                data,
                                                function(
                                                    index,
                                                    element
                                                ) {
                                                    let imgUrl =
                                                        publicFile +
                                                        "/img/" +
                                                        dataLoad +
                                                        "/" +
                                                        element
                                                        .img_url;
                                                    let imgSrc =
                                                        checkFileExists(
                                                            imgUrl
                                                        ) ?
                                                        imgUrl :
                                                        "https://i.postimg.cc/CMqt7f1Z/image.png";
                                                    if (
                                                        index >=
                                                        quantity &&
                                                        index <=
                                                        quantityLoad
                                                    ) {
                                                        list.append(
                                                            ` <div class="col-6 col-xl-2 col-md-3 col-sm-4"> <a href="/home/artist-details/${element.id}" class="cover cover--round"> <div class="cover__image"> <img src="${img src}" alt="Artist" /> </div> <div class="cover__foot"> <span class="cover__title text-truncate"> ${element.name}</span> </div> </a> </div> `
                                                        );
                                                    }
                                                }
                                            );
                                            $(".btn-load-more").attr(
                                                "data-quantity",
                                                quantityLoad
                                            );
                                            $(".btn-load-more")
                                                .removeClass("loading")
                                                .find("span")
                                                .text("Load more");
                                        }
                                    } else if (
                                        dataId &&
                                        dataType != "favorite" &&
                                        dataType != "history"
                                    ) {
                                        let list = $(
                                            ".list-" +
                                            dataType +
                                            "-songs"
                                        );
                                        $.each(
                                            data,
                                            function(index,
                                                element) {
                                                let artists =
                                                    element.artists;
                                                let artistLinks =
                                                    "";
                                                for (
                                                    let i = 0; i <
                                                    4; i++
                                                ) {
                                                    artistLinks +=
                                                        '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                        artists[i]
                                                        .id +
                                                        '">' +
                                                        artists[i]
                                                        .name +
                                                        "</a>";
                                                    if (i != 3) {
                                                        artistLinks
                                                            +=
                                                            ", ";
                                                    }
                                                    if (i == 3) {
                                                        artistLinks
                                                            +=
                                                            "...";
                                                    }
                                                }
                                                let publicUrl =
                                                    window.location
                                                    .origin +
                                                    "/img/" +
                                                    dataLoad +
                                                    "/";
                                                let publicUrlMusic =
                                                    window.location
                                                    .origin +
                                                    "/music/" +
                                                    element.url;
                                                let imgUrl =
                                                    publicUrl +
                                                    element.img_url;
                                                let imgSrc =
                                                    checkFileExists(
                                                        imgUrl
                                                    ) ?
                                                    imgUrl :
                                                    "https://i.postimg.cc/mrg9mz3N/image.png";
                                                if (
                                                    index >=
                                                    quantity &&
                                                    index <=
                                                    quantityLoad
                                                ) {
                                                    list.append(
                                                        ` <div class="list__item" data-song-id="${element.id}" data-song-name="${element.name}" data-song-album="" data-song-url="${publicUrlMusic}" data-song-cover="${img src}"> <div class="list__cover"> <img src="${img src}" alt="" /> <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${element.id}" aria-label="Play pause"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button> </div> <div class="list__content"> <a href="/home/song-details/${element.id}" class="capitalize list__title text-truncate">${element.name}</a> <p class="cover__subtitle text-truncate"></p> </div> <ul class="list__option"> <li class="icon-fvr"> <label class="add-fvr" data-type="song" data-favorite-id="${element.id}" for="song[${element.id}]"> <input title="like" type="checkbox" class="like" id="song[${element.id}]"> <div class="checkmark"> <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"> </path> </svg> <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"> </path> </svg> <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg"> <polygon points="10,10 20,20" class="poly"></polygon> <polygon points="10,50 20,50" class="poly"></polygon> <polygon points="20,80 30,70" class="poly"></polygon> <polygon points="90,10 80,20" class="poly"></polygon> <polygon points="90,50 80,50" class="poly"></polygon> <polygon points="80,80 70,70" class="poly"></polygon> </svg> </div> </label> </li> <li>${element.duration}</li> <li class="dropstart d-inline-flex"> <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a> <ul class="dropdown-menu dropdown-menu-sm"> <li> <a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${element.id}">Add to queue</a> </li> <li> <a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${element.id}">Play</a> </li> </ul> </li> </ul> </div> `
                                                    );
                                                }
                                                $(
                                                    ".cover__subtitle"
                                                ).html(
                                                    artistLinks);
                                                $(
                                                    ".btn-load-more"
                                                ).attr(
                                                    "data-quantity",
                                                    quantityLoad
                                                );
                                                $(".btn-load-more")
                                                    .removeClass(
                                                        "loading"
                                                    )
                                                    .find("span")
                                                    .text(
                                                        "Load more"
                                                    );
                                            }
                                        );
                                        $(".btn-load-more").attr(
                                            "data-quantity",
                                            quantityLoad
                                        );
                                        $(".btn-load-more")
                                            .removeClass("loading")
                                            .prop("disabled", false)
                                            .find("span")
                                            .text("Load more");
                                    } else {
                                        let list = $(
                                            ".list-" +
                                            dataType +
                                            "-songs"
                                        );
                                        $.each(
                                            data,
                                            function(index,
                                                element) {
                                                let artists =
                                                    element["song"]
                                                    .artists;
                                                let artistLinks =
                                                    "";
                                                for (
                                                    let i = 0; i <
                                                    4; i++
                                                ) {
                                                    artistLinks +=
                                                        '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                        artists[i]
                                                        .id +
                                                        '">' +
                                                        artists[i]
                                                        .name +
                                                        "</a>";
                                                    if (i != 3) {
                                                        artistLinks
                                                            +=
                                                            ", ";
                                                    }
                                                    if (i == 3) {
                                                        artistLinks
                                                            +=
                                                            "...";
                                                    }
                                                }
                                                let publicUrl =
                                                    window.location
                                                    .origin +
                                                    "/img/" +
                                                    dataLoad +
                                                    "/";
                                                let publicUrlMusic =
                                                    window.location
                                                    .origin +
                                                    "/music/" +
                                                    element["song"]
                                                    .url;
                                                let imgUrl =
                                                    publicUrl +
                                                    element["song"]
                                                    .img_url;
                                                let imgSrc =
                                                    checkFileExists(
                                                        imgUrl
                                                    ) ?
                                                    imgUrl :
                                                    ["song"]
                                                    .img_url;
                                                if (
                                                    index >=
                                                    quantity &&
                                                    index <=
                                                    quantityLoad
                                                ) {
                                                    list.append(
                                                        ` <div class="list__item" data-song-id="${element["song"].id}" data-song-name="${element["song"].name}" data-song-album="" data-song-url="${publicUrlMusic}" data-song-cover="${img src}"> <div class="list__cover"> <img src="${img src}" alt="" /> <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${element["song"].id}" aria-label="Play pause"><i class="ri-play-fill icon-play"></i> <i class="ri-pause-fill icon-pause"></i></button> </div> <div class="list__content"> <a href="/home/song-details/${element["song"].id}" class="capitalize list__title text-truncate">${element["song"].name}</a> <p class="cover__subtitle text-truncate"></p> </div> <ul class="list__option"> <li class="relative_time">${element["relative_time"]}</li> <li class="icon-fvr"> <label class="add-fvr" data-type="song" data-favorite-id="${element["song"].id}" for="song[${element["song"].id}]"> <input title="like" type="checkbox" class="like" id="song[${element["song"].id}]"> <div class="checkmark"> <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z"> </path> </svg> <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg"> <path d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z"> </path> </svg> <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg"> <polygon points="10,10 20,20" class="poly"></polygon> <polygon points="10,50 20,50" class="poly"></polygon> <polygon points="20,80 30,70" class="poly"></polygon> <polygon points="90,10 80,20" class="poly"></polygon> <polygon points="90,50 80,50" class="poly"></polygon> <polygon points="80,80 70,70" class="poly"></polygon> </svg> </div> </label> </li> <li>${element["song"].duration}</li> <li class="dropstart d-inline-flex"> <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a> <ul class="dropdown-menu dropdown-menu-sm"> <li> <a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${element["song"].id}">Add to queue</a> </li> <li> <a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${element["song"].id}">Play</a> </li> </ul> </li> </ul> </div> `
                                                    );
                                                }
                                                $(
                                                    ".cover__subtitle"
                                                ).html(
                                                    artistLinks);
                                                $(
                                                    ".btn-load-more"
                                                ).attr(
                                                    "data-quantity",
                                                    quantityLoad
                                                );
                                                $(".btn-load-more")
                                                    .removeClass(
                                                        "loading"
                                                    )
                                                    .find("span")
                                                    .text(
                                                        "Load more"
                                                    );
                                            }
                                        );
                                        $(".btn-load-more").attr(
                                            "data-quantity",
                                            quantityLoad
                                        );
                                        $(".btn-load-more")
                                            .removeClass("loading")
                                            .prop("disabled", false)
                                            .find("span")
                                            .text("Load more");
                                    }
                                },
                            });
                        });
                    }
                    let available =
                        contentSongSuggest.find(".list__item");
                    if (!available.length) {
                       $('.section.suggest').hide();
                    }
                    let count = $(".info-list--dotted .count");
                    count.text(songsInPlaylist.length + " Songs");
                },
            });
        })
    })
</script>
@endsection