@extends('modules.admin.master')
@section('users', 'open')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">Edit a User</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.accounts.all') }}">Users</a>
                    </li>
                    <li class="active">
                        <strong>Edit User</strong>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left">Account</h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>
                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <form action="{{ route('admin.accounts.update', ['id' => $acc->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="field-1">Email *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="email" name="email" {{$acc->id == 1 ? '' : 'disabled'}}
                                    value="{{ old('email', $acc->email) }}" class="form-control @error('email')
                                    is-invalid @enderror" id="field-1">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="field-1">Name</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ old('name', $acc->name) }}" class="form-control @error('name')
                                        is-invalid @enderror" id="field-1">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="field-5">Password *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="password" name="password"
                                        class="form-control  @error('password') is-invalid @enderror" id="field-5">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-5">Re-Password *</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="field-5">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="field-5">Gender:</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <label class="song-status" for="male" class="form-label">
                                        <input class="status-radio" type="radio" id="male" name="gender" value="1" {{
                                            old('gender', $acc->gender) == 1 ? 'checked' : '' }}>
                                        <span>Male</span>
                                    </label>
                                    <label class="song-status" for="fmale" class="form-label ms-3">
                                        <input class="status-radio" type="radio" id="fmale" name="gender" value="2" {{
                                            old('gender', $acc->gender) == 2 ? 'checked' : '' }}>
                                        <span>Female</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="field-2">Phone</label>
                                <span class="desc">e.g. "+(84) 123 456"</span>
                                <div class="controls">
                                    <input type="number" name="phone" value="{{ old('phone', $acc->phone) }}"
                                        class="form-control @error('phone') is-invalid @enderror" id="field-2">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="field-6">Address</label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <textarea class="form-control autogrow" cols="5" id="field-6"
                                        name="address">{{ old('address', $acc->address) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                @php
                                $img = $acc->avatar == null || !file_exists(public_path('img/account/' . $acc->avatar))
                                ? $acc->avatar : asset('img/account/' . $acc->avatar);
                                @endphp
                                <label class="form-label" for="field-10">Avatar</label>
                                <span class="desc"></span>
                                <div class="controls upload-img">
                                    <span class="upload-img-title custom-admin-img"><img src="{{ $img }}" alt=""></span>
                                    <label for="upload-img-input" class="drop-container">
                                        <input id="img" name="avatar" type="file" value="" dropzone="true" accept="image/*"
                                            class="form-control @error('avatar') is-invalid @enderror"
                                            id="upload-img-input">
                                    </label>
                                    @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12 padding-bottom-30">
                            <div class="text-right">
                                <input class="btn btn-primary btn-submit" type="submit" value="Save">
                                <a href="/admin/accounts/all" class="btn btn-primary btn-submit ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </section>
    </div>
</section>
@endsection