@extends('modules.admin.master')
@section('users', 'open')
@section('user-link-1', 'active')
@section('content')
<section class="wrapper main-wrapper" style=''>
    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">All Users</h1>
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
                        <strong>All Users</strong>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left">All Users</h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>
                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="table-responsive">
                                <table id="my-table" class="acc-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Avatar</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            {{-- <th>Delete</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                ajax: '{{ route('admin.accounts.data') }}',
                columns: [{
                        data: 'id',
                        name: 'users.id'
                    },
                    {
                        data: 'email',
                        name: 'users.email'
                    },
                    {
                        data: 'name',
                        name: 'users_info.name'
                    },
                    {
                        data: 'avatar',
                        name: 'users_info.avatar',
                        render: function(data) {
                            let isLink = data.startsWith('http');
                            if(!isLink) {
                                let imgSrc = "{{ asset('img/account') }}/" + data;
                                let http = new XMLHttpRequest();
                                http.open('HEAD', imgSrc, false);
                                http.send();
                                if (data === null || http.status == 404) {
                                return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                            } else {
                                return '<img src="' + "{{ asset('img/account') }}/" + data +
                                    '" width="75" height="75">';
                            }
                            } else {
                                return '<img src="' + data + '" width="75" height="75">';
                            }
                        }
                    },

                    {
                        data: 'role',
                        name: 'users.role'
                    },
                    {
                        data: 'is_active',
                        name: 'users.is_active'

                    },

                    {
                        data: 'edit',
                        name: ''
                    }
                ]
            });
        })

        $(document).on('change', '.input-toggle', function() {
            let status = $(this).prop('checked');
            if (confirm(`You definitely want to ${!status?'Block':'Active'} this Account ?`)) {
                let id = $(this).attr('id').replace("toggle[", "").replace("]", "");
                let button = $(this);
                $.ajax({
                    url: "{{ route('admin.accounts.change-status', ['id' => ':id']) }}".replace(':id', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let label = button.text() === 'Block' ? 'Active' :
                            'Block';
                        let message = label + ' account successfully!';
                        let btnClass = button.hasClass('btn-primary') ? 'btn-danger' :
                            'btn-primary';
                        button.text(label).removeClass('btn-primary btn-danger').addClass(
                            btnClass);
                        toastr.success(message, 'Success', {
                            timeOut: 2000,
                            positionClass: 'toast-top-right'
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        toastr.error('Err!! Something went wrong. Try again.', 'Error', {
                            timeOut: 2000,
                            positionClass: 'toast-top-right'
                        });
                    }
                });
            } else {
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });

        $(document).on('click', '.btn-role', function() {
            let role = $(this).data('role');
            if (confirm(
                    `You definitely want to change the role of this Account to ${role==='Admin'?'Member':'Admin'}?`
                )) {
                let id = $(this).data('id');
                let button = $(this);
                $.ajax({
                    url: "{{ route('admin.accounts.change-role', ['id' => ':id']) }}".replace(':id', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let label = button.text() === 'Admin' ? 'Member' :
                            'Admin';
                        let message = 'Change role to ' + label + ' successfully!';
                        let btnClass = button.hasClass('btn-success') ? 'btn-secondary' :
                            'btn-success';
                        button.text(label).removeClass('btn-success btn-secondary').addClass(
                            btnClass);
                        toastr.success(message, 'Success', {
                            timeOut: 2000,
                            positionClass: 'toast-top-right'
                        });
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        toastr.error('Err!! Something went wrong. Try again.', 'Error', {
                            timeOut: 2000,
                            positionClass: 'toast-top-right'
                        });
                    }
                });
            }
        });
</script>
@endsection