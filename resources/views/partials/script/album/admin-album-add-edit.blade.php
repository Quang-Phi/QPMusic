<script>
    $(document).ready(function() {
        let checkedSongs = [];
        let filteredSongs = [];
        let checkedGenre = [];
        let checkedArtist = [];
        let currentImgChecked = $('#img-checked-empty');
        let currentImgSelected = $('#img-selected-empty');
        let genreContent = $('.genre-content');
        let artistContent = $('.artist-content');
        let contentSelected = $('.content-selected');
        let countSelected = $('#count');
        let songList = $('#song-list');
        let selectAllCheckbox = $('#select-all');
        let selectAllLabel = $('#select-all-label');
        let searchInput = $('#search-input');
        let img = $('<img>').attr({
            src: 'https://i.postimg.cc/W4QwLw28/image.png'
        });
        let imgTd = $('<td>').attr({
            colspan: '7',
            class: 'my-td'
        }).append(img);
        let imgEmpty = $('<tr>').append(imgTd);
        let img2 = $('<img>').attr({
            src: 'https://i.postimg.cc/tJcY5zVj/image.png'
        });
        let imgNotFound = $('<div>').attr({
            class: 'img-not-found',
        }).append(img2);
        let genres = <?php echo json_encode($genres); ?>;
        checkedSongs = <?php echo json_encode($songsAlbum); ?>;
        let artists = <?php echo json_encode($artists); ?>;

        function createSongRow(song, index) {
            currentImgChecked.empty();
            currentImgSelected.empty();
            let theadSelected = $('#thead-selected');
            let newTheadSelected = $('<tr>').append(
                $('<th>').attr('scope', 'col').text('#'),
                $('<th>').attr('scope', 'col').text('Name'),
                $('<th>').attr('scope', 'col').text(
                    'Artist'),
                $('<th>').attr('scope', 'col').text(
                    'Genre'),
                $('<th>').attr('scope', 'col').text(
                    'Album'),
                $('<th>').attr('scope', 'col').text(
                    'Description'),
                $('<th>').attr('scope', 'col').text(
                    'Delete'),
            );
            theadSelected.empty();
            theadSelected.append(newTheadSelected);
            let genre = $('<p class="capitalize">').text(song
                .genres.map(
                    genre => genre
                    .name).join(
                    ', '));
            let artist = $('<p class="capitalize">').text(song
                .artists.map(
                    artist =>
                    artist
                    .name)
                .join(', '));
            let album = $('<p class="capitalize">').text(song
                .albums.map(
                    album =>
                    album
                    .name)
                .join(', '));
            let description = $('<p>').text(song
                .description);
            let labelDelete = $('<label>').attr({
                class: "btn",
                for: `song[${song.id}]`
            }).html('<i class="ri-close-fill"></i>');
            let deletebtn = $('<span>').append(labelDelete);
            let artistSong = $('<td>').append(
                artist);
            let genreSong = $('<td>').append(
                genre);
            let albumSong = $('<td>').append(
                album);
            let deleteSong = $('<td>').append(
                deletebtn);
            let desSong = $('<td>').append(description);

            let isChecked = checkedSongs.some(item => item.id === song.id);
            let itemSong = $('<input>').attr({
                type: 'checkbox',
                name: `songs[]`,
                value: song.id,
                id: `song[${song.id}]`,
                checked: isChecked
            })
            let labelSong = $('<label>').attr({
                for: `song[${song.id}]`,
            }).text(song.name);

            let checkboxSong = $('<td>').append(itemSong);
            let nameSong = $('<td>').append(labelSong);
            let newRow = $('<tr>').append(
                checkboxSong,
                nameSong,
                artistSong,
                genreSong,
                albumSong,
                desSong,
                deleteSong
            );
            $(itemSong).on('change', function() {
                if ($(this).is(':checked')) {
                    if (!checkedSongs.find(item => item.id ===
                            song.id)) {
                        checkedSongs.push(song);
                    }
                    contentSelected.empty();
                    let countSongs = $('<span>').text(checkedSongs
                        .length);
                    countSelected.html(countSongs);
                    checkedSongs.forEach(function(song, index) {
                        contentSelected.append(createSongRow(
                            song, index));
                    });
                } else {
                    checkedSongs = checkedSongs.filter(item => item
                        .id !== song.id);
                    contentSelected.empty();
                    let countSongs = $('<span>').text(checkedSongs
                        .length);
                    countSelected.html(countSongs);
                    if (checkedSongs.length) {
                        checkedSongs.forEach(function(song, index) {
                            contentSelected.append(createSongRow(
                                song, index));
                        });
                    } else {
                        if (currentImgChecked.html() === '' && contentSelected.html() === '') {
                            contentSelected.append(imgEmpty);
                        }
                    }
                }
            });
            return newRow;
        };

        const myFilter = (text, type) => {
            if (type == 'genre') {
                let listGenreFiltered = genres.filter(genre => genre.name.toLowerCase().includes(text));
                genreContent.empty();
                listGenreFiltered.forEach(item => {
                    let isChecked = checkedGenre.some(genreId => Number(genreId) === item.id);
                    let inputGenre = $('<input>').attr({
                        type: 'checkbox',
                        name: "genre",
                        id: `genre[${item.id}]`,
                        value: `${item.id}`,
                        class: 'my-input',
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `genre[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputGenre, label)
                    genreContent.append(newdiv);
                });
            } else {
                let listArtistFiltered = artists.filter(artist => artist.name.toLowerCase().includes(text));
                artistContent.empty();
                listArtistFiltered.forEach(item => {
                    let isChecked = checkedArtist.some(artistId => Number(artistId) === item.id);
                    let inputArtist = $('<input>').attr({
                        type: 'checkbox',
                        name: "artist",
                        id: `artist[${item.id}]`,
                        value: `${item.id}`,
                        class: 'my-input',
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `artist[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputArtist, label)
                    artistContent.append(newdiv);
                });
            }
        };

        $('#genre, #artist').on('input', function() {
            let searchText = $(this).val().toLowerCase();
            let type = $(this).attr('id');
            myFilter(searchText, type);
        });
        myFilter('', 'genre');
        myFilter('', 'artist');

        $('body').on('change',
            '.my-input, #select-genre, #select-artist, #delete-all-select',
            function(event) {
                event.preventDefault();
                currentImgChecked.empty();
                currentImgSelected.empty();
                let inputName = $(this).attr('name');
                let inputId = $(this).val();
                if ($(this).is(':checked')) {
                    if (inputName === 'genre') {
                        if (!checkedGenre.find(genre => genre ===
                                inputId)) {
                            checkedGenre.push(inputId);
                        }
                    } else if (inputName === 'artist') {
                        if (!checkedArtist.find(artist => artist ===
                                inputId)) {
                            checkedArtist.push(inputId);
                        }
                    } else if (inputName === 'select-genre') {
                        $('.group-genre input[name="genre"]').prop('checked', true);
                        checkedGenre = $('.group-genre input[name="genre"]').map(
                            function() {
                                return this.value;
                            }).get();

                    } else if (inputName === 'select-artist') {
                        $('.group-artist input[name="artist"]').prop('checked', true);
                        checkedArtist = $('.group-artist input[name="artist"]').map(
                            function() {
                                return this.value;
                            }).get();
                    } else if (inputName === 'delete') {
                        if (window.confirm('Do you want to delete all selected songs ?')) {
                            checkedSongs = [];
                            countSelected.text('0');
                            contentSelected.empty();
                            contentSelected.append(imgEmpty);
                        }
                    }
                } else {
                    if (inputName === 'genre') {
                        checkedGenre = checkedGenre.filter(item => item !== inputId);
                    } else if (inputName === 'artist') {
                        checkedArtist = checkedArtist.filter(item => item !== inputId);
                    } else if (inputName === 'select-genre') {
                        $('.group-genre input[name="genre"]').prop('checked', false);
                        checkedGenre = [];
                    } else if (inputName === 'select-artist') {
                        $('.group-artist input[name="artist"]').prop('checked', false);
                        checkedArtist = [];

                    } else if (inputName === 'delete') {
                        if (window.confirm('Do you want to delete all selected songs ?')) {
                            checkedSongs = [];
                            countSelected.text('0');
                            contentSelected.empty();
                            contentSelected.append(imgEmpty);

                        }
                    }
                }
                let songList = $('#song-list');
                let select = $('.select');
                let search = $('.my-search');
                let tHead = $('#thead');
                // selectAllCheckbox = [];

                $.ajax({
                    url: '{{ route('admin.songs.song-by-request') }}',
                    type: 'POST',
                    data: {
                        genre_ids: checkedGenre,
                        artist_ids: checkedArtist,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        let songs = response.songs;
                        let genres = response.genres;
                        let artists = response.artists;
                        let relatedGenres = response.related_genres;
                        let relatedArtists = response.related_artists;
                        let newThead = $('<tr>').append(
                            $('<th>').attr('scope', 'col').text('#'),
                            $('<th>').attr('scope', 'col').text('Name'),
                            $('<th>').attr('scope', 'col').text(
                                'Artist'),
                            $('<th>').attr('scope', 'col').text(
                                'Genre'),
                            $('<th>').attr('scope', 'col').text(
                                'Album'),
                            $('<th>').attr('scope', 'col').text(
                                'Description'),
                        );
                        tHead.empty();
                        tHead.append(newThead);

                        let searchInput = $('#search-input');
                        if (searchInput.length === 0) {
                            searchInput = $('<input>').attr({
                                type: 'search',
                                placeholder: 'Search description...',
                                id: 'search-input',
                                class: 'px-2'
                            });
                        }

                        let selectAllLabel = $('#select-all-label');

                        if (selectAllCheckbox.length === 0) {
                            selectAllCheckbox = $('<input>').attr({
                                type: 'checkbox',
                                id: 'select-all'
                            });
                            selectAllLabel = $('<label>').attr({
                                for: 'select-all',
                                id: 'select-all-label'
                            }).text('Select All');
                            select.append(selectAllCheckbox,
                                selectAllLabel);
                        }

                        search.append(searchInput);

                        function filterSongs(searchText) {
                            filteredSongs = songs.filter(function(song) {
                                return (song.description ?? '')
                                    .toLowerCase()
                                    .includes(searchText) ||
                                    song.artists.some(artist => artist.name
                                        .toLowerCase().includes(searchText)) ||
                                    song.name.toLowerCase().includes(
                                        searchText);;
                            })
                            songList.empty();
                            if (filteredSongs.length) {
                                filteredSongs.forEach(function(song, index) {
                                    let newRow = createSongRow(song,
                                        index);
                                    songList.append(newRow);
                                });
                                if (!checkedSongs.length) {
                                    if (currentImgChecked.html() === '' && contentSelected
                                        .html() === '') {
                                        if (tHead.html() === '') {
                                            contentSelected.empty();
                                            currentImgChecked.html(
                                                '<img src="https://i.postimg.cc/W4QwLw28/image.png" alt="">'
                                            );
                                        } else {
                                            contentSelected.append(imgEmpty);
                                        }
                                    }
                                }
                            } else {
                                let imgEmpty2 = $('<tr>').html(`
                                        <td colspan="7" class="my-td"><img src="https://i.postimg.cc/W4QwLw28/image.png" alt=""></td>
                                    `)
                                songList.append(imgEmpty);
                                let theadSelected = $('#thead-selected');
                                if (!checkedSongs.length) {
                                    theadSelected.empty();
                                    contentSelected.empty();
                                    currentImgChecked.html(
                                        '<img src="https://i.postimg.cc/W4QwLw28/image.png" alt="">'

                                    );
                                }
                            }
                        }
                        searchInput.on('input', function() {
                            let searchText = $(this).val()
                                .toLowerCase();
                            filterSongs(searchText);
                        });
                        filterSongs('');

                        if (checkedArtist.length && checkedGenre.length) {
                            genreContent.empty();
                            artistContent.empty();
                            relatedGenres.forEach(item => {
                                let isChecked = checkedGenre.some(genreId =>
                                    Number(
                                        genreId) === item.id);
                                let inputGenre = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "genre",
                                    id: `genre[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `genre[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputGenre,
                                    label)
                                genreContent.append(newdiv)
                            });
                            relatedArtists.forEach(item => {
                                let isChecked = checkedArtist.some(artistId =>
                                    Number(artistId) === item.id);
                                let inputArtist = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "artist",
                                    id: `artist[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `artist[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputArtist,
                                    label)
                                artistContent.append(newdiv);
                            });
                        }
                        if (checkedArtist.length && relatedGenres.length) {
                            genreContent.empty();
                            relatedGenres.forEach(item => {
                                let isChecked = checkedGenre.some(genreId =>
                                    Number(
                                        genreId) === item.id);
                                let inputGenre = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "genre",
                                    id: `genre[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `genre[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputGenre,
                                    label)
                                genreContent.append(newdiv)
                            });
                        }
                        if (checkedArtist.length && !relatedGenres.length) {
                            genreContent.empty();
                            genreContent.append(imgNotFound);
                        }
                        if (checkedGenre.length && relatedArtists.length) {
                            artistContent.empty();
                            relatedArtists.forEach(item => {
                                let isChecked = checkedArtist.some(artistId =>
                                    Number(artistId) === item.id);
                                let inputArtist = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "artist",
                                    id: `artist[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `artist[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputArtist,
                                    label)
                                artistContent.append(newdiv);
                            });
                        }
                        if (checkedGenre.length && !relatedArtists.length) {
                            artistContent.empty();
                            artistContent.append(imgNotFound);
                        }
                        if (!checkedGenre.length) {
                            artistContent.empty();
                            artists.forEach(item => {
                                let isChecked = checkedArtist.some(artistId =>
                                    Number(artistId) === item.id);
                                let inputArtist = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "artist",
                                    id: `artist[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `artist[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputArtist,
                                    label)
                                artistContent.append(newdiv);
                            });

                        }
                        if (!checkedArtist.length) {
                            genreContent.empty();
                            genres.forEach(item => {
                                let isChecked = checkedGenre.some(genreId =>
                                    Number(
                                        genreId) === item.id);
                                let inputGenre = $('<input>').attr({
                                    type: 'checkbox',
                                    name: "genre",
                                    id: `genre[${item.id}]`,
                                    value: `${item.id}`,
                                    class: 'my-input',
                                    checked: isChecked
                                })
                                let label = $('<label>').attr({
                                    for: `genre[${item.id}]`,
                                }).text(`${item.name}`);
                                let newdiv = $('<div>').append(inputGenre,
                                    label)
                                genreContent.append(newdiv)
                            });

                        }
                        if (!checkedGenre.length && !checkedArtist.length) {
                            tHead.empty();
                            songList.empty();
                            select.empty();
                            search.empty();
                            currentImgSelected.html(
                                `<img src="https://i.postimg.cc/W4QwLw28/image.png" alt="">`
                            )
                            if (!checkedSongs.length) {
                                contentSelected.empty();
                                if (currentImgChecked.html() === '' && contentSelected
                                    .html() ===
                                    '') {
                                    contentSelected.append(imgEmpty);
                                }
                            }
                        }

                        selectAllCheckbox.change(function() {
                            $('input[name="songs[]"]').prop(
                                'checked', this
                                .checked);
                            if (this.checked) {
                                    filteredSongs.forEach(item => {
                                        if (!checkedSongs.find(song => song
                                                .id === item.id)) {
                                            checkedSongs.push(item);
                                        }
                                        contentSelected.empty();
                                        let countSongs = $('<span>').text(
                                            checkedSongs.length);
                                        countSelected.html(countSongs);
                                        if (checkedSongs.length) {
                                            checkedSongs.forEach(function(
                                                song) {
                                                contentSelected.append(
                                                    createSongRow(
                                                        song));
                                            });
                                        } else {
                                            contentSelected.append(
                                                imgEmpty
                                            )
                                        }
                                    });
                            } else {
                                if ($('input[name="songs[]"]').length > 0) {
                                        filteredSongs.forEach(item => {
                                            if (checkedSongs.find(song => song
                                                    .id === item.id)) {
                                                checkedSongs = checkedSongs
                                                    .filter(song => song.id !==
                                                        item.id);
                                            }
                                            contentSelected.empty();
                                            let countSongs = $('<span>').text(
                                                checkedSongs.length);
                                            countSelected.html(countSongs);
                                            if (checkedSongs.length) {
                                                checkedSongs.forEach(function(
                                                    song) {
                                                    contentSelected
                                                        .append(
                                                            createSongRow(
                                                                song));
                                                });
                                            } else {
                                                contentSelected.append(
                                                    imgEmpty
                                                )
                                            }
                                        });
                                }
                            }
                            selectAllLabel.text(this.checked ?
                                'Deselect All' :
                                'Select All');
                        });

                        $('input[name^="song["]').change(function() {
                            if ($('input[name^="song["]:checked')
                                .length === $(
                                    'input[name^="song["]').length
                            ) {
                                selectAllCheckbox.prop('checked',
                                    true);
                                selectAllLabel.text('Deselect All');
                            } else {
                                selectAllCheckbox.prop('checked',
                                    false);
                                selectAllLabel.text('Select All');
                            }
                        });

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', textStatus, errorThrown);
                    }
                });
            }
        );

        $('input[name="my-songs[]"]').on('change', function() {
            let inputId = $(this).val();
            checkedSongs = checkedSongs.filter((item) => {
                return item.id !== parseInt(inputId);
            })
            contentSelected.find(`#song\\[${inputId}\\]`).closest('tr').remove();
            countSelected.html(checkedSongs.length);
            if (!checkedSongs.length) {
                contentSelected.append(imgEmpty);
            }
        });


        $('form').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let formData = new FormData(form[0]);
            formData.append('checkedSong', JSON.stringify(checkedSongs));
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('admin.albums.all') }}";
                },
                error: function(xhr, status) {
                    if (xhr.status === 422) {
                        let errors = JSON.parse(xhr.responseText);
                        let formGroupElementErr = $('.form-group.has-error');
                        formGroupElementErr.removeClass('has-error');
                        formGroupElementErr.find('.invalid-feedback').remove()

                        let inputElementErr = $('.form-control.is-invalid');
                        inputElementErr.removeClass('is-invalid');

                        let groupContainerErr = $('.drop-container.has-error');
                        groupContainerErr.removeClass('has-error');
                        groupContainerErr.find('.invalid-feedback').remove()
                        $.each(errors.errors, function(field, messages) {
                            let inputElement = $('input[name="' + field + '"]');
                            inputElement.addClass('is-invalid');

                            let formGroupElement = inputElement.closest(
                                '.form-group');
                            formGroupElement.addClass('has-error');
                            formGroupElement.find('.invalid-feedback').remove();

                            let dropContainer = inputElement.closest(
                                '.drop-container');
                            dropContainer.addClass('has-error');
                            dropContainer.find('.invalid-feedback').remove();

                            $.each(messages, function(index, message) {
                                formGroupElement.append(
                                    '<div style="display:block;" class="invalid-feedback">' +
                                    message + '</div>');
                                dropContainer.append(
                                    '<div style="display:block;" class="invalid-feedback">' +
                                    message + '</div>');
                            });
                        });
                    }
                }
            });
        });

    });
</script>
