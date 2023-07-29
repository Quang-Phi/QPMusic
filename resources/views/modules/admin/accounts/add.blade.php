@extends('modules.admin.master')
@section('users', 'open')
@section('user-link-2', 'active')
@section('content')
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Add a User</h1>
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
                            <strong>Add User</strong>
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
                        <form action="{{ route('admin.accounts.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">

                                <div class="form-group">
                                    <label class="form-label" for="field-1">Email *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid @enderror" id="field-1">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-5">Password *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="field-5">
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="field-6">Re-Password *</label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="field-6">
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group"> <label class="form-label" for="field-4">Role</label> <span
                                        class="desc"></span>
                                    <div class="controls">
                                        <label class="song-status">
                                            <input class="status-radio" checked type="radio" hidden name="role"
                                                value="Member" id="status_1">
                                            <span>Member</span>
                                        </label>
                                        <label class="song-status">
                                            <input class="status-radio" type="radio" hidden name="role" value="Admin"
                                                id="status_2">
                                            <span>Admin</span>
                                        </label>
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
