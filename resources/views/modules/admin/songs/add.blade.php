@extends('modules.admin.master')
@section('songs', 'open')
@section('song-link-2', 'active')
@section('content')
<section class="wrapper main-wrapper" style="">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Add a Song</h1>
            </div>
            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li> <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a> </li>
                    <li> <a href="{{ route('admin.songs.all') }}">Songs</a> </li>
                    <li class="active"> <strong>Add Song</strong> </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">Basic Info</h2>
                <div class="actions panel_actions pull-right"> <i class="box_toggle fa fa-chevron-down"></i> </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <form action="{{ route('admin.songs.store') }}" method="post" enctype="multipart/form-data"> @csrf
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-group"> <label class="form-label" for="field-1">Song MP3 File *</label>
                                <span class="desc"></span>
                                <div class="controls"> <input type="file" name="url" dropzone="true"
                                        accept="audio/mpeg, audio/mp3"
                                        class="form-control @error('name') is-invalid @enderror" id="field-1" />
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-2">Song Name *</label> <span
                                    class="desc"></span>
                                <div class="controls"> <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="field-2" />
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-5">Musician</label> <span
                                    class="desc"></span>
                                <div class="controls"> <input type="text" name="musician" value="{{ old('musician') }}"
                                        class="form-control" id="field-5" /> </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-4">Status *</label> <span
                                    class="desc"></span>
                                <div class="controls">
                                    <label class="song-status">
                                        <input class="status-radio" type="radio" hidden name="status" value="1"
                                            id="status_1">
                                        <span>Old</span>
                                    </label>
                                    <label class="song-status">
                                        <input class="status-radio" checked type="radio" hidden name="status" value="2"
                                            id="status_2">
                                        <span>New</span>
                                    </label>
                                    <label class="song-status">
                                        <input class="status-radio" type="radio" hidden name="status" value="3"
                                            id="status_3">
                                        <span>Comming Soon</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-8">Release date</label> <span
                                    class="desc"></span>
                                <div class="controls"> <input type="date" name="release_date"
                                        value="{{ old('release_date') }}"
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
                                            <span class="content"></span>
                                        </div>
                                        <label class="form-label">More
                                            Genre</label>
                                        <div> <i class="box_toggle fa fa-chevron-up"></i> </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="genre-title justify-content-between d-flex">
                                                <div class="search-genre"><input type="search" name=""
                                                        id="search-genre"></div>
                                                <div class="title-select-all"><input type="checkbox" name="select-genre"
                                                        id="select-genre"><label for="select-genre">Select All</label>
                                                </div>
                                            </div>
                                            <div class="genre-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;"></div> @error('genre')
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
                                            <span class="content"></span>
                                        </div>
                                        <label class="form-label" for="field-2">More
                                            Artist</label>
                                        <div> <i class="box_toggle fa fa-chevron-up"></i> </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="artist-title justify-content-between d-flex">
                                                <div class="search-artist"><input type="search" name=""
                                                        id="search-artist"></div>
                                                <div class="title-select-all"><input type="checkbox"
                                                        name="select-artist" id="select-artist"><label
                                                        for="select-artist">Select All</label> </div>
                                            </div>
                                            <div class="artist-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;"></div> @error('artist')
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
                                                Album:</label>
                                            <span class="content">Null</span>
                                        </div>
                                        <label class="form-label">More
                                            Album</label>
                                        <div> <i class="box_toggle fa fa-chevron-up"></i> </div>
                                        <div class="content-body collapsed" style="display: none">
                                            <div class="album-title justify-content-between d-flex">
                                                <div class="search-album"><input type="search" name=""
                                                        id="search-album"></div>
                                                <div class="title-select-all"><input type="checkbox" name="select-album"
                                                        id="select-album"><label for="select-album">Select All</label>
                                                </div>
                                            </div>
                                            <div class="album-content scroll-custom"
                                                style="max-height:200px; overflow-y:scroll;"></div> @error('album')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-6">Description</label>
                                <span class="desc"></span>
                                <div class="controls"> <input type="text" name="description"
                                        value="{{ old('description') }}" class="form-control" id="field-6" />
                                </div>
                            </div>
                            <div class="form-group"> <label class="form-label" for="field-7">Song Lyric</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <textarea style="width: 100%;" id="field-7" name="lyric" id=""
                                        rows="3">{{ old('lyric') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group img"> <label class="form-label">Song Image *</label>
                                <span class="desc"></span>
                                <div class="controls upload-img">
                                    <span class="upload-img-title custom-admin-img"><img src="" alt=""
                                            onerror="this.style.display='none';">
                                    </span>
                                    <span class="img-drop">
                                        <img src="https://i.postimg.cc/fyDxzfFv/image.png" alt="">
                                    </span>
                                    <label for="upload-img-input" class="drop-container">
                                        <input id="img" name="img_url" dropzone="true" accept="image/*" type="file"
                                            value="" class="form-control @error('img_url') is-invalid @enderror"
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
@include('partials.script.song.admin-song-add')
@endsection