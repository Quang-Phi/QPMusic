@extends('modules.admin.master')
@section('artists', 'open')
@section('artist-link-2', 'active')
@section('content')
<section class="wrapper main-wrapper" style=''>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Add a Artist</h1>
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
                        <strong>Add Artist</strong>
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
                    <form action="{{ route('admin.artists.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="field-1">Name *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="field-1">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-3">Biography</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <textarea style="width: 100%;" id="field-3" name="bio" id=""
                                        rows="3">{{ old('bio') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-2">Avatar *</label>
                                <span class="desc"></span>
                                <div class="controls upload-img">
                                    <span class="upload-img-title custom-admin-img"><img src="" alt=""
                                            onerror="this.style.display='none';">
                                    </span>
                                    <span class="img-drop">
                                        <img src="https://i.postimg.cc/fyDxzfFv/image.png" alt="">
                                    </span>
                                    <label for="upload-img-input" class="drop-container">
                                        <input id="img" name="img_url" type="file" value="" dropzone="true" accept="image/*"
                                            class="form-control @error('img_url') is-invalid @enderror"
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
                                <a href="/admin/artists/all" class="btn btn-primary btn-submit ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection