@extends('modules.admin.master')
@section('artists', 'open')
@section('artist-link-1', 'active')
@section('content')
    <section class="wrapper main-wrapper" style=''>

        <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
            <div class="page-title">

                <div class="pull-left">
                    <h1 class="title">Artists</h1>
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
                            <strong>All Artists</strong>
                        </li>
                    </ol>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-lg-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">All Artists</h2>
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
            </section>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#my-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.artists.data') }}',
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
                                let imgSrc = "{{ asset('img/artist') }}/" + data;
                                let http = new XMLHttpRequest();
                                http.open('HEAD', imgSrc, false);
                                http.send();
                                if (data === null || http.status == 404) {
                                return '<img src="https://i.postimg.cc/mrg9mz3N/image.png" width="75" height="75">';
                            } else {
                                return '<img src="' + "{{ asset('img/artist') }}/" + data +
                                    '" width="75" height="75">';
                            }
                            } else {
                                return '<img src="' + data + '" width="75" height="75">';
                            }
                        }
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
            let artistID = $(this).data('artist-id');
            confirmDelete(deleteUrl, artistID);
        });

        let checkedArtists = [];

        function handleCheckbox(event) {
            let checkbox = event.target;
            let inputId = $(checkbox).val();
            if ($(checkbox).is(':checked')) {
                if (!checkedArtists.find(artist => artist === inputId)) {
                    checkedArtists.push($(checkbox).val());
                }
            } else {
                if (checkedArtists.find(artist => artist === inputId)) {
                    checkedArtists = checkedArtists.filter(artist => artist !== inputId);
                }
            }
        }

        function confirmDelete(deleteUrl, artistID) {
            if (confirm("Do you want to delete this Artist?")) {
                const dialog = $('<dialog>');
                dialog.html(`
                        <form method="dialog">
                            <div class="dialog-photo">
                                <img src="https://images.unsplash.com/photo-1515224526905-51c7d77c7bb8?ixlib=rb-0.3.5&s=9980646201037d28700d826b1bd096c4&auto=format&fit=crop&w=700&q=80" alt="">
                            </div>
                            <div class="dialog-content">
                                <p>Select change for the Songs of this Artist:</p>
                                <label>
                                    <input type="radio" name="relatedSongs" value="1"> Delete Artist and set the Artist of related Songs to null.
                                </label>
                                <label>
                                    <input type="radio" name="relatedSongs" value="2"> Change the Artist for the related Songs.
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
                                "Are you sure you want to delete this Artist along with the related Songs?"
                            )) {
                            window.location.href = deleteUrl;
                        }
                    } else if (relatedSongs === '2') {
                        const newDialog = $('<dialog>');
                        $.ajax({
                            url: "{{ route('admin.artists.change-song-artist', ['id' => ':artistID']) }}"
                                .replace(':artistID', artistID),
                            success: function(data) {
                                dialog.get(0).close();
                                newDialog.html(`
                                <form method="dialog">
                                    <div class="dialog-photo">
                                        <img src="https://images.unsplash.com/photo-1515224526905-51c7d77c7bb8?ixlib=rb-0.3.5&s=9980646201037d28700d826b1bd096c4&auto=format&fit=crop&w=700&q=80" alt="">
                                    </div>
                                    <div class="dialog-content">
                                        <p>Select a new Artist for the Songs:</p>
                                        <div class="dialog-artist scroll-custom">
                                             ${data.map(item=>`
                                                                <div >
                                                                  <input onchange="handleCheckbox(event)" type="checkbox" name="artist" id="artist[${item.id}]" value="${item.id}">
                                                                  <label for="artist[${item.id}]">${item.name}</label>
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
                                        $.ajax({
                                            type: "POST",
                                            url: "{{ route('admin.artists.update-song-artist', ['id' => ':artistID']) }}"
                                                .replace(':artistID', artistID),
                                            data: {
                                                checkedArtists: checkedArtists,
                                                _token: '{{ csrf_token() }}'

                                            },
                                            success: function() {
                                                window.location.href =
                                                    "{{ route('admin.artists.all') }}";
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
                    dialog.get(0).close();
                });

                dialog.find('button[value="cancel"]').on('click', () => {
                    dialog.get(0).close();
                });

                $('body').append(dialog);
                $(this).find('dialog').remove();
                dialog.get(0).showModal();
            } else {
                // Không xóa thể loại
            }
        }
    </script>
    </div>
@endsection
