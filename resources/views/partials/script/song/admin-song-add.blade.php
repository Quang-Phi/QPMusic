<script>
    let checkedGenres = [];
    let checkedArtists = [];
    let checkedAlbums = [];

    $(document).ready(function() {
        let genreContent = $('.genre-content'),
         artistContent = $('.artist-content'),
         albumContent = $('.album-content'),
         genres = <?php echo json_encode($genres); ?>,
         artists = <?php echo json_encode($artists); ?>,
         albums = <?php echo json_encode($albums); ?>,
         artistsSongFile = [],
         genresSongFile = [];
         albumsSongFile = [];

        $('input[name="url"]').on('change', function() {
            let inputName  = $('input[name="name"]'),
                currentGenre = $('.current-genre span.content'),
                currentAlbum = $('.current-album span.content'),
                currentArtist = $('.current-artist span.content');
            let formData = new FormData(),
            csrfToken = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', csrfToken);
            try {
                formData.append('song', this.files[0]);
            } catch (error) {
                console.log(error);
            }
            $.ajax({
                type: "POST",
                url: "/admin/songs/info-song",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    artistsSongFile = data.artistsSongFile;
                    genresSongFile = data.genresSongFile;
                    inputName.val(data.title);
                    // currentAlbum.empty();
                    artistsSongFile.length?currentArtist.empty(): '';
                        artistsSongFile.forEach(function(item, index) {  
                            // albumsSongFile.push('album '+ item);
                        if(index != artistsSongFile.length-1){
                        currentArtist.append(`${item}, `);
                        }
                        else{
                        currentArtist.append(`${item}`);
                        }
                    });

                    genresSongFile.length?currentGenre.empty(): '';
                    genresSongFile.forEach(function(item, index) {          
                        if(index != genresSongFile.length-1){
                        currentGenre.append(`${item}, `);
                        }
                        else{
                        currentGenre.append(`${item}`);
                        }
                    });

                //    albumsSongFile.length?currentAlbum.empty(): '';
                //    albumsSongFile.forEach(function(item, index) {          
                //         if(index != albumsSongFile.length-1){
                //             currentAlbum.append(`${item}, `);
                //         }
                //         else{
                //             currentAlbum.append(`${item}`);
                //         }
                //     });



                    if(data.songArtistIdInDB.length){
                        data.songArtistIdInDB.forEach(function(item, index) { 
                            checkedArtists.push(item);
                        });
                    }

                    if(data.songGenreIdInDB.length){
                    data.songGenreIdInDB.forEach(function(item, index) { 
                        checkedGenres.push(item);
                    });
                    }

                    // if(data.songAlbumIdInDB.length){
                    // data.songAlbumIdInDB.forEach(function(item, index) {
                    //     checkedAlbums.push(item);
                    // })
                    // }
                    myFilter('', 'genre');
                    myFilter('', 'artist');
                    myFilter('', 'album');
                }
            });
        });

        const myFilter = (text, type) => {
            if (type == 'genre') {
                let listGenreFiltered = genres.filter(genre => genre.name.toLowerCase().includes(text));
                genreContent.empty();
                listGenreFiltered.forEach(item => {
                    let isChecked = checkedGenres.some(genreId => Number(genreId) === item.id);
                    let inputGenre = $('<input>').attr({
                        type: 'checkbox',
                        name: "genre",
                        id: `genre[${item.id}]`,
                        value: `${item.id}`,
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `genre[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputGenre, label)
                    genreContent.append(newdiv);
                });
            }else if (type == 'album') {
                let listAlbumFiltered = albums.filter(album => album.name.toLowerCase().includes(text));
                albumContent.empty();
                listAlbumFiltered.forEach(item => {
                    let isChecked = checkedAlbums.some(albumId => Number(albumId) === item.id);
                    let inputAlbum = $('<input>').attr({
                        type: 'checkbox',
                        name: "album",
                        id: `album[${item.id}]`,
                        value: `${item.id}`,
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `album[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputAlbum, label)
                    albumContent.append(newdiv);
                });
            } else {
                let listArtistFiltered = artists.filter(artist => artist.name.toLowerCase().includes(text));
                artistContent.empty();
                listArtistFiltered.forEach(item => {
                    let isChecked = checkedArtists.some(artistId => Number(artistId) === item.id);
                    let inputArtist = $('<input>').attr({
                        type: 'checkbox',
                        name: "artist",
                        id: `artist[${item.id}]`,
                        value: `${item.id}`,
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `artist[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputArtist, label)
                    artistContent.append(newdiv);
                });
            }

            $('input[name="genre"], input[name="artist"],input[name="album"]').change(function() {
                let inputName = $(this).attr('name'),
                    inputId = Number($(this).val());
                if ($(this).is(':checked')) {
                    if (inputName === 'genre') {
                        if (!checkedGenres.find(genreId => genreId ===
                                inputId)) {
                            checkedGenres.push(inputId);
                        }
                    } else if (inputName === 'artist') {
                        if (!checkedArtists.find(artistId => artistId ===
                                inputId)) {
                            checkedArtists.push(inputId);
                        }
                    }
                    else if (inputName === 'album') {
                        if (!checkedAlbums.find(albumId => albumId ===
                                inputId)) {
                            checkedAlbums.push(inputId);
                        }
                    }
                } else {
                    if (inputName === 'genre') {
                        checkedGenres = checkedGenres.filter(item => item !== inputId);
                    } else if (inputName === 'artist') {
                        checkedArtists = checkedArtists.filter(item => item !== inputId);
                    }
                    else if (inputName === 'album') {
                        checkedAlbums = checkedAlbums.filter(item => item !== inputId);
                    }
                }
            });
        };

        $('#search-genre').on('input', function() {
            let searchText = $(this).val().toLowerCase();
            myFilter(searchText, 'genre');
        });

        $('#search-artist').on('input', function() {
            let searchText = $(this).val().toLowerCase();
            myFilter(searchText, 'artist');
        });

        $('#search-album').on('input', function() {
            let searchText = $(this).val().toLowerCase();
            myFilter(searchText, 'album');
        });

        myFilter('', 'genre');
        myFilter('', 'artist');
        myFilter('', 'album');

        $('#main-content').on('change',
            'input[name="genre"], input[name="artist"],input[name="album"],#select-genre,#select-album, #select-artist',
            function(event) {
                event.preventDefault();
                let inputName = $(this).attr('name'),
                    inputId = Number($(this).val());
                if ($(this).is(':checked')) {
                    if (inputName === 'genre') {
                        if (!checkedGenres.find(genreId => genreId ===
                                inputId)) {
                            checkedGenres.push(inputId);
                        }
                    } else if (inputName === 'artist') {
                        if (!checkedArtists.find(artistId => artistId ===
                                inputId)) {
                            checkedArtists.push(inputId);
                        }
                    } else if (inputName === 'album') {
                        if (!checkedAlbums.find(albumId => albumId ===
                                inputId)) {
                           checkedAlbums .push(inputId);
                        }
                    } else if (inputName === 'select-genre') {
                        $('.group-genre input[name="genre"]').prop('checked', true);
                        checkedGenres = $('.group-genre input[name="genre"]').map(
                            function() {
                                return this.value;
                            }).get();

                    } else if (inputName === 'select-artist') {
                        $('.group-artist input[name="artist"]').prop('checked', true);
                        checkedArtists = $('.group-artist input[name="artist"]').map(
                            function() {
                                return this.value;
                            }).get();
                    } else if (inputName === 'select-album') {
                        $('.group-album input[name="album"]').prop('checked', true);
                        checkedAlbums = $('.group-album input[name="album"]').map(
                            function() {
                                return this.value;
                            }).get();
                    } 
                } else {
                    if (inputName === 'genre') {
                        checkedGenres = checkedGenres.filter(item => item !== inputId);
                    } else if (inputName === 'artist') {
                        checkedArtists = checkedArtists.filter(item => item !== inputId);
                    } else if (inputName === 'album') {
                        checkedAlbums = checkedAlbums.filter(item => item !== inputId);
                    } else if (inputName === 'select-genre') {
                        $('.group-genre input[name="genre"]').prop('checked', false);
                        checkedGenres = [];
                    } else if (inputName === 'select-artist') {
                        $('.group-artist input[name="artist"]').prop('checked', false);
                        checkedArtists = [];

                    } else if (inputName === 'select-album') {
                        $('.group-album input[name="album"]').prop('checked', false);
                        checkedAlbums = [];

                    } 
                }
            }
        );

        $('form').submit(function(event) {
            event.preventDefault();
            let form = $(this),
                url = form.attr('action'),
                formData = new FormData(form[0]);
            formData.append('checkedGenres', JSON.stringify(checkedGenres));
            formData.append('checkedArtists', JSON.stringify(checkedArtists));
            formData.append('checkedAlbums', JSON.stringify(checkedAlbums));
            formData.append('artistsSongFile', JSON.stringify(artistsSongFile));
            formData.append('genresSongFile', JSON.stringify(genresSongFile));
            formData.append('albumsSongFile', JSON.stringify(albumsSongFile));
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('admin.songs.all') }}";
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