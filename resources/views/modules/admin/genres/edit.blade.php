@extends('modules.admin.master')
@section('genres', 'open')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">Edit a Genre</h1>
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
                        <strong>Edit Genre</strong>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left">Basic Info</h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>
                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <form action="{{ route('admin.genres.update', ['id' => $genre->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="field-1">Genre Name *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ old('name', $genre->name) }}"
                                        class="form-control @error('name') is-invalid @enderror" id="field-1">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div style="display:flex;flex-direction: column-reverse;">
                                <div class="form-group">
                                    <label class="form-label">Choose More Song</label>
                                    <span class="desc"></span>
                                    <div>
                                        <i class="box_toggle fa fa-chevron-up"></i>
                                    </div>
                                    <div class="content-body collapsed" style="display: none">
                                        <div class="controls">
                                            <div class="group-choose"
                                                style="display:grid; grid-template-columns: repeat(1, 1fr);"
                                                class="controls">
                                                <label class="form-label">With Artist:</label>
                                                <div class="group-artist">
                                                    <div class="artist-title justify-content-between d-flex">
                                                        <div class="search-artist"><input type="search" name=""
                                                                id="artist"></div>
                                                        <div class="title-select-all"><input type="checkbox"
                                                                name="select-artist" id="select-artist"><label
                                                                for="select-artist">Select All</label>
                                                        </div>
                                                    </div>

                                                    <div class="artist-content scroll-custom"
                                                        style="max-height:200px; overflow-y:scroll;"></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="result">
                                            <label style="margin-bottom: 16px;" class="form-label">Select Songs:
                                            </label>
                                            <div class="select-group d-flex">
                                                <div class="select"></div>
                                                <div class="my-search mx-3"></div>
                                            </div>
                                            <div class="scroll-custom" style="max-height: 228px; overflow-y: scroll;">
                                                <div id="img-selected-empty">
                                                    <img src="https://i.postimg.cc/W4QwLw28/image.png" alt="">
                                                </div>
                                                <table class="table table-hover">
                                                    <thead id="thead"></thead>
                                                    <tbody style="max-height:200px;overflow-y:scroll;" id="song-list">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div id="selected">
                                        <div class="title d-flex justify-content-between">
                                            <label class="form-label count-selected" for="field-2">Songs in:
                                                <span id="count">{{ $songsGenre->count() }}</span></label>
                                            <div class="delete-all-select">
                                                <label>
                                                    <input hidden type="checkbox" name="delete" id="delete-all-select">
                                                    Delete all
                                                </label>
                                            </div>

                                        </div>
                                        <div>
                                            <i class="box_toggle fa fa-chevron-down"></i>
                                        </div>
                                        <div class="content-body" style="">
                                            <div style="max-height:500px; overflow-y:scroll;" class="scroll-custom">
                                                <div id="img-checked-empty">
                                                    @if ($songsGenre->count() == 0)
                                                    <img src="https://i.postimg.cc/W4QwLw28/image.png" alt="">
                                                    @endif
                                                </div>
                                                <table class="table table-hover table-selected">
                                                    <thead id="thead-selected">
                                                        <tr>
                                                            @if (!$songsGenre->count() == 0)
                                                            <th scope="col">#</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Artist</th>
                                                            <th scope="col">Genre</th>
                                                            <th scope="col">Album</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Delete</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody class="content-selected">
                                                        @foreach ($songsGenre as $song)
                                                        <tr>
                                                            <td>
                                                                <input class="item-song" type="checkbox"
                                                                    name="my-songs[]" id="song[{{ $song->id }}]"
                                                                    value="{{ $song->id }}" checked 
                                                                    @if(is_array(old('song')) && in_array($song->id,old('song'))) checked 
                                                                    @endif>
                                                            </td>
                                                            <td>
                                                                <label for="song[{{ $song->id }}]">{{ $song->name }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <p class="capitalize">
                                                                    @foreach ($song->artists as $item)
                                                                    {{ $item->name }},
                                                                    @endforeach
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <p class="capitalize">
                                                                    @foreach ($song->genres as $item)
                                                                    {{ $item->name }},
                                                                    @endforeach
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <p class="capitalize">
                                                                    @foreach ($song->albums as $item)
                                                                    {{ $item->name }},
                                                                    @endforeach
                                                                </p>
                                                            </td>

                                                            <td>
                                                                <p>
                                                                    {{ $song->description }}
                                                                </p>
                                                            </td>
                                                            <td>
                                                                <label class="btn" for="song[{{ $song->id }}]"><i
                                                                        class="ri-close-fill"></i></label>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-3">Genre Description</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <textarea style="width:100%;" class="@error('description') is-invalid @enderror"
                                        name="description" id=""
                                        rows="5">{{ old('description', $genre->description) }}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group img">
                                @php
                                $img = $genre->img_url == null || !file_exists(public_path('img/genre/' .
                                $genre->img_url)) ? $genre->img_url : asset('img/genre/' . $genre->img_url);
                                @endphp
                                <label class="form-label" for="field-1">Genre IMG *</label>
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

                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 padding-bottom-30">
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary btn-submit" value="Save" />
                                <a href="/admin/genres/all" class="btn btn-primary btn-submit ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </section>
    </div>
</section>
@include('partials.script.genre.admin-genre-add-edit')
@endsection