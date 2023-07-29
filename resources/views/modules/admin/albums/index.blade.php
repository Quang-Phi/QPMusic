@extends('modules.admin.master')
@section('albums', 'open')
@section('album-link-1', 'active')
@section('content')
<section class="wrapper main-wrapper" style=''>

    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

            <div class="pull-left">
                <h1 class="title">Albums</h1>
            </div>

            <div class="pull-right hidden-xs">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{route('admin.index')}}"><i class="fa fa-home"></i>Home</a>
                    </li>
                    <li>
                        <a href="{{route('admin.albums.all')}}">Albums</a>
                    </li>
                    <li class="active">
                        <strong>All Albums</strong>
                    </li>
                </ol>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left">All Albums</h2>
                <div class="actions panel_actions pull-right">
                    <i class="box_toggle fa fa-chevron-down"></i>

                </div>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <div class="row">
                            <div class="table-responsive">
                                <table id="my-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>IMG</th>
                                            <th>Release Date</th>
                                            <th>Description</th>
                                            {{-- <th>Artist</th> --}}
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
                                            ajax: '{{ route('admin.albums.data') }}',
                                            columns: [{
                                                    data: 'id',
                                                    name: 'id'
                                                },
                                                {
                                                    data: 'name',
                                                    name: '',
                                                },
                                                {
                                                    data: 'img_url',
                                                    name: 'img_url',
                                                    render: function(data) {
                                                        let isLink = data.startsWith('http');
                                                        if(!isLink) {
                                                            let imgSrc = "{{ asset('img/album') }}/" + data;
                                                            let http = new XMLHttpRequest();
                                                            http.open('HEAD', imgSrc, false);
                                                            http.send();
                                                            if (data === null || http.status == 404) {
                                                            return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                                                        } else {
                                                            return '<img src="' + "{{ asset('img/album') }}/" + data +
                                                                '" width="75" height="75">';
                                                        }
                                                        } else {
                                                            return '<img src="' + data + '" width="75" height="75">';
                                                        }
                                                    }
                                                },
                                                {
                                                    data: 'release_date',
                                                    name: 'release_date',
                                                },

                                                {
                                                    data: 'description',
                                                    name: 'description'
                                                },

                                                {
                                                    data: 'edit',
                                                    name: ''
                                                },
                                                {
                                                    data: 'delete',
                                                    name: ''
                                                },
                                            ]
                                        });
                                    }).responsive.recalc();
                            </script>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>


</section>
@endsection