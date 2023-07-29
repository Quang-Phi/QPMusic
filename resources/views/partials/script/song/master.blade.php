<script>
    let checkedGenre = [];
    let checkedArtist = [];
    $(document).ready(function() {
        let genreContent = $('.genre-content');
        let artistContent = $('.artist-content');
        let genres = <?php echo json_encode($genres); ?>;
        let artists = <?php echo json_encode($artists); ?>;
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
                        checked: isChecked
                    })
                    let label = $('<label>').attr({
                        for: `artist[${item.id}]`,
                    }).text(`${item.name}`);
                    let newdiv = $('<div>').append(inputArtist, label)
                    artistContent.append(newdiv);
                });
            }
            $('input[name="genre"], input[name="artist"]').change(function() {
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
                    }
                } else {
                    if (inputName === 'genre') {
                        checkedGenre = checkedGenre.filter(item => item !== inputId);
                    } else if (inputName === 'artist') {
                        checkedArtist = checkedArtist.filter(item => item !== inputId);
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

        myFilter('', 'genre');
        myFilter('', 'artist');
        
        $('#select-genre, #select-artist').change(function() {
            let inputName = $(this).attr('name');
            let inputId = $(this).val();
            if ($(this).is(':checked')) {
                if (inputName === 'select-genre') {
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
                }
            } else {
                if (inputName === 'select-genre') {
                    $('.group-genre input[name="genre"]').prop('checked', false);
                    checkedGenre = [];

                } else if (inputName === 'select-artist') {
                    $('.group-artist input[name="artist"]').prop('checked', false);
                    checkedArtist = [];
                }
            }
        });

        $('form').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let formData = new FormData(form[0]);
            formData.append('checkedGenre', JSON.stringify(checkedGenre));
            formData.append('checkedArtist', JSON.stringify(checkedArtist));
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.href = "{{ route('admin.songs.all') }}";
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        let errors = JSON.parse(xhr.responseText);
                        $.each(errors.errors, function(field, messages) {
                            let inputElement = $('input[name="' + field + '"]');
                            let formGroupElement = inputElement.closest(
                                '.form-group');
                            formGroupElement.addClass('has-error');
                            formGroupElement.find('.invalid-feedback').remove();
                            $.each(messages, function(index, message) {
                                formGroupElement.append(
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