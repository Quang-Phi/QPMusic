@extends('modules.admin.master')
@section('songs', 'open')
@section('content')
<section class="wrapper main-wrapper" style="">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Edit a Song</h1>
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
                        <strong>Edit Song</strong>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Basic Info</h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>

                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <form action="{{ route('admin.songs.update', ['id' => $song->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <div class="current-artist">
                                    <label class="form-label">Current
                                        File * :</label>
                                    <span class="content">
                                        {{ $song->url }}
                                    </span>
                                </div>
                                <label class="form-label">Change Song File:</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="file" name="url" dropzone="true" value="" class="form-control"
                                        id="field-7" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-1">Song Name *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ old('name', $song->name) }}"
                                        class="form-control" id="field-1" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-17">Musician</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" name="musician" value="{{ old('title', $song->musician) }}"
                                        class="form-control" id="field-17" />
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-8">Release date</label>
                                <span class="desc"></span>
                                <div class="controls"> <input type="date" name="release_date"
                                        value="{{ old('release_date', $song->release_date) }}"
                                        class="form-control @error('release_date') is-invalid @enderror" id="field-8" />
                                    @error('release_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="controls">
                                    <div class="group-genre">
                                        <div class="current-genre">
                                            <label class="form-label">Current
                                                Genre * :</label>
                                            <span class="content">
                                                @foreach ($songGenres as $index => $item)
                                                <span class="capitalize">{{ $item->name }}</span>
                                                @if ($index !== $songGenres->count() - 1)
                                                ,
                                                @endif
                                                @endforeach
                                            </span>
                                        </div>
                                        <label class="form-label" for="field-17">Change Genre</label>
                                        <div>
                                            <i class="box_toggle fa fa-chevron-up"></i>
                                        </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="genre-title justify-content-between d-flex">
                                                <div class="search-genre"><input type="search" name=""
                                                        id="search-genre"></div>
                                                <div class="title-select-all"><input type="checkbox" name="select-genre"
                                                        id="select-genre"><label for="select-genre">Select All</label>
                                                </div>
                                            </div>
                                            <div class="genre-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;">
                                                @foreach ($genres as $item)
                                                @if ($songGenres->contains($item))
                                                <input type="checkbox" name="genre[]" id="genre" value="{{ $item->id }}"
                                                    checked>
                                                @else
                                                <input type="checkbox" name="genre[]" id="genre"
                                                    value="{{ $item->id }}">
                                                @endif
                                                <label for="genre">{{ $item->name }}</label><br>
                                                @endforeach
                                            </div>
                                            @error('genre')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <div class="group-artist">
                                        <div class="current-artist">
                                            <label class="form-label">Current
                                                Artist * :</label>
                                            <span class="content">
                                                @foreach ($songArtists as $index => $item)
                                                <span class="capitalize">{{ $item->name }}</span>
                                                @if ($index !== $songArtists->count() - 1)
                                                ,
                                                @endif
                                                @endforeach
                                            </span>
                                        </div>
                                        <label class="form-label">Change Artist:</label>
                                        <div>
                                            <i class="box_toggle fa fa-chevron-up"></i>
                                        </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="artist-title justify-content-between d-flex">
                                                <div class="search-artist"><input type="search" name=""
                                                        id="search-artist"></div>
                                                <div class="title-select-all"><input type="checkbox"
                                                        name="select-artist" id="select-artist"><label
                                                        for="select-artist">Select All</label>
                                                </div>
                                            </div>

                                            <div class="artist-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;">
                                                @foreach ($artists as $item)
                                                @if ($songArtists->contains($item))
                                                <input type="checkbox" name="artist[]" id="artist"
                                                    value="{{ $item->id }}" checked>
                                                @else
                                                <input type="checkbox" name="artist[]" id="artist"
                                                    value="{{ $item->id }}">
                                                @endif
                                                <label for="artist">{{ $item->name }}</label><br>
                                                @endforeach
                                            </div>
                                            @error('artist')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="controls">
                                    <div class="group-album">
                                        <div class="current-album">
                                            <label class="form-label">Current
                                                Albums * :</label>
                                            <span class="content">
                                                @foreach ($songAlbums as $index => $item)
                                                <span class="capitalize">{{ $item->name }}</span>
                                                @if ($index !== $songAlbums->count() - 1)
                                                ,
                                                @endif
                                                @endforeach
                                            </span>
                                        </div>
                                        <label class="form-label">Change Album:</label>
                                        <div>
                                            <i class="box_toggle fa fa-chevron-up"></i>
                                        </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="album-title justify-content-between d-flex">
                                                <div class="search-album"><input type="search" name=""
                                                        id="search-album"></div>
                                                <div class="title-select-all"><input type="checkbox" name="select-album"
                                                        id="select-album"><label for="select-album">Select All</label>
                                                </div>
                                            </div>

                                            <div class="album-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;">
                                                @foreach ($albums as $item)
                                                @if ($songAlbums->contains($item))
                                                <input type="checkbox" name="album[]" id="album" value="{{ $item->id }}"
                                                    checked>
                                                @else
                                                <input type="checkbox" name="album[]" id="album"
                                                    value="{{ $item->id }}">
                                                @endif
                                                <label for="album">{{ $item->name }}</label><br>
                                                @endforeach
                                            </div>
                                            @error('album')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-8">Song Lyric</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <textarea style="width: 100%;" id="field-8" name="lyric" id=""
                                        rows="3">{{ old('lyric', $song->lyric) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group img">
                                @php
                                $img = $song->img_url == null || !file_exists(public_path('img/song/' . $song->img_url))
                                ? $song->img_url : asset('img/song/' . $song->img_url);
                                @endphp
                                <label class="form-label" for="field-9">Song Image *</label>
                                <span class="desc"></span>
                                <div class="controls upload-img">
                                    <span class="upload-img-title custom-admin-img"><img src="{{ $img }}" alt=""></span>
                                    <label for="upload-img-input" class="drop-container">
                                        <input id="img" name="img_url" type="file" value="" dropzone="true"
                                            accept="image/*" class="form-control @error('img_url') is-invalid @enderror"
                                            id="upload-img-input">
                                        @error('img_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 padding-bottom-30">
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary btn-submit" value="Save" />
                                <a href="/admin/songs/all" class="btn btn-primary btn-submit ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
@include('partials.script.song.admin-song-edit')

@endsection