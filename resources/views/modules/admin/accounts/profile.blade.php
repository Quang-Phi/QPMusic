@extends('modules.admin.master')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class='col-lg-12 col-md-12 col-sm-12 col-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">Profile</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li class="active">
                        <strong>Profile</strong>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div>
        <div class="col-lg-6 col-md-6 col-sm-10 col-12">
            <section class="box nobox">
                <div class="content-body">
                    <div class="row">
                        <div class="plan__data">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="px-4 pt-2 pe-xl-0 pt-sm-0 mt-4 mb-3 my-sm-0 w-100">
                                    @php
                                    $avatar = $acc->avatar == null || !file_exists(public_path('img/account/' .
                                    $acc->avatar)) ? $acc->avatar : asset('img/account/' . $acc->avatar);
                                    @endphp
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar avatar--xl">
                                            <div class="avatar__image">
                                                <img src="{{ $avatar }}" alt="user" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col-sm-6">
                                            <label for="name" class="form-label fw-medium">Name</label>
                                            <input name="name" disabled type="text" id="name" class="form-control"
                                                value="{{ old('name', $acc->name) }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="email" class="form-label fw-medium">Email</label>
                                            <input name="email" disabled type="text" id="email" class="form-control"
                                                value="{{ old('email', $acc->email) }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="Gender" class="form-label fw-medium">Gender</label>
                                            <input name="gender" disabled type="text" id="Gender" class="form-control"
                                                value="{{ old('gender', $acc->gender == 1 ? 'Male' : 'Female') }}" />
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="phone" class="form-label fw-medium">Phone Number</label>
                                            <input name="phone" disabled type="text" id="phone" class="form-control"
                                                value="{{ old('phone', $acc->phone) }}" />
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="Address" class="form-label fw-medium">Address</label>
                                            <input name="address" disabled type="text" id="Address" class="form-control"
                                                value="{{ old('address', $acc->address) }}" />
                                        </div>

                                        <div class="col-12">
                                            <a class="btn btn-primary btn-submit"
                                                href="{{ route('admin.accounts.edit', ['id' => $acc->id]) }}">Edit
                                                Profile</a>
                                            <a href="/admin/accounts/all"
                                                class="btn btn-primary btn-submit ms-2">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-10 col-12">
            <div class="table-responsive">
                <table id="tb2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Registration Time</th>
                            <th>Expires At</th>
                            <th>Package Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
                $('#tb2').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('admin.accounts.data-transactions', ['id' => $acc->id]) }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'registration_time',
                            name: 'registration_time'
                        },
                        {
                            data: 'expires_at',
                            name: 'expires_at'
                        },
                        {
                            data: 'package_type',
                            name: 'package_type'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        }
                    ],
                });
            });
    </script>
</section>
@endsection