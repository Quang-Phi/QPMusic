<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/viewport/viewportchecker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('assets/js/plugins.bundle.js') }}" type="text/javascript"></script> --}}
<script src="{{ asset('assets/js/custom-script.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.page-topbar .sidebar_toggle').on('click', function() {
            let topbar = $(".page-topbar");
            let mainarea = $("#main-content");
            let menuarea = $(".page-sidebar");

            if (menuarea.hasClass("collapseit")) {
                menuarea.addClass("expandit").removeClass("collapseit");
                topbar.removeClass("sidebar_shift");
                mainarea.removeClass("sidebar_shift");
                // ULTRA_SETTINGS.mainmenuScroll();
            } else {
                menuarea.addClass("collapseit").removeClass("expandit");
                topbar.addClass("sidebar_shift");
                mainarea.addClass("sidebar_shift");
                // ULTRA_SETTINGS.mainmenuCollapsed();
            }
        });

        $('.box_toggle').on('click', function() {
            let content = $(this).parent().parent().find(".content-body");
            if (content.hasClass("collapsed")) {
                content.removeClass("collapsed").slideDown(500);
                $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            } else {
                content.addClass("collapsed").slideUp(500);
                $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            }

        });
    });

    $(document).ready(function() {
        let readMore = $('.read-more');
        let content = $('.text-profile');
        let lyricMore = $('.lyric-more');
        let lyric = $('.text-lyric');
        readMore.click(function() {
            if (readMore.html() == 'See more') {
                readMore.html('Collapse');
                setTimeout(function() {
                    content.addClass('text-profile-show');
                }, 100);
            } else {
                readMore.html('See more');
                content.removeClass('text-profile-show');
            }

        })
        lyricMore.click(function() {
            if (lyricMore.html() == 'See more') {
                lyricMore.html('Collapse');
                setTimeout(function() {
                    lyric.addClass('text-profile-show');
                }, 100)
            } else {
                lyricMore.html('See more');
                lyric.removeClass('text-profile-show');
            }
        })
    });

    function conFirmDelete() {
        if (windown.confirm('Delete this?')) {
            return true
        }
        return false;
    }

    $(document).ready(function() {
        const input = $('#img');
        const image = $('.custom-admin-img img');
        let text = $('.text-img');

        input.change(function() {
            const file = input[0].files[0];
            const reader = new FileReader();
            text.empty();
            reader.addEventListener('load', function() {
                image.attr('src', reader.result);
                image.css('display', 'block');
            });

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    });

    $('.player-custom').click(function() {
        let player = $('#player');
        if (player.height() === 0) {
            player.css('height', '74px');
            player.css('padding', '0 1.25rem 0');
        } else {
            player.css('height', '0px');
            player.css('padding', '0 1.25rem 0.1rem');
        }
    });

    $(document).ready(function() {
        $(window).on('beforeunload', function() {
            localStorage.removeItem("songs");
        });
    });

    $(document).ready(function() {
        $('.btn.btn-icon.btn-primary.rounded-pill').on('click', function() {
            let button = $(this);
            let time = $('#player .me-4');

            setTimeout(function() {
                $(button).prop("disabled", true);
            }, 100);

            if (time.hasClass('d-none')) {
                time.removeClass('d-none');
            }
        })
    });
</script>
