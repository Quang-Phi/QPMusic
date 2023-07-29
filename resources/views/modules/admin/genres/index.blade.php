@extends('modules.admin.master')
@section('genres', 'open')
@section('genre-link-1', 'active')

@section('content')
    <section class="wrapper main-wrapper" style=''>
        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Music Genres</h1>
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
                            <strong>All Genres</strong>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        {{-- list genre --}}
        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">All Genres</h2>
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
                                                <th>Description</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
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
        </div>

        </div>
        </div>


        </div>
        </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#my-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.genres.data') }}',
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
                                let imgSrc = "{{ asset('img/genre') }}/" + data;
                                let http = new XMLHttpRequest();
                                http.open('HEAD', imgSrc, false);
                                http.send();
                                if (data === null || http.status == 404) {
                                return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                            } else {
                                return '<img src="' + "{{ asset('img/genre') }}/" + data +
                                    '" width="75" height="75">';
                            }
                            } else {
                                return '<img src="' + data + '" width="75" height="75">';
                            }
                        }
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
        })

        $(document).on('click', '.delete-btn', function(event) {
            event.preventDefault();
            let deleteUrl = $(this).attr('href');
            let genreID = $(this).data('id');
            confirmDelete(deleteUrl, genreID);
        });

        let checkedGenres = [];

        function handleCheckbox(event) {
            let checkbox = event.target;
            let inputId = $(checkbox).val();
            if ($(checkbox).is(':checked')) {
                if (!checkedGenres.find(genre => genre === inputId)) {
                    checkedGenres.push($(checkbox).val());
                }
            } else {
                if (checkedGenres.find(genre => genre === inputId)) {
                    checkedGenres = checkedGenres.filter(genre => genre !== inputId);
                }
            }
        }

        function confirmDelete(deleteUrl, genreID) {
            if (confirm("Do you want to delete this Genre?")) {
                const dialog = $('<dialog>');
                dialog.html(`
                        <form method="dialog">
                            <div class="dialog-photo">
                                <img src="https://images.unsplash.com/photo-1515224526905-51c7d77c7bb8?ixlib=rb-0.3.5&s=9980646201037d28700d826b1bd096c4&auto=format&fit=crop&w=700&q=80" alt="">
                            </div>
                            <div class="dialog-content">
                                <p>Select change for the Songs belonging to this Genre.</p>
                                <label>
                                    <input type="radio" name="relatedSongs" value="1"> Delete Genre and set the Genre of related Songs to null.
                                </label>
                                <label>
                                    <input type="radio" name="relatedSongs" value="2"> Change the Genre of related Songs.
                                </label>
                                <menu>
                                    <button class = "btn btn-success" value="confirm">Confirm</button>
                                    <button class = "btn btn-primary" value="cancel">Cancel</button>
                                </menu>
                            </div>
                        </form>
                    `);
                dialog.find('form').on('submit', (event) => {
                    event.preventDefault();
                    dialog.get(0).close();
                });

                dialog.find('button[value="confirm"]').on('click', () => {
                    const formData = new FormData(dialog.find('form')[0]);
                    const relatedSongs = formData.get('relatedSongs');

                    if (relatedSongs === '1') {
                        if (confirm(
                                "Are you sure you want to delete this Genre along with its related Songs?"
                            )) {
                            window.location.href = deleteUrl;
                        }
                    } else if (relatedSongs === '2') {
                        const newDialog = $('<dialog>');
                        $.ajax({
                            url: "{{ route('admin.genres.change-song-genre', ['id' => ':genreID']) }}"
                                .replace(':genreID', genreID),
                            success: function(data) {
                                dialog.get(0).close();
                                newDialog.html(`
                                <form method="dialog">
                                    <div class="dialog-photo">
                                        <img src="https://images.unsplash.com/photo-1515224526905-51c7d77c7bb8?ixlib=rb-0.3.5&s=9980646201037d28700d826b1bd096c4&auto=format&fit=crop&w=700&q=80" alt="">
                                    </div>
                                    <div class="dialog-content">
                                        <p>Select change for the Songs belonging to this Genre:</p>
                                        <div class="dialog-genre scroll-custom">
                                             ${data.map(item=>`
                                                                                                                        <div >
                                                                                                                            <input onchange="handleCheckbox(event)" type="checkbox" name="genre" id="genre[${item.id}]" value="${item.id}">
                                                                                                                            <label for="genre[${item.id}]">${item.name}</label>
                                                                                                                        </div>`).join('')}
                                        </div>
                                        <menu>
                                            <button class = "btn btn-success" value="confirm">Confirm</button>
                                            <button class = "btn btn-primary" value="cancel">Cancel</button>
                                        </menu>
                                    </div>
                                </form>
                                `);

                                newDialog.find('form').on('submit', (event) => {
                                    event.preventDefault();
                                });
                                newDialog.find('button[value="confirm"]').on('click',
                                    () => {
                                        dialog.get(0).close();
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ route('admin.genres.update-song-genre', ['id' => ':genreID']) }}"
                                                .replace(':genreID', genreID),
                                            data: {
                                                checkedGenres: checkedGenres,
                                                _token: '{{ csrf_token() }}'

                                            },
                                            success: function() {
                                                window.location.href =
                                                    "{{ route('admin.genres.all') }}";
                                            }

                                        });
                                        newDialog.get(0).close();
                                    });

                                newDialog.find('button[value="cancel"]').on('click', () => {
                                    newDialog.get(0).close();
                                    dialog.get(0).close();
                                });

                                $('body').append(newDialog);
                                newDialog.get(0).showModal();
                                dialog.get(0).close();
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    } else {
                        dialog.get(0).close();
                        newDialog.get(0).close();
                    }
                });

                dialog.find('button[value="cancel"]').on('click', () => {
                    dialog.get(0).close();
                });

                $('body').append(dialog);
                dialog.get(0).showModal();
            } else {}
        }
    </script>
@endsection
