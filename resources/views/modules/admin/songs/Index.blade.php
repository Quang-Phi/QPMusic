@extends('modules.admin.master')
@section('songs', 'open')
@section('song-link-1', 'active')
@section('content')
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">All Songs</h1>
                </div>

                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('admin.index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.songs.all') }}">Songs</a>
                        </li>
                        <li class="active">
                            <strong>All Songs</strong>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">All Songs</h2>
                    <div class="actions panel_actions pull-right">
                        <i class="box_toggle fa fa-chevron-down"></i>

                    </div>
                </header>
                <div class="content-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="my-table" class="table-songs">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>IMG</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#my-table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            responsive: true,
                                            ajax: '{{ route('admin.songs.data') }}',
                                            columns: [{
                                                    data: 'id',
                                                    name: 'users.id'
                                                },
                                                {
                                                    data: 'name',
                                                    name: 'name'
                                                },
                                                {
                                                    data: 'img_url',
                                                    name: 'img_url',
                                                    render: function(data) {
                                                        let isLink = data.startsWith('http');
                                                        if(!isLink) {
                                                            let imgSrc = "{{ asset('img/song') }}/" + data;
                                                            let http = new XMLHttpRequest();
                                                            http.open('HEAD', imgSrc, false);
                                                            http.send();
                                                            if (data === null || http.status == 404) {
                                                            return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                                                        } else {
                                                            return '<img src="' + "{{ asset('img/song') }}/" + data +
                                                                '" width="75" height="75">';
                                                        }
                                                        } else {
                                                            return '<img src="' + data + '" width="75" height="75">';
                                                        }
                                                    }
                                                },
                                                {
                                                    data: 'status',
                                                    name: 'status'
                                                },
                                                {
                                                    data: 'description',
                                                    name: 'description'
                                                },
                                                {
                                                    data: 'edit',
                                                    name: '',
                                                },
                                                {
                                                    data: 'delete',
                                                    name: '',
                                                }
                                            ]
                                        });
                                    });
                                </script>

                                <script>
                                    $(document).on('change', '.status-radio', function() {
                                        let val = parseInt($(this).val());
                                        let songId = $(this).data('song-id');
                                        let status = $(this).data('song-status');
                                        if (confirm(
                                                `You definitely want to change the status to ${val===1 ? 'Old' : val===2 ? 'New' : 'Coming soon'}?`
                                            )) {
                                            let songId = $(this).data('song-id');
                                            let status = $(this).val();

                                            $.ajax({
                                                url: "{{ route('admin.songs.change-status') }}",
                                                method: "POST",
                                                data: {
                                                    song_id: songId,
                                                    status: status,
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                success: function(response) {
                                                    let message = '';
                                                    if (status == 1) {
                                                        message = 'The song is now Old.';
                                                    } else if (status == 2) {
                                                        message = 'The song is now New.';
                                                    } else if (status == 3) {
                                                        message = 'The song is Coming soon.';
                                                    }
                                                    toastr.success(message, 'Success', {
                                                        timeOut: 2000,
                                                        positionClass: 'toast-top-right'
                                                    });
                                                },
                                                error: function(xhr, status, error) {
                                                    window.location.href = "{{ route('admin.songs.all') }}";
                                                    toastr.error('Err!! Something went wrong. Try again.', 'Error', {
                                                        timeOut: 2000,
                                                        positionClass: 'toast-top-right',

                                                    });
                                                }
                                            });
                                        } else {
                                            $(this).prop('checked', false);
                                            let radio = $('input[type="radio"]').filter(function() { 
                                                return $(this).val() == status;
                                            });

                                            radio.prop('checked', true);
                                        }
                                    });
                                </script>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>


    </section>
@endsection
