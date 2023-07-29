@extends('modules.admin.master')
@section('songs', 'open')
@section('song-link-3', 'active')
@section('content')
<section class="wrapper main-wrapper" style="">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="page-title">
            <div class="pull-left">
                <h1 class="title">Add many Song</h1>
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
                    <form action="{{ route('admin.songs.store-many-song') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-group"> <label class="form-label" for="field-1">Song MP3 File (Max
                                    10Files) *</label>
                                <span class="desc"></span>
                                <div class="controls"> <input type="file" name="url[]" multiple
                                        accept="audio/mpeg, audio/mp3" dropzone="true" class="form-control"
                                        id="field-1" />
                                </div>
                                @if ($errors->has('url'))
                                    <div class="invalid-feedback">{{ $errors->first('url') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 padding-bottom-30">
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary btn-submit" value="Save" />
                                <a href="/admin/songs/all" class="btn btn-primary btn-submit ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function () {
                            $('input[type="file"]').on('change', function () {
                              if(this.files.length>10){
                                const firstTenFiles = Array.from(this.files).slice(0, 10);
                                const fileList = new DataTransfer();
                                firstTenFiles.forEach(file => fileList.items.add(file));
                                this.files = fileList.files;
                              }
                            })
                        })
                    </script>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection