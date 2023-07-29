"use strict";

var Base = (function () {
    var e = "active",
        t = $("body"),
        csrfToken = $('meta[name="csrf-token"]').attr("content"),
        a = function (a, r) {
            var l = $("#line_loader");
            l.show().animate({ width: 20 + 80 * Math.random() + "%" }, 200),
                $.ajax({ url: a, type: "GET", dataType: "html" })
                    .done(function (e, t, a) {
                        l
                            .animate({ width: "100%" }, 200)
                            .fadeOut(300, function () {
                                $(this).width("0");
                            }),
                            ((e = $("<div>" + e + "</div>")),
                            $("head title").html(e.find("title").html()),
                            $("#wrapper").html(e.find("#wrapper").html()),
                            $("html, body").animate({ scrollTop: 0 }, 100),
                            n(),
                            i());
                    })
                    .fail(function () {
                        window.location.href = "404.html";
                    })
                    .always(function () {
                        r &&
                            r.length &&
                            $(window).width() < 992 &&
                            ($(".sidebar-toggler").toggleClass(e),
                            t.removeAttr("data-sidebar-toggle"));
                    });
        },
        i = function () {
            var e = Utils.getLocalItem("skin"),
                t = document.getElementById("header"),
                a = document.getElementById("sidebar");
            e &&
                t &&
                a &&
                (t.setAttribute("data-header", e.header),
                a.setAttribute("data-sidebar", e.sidebar));
        },
        f = function (e) {
            let isLink = e.img_url.split("/");
            if (isLink[0] == "http:" || isLink[0] == "https:") {
                return true;
            }
            return false;
        },
        n = function () {
            var a, i, n, r, l;
            if (
                ($('[data-scroll="true"]').each(function () {
                    new PerfectScrollbar(this, {
                        wheelSpeed: 2,
                        swipeEasing: !0,
                        wheelPropagation: !1,
                        minScrollbarLength: 40,
                    });
                }),
                $(".swiper").each(function () {
                    var e = parseInt(this.getAttribute("data-swiper-slides")),
                        t = this.parentElement,
                        a = this.getAttribute("data-swiper-loop"),
                        i = this.getAttribute("data-swiper-autoplay"),
                        n = t.querySelector(".swiper-button-next"),
                        r = t.querySelector(".swiper-button-prev"),
                        l = t.querySelector(".swiper-pagination"),
                        o = this.getAttribute("data-swiper-pagination")
                            ? this.getAttribute("data-swiper-pagination")
                            : "bullets",
                        s = t.querySelector(".swiper-scrollbar"),
                        d = 1,
                        p = 2;
                    1 === e
                        ? (d = p = 1)
                        : e > 1 && e < 5
                        ? ((d = 2), (p = 1))
                        : e >= 5 && ((d = 3), (p = 2));
                    var u = {
                        speed: 500,
                        slidesPerView: p,
                        slidesPerGroup: p,
                        spaceBetween: 16,
                        a11y: !0,
                        breakpoints: {
                            576: { slidesPerView: d, slidesPerGroup: d },
                            1200: {
                                slidesPerView: e,
                                slidesPerGroup: e,
                                spaceBetween: 24,
                            },
                        },
                    };
                    a && (u.loop = a),
                        i &&
                            (u.autoplay = {
                                delay: 5e3,
                                disableOnInteraction: !1,
                                pauseOnMouseEnter: !0,
                            }),
                        n && r && (u.navigation = { nextEl: n, prevEl: r }),
                        l &&
                            (u.pagination = {
                                el: l,
                                type: o,
                                clickable: !0,
                                dynamicBullets: !0,
                            }),
                        s && (u.scrollbar = { el: s, draggable: !0 }),
                        new Swiper(this, u);
                }),
                document.querySelector(".dropzone") &&
                    ((Dropzone.autoDiscover = !1),
                    new Dropzone(".dropzone", { url: "/file/post" })),
                (a = "mat-tabs__line"),
                (i = $("<span>", { class: a })),
                (n = $(".mat-tabs")),
                (r = $(".nav-link")),
                n.each(function () {
                    var e = $(this).find(".nav-link.active").outerWidth();
                    i.stop().css({ width: e }), i.appendTo(this);
                }),
                r.on("click", function () {
                    var e = $(this);
                    e.closest(".mat-tabs")
                        .find("." + a)
                        .stop()
                        .css({
                            left: e.position().left,
                            width: e.outerWidth(),
                        });
                }),
                (l = !1),
                $(".sidebar-toggler").on("click", function () {
                    (l = !l),
                        $(this).toggleClass(e),
                        t.attr("data-sidebar-toggle", l ? "true" : "false");
                    $("#playlists-content").hasClass("show")
                        ? $("#playlists-content").removeClass("show")
                        : "";
                    $(".navbar-nav").hasClass("d-none")
                        ? $(".navbar-nav").removeClass("d-none")
                        : "";
                }),
                $("#page_content").on("click", ".item-download a", function () {
                    let idSong = $(this).data("download-id");
                    let useFeature = $("body").data("use-feature");
                    if (useFeature == true) {
                        let url =
                            "/home/download-song/" +
                            idSong +
                            "?rand=" +
                            Math.floor(Math.random() * 100);
                        window.location = url;
                    } else {
                        toastr.info("Upgrade to Premium to download this Song");
                    }
                }),
                $(".search__head__filter button").on("click", function () {
                    $(".search__head__filter button").removeClass("active");
                    $(this).addClass("active");
                    let tabContent = $(".tab-content");
                    tabContent.removeClass("active");
                    let dataTab = $(this).data("tab-nav"),
                        content = $(
                            '.tab-content[data-tab-content="' + dataTab + '"]'
                        );
                    content.addClass("active");
                    search.bind(this)();
                }),
                $("#search_input").on("keyup", function () {
                    search.bind(this)();
                }),
                $(".item-remove-playlist a").on("click", function () {
                    let idSong = $(this).data("song-id-item"),
                        idPlaylist = $(this).data("playlist-id");
                    if (confirm("Are you sure?")) {
                        console.log(idSong, idPlaylist);
                        $.ajax({
                            type: "get",
                            url: "/home/remove-song-from-playlist",
                            data: {
                                idSong: idSong,
                                idPlaylist: idPlaylist,
                                _token: csrfToken,
                            },
                            dataType: "json",
                            success: function (response) {
                                response.success == true
                                    ? toastr.success(
                                          "Remove song successfully",
                                          "Success"
                                      )
                                    : toastr.error(
                                          "Remove song failed",
                                          "Error"
                                      );
                                $(
                                    '.list__item[data-song-id="' + idSong + '"]'
                                ).remove();
                            },
                        });
                    }
                }),
                $(document).on("click", function (event) {
                    if (!$(event.target).is(".icon-rate,.icon-rate *")) {
                        $("#reviews").removeClass("active");
                    }
                    if (!$(event.target).is(".header-container *")) {
                        $("#search_results").removeClass("active");
                    }
                    if (!$(event.target).is("dialog form *,.playlist_name")) {
                        $("body").find("dialog").remove();
                    }
                }),
                $(".icon-rate a").on("click", function (e) {
                    e.preventDefault();
                    $("#reviews").toggleClass("active");
                }),
                $("#reviews form").submit(function (event) {
                    event.preventDefault();
                    let form = $(this),
                        url = form.attr("action"),
                        formData = new FormData(form[0]),
                        type = form.find('input[name="type"]').val();
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            $("#reviews").removeClass("active");
                            if (response.success == true) {
                                toastr.success(
                                    `Submit  ${type} review successfully`,
                                    "Success"
                                );
                                $("#reviews").removeClass("active");
                            } else {
                                toastr.error(
                                    `You have already reviewed ${type}`,
                                    "Error"
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            // console.log(xhr.responseText);
                        },
                    });
                }),
                $(".search").on("click", function (e) {
                    e.stopPropagation();
                }),
                $(".player-custom").click(function () {
                    let player = $("#player");
                    if (player.height() < 50) {
                        player.css("height", "72px");
                        player.css("padding", "0 1.25rem 0");
                    } else {
                        player.css("height", "0px");
                        player.css("padding", "0 1.25rem 0.1rem");
                    }
                }),
                $("#play_all, a[data-collection-play-id]").on(
                    "click",
                    function () {
                        let csrfToken = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        let collection = $(this).data("type");
                        let albumId = $(this).data("collection-play-id");
                        $.ajax({
                            url: "/home/histories-add/" + albumId,
                            method: "POST",
                            data: {
                                _token: csrfToken,
                                albumId: albumId,
                                collection: collection,
                            },
                        });
                    }
                ),
                $("#page_content,#search_results").on(
                    "change",
                    ".add-fvr",
                    function (e) {
                        let idItem = $(this).data("favorite-id"),
                            typeItem = $(this).data("type"),
                            checked = $(this).is(":checked"),
                            count = $(this).parent().find("span.fw-medium"),
                            countNum = parseInt(count.text());
                        csrfToken = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        $.ajax({
                            url: "/home/favorites-item/" + idItem,
                            method: "POST",
                            data: {
                                _token: csrfToken,
                                idItem: idItem,
                                typeItem: typeItem,
                            },
                            success: function (response) {
                                if (typeItem == "song") {
                                    if (response.action == "added") {
                                        count.text(countNum + 1);
                                        toastr.success(
                                            "Successfully added Song to Favorites.",
                                            "Success!"
                                        );
                                    } else {
                                        countNum > 0
                                            ? count.text(countNum - 1)
                                            : count.text(0);
                                        let wrap = $(".list.song-favorite");
                                        wrap.find(
                                            '.list__item[data-song-id="' +
                                                idItem +
                                                '"]'
                                        ).remove();
                                        let availabel =
                                            wrap.find(".list__item");
                                        if (!availabel.length) {
                                            wrap.append(`
                                        <p>The favorite Songs list is empty.</p>
                                        `);
                                        }

                                        toastr.error(
                                            "Successfully removed Song from Favorites.",
                                            "Success!"
                                        );
                                    }
                                } else if (typeItem == "album") {
                                    if (response.action == "added") {
                                        count.text(countNum + 1);
                                        toastr.success(
                                            "Successfully added Album to Favorites.",
                                            "Success!"
                                        );
                                    } else {
                                        countNum > 0
                                            ? count.text(countNum - 1)
                                            : count.text(0);
                                        let wrap = $(".album-wraper");
                                        wrap.find(
                                            '.swiper-slide[data-album-id="' +
                                                idItem +
                                                '"]'
                                        ).remove();
                                        let availabel =
                                            wrap.find(".swiper-slide");
                                        if (!availabel.length) {
                                            wrap.append(`
                                        <p>The favorite Albums list is empty.</p>
                                        `);
                                        }
                                        toastr.error(
                                            "Successfully removed Album from Favorites.",
                                            "Success!"
                                        );
                                    }
                                } else if (typeItem == "artist") {
                                    count.text(countNum + 1);
                                    if (response.action == "added") {
                                        toastr.success(
                                            "Successfully added Artist to Favorites.",
                                            "Success!"
                                        );
                                    } else {
                                        countNum > 0
                                            ? count.text(countNum - 1)
                                            : count.text(0);
                                        let wrap = $(".album-wraper");
                                        wrap.find(
                                            '.swiper-slide[data-album-id="' +
                                                idItem +
                                                '"]'
                                        ).remove();
                                        let availabel =
                                            wrap.find(".swiper-slide");
                                        if (!availabel.length) {
                                            wrap.append(`
                                        <p>No Artist Available</p>
                                        `);
                                        }
                                        toastr.error(
                                            "Successfully removed Artist from Favorites.",
                                            "Success!"
                                        );
                                    }
                                }
                            },
                            error: function (err) {
                                toastr.error(
                                    "Something went wrong. Please try again.",
                                    "Error!"
                                );
                                $(this).prop("checked", !checked);
                            },
                        });
                    }
                ),
                $(".btn-load-more").on("click", function (e) {
                    e.preventDefault();
                    $(this).addClass("loading");
                    $(this)
                        .prop("disabled", true)
                        .find("span")
                        .text("Loading...");
                    let dataType = $(this).data("type");
                    let limit = $(this).data("limit");
                    let quantity = $(this).attr("data-quantity");
                    let dataId = $(this).data("id");
                    let dataLoad = $(this).data("load");
                    let csrfToken = $('meta[name="csrf-token"]').attr(
                        "content"
                    );

                    let quantityLoad = parseInt(quantity) + parseInt(limit);
                    $.ajax({
                        type: "get",
                        url: "/home/load-more",
                        data: {
                            dataType: dataType,
                            quantityLoad: quantityLoad,
                            dataId: dataId,
                            dataLoad: dataLoad,
                            _token: csrfToken,
                        },
                        dataType: "json",
                        success: function (response) {
                            let data = response.data;
                            let publicFile = window.location.origin;

                            function checkFileExists(fileUrl) {
                                var http = new XMLHttpRequest();
                                http.open("HEAD", fileUrl, false);
                                http.send();
                                return http.status != 404;
                            }
                            if (!dataId) {
                                if (dataType == "genre") {
                                    let list = $(".genre-list");
                                    $.each(data, function (index, element) {
                                        let imgUrl =
                                            publicFile +
                                            "/img/" +
                                            dataLoad +
                                            "/" +
                                            element.img_url;
                                        let imgSrc = "";
                                        if (f(element)) {
                                            imgSrc = element.img_url;
                                        } else {
                                            if (checkFileExists(imgUrl)) {
                                                imgSrc = imgUrl;
                                            }
                                        }
                                        if (
                                            index >= quantity &&
                                            index <= quantityLoad
                                        ) {
                                            list.append(`
                                                    <div class="col-xl-3 col-sm-6 genre-item">
                                                    <div class="cover cover--round">
                                                        <a href="/home/genre-details/${element.id}" class="cover__image">
                                                        <img src="${imgSrc}" alt="Remix">
                                                        <div class="cover__image__content">
                                                            <span class="capitalize cover__title mb-1 fs-6 text-truncate">${element.name}</span>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    </div>
                                                `);
                                        }
                                    });
                                    $(".btn-load-more").attr(
                                        "data-quantity",
                                        quantityLoad
                                    );
                                    $(".btn-load-more")
                                        .removeClass("loading")
                                        .find("span")
                                        .text("Load more");
                                } else if (dataType == "album") {
                                    let dataAlbum = response.data["albums"];
                                    let dataFvr = response.data["albumFvr"];
                                    let albumFVr = dataFvr.map((item) => {
                                        return item.album_id;
                                    });

                                    let list = $(".list.album-list");
                                    $.each(
                                        dataAlbum,
                                        function (index, element) {
                                            let artistLinks = "";
                                            if (
                                                index >= quantity &&
                                                index <= quantityLoad
                                            ) {
                                                $.ajax({
                                                    type: "get",
                                                    url:
                                                        "/home/get-artsist-in-album/" +
                                                        element.id,
                                                    data: {
                                                        _token: csrfToken,
                                                    },
                                                    dataType: "json",
                                                    success: function (songs) {
                                                        let artists = [];
                                                        if (songs.length) {
                                                            if (
                                                                songs.length > 3
                                                            ) {
                                                                for (
                                                                    let i = 0;
                                                                    i < 3;
                                                                    i++
                                                                ) {
                                                                    let artistsArr =
                                                                        songs[i]
                                                                            .artists;
                                                                    $.each(
                                                                        artistsArr,
                                                                        function (
                                                                            index,
                                                                            item
                                                                        ) {
                                                                            artists.push(
                                                                                item
                                                                            );
                                                                        }
                                                                    );
                                                                }
                                                            } else {
                                                                for (
                                                                    let i = 0;
                                                                    i <
                                                                    songs.length;
                                                                    i++
                                                                ) {
                                                                    let artistsArr =
                                                                        songs[i]
                                                                            .artists;
                                                                    $.each(
                                                                        artistsArr,
                                                                        function (
                                                                            index,
                                                                            item
                                                                        ) {
                                                                            artists.push(
                                                                                item
                                                                            );
                                                                        }
                                                                    );
                                                                }
                                                            }
                                                        }

                                                        const uniqueArtists =
                                                            artists.filter(
                                                                (
                                                                    item,
                                                                    index
                                                                ) => {
                                                                    return (
                                                                        index ===
                                                                        artists.findIndex(
                                                                            (
                                                                                obj
                                                                            ) => {
                                                                                return (
                                                                                    obj.id ===
                                                                                        item.id &&
                                                                                    obj.name ===
                                                                                        item.name
                                                                                );
                                                                            }
                                                                        )
                                                                    );
                                                                }
                                                            );
                                                        let artistList =
                                                            uniqueArtists.slice(
                                                                0,
                                                                3
                                                            );
                                                        $.each(
                                                            artistList,
                                                            function (
                                                                index,
                                                                item
                                                            ) {
                                                                artistLinks +=
                                                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                                    item.id +
                                                                    '">' +
                                                                    item.name +
                                                                    "</a>";
                                                                if (
                                                                    artistList.length >
                                                                        1 &&
                                                                    index !=
                                                                        artistList.length -
                                                                            1
                                                                ) {
                                                                    artistLinks +=
                                                                        ", ";
                                                                }
                                                                if (
                                                                    artistList.length >
                                                                        3 &&
                                                                    index ==
                                                                        artistList.length -
                                                                            1
                                                                ) {
                                                                    artistLinks +=
                                                                        ", ...";
                                                                }
                                                            }
                                                        );
                                                        let imgUrl =
                                                            publicFile +
                                                            "/img/" +
                                                            dataLoad +
                                                            "/" +
                                                            element.img_url;
                                                        let imgSrc = "";
                                                        if (f(element)) {
                                                            imgSrc =
                                                                element.img_url;
                                                        } else {
                                                            if (
                                                                checkFileExists(
                                                                    imgUrl
                                                                )
                                                            ) {
                                                                imgSrc = imgUrl;
                                                            }
                                                        }
                                                        list.append(`
                                                        <div class="list__item">
                                                            <a href="/home/album-details/${
                                                                element.id
                                                            }" class="list__cover"><img
                                                                    src="${imgSrc}" alt="" /></a>
                                                            <div class="list__content">
                                                                <a href="/home/album-details/${
                                                                    element.id
                                                                }"
                                                                    class="list__title text-truncate">${
                                                                        element.name
                                                                    }</a>
                                                                <p class="cover__subtitle text-truncate"> ${artistLinks}</p>
                                                            </div>
                                                            <ul class="list__option">
                                                                <li class="icon-fvr">
                                                                    <label class="add-fvr" data-type="album" data-favorite-id="${
                                                                        element.id
                                                                    }"
                                                                        for="album[${
                                                                            element.id
                                                                        }]">
                                                                        <input ${
                                                                            albumFVr.includes(
                                                                                element.id
                                                                            )
                                                                                ? "checked"
                                                                                : ""
                                                                        } title="like" type="checkbox" class="like" id="album[${
                                                            element.id
                                                        }]">
                                                                        
                                                                        <div class="checkmark">
                                                                            <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                                                </path>
                                                                            </svg>
                                                                            <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                                                </path>
                                                                            </svg>
                                                                            <svg class="celebrate" width="100" height="100"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <polygon points="10,10 20,20" class="poly"></polygon>
                                                                                <polygon points="10,50 20,50" class="poly"></polygon>
                                                                                <polygon points="20,80 30,70" class="poly"></polygon>
                                                                                <polygon points="90,10 80,20" class="poly"></polygon>
                                                                                <polygon points="90,50 80,50" class="poly"></polygon>
                                                                                <polygon points="80,80 70,70" class="poly"></polygon>
                                                                            </svg>
                                                                        </div>
                                                                    </label>
                                                                </li>
                                                                <li class="dropstart d-inline-flex">
                                                                    <a class="dropdown-link" href="javascript:void(0);" role="button"
                                                                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                                                            class="ri-more-fill"></i></a>
                                                                    <ul class="dropdown-menu dropdown-menu-sm">
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                        data-collection-play-id="${
                                                                            element.id
                                                                        }" 
                                                                        data-type="album" 
                                                                        data-id="${
                                                                            element.id
                                                                        }">Play</a>
                                                                    </li>
                                                                    <li>
                                                                    <a class="dropdown-item"
                                                                        href="/home/album-details/${
                                                                            element.id
                                                                        }">View
                                                                        details</a>
                                                                </li>
                
                                                                    </ul>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                     `);

                                                        $(
                                                            ".btn-load-more"
                                                        ).attr(
                                                            "data-quantity",
                                                            quantityLoad
                                                        );
                                                        $(".btn-load-more")
                                                            .removeClass(
                                                                "loading"
                                                            )
                                                            .find("span")
                                                            .text("Load more");
                                                    },
                                                });
                                                $(
                                                    ".list__content .cover__subtitle"
                                                ).append(artistLinks);
                                            }
                                        }
                                    );
                                } else if (dataType == "artist") {
                                    let list = $(".artist-list");
                                    $.each(data, function (index, element) {
                                        if (
                                            index >= quantity &&
                                            index <= quantityLoad
                                        ) {
                                            let imgUrl =
                                                publicFile +
                                                "/img/" +
                                                dataLoad +
                                                "/" +
                                                element.img_url;
                                            let imgSrc = "";
                                            if (f(element)) {
                                                imgSrc = element.img_url;
                                            } else {
                                                if (checkFileExists(imgUrl)) {
                                                    imgSrc = imgUrl;
                                                }
                                            }
                                            list.append(`
                                                    <div class="col-6 col-xl-2 col-md-3 col-sm-4">
                                                        <a href="/home/artist-details/${element.id}" class="cover cover--round">
                                                            <div class="cover__image">
                                                                <img src="${imgSrc}" alt="Artist" />
                                                            </div>
                                                            <div class="cover__foot">
                                                                <span class="cover__title text-truncate"> ${element.name}</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                `);
                                        }
                                    });
                                    $(".btn-load-more").attr(
                                        "data-quantity",
                                        quantityLoad
                                    );
                                    $(".btn-load-more")
                                        .removeClass("loading")
                                        .find("span")
                                        .text("Load more");
                                } else if (dataType == "playlist") {
                                    let list = $(".list.playlist-list");
                                    $.each(data, function (index, element) {
                                        let artistLinks = "";
                                        if (
                                            index >= quantity &&
                                            index <= quantityLoad
                                        ) {
                                            $.ajax({
                                                type: "get",
                                                url:
                                                    "/home/get-artsist-in-playlist/" +
                                                    element.id,
                                                data: {
                                                    _token: csrfToken,
                                                },
                                                dataType: "json",
                                                success: function (songs) {
                                                    let artists = [];
                                                    if (songs.length) {
                                                        if (songs.length > 3) {
                                                            for (
                                                                let i = 0;
                                                                i < 3;
                                                                i++
                                                            ) {
                                                                let artistsArr =
                                                                    songs[i]
                                                                        .artists;
                                                                $.each(
                                                                    artistsArr,
                                                                    function (
                                                                        index,
                                                                        item
                                                                    ) {
                                                                        artists.push(
                                                                            item
                                                                        );
                                                                    }
                                                                );
                                                            }
                                                        } else {
                                                            for (
                                                                let i = 0;
                                                                i <
                                                                songs.length;
                                                                i++
                                                            ) {
                                                                let artistsArr =
                                                                    songs[i]
                                                                        .artists;
                                                                $.each(
                                                                    artistsArr,
                                                                    function (
                                                                        index,
                                                                        item
                                                                    ) {
                                                                        artists.push(
                                                                            item
                                                                        );
                                                                    }
                                                                );
                                                            }
                                                        }
                                                    }

                                                    const uniqueArtists =
                                                        artists.filter(
                                                            (item, index) => {
                                                                return (
                                                                    index ===
                                                                    artists.findIndex(
                                                                        (
                                                                            obj
                                                                        ) => {
                                                                            return (
                                                                                obj.id ===
                                                                                    item.id &&
                                                                                obj.name ===
                                                                                    item.name
                                                                            );
                                                                        }
                                                                    )
                                                                );
                                                            }
                                                        );
                                                    let artistList =
                                                        uniqueArtists.slice(
                                                            0,
                                                            3
                                                        );
                                                    $.each(
                                                        artistList,
                                                        function (index, item) {
                                                            artistLinks +=
                                                                '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                                item.id +
                                                                '">' +
                                                                item.name +
                                                                "</a>";
                                                            if (
                                                                artistList.length >
                                                                    1 &&
                                                                index !=
                                                                    artistList.length -
                                                                        1
                                                            ) {
                                                                artistLinks +=
                                                                    ", ";
                                                            }
                                                            if (
                                                                artistList.length >
                                                                    3 &&
                                                                index ==
                                                                    artistList.length -
                                                                        1
                                                            ) {
                                                                artistLinks +=
                                                                    ", ...";
                                                            }
                                                        }
                                                    );
                                                    let imgUrl =
                                                        publicFile +
                                                        "/img/" +
                                                        dataLoad +
                                                        "/" +
                                                        element.img_url;
                                                    let imgSrc = "";
                                                    if (f(element)) {
                                                        imgSrc =
                                                            element.img_url;
                                                    } else {
                                                        if (
                                                            checkFileExists(
                                                                imgUrl
                                                            )
                                                        ) {
                                                            imgSrc = imgUrl;
                                                        }
                                                    }
                                                    list.append(`
                                                        <div class="list__item">
                                                            <a href="/home/playlist-details/${element.id}" class="list__cover"><img
                                                                    src="${imgSrc}" alt="" /></a>
                                                            <div class="list__content">
                                                                <a href="/home/playlist-details/${element.id}"
                                                                    class="list__title text-truncate">${element.name}</a>
                                                                <p class="cover__subtitle text-truncate"> ${artistLinks}</p>
                                                            </div>
                                                            <ul class="list__option">
                                                                <li class="icon-fvr">
                                                                    <label class="add-fvr" data-type="playlist" data-favorite-id="${element.id}"
                                                                        for="playlist[${element.id}]">
                                                                        <input title="like" type="checkbox" class="like" id="playlist[${element.id}]">
                                                                        
                                                                        <div class="checkmark">
                                                                            <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                                                </path>
                                                                            </svg>
                                                                            <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                                                </path>
                                                                            </svg>
                                                                            <svg class="celebrate" width="100" height="100"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <polygon points="10,10 20,20" class="poly"></polygon>
                                                                                <polygon points="10,50 20,50" class="poly"></polygon>
                                                                                <polygon points="20,80 30,70" class="poly"></polygon>
                                                                                <polygon points="90,10 80,20" class="poly"></polygon>
                                                                                <polygon points="90,50 80,50" class="poly"></polygon>
                                                                                <polygon points="80,80 70,70" class="poly"></polygon>
                                                                            </svg>
                                                                        </div>
                                                                    </label>
                                                                </li>
                                                                <li class="dropstart d-inline-flex">
                                                                    <a class="dropdown-link" href="javascript:void(0);" role="button"
                                                                        data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                                                            class="ri-more-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                     `);

                                                    $(".btn-load-more").attr(
                                                        "data-quantity",
                                                        quantityLoad
                                                    );
                                                    $(".btn-load-more")
                                                        .removeClass("loading")
                                                        .find("span")
                                                        .text("Load more");
                                                },
                                            });
                                            $(
                                                ".list__content .cover__subtitle"
                                            ).append(artistLinks);
                                        }
                                    });
                                }
                            } else if (
                                dataId &&
                                dataType != "favorite" &&
                                dataType != "history"
                            ) {
                                let dataSong = response.data["songs"],
                                    dataFvr = response.data["songFvr"],
                                    dataPlaylists = response.data["playlists"],
                                    list = $(".list-" + dataType + "-songs"),
                                    songFVr = dataFvr.map((item) => {
                                        return item.song_id;
                                    });
                                $.each(dataSong, function (index, element) {
                                    if (
                                        index >= quantity &&
                                        index <= quantityLoad
                                    ) {
                                        let playlists = "";
                                        dataPlaylists.forEach((item) => {
                                            playlists += `<li data-playlist-id="${item.id}" data-song-id-item="${element.id}" class="dropdown-item">
                                                                <a href="javascript:void(0)">${item.name}</a>
                                                           </li>`;
                                        });
                                        let artists = element.artists;
                                        let artistLinks = "";
                                        let artistName = "";
                                        if (artists.length > 3) {
                                            for (let i = 0; i < 3; i++) {
                                                artistName += artists[i].name;
                                                artistLinks +=
                                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                    artists[i].id +
                                                    '">' +
                                                    artists[i].name +
                                                    "</a>";
                                                if (i != 2) {
                                                    artistLinks += ", ";
                                                    artistName += ", ";
                                                }
                                                if (i == 2) {
                                                    artistLinks += "...";
                                                    artistName += "...";
                                                }
                                            }
                                        } else {
                                            for (
                                                let i = 0;
                                                i < artists.length;
                                                i++
                                            ) {
                                                artistName += artists[i].name;
                                                artistLinks +=
                                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                    artists[i].id +
                                                    '">' +
                                                    artists[i].name +
                                                    "</a>";
                                                if (i != artists.length - 1) {
                                                    artistLinks += ", ";
                                                    artistName += ", ";
                                                }
                                                if (
                                                    artists.length > 3 &&
                                                    artists.length != 1
                                                ) {
                                                    if (
                                                        i ==
                                                        artists.length - 1
                                                    ) {
                                                        artistLinks += "...";
                                                        artistName += "...";
                                                    }
                                                }
                                            }
                                        }
                                        let publicUrl =
                                            window.location.origin +
                                            "/img/" +
                                            dataLoad +
                                            "/";
                                        let publicUrlMusic =
                                            window.location.origin +
                                            "/music/" +
                                            element.url;
                                        let imgUrl =
                                            publicUrl + element.img_url;
                                        let imgSrc = "";
                                        if (f(element)) {
                                            imgSrc = element.img_url;
                                        } else {
                                            if (checkFileExists(imgUrl)) {
                                                imgSrc = imgUrl;
                                            }
                                        }
                                        list.append(`
                                                <div class="list__item" data-song-id="${
                                                    element.id
                                                }" data-song-name="${
                                            element.name
                                        }"
                                        data-song-artist="${artistName}"
                                                    data-song-album=""
                                                    data-song-url="${publicUrlMusic}" data-song-cover="${imgSrc}">
                                                    <div class="list__cover">
                                                        <img src="${imgSrc}" alt="" />
                                                        <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                            data-play-id="${
                                                                element.id
                                                            }" aria-label="Play pause"><i
                                                                class="ri-play-fill icon-play"></i>
                                                            <i class="ri-pause-fill icon-pause"></i></button>
                                                    </div>
                                                    <div class="list__content">
                                                            <a href="/home/song-details/${
                                                                element.id
                                                            }"
                                                                class="capitalize list__title text-truncate">${
                                                                    element.name
                                                                }</a>
                                                                <p class="cover__subtitle text-truncate">
                                                                ${artistLinks}
                                                                </p>
                    
                                                    </div>
                                                        <ul class="list__option">
                                                            <li class="icon-fvr">
                                                                <label class="add-fvr" data-type="song" data-favorite-id="${
                                                                    element.id
                                                                }"
                                                                    for="song[${
                                                                        element.id
                                                                    }]">
                                                                    <input ${
                                                                        songFVr.includes(
                                                                            element.id
                                                                        )
                                                                            ? "checked"
                                                                            : ""
                                                                    } title="like" type="checkbox"
                                                                        class="like" id="song[${
                                                                            element.id
                                                                        }]">
                                                                    <div class="checkmark">
                                                                        <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                                            </path>
                                                                        </svg>
                                                                        <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                                            </path>
                                                                        </svg>
                                                                        <svg class="celebrate" width="100" height="100"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <polygon points="10,10 20,20" class="poly"></polygon>
                                                                            <polygon points="10,50 20,50" class="poly"></polygon>
                                                                            <polygon points="20,80 30,70" class="poly"></polygon>
                                                                            <polygon points="90,10 80,20" class="poly"></polygon>
                                                                            <polygon points="90,50 80,50" class="poly"></polygon>
                                                                            <polygon points="80,80 70,70" class="poly"></polygon>
                                                                        </svg>
                                                                    </div>
                                                                </label>
                                                            </li>
                                                            <li>${
                                                                element.duration
                                                            }</li>
                                                            <li class="dropstart d-inline-flex">
                                                                <a class="dropdown-link" href="javascript:void(0);" role="button"
                                                                    data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                                                        class="ri-more-fill"></i></a>
                                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-play-id="${
                                                                                element.id
                                                                            }">Play</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-queue-id="${
                                                                                element.id
                                                                            }">Add to queue</a>
                                                                    </li>
                                                                    <li class="item-playlist">
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-song-id-item="${
                                                                                element.id
                                                                            }">Add to
                                                                            Playlist</a>
                                                                        <div class="sub-menu-2">
                                                                            <span class="create"><a data-change="false" data-song-id-item=${
                                                                                element.id
                                                                            }
                                                                                    class="dropdown-item" href="javascript:void(0)">Create New
                                                                                    Playlist</a></span>
                                                                            <ul>
                                                                            ${playlists}
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li class="item-download">
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-download-id="${
                                                                                element.id
                                                                            }">Download</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="/home/song-details/${
                                                                                element.id
                                                                            }"
                                                                            role="button">View details</a>
                                                                    </li>
                                                                                            </ul>
                                                                                        </li>
                                                                                    </ul>
                                                                            </div>
                                                                        `);
                                    }
                                    $(".btn-load-more").attr(
                                        "data-quantity",
                                        quantityLoad
                                    );
                                    $(".btn-load-more")
                                        .removeClass("loading")
                                        .find("span")
                                        .text("Load more");
                                });
                                $(".btn-load-more").attr(
                                    "data-quantity",
                                    quantityLoad
                                );
                                $(".btn-load-more")
                                    .removeClass("loading")
                                    .prop("disabled", false)
                                    .find("span")
                                    .text("Load more");
                            } else if (
                                dataType == "favorite" ||
                                dataType == "history"
                            ) {
                                let list = $(".list-" + dataType + "-songs");
                                $.each(data, function (index, element) {
                                    if (
                                        index >= quantity &&
                                        index <= quantityLoad
                                    ) {
                                        let playlists = "";
                                        element["playlists"].forEach((item) => {
                                            playlists += `<li data-playlist-id="${item.id}" data-song-id-item="${element["song"].id}" class="dropdown-item">
                                                                <a href="javascript:void(0)">${item.name}</a>
                                                           </li>`;
                                        });
                                        let artists = element["song"].artists;
                                        let artistLinks = "";
                                        if (artists.length > 3) {
                                            for (let i = 0; i < 3; i++) {
                                                artistLinks +=
                                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                    artists[i].id +
                                                    '">' +
                                                    artists[i].name +
                                                    "</a>";
                                                if (i != 3) {
                                                    artistLinks += ", ";
                                                }
                                                if (i == 3) {
                                                    artistLinks += "...";
                                                }
                                            }
                                        } else {
                                            for (
                                                let i = 0;
                                                i < artists.length;
                                                i++
                                            ) {
                                                artistLinks +=
                                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                    artists[i].id +
                                                    '">' +
                                                    artists[i].name +
                                                    "</a>";
                                                if (
                                                    artists.length > 1 &&
                                                    i != artists.length - 1
                                                ) {
                                                    artistLinks += ", ";
                                                }
                                                if (
                                                    artists.length > 3 &&
                                                    i == artists.length - 1
                                                ) {
                                                    artistLinks += "...";
                                                }
                                            }
                                        }
                                        let publicUrl =
                                            window.location.origin +
                                            "/img/" +
                                            dataLoad +
                                            "/";
                                        let publicUrlMusic =
                                            window.location.origin +
                                            "/music/" +
                                            element["song"].url;
                                        let imgUrl =
                                            publicUrl + element["song"].img_url;
                                        let imgSrc = "";
                                        if (f(element["song"])) {
                                            imgSrc = element["song"].img_url;
                                        } else {
                                            if (checkFileExists(imgUrl)) {
                                                imgSrc = imgUrl;
                                            }
                                        }
                                        list.append(`
                                                <div class="list__item" data-song-id="${
                                                    element["song"].id
                                                }" data-song-name="${
                                            element["song"].name
                                        }"
                                                    data-song-album=""
                                                    data-song-url="${publicUrlMusic}" data-song-cover="${imgSrc}">
                                                    <div class="list__cover">
                                                        <img src="${imgSrc}" alt="" />
                                                        <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                                            data-play-id="${
                                                                element["song"]
                                                                    .id
                                                            }" aria-label="Play pause"><i
                                                                class="ri-play-fill icon-play"></i>
                                                            <i class="ri-pause-fill icon-pause"></i></button>
                                                    </div>
                                                    <div class="list__content">
                                                            <a href="/home/song-details/${
                                                                element["song"]
                                                                    .id
                                                            }"
                                                                class="capitalize list__title text-truncate">${
                                                                    element[
                                                                        "song"
                                                                    ].name
                                                                }</a>
                                                                <p class="cover__subtitle text-truncate">${artistLinks}</p>
                    
                                                    </div>
                                                        <ul class="list__option">
                                                        <li class="relative_time">${
                                                            element[
                                                                "relative_time"
                                                            ]
                                                        }</li>
                                                            <li class="icon-fvr">
                                                                <label class="add-fvr" data-type="song" data-favorite-id="${
                                                                    element[
                                                                        "song"
                                                                    ].id
                                                                }"
                                                                    for="song[${
                                                                        element[
                                                                            "song"
                                                                        ].id
                                                                    }]">
                                                                    <input ${
                                                                        dataType ==
                                                                        "favorite"
                                                                            ? "checked"
                                                                            : element[
                                                                                  "songFvr"
                                                                              ] !=
                                                                              null
                                                                            ? "checked"
                                                                            : ""
                                                                    } title="like" type="checkbox"
                                                                        class="like" id="song[${
                                                                            element[
                                                                                "song"
                                                                            ].id
                                                                        }]">
                                                                    <div class="checkmark">
                                                                        <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                                            </path>
                                                                        </svg>
                                                                        <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                                            </path>
                                                                        </svg>
                                                                        <svg class="celebrate" width="100" height="100"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <polygon points="10,10 20,20" class="poly"></polygon>
                                                                            <polygon points="10,50 20,50" class="poly"></polygon>
                                                                            <polygon points="20,80 30,70" class="poly"></polygon>
                                                                            <polygon points="90,10 80,20" class="poly"></polygon>
                                                                            <polygon points="90,50 80,50" class="poly"></polygon>
                                                                            <polygon points="80,80 70,70" class="poly"></polygon>
                                                                        </svg>
                                                                    </div>
                                                                </label>
                                                            </li>
                                                            <li>${
                                                                element["song"]
                                                                    .duration
                                                            }</li>
                                                            <li class="dropstart d-inline-flex">
                                                                <a class="dropdown-link" href="javascript:void(0);" role="button"
                                                                    data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                                                        class="ri-more-fill"></i></a>
                                                                <ul class="dropdown-menu dropdown-menu-sm">
                                                                <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-play-id="${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }">Play</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-queue-id="${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }">Add to queue</a>
                                                                    </li>
                    
                                                                    
                                                                    <li class="item-playlist">
                                                                        <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                                            data-song-id="${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }">Add to
                                                                            Playlist</a>
                                                                        <div class="sub-menu-2">
                                                                            <span class="create"><a data-change="false" data-song-id-item=${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }
                                                                                    class="dropdown-item" href="javascript:void(0)">Create New
                                                                                    Playlist</a></span>
                                                                            <ul>
                                                                            ${playlists}
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="/home/download-song/${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }"
                                                                            role="button">Download</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item"
                                                                            href="/home/song-details/${
                                                                                element[
                                                                                    "song"
                                                                                ]
                                                                                    .id
                                                                            }"
                                                                            role="button">View details</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                </div>
                                             `);
                                    }
                                    $(".btn-load-more").attr(
                                        "data-quantity",
                                        quantityLoad
                                    );
                                    $(".btn-load-more")
                                        .removeClass("loading")
                                        .find("span")
                                        .text("Load more");
                                });
                                $(".btn-load-more").attr(
                                    "data-quantity",
                                    quantityLoad
                                );
                                $(".btn-load-more")
                                    .removeClass("loading")
                                    .prop("disabled", false)
                                    .find("span")
                                    .text("Load more");
                            }
                        },
                    });
                }),
                $("body").on(
                    "mouseenter",
                    ".dropdown-menu .item-playlist",
                    function () {
                        const $this = $(this);
                        const $dropdown = $this.find(".sub-menu");
                        const $dropdown2 = $this.find(".sub-menu-2");
                        const offset = $this.offset();
                        const scrollTop = $(window).scrollTop();
                        const scrollLeft = $(window).scrollLeft();
                        const relativeTop = offset.top - scrollTop;
                        const relativeLeft = offset.left - scrollLeft;
                        const toggle = $("body").data("sidebar-toggle");
                        $dropdown
                            .removeClass("right-bottom")
                            .removeClass("left-bottom");
                        $dropdown2
                            .removeClass("left-bottom")
                            .removeClass("left-top");
                        var width = $(window).width();
                        if (width < 576) {
                            if (relativeLeft < 150) {
                                $dropdown.addClass("right-bottom");
                            } else {
                                $dropdown.addClass("left-bottom");
                            }
                        } else if (width < 768) {
                            if (250 < relativeLeft < 450) {
                                $dropdown.addClass("left-bottom");
                            }
                        } else {
                            if (toggle) {
                                if (relativeLeft < 250) {
                                    $dropdown.addClass("right-bottom");
                                } else {
                                    $dropdown.addClass("left-bottom");
                                }
                            } else {
                                if (relativeLeft < 400) {
                                    $dropdown.addClass("right-bottom");
                                } else {
                                    $dropdown.addClass("left-bottom");
                                }
                            }
                            if (relativeTop < 250) {
                                $dropdown2.addClass("left-bottom");
                            } else {
                                $dropdown2.addClass("left-top");
                            }
                        }
                    }
                ),
                $("#sidebar , #page_content,#search_results").on(
                    "click",
                    ".nav-item.playlists-create,.sub-menu .create a,.sub-menu-2 .create a",
                    function () {
                        let useFeature = $("body").data("use-feature");
                        let change = $(this).data("change");
                        let songId = $(this).data("song-id-item");
                        let csrfToken = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        if (useFeature == true) {
                            $.ajax({
                                type: "post",
                                url: "/home/create-playlist",
                                data: {
                                    change: change,
                                    songId: songId,
                                    _token: csrfToken,
                                },
                                dataType: "json",
                                success: function (response) {
                                    let playlist = response.playlist;
                                    let playlistList = $("#playlists-list");
                                    toastr.success(
                                        playlist.name + "  Created",
                                        "Success"
                                    );
                                    if (change == false) {
                                        let newItem = `
                                        <li class="nav-item">
                                            <a id="playlist-${playlist.id}" 
                                                href="/home/playlist/${playlist.id}">
                                                    ${playlist.name}
                                                </a>
                                        </li>
                                    `;
                                        playlistList.prepend(newItem);
                                        if (
                                            playlistList.find("li").length > 8
                                        ) {
                                            $("#playlists-list li")
                                                .last()
                                                .remove();
                                        }
                                        toastr.success(
                                            "Add Song to " +
                                                playlist.name +
                                                " success",
                                            "Success"
                                        );
                                    } else {
                                        setTimeout(() => {
                                            window.location.href =
                                                "/home/playlist-details/" +
                                                playlist.id;
                                        }, 1000);
                                    }
                                },
                            });
                        } else {
                            toastr.info(
                                "Upgrade to Premium to create Playlists"
                            );
                        }
                    }
                ),
                $("#page_content,#search_results").on(
                    "click",
                    ".item-playlist li.dropdown-item",
                    function () {
                        let songId = $(this).data("song-id-item");
                        let playlistId = $(this).data("playlist-id");
                        let csrfToken = $('meta[name="csrf-token"]').attr(
                            "content"
                        );
                        $.ajax({
                            type: "post",
                            url:
                                "/home/add-song-to-playlist/" +
                                playlistId +
                                "/" +
                                songId,
                            data: {
                                playlistId: playlistId,
                                songId: songId,
                                _token: csrfToken,
                            },
                            dataType: "json",
                            success: function (response) {
                                if (!response.exist) {
                                    toastr.success(
                                        "Add Song to " +
                                            response.playlist.name +
                                            " success",
                                        "Success"
                                    );
                                } else {
                                    toastr.warning(
                                        "Song already exist",
                                        "Error"
                                    );
                                }
                            },
                        });
                    }
                ),
                t.on("click", function () {
                    $(this).removeAttr("data-search-results");
                }),
                $(".amplitude-play-pause").hasClass("amplitude-playing"))
            ) {
                var o = Amplitude.getActiveSongMetadata();
                $("[data-play-id]").removeClass(e),
                    $("[data-play-id=" + o.id + "]").addClass(e);
            }
        },
        search = function () {
            let key = $("#search_input").val(),
                dataTab = $(".search__head__filter button.active").data(
                    "tab-nav"
                ),
                dataContent = $(
                    `.tab-content[data-tab-content="${dataTab}"] .list-container`
                );
            $(".search__body .err").remove();
            dataContent.empty();
            if (key) {
                $(".load").removeClass("d-none");
                $("#search_results").addClass("active");
            }
            clearTimeout(this.timeout);
            if (key) {
                this.timeout = setTimeout(function () {
                    $.ajax({
                        type: "get",
                        url: "/home/search",
                        data: {
                            _csrf: csrfToken,
                            key: key,
                            dataTab: dataTab,
                        },
                        dataType: "json",
                        success: function (response) {
                            let data = response[dataTab],
                                dataFvr = response["songFvr"],
                                dataPlaylists = response["playlists"],
                                newDiv = "",
                                songFVrIds = dataFvr
                                    ? dataFvr.map((item) => {
                                          return item.song_id;
                                      })
                                    : [];
                            function checkFileExists(fileUrl) {
                                var http = new XMLHttpRequest();
                                http.open("HEAD", fileUrl, false);
                                http.send();
                                return http.status != 404;
                            }
                            if (!data.length) {
                                $(".search__body").prepend(` 
                                    <div class="err"> 
                                        <img src="https://i.postimg.cc/FK06R6t0/image.png" class="img-fluid">
                                   <p class="text-center">No result found</p>
                                        </div>
                                `);
                                $(".load").addClass("d-none");
                            }
                            $.each(data, function (index, element) {
                                if (dataTab == "songs") {
                                    let playlists = "";
                                    dataPlaylists.forEach((item) => {
                                        playlists += `<li data-playlist-id="${item.id}" data-song-id-item="${element.id}" class="dropdown-item">
                                                    <a href="javascript:void(0)">${item.name}</a>
                                               </li>`;
                                    });
                                    let artists = element.artists;
                                    let artistLinks = "";
                                    let artistName = "";
                                    if (artists.length > 3) {
                                        for (let i = 0; i < 3; i++) {
                                            artistName += artists[i].name;
                                            artistLinks +=
                                                '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                artists[i].id +
                                                '">' +
                                                artists[i].name +
                                                "</a>";
                                            if (i != 2) {
                                                artistLinks += ", ";
                                                artistName += ", ";
                                            }
                                            if (i == 2) {
                                                artistLinks += "...";
                                                artistName += "...";
                                            }
                                        }
                                    } else {
                                        for (
                                            let i = 0;
                                            i < artists.length;
                                            i++
                                        ) {
                                            artistName += artists[i].name;
                                            artistLinks +=
                                                '<a class="capitalize text-dark" href="/home/artist-details/' +
                                                artists[i].id +
                                                '">' +
                                                artists[i].name +
                                                "</a>";
                                            if (i != artists.length - 1) {
                                                artistLinks += ", ";
                                                artistName += ", ";
                                            }
                                            if (
                                                artists.length > 3 &&
                                                artists.length != 1
                                            ) {
                                                if (i == artists.length - 1) {
                                                    artistLinks += "...";
                                                    artistName += "...";
                                                }
                                            }
                                        }
                                    }
                                    let publicUrl =
                                            window.location.origin +
                                            "/img/" +
                                            dataTab +
                                            "/",
                                        publicUrlMusic =
                                            window.location.origin +
                                            "/music/" +
                                            element.url,
                                        imgUrl = publicUrl + element.img_url,
                                        imgSrc = "";
                                    if (f(element)) {
                                        imgSrc = element.img_url;
                                    } else {
                                        if (checkFileExists(imgUrl)) {
                                            imgSrc = imgUrl;
                                        }
                                    }
                                    newDiv += `
                                    <div class="col-xl-6 col-md-12 col-sm-12">
                                        <div class="list__item" data-song-id="${
                                            element.id
                                        }" data-song-name="${
                                        element.name
                                    }" data-song-artist="${artistName}" data-song-album="" data-song-url="${publicUrlMusic}" data-song-cover="${imgSrc}">
                                            <div class="list__cover">
                                                <img src="${imgSrc}" alt="" />
                                                <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill" data-play-id="${
                                                    element.id
                                                }" aria-label="Play pause"><i class="ri-play-fill icon-play"></i>
                                                    <i class="ri-pause-fill icon-pause"></i></button>
                                            </div>
                                            <div class="list__content">
                                                <a href="/home/song-details/${
                                                    element.id
                                                }" class="capitalize list__title text-truncate">${
                                        element.name
                                    }</a>
                                                <p class="cover__subtitle text-truncate">
                                                    ${artistLinks}
                                                </p>
                                        
                                            </div>
                                            <ul class="list__option">
                                                <li class="icon-fvr">
                                                    <label class="add-fvr" data-type="song" data-favorite-id="${
                                                        element.id
                                                    }" for="song[${
                                        element.id
                                    }]">
                                                        <input ${
                                                            songFVrIds.includes(
                                                                element.id
                                                            )
                                                                ? "checked"
                                                                : ""
                                                        } title="like" type="checkbox" class="like"
                                                            id="song[${
                                                                element.id
                                                            }]">
                                                        <div class="checkmark">
                                                            <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                                </path>
                                                            </svg>
                                                            <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                                </path>
                                                            </svg>
                                                            <svg class="celebrate" width="100" height="100" xmlns="http://www.w3.org/2000/svg">
                                                                <polygon points="10,10 20,20" class="poly"></polygon>
                                                                <polygon points="10,50 20,50" class="poly"></polygon>
                                                                <polygon points="20,80 30,70" class="poly"></polygon>
                                                                <polygon points="90,10 80,20" class="poly"></polygon>
                                                                <polygon points="90,50 80,50" class="poly"></polygon>
                                                                <polygon points="80,80 70,70" class="poly"></polygon>
                                                            </svg>
                                                        </div>
                                                    </label>
                                                </li>
                                                <li>${element.duration}</li>
                                                <li class="dropstart d-inline-flex">
                                                    <a class="dropdown-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown"
                                                        aria-label="Cover options" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                                    <ul class="dropdown-menu dropdown-menu-sm">
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" role="button" data-play-id="${
                                                                element.id
                                                            }">Play</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" role="button" data-queue-id="${
                                                                element.id
                                                            }">Add to queue</a>
                                                        </li>
                                                        <li class="item-playlist">
                                                            <a class="dropdown-item" href="javascript:void(0);" role="button" data-song-id-item="${
                                                                element.id
                                                            }">Add to
                                                                Playlist</a>
                                                            <div class="sub-menu-2">
                                                                <span class="create"><a data-change="false" data-song-id-item=${
                                                                    element.id
                                                                }
                                                                        class="dropdown-item" href="javascript:void(0)">Create New
                                                                        Playlist</a></span>
                                                                <ul>
                                                                    ${playlists}
                                                                </ul>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="/home/download-song/${
                                                                element.id
                                                            }" role="button">Download</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="/home/song-details/${
                                                                element.id
                                                            }" role="button">View details</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                `;
                                } else if (dataTab == "artists") {
                                    let publicUrl =
                                            window.location.origin +
                                            "/img/" +
                                            dataTab +
                                            "/",
                                        publicUrlMusic =
                                            window.location.origin +
                                            "/music/" +
                                            element.url,
                                        imgUrl = publicUrl + element.img_url,
                                        imgSrc = "";
                                    if (f(element)) {
                                        imgSrc = element.img_url;
                                    } else {
                                        if (checkFileExists(imgUrl)) {
                                            imgSrc = imgUrl;
                                        }
                                    }
                                    newDiv += `
                                <div class="col-xl-3 col-md-4 col-sm-6">
                                    <div class="list__item">
                                    <a href="/home/artist-details/${element.id}" class="list__cover"
                                        ><img
                                        src="${imgSrc}"
                                        alt="Jina Moore"
                                    /></a>
                                    <div class="list__content">
                                        <a
                                        href="/home/artist-details/${element.id}"
                                        class="list__title text-truncate"
                                        >${element.name}</a
                                        >
                                    </div>
                                    </div>
                                </div>
                                `;
                                } else if (dataTab == "albums") {
                                    let publicUrl =
                                            window.location.origin +
                                            "/img/" +
                                            dataTab +
                                            "/",
                                        imgUrl = publicUrl + element.img_url,
                                        imgSrc = "";
                                    if (f(element)) {
                                        imgSrc = element.img_url;
                                    } else {
                                        if (checkFileExists(imgUrl)) {
                                            imgSrc = imgUrl;
                                        }
                                    }
                                    newDiv += `
                                        <div class="col-xl-3 col-md-4 col-sm-6">
                                            <div class="list__item">
                                            <a href="/home/album-details/${element.id}" class="list__cover"
                                                ><img
                                                src="${imgSrc}"
                                                alt="Jina Moore"
                                            /></a>
                                            <div class="list__content">
                                                <a
                                                href="/home/album-details/${element.id}"
                                                class="list__title text-truncate"
                                                >${element.name}</a
                                                >
                                            </div>
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                            dataContent.append(newDiv);
                            $(".load").addClass("d-none");
                        },
                    });
                }, 1000);
            } else {
                $(".load").addClass("d-none");
                $("#search_results").removeClass("active");
            }
        };
    return {
        init: function () {
            $("#loader").fadeOut(1e3),
                t.settings(),
                n(),
                $(window).on("popstate", function () {
                    var e = window.location.href.split("/").pop();
                    e && a(e);
                }),
                $(document).on(
                    "click",
                    'a:not([href^="#"])a:not([href^="mail"])a:not([href^="tel"]):not([href^="javascript"]):not(.external):not([target])',
                    function (e) {
                        e.preventDefault(), e.stopPropagation();
                        var t = $(this).closest("#sidebar"),
                            i =
                                "undefined" !== $(this).attr("href")
                                    ? $(this).attr("href")
                                    : null;
                        i && (window.history.pushState("", "", i), a(i, t));
                    }
                );
        },
    };
})();
$(document).ready(function () {
    Base.init();
});
var Player = (function () {
    var e = "active",
        t = $("body"),
        ads = t.data("ads"),
        a = $("#playlist"),
        i = [],
        q = 0,
        n = Amplitude.getConfig(),
        publicLink = window.location.origin,
        r = { playPause: !1, nextPrev: !1 },
        l = function (e) {
            setTimeout(e, Amplitude.getDelay());
        },
        f = function (e) {
            let isLink = e.img_url.split("/");
            if (isLink[0] == "http:" || isLink[0] == "https:") {
                return true;
            }
            return false;
        },
        o = function (t = !0) {
            $("#player").addClass("show"),
                Amplitude.getSongs() &&
                    1 === Amplitude.getSongs().length &&
                    (Amplitude.pause(),
                    l(() => {
                        Player.volumeBackground();
                    })),
                Amplitude.init({
                    songs: i,
                    callbacks: {
                        song_change: function () {
                            let song_id = Amplitude.getActiveSongMetadata().id;
                            let csrfToken = $('meta[name="csrf-token"]').attr(
                                "content"
                            );
                            $.ajax({
                                url: "/home/histories-add/" + song_id,
                                method: "POST",
                                data: {
                                    _token: csrfToken,
                                    song_id: song_id,
                                },
                            });

                            if (ads) {
                                q++;
                                if (q == Math.floor(Math.random() * 4) + 4) {
                                    let videos = [
                                        "1.mp4",
                                        "2.mp4",
                                        "3.mp4",
                                        "4.mp4",
                                        "5.mp4",
                                        "6.mp4",
                                        "7.mp4",
                                        "8.mp4",
                                        "9.mp4",
                                        "10.mp4",
                                    ];
                                    h(), p(), (q = 0), z();
                                    let newVideo =
                                        videos[
                                            Math.floor(
                                                Math.random() * videos.length
                                            )
                                        ];
                                    let srcLink =
                                        publicLink + "/videos/" + newVideo;

                                    $("#player").append(`
                                        <div id="video">
                                            <a href="/user/premium" class="close"> <i class="ri-close-line"></i> </a>
                                            <video autoplay metadata controls>
                                                <source nodownload src="${srcLink}">
                                            </video>
                                        </div>
                                `);
                                    $("video").on("ended", function () {
                                        k(),
                                            m(),
                                            p(false),
                                            (q = 0),
                                            $(".amplitude-play-pause").click();
                                    });
                                } else {
                                    if (q > 5) {
                                        q = 2;
                                    }
                                    l(() => {
                                        v(),
                                            "playing" ===
                                            Amplitude.getPlayerState()
                                                ? g()
                                                : $(
                                                      "[data-play-id]"
                                                  ).removeClass(e),
                                            d(n);
                                    });
                                }
                            } else {
                                l(() => {
                                    v(),
                                        "playing" === Amplitude.getPlayerState()
                                            ? g()
                                            : $("[data-play-id]").removeClass(
                                                  e
                                              ),
                                        d(n);
                                });
                            }
                        },
                    },
                });
            var n = i[0];
            a.html(u(n)), p(!1), m(), t && (Amplitude.play(), g(), v()), d(n);
        },
        z = function (e) {
            setTimeout(() => {
                if ($(".amplitude-play-pause").hasClass("amplitude-playing")) {
                    $(".amplitude-play-pause").click();
                }
                $(".amplitude-play-pause").prop("disabled", true);
            }, 200);
            $("body")
                .find("#sidebar,#header,#page_content,#player .container")
                .css("pointer-events", "none");
        },
        k = function (e) {
            $("#player").find("#video").remove();
            $(".amplitude-play-pause").prop("disabled", false);
            $("body")
                .find("#sidebar,#header,#page_content,#player .container")
                .css("pointer-events", "auto");
        },
        s = function (e) {
            var t = $(e).closest("[data-song-id]");
            return {
                id: parseInt(t.data("song-id")),
                name: t.data("song-name"),
                artist: t.data("song-artist"),
                album: t.data("song-album"),
                url: t.data("song-url"),
                cover_art_url: t.data("song-cover"),
            };
        },
        d = function (e) {
            var t = $("#player_options");
            t.find("[data-favorite-id]").attr("data-favorite-id", e.id),
                t.find("[data-playlist-id]").attr("data-playlist-id", e.id),
                t.find("[download]").attr("href", e.url);
        },
        p = function (e = !0) {
            $(
                ".amplitude-repeat, .amplitude-prev, .amplitude-next, .amplitude-shuffle"
            ).prop("disabled", e);
        },
        u = function (e) {
            var t = Amplitude.getActiveSongMetadata();
            return `<div class="list__item"\n        data-song-id="${
                e.id
            }"\n        data-song-name="${e.name}"\n        data-song-artist="${
                e.artist
            }"\n        data-song-album="${e.album}"\n        data-song-url="${
                e.url
            }"\n        data-song-cover="${e.cover_art_url}">\n            
            <div class="list__cover">\n                
            <img src="${e.cover_art_url}" alt="${e.name}">\n                
                <a href="javascript:void(0);" 
                    class="btn btn-play btn-sm btn-default btn-icon rounded-pill ${
                        e.id === t.id ? "active" : ""
                    }"
                    data-play-id="${e.id}">\n
                        <i class="ri-play-fill icon-play"></i>\n
                        <i class="ri-pause-fill icon-pause"></i>\n 
                 </a>\n            
            </div>\n            
                <div class="list__content">\n
                    <a href="/home/song-details/${
                        e.id
                    }" class="list__title text-truncate">${e.name}</a>\n
                    <p class="list__subtitle text-truncate capitalize">\n
                    ${e.artist}\n
                    </p>\n            
                </div>\n            
                    <ul class="list__option">\n 
                        <li class="list__icon-hover icon-fvr">\n
                        <label class="add-fvr" data-type="song"
                            data-favorite-id="${e.id}"
                            for="song[${e.id}]">
                            <input {{ $favorite ? 'checked' : '' }} title="like"
                                type="checkbox" class="like" id="song[${e.id}]">
                            <div class="checkmark">
                                <svg viewBox="0 0 24 24" class="outline"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                    </path>
                                </svg>
                                <svg viewBox="0 0 24 24" class="filled"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                    </path>
                                </svg>
                                <svg class="celebrate" width="100" height="100"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <polygon points="10,10 20,20" class="poly"></polygon>
                                    <polygon points="10,50 20,50" class="poly"></polygon>
                                    <polygon points="20,80 30,70" class="poly"></polygon>
                                    <polygon points="90,10 80,20" class="poly"></polygon>
                                    <polygon points="90,50 80,50" class="poly"></polygon>
                                    <polygon points="80,80 70,70" class="poly"></polygon>
                                </svg>
                            </div>
                        </label>
                        </li>\n  
                        <li class="list__icon-hover">\n                    
                            <a href="javascript:void(0);" role="button" 
                            class="d-inline-flex" 
                            data-remove-song-id="${
                                e.id
                            }">\n                        
                                        <i class="ri-close-line fs-6"></i>\n                    
                            </a>\n                
                        </li>\n  
                    </ul>\n        
                </div>`;
        },
        c = function () {
            (i = []),
                p(),
                Amplitude.pause(),
                (n.player_state = "paused"),
                Utils.removeLocalItem("songs"),
                a.html(
                    '<div class="col-sm-8 col-10 mx-auto mt-5 text-center">\n            <i class="ri-music-2-line mb-3"></i>\n            <p>No songs, album or playlist are added on lineup.</p>\n        </div>'
                ),
                l(() => {
                    h(), v();
                });
        },
        g = function () {
            var t = Amplitude.getActiveSongMetadata();
            $("[data-play-id]").removeClass(e),
                $("[data-play-id=" + t.id + "]").addClass(e);
        },
        m = function () {
            $(".amplitude-play-pause")
                .removeClass("amplitude-paused")
                .addClass("amplitude-playing");
        },
        h = function () {
            $(".amplitude-play-pause")
                .removeClass("amplitude-playing")
                .addClass("amplitude-paused"),
                $("[data-play-id]").removeClass(e);
        },
        v = function () {
            var e = Amplitude.getActiveSongMetadata(),
                t = Amplitude.getActivePlaylist()
                    ? Amplitude.getActivePlaylist()
                    : "";
            if ("mediaSession" in navigator) {
                var a = navigator.mediaSession;
                (a.metadata = new MediaMetadata({
                    title: e.name,
                    artist: e.artist,
                    album: e.album,
                    artwork: [
                        {
                            src: e.cover_art_url,
                            sizes: "96x96",
                            type: "image/jpg",
                        },
                        {
                            src: e.cover_art_url,
                            sizes: "128x128",
                            type: "image/jpg",
                        },
                        {
                            src: e.cover_art_url,
                            sizes: "192x192",
                            type: "image/jpg",
                        },
                        {
                            src: e.cover_art_url,
                            sizes: "256x256",
                            type: "image/jpg",
                        },
                        {
                            src: e.cover_art_url,
                            sizes: "384x384",
                            type: "image/jpg",
                        },
                        {
                            src: e.cover_art_url,
                            sizes: "512x512",
                            type: "image/jpg",
                        },
                    ],
                })),
                    i.length >= 1 &&
                        !r.playPause &&
                        ((r.playPause = !0),
                        a.setActionHandler(
                            "play",
                            () => (Amplitude.play(), m(), void g())
                        ),
                        a.setActionHandler(
                            "pause",
                            () => (Amplitude.pause(), void h())
                        )),
                    i.length >= 2 &&
                        !r.nextPrev &&
                        ((r.nextPrev = !0),
                        a.setActionHandler("previoustrack", () =>
                            Amplitude.prev(t)
                        ),
                        a.setActionHandler("nexttrack", () =>
                            Amplitude.next(t)
                        ));
            }
        },
        y = function (d, p, callback) {
            let arr = [];
            let csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                type: "get",
                url: "/home/load-more",
                data: {
                    dataType: d,
                    dataId: p,
                    _token: csrfToken,
                },
                dataType: "json",
                success: function (response) {
                    function checkFileExists(fileUrl) {
                        var http = new XMLHttpRequest();
                        http.open("HEAD", fileUrl, false);
                        http.send();
                        return http.status != 404;
                    }
                    let dataSong = response.data["songs"];
                    let dataFvr = response.data["songFvr"];
                    let dataPlaylists = response.data["playlists"];
                    let songFVr = dataFvr.map((item) => {
                        return item.song_id;
                    });
                    $.each(dataSong, function (index, element) {
                        let playlists = "";
                        dataPlaylists.forEach((item) => {
                            playlists += `<li data-playlist-id="${item.id}" data-song-id-item="${element.id}" class="dropdown-item">
                                                            <a href="javascript:void(0)">${item.name}</a>
                                                       </li>`;
                        });
                        let artists = element.artists;
                        let artistLinks = "";
                        let artistName = "";
                        if (artists.length > 3) {
                            for (let i = 0; i < 3; i++) {
                                artistName += artists[i].name;
                                artistLinks +=
                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                    artists[i].id +
                                    '">' +
                                    artists[i].name +
                                    "</a>";
                                if (i != artists.length - 1) {
                                    artistLinks += ", ";
                                    artistName += ", ";
                                }
                                if (artists.length != 1) {
                                    if (i == artists.length - 1) {
                                        artistLinks += "...";
                                        artistName += "...";
                                    }
                                }
                            }
                        } else {
                            for (let i = 0; i < artists.length; i++) {
                                artistName += artists[i].name;
                                artistLinks +=
                                    '<a class="capitalize text-dark" href="/home/artist-details/' +
                                    artists[i].id +
                                    '">' +
                                    artists[i].name +
                                    "</a>";
                                if (i != artists.length - 1) {
                                    artistLinks += ", ";
                                    artistName += ", ";
                                }
                                if (artists.length != 1) {
                                    if (i == artists.length - 1) {
                                        artistLinks += "...";
                                        artistName += "...";
                                    }
                                }
                            }
                        }
                        let publicUrl = window.location.origin + "/img/song/";
                        let publicUrlMusic =
                            window.location.origin + "/music/" + element.url;
                        let imgUrl = publicUrl + element.img_url;

                        let imgSrc = "";
                        if (f(element)) {
                            imgSrc = element.img_url;
                        } else {
                            if (checkFileExists(imgUrl)) {
                                imgSrc = imgUrl;
                            }
                        }
                        let i = s(`
                            <div class="list__item" data-song-id="${element.id}"
                                data-song-name="${element.name}"
                                data-song-artist="${artistName}"
                                data-song-album=""
                                data-song-url="${publicUrlMusic}" 
                                data-song-cover="${imgSrc}">
                                <div class="list__cover">
                                    <img src="${imgSrc}" alt="" />
                                    <button class="btn btn-play btn-sm btn-default btn-icon rounded-pill"
                                        data-play-id="${
                                            element.id
                                        }" aria-label="Play pause"><i
                                            class="ri-play-fill icon-play"></i>
                                        <i class="ri-pause-fill icon-pause"></i></button>
                                </div>
                                <div class="list__content">
                                        <a href="/home/song-details/${
                                            element.id
                                        }"
                                            class="capitalize list__title text-truncate">${
                                                element.name
                                            }</a>
                                            <p class="cover__subtitle text-truncate">
                                            ${artistLinks}
                                            </p>

                                </div>
                                    <ul class="list__option">
                                        <li class="icon-fvr">
                                            <label class="add-fvr" data-type="song" data-favorite-id="${
                                                element.id
                                            }"
                                                for="song[${element.id}]">
                                                <input ${
                                                    songFVr.includes(element.id)
                                                        ? "checked"
                                                        : ""
                                                } title="like" type="checkbox"
                                                    class="like" id="song[${
                                                        element.id
                                                    }]">
                                                <div class="checkmark">
                                                    <svg viewBox="0 0 24 24" class="outline" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                                        </path>
                                                    </svg>
                                                    <svg viewBox="0 0 24 24" class="filled" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                        </path>
                                                    </svg>
                                                    <svg class="celebrate" width="100" height="100"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <polygon points="10,10 20,20" class="poly"></polygon>
                                                        <polygon points="10,50 20,50" class="poly"></polygon>
                                                        <polygon points="20,80 30,70" class="poly"></polygon>
                                                        <polygon points="90,10 80,20" class="poly"></polygon>
                                                        <polygon points="90,50 80,50" class="poly"></polygon>
                                                        <polygon points="80,80 70,70" class="poly"></polygon>
                                                    </svg>
                                                </div>
                                            </label>
                                        </li>
                                        <li>${element.duration}</li>
                                        <li class="dropstart d-inline-flex">
                                            <a class="dropdown-link" href="javascript:void(0);" role="button"
                                                data-bs-toggle="dropdown" aria-label="Cover options" aria-expanded="false"><i
                                                    class="ri-more-fill"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-sm">
                                            <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                        data-play-id="${
                                                            element.id
                                                        }">Play</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                        data-queue-id="${
                                                            element.id
                                                        }">Add to queue</a>
                                                </li>
                                                <li class="item-playlist">
                                                    <a class="dropdown-item" href="javascript:void(0);" role="button"
                                                        data-song-id-item="${
                                                            element.id
                                                        }">Add to
                                                        Playlist</a>
                                                    <div class="sub-menu-2">
                                                        <span class="create"><a data-change="false" data-song-id-item=${
                                                            element.id
                                                        }
                                                                class="dropdown-item" href="javascript:void(0)">Create New
                                                                Playlist</a></span>
                                                        <ul>
                                                        ${playlists}
                                                        </ul>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="/home/download-song/${
                                                            element.id
                                                        }"
                                                        role="button">Download</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="/home/song-details/${
                                                            element.id
                                                        }"
                                                        role="button">View details</a>
                                                </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                        </div>
                     `);
                        arr.push(i);
                    });
                    callback(arr);
                },
            });
        },
        x = function (e) {
            let b = $(".btn-play, a.btn-play"),
                bt = $(e),
                tm = $("#player .me-4");
            b.prop("disabled", false);
            bt.prop("disabled", true);
            if (tm.hasClass("d-none")) {
                tm.removeClass("d-none");
            }
        };
    return {
        volumeBackground: function () {
            var e = $('.player-volume input[type="range"]'),
                t = parseInt(e.val(), 10),
                a = Utils.isDarkMode()
                    ? "255, 255, 255"
                    : Utils.getCSSVarValue("dark-rgb"),
                i =
                    "linear-gradient(to right, rgb(" +
                    a +
                    ") 0%, rgb(" +
                    a +
                    ") " +
                    t +
                    "%, rgba(" +
                    a +
                    ", 0) " +
                    t +
                    "%, rgba(" +
                    a +
                    ", 0) 100%)";
            e.css("background", i);
        },
        init: function () {
            var r;
            !(function () {
                if (
                    Utils.getLocalItem("songs") &&
                    Utils.getLocalItem("songs").length &&
                    ((i = Utils.getLocalItem("songs")),
                    o(!1),
                    h(),
                    i.length > 1)
                )
                    for (let t = 0; t < i.length; t++) {
                        var e = i[t];
                        0 === t ? a.html(u(e)) : a.append(u(e));
                    }
            })(),
                $("#search_results,body").on(
                    "click",
                    "[data-play-id]",
                    function () {
                        let e = this;
                        x(e);
                        var t = s(this),
                            n = i.findIndex((e) => e.id === t.id);
                        $(this).hasClass(e)
                            ? (Amplitude.pause(), h())
                            : -1 === n
                            ? (i.push(t),
                              1 === i.length
                                  ? o()
                                  : (a.append(u(t)),
                                    Amplitude.playSongAtIndex(i.length - 1)))
                            : Amplitude.playSongAtIndex(n),
                            Utils.setLocalItem("songs", i);
                    }
                ),
                $("#search_results,body").on(
                    "click",
                    "[data-queue-id]",
                    function () {
                        var e = s(this);
                        -1 === i.findIndex((t) => t.id === e.id)
                            ? (i.push(e),
                              1 === i.length ? o() : a.append(u(e)))(
                                  toastr.success(
                                      "Successfully added Song to Queue.",
                                      "Success!"
                                  )
                              )
                            : toastr.warning(
                                  "Song already in Queue.",
                                  "Warning!"
                              ),
                            Utils.setLocalItem("songs", i);
                    }
                ),
                t.on("click", "[data-next-id]", function () {
                    var e = s(this),
                        t = Amplitude.getActiveIndex(),
                        n = i.findIndex((t) => t.id === e.id);
                    i && !i.length
                        ? (i.push(e), o())(
                              toastr.success(
                                  "Successfully added Song to Queue.",
                                  "Success!"
                              )
                          )
                        : -1 === n
                        ? (i.splice(t + 1, 0, e),
                          a.find(".list__item").eq(t).after(u(e)))
                        : toastr.warning("Song already in Queue.", "Warning!"),
                        Utils.setLocalItem("songs", i);
                }),
                t.on("click", "[data-collection-play-id]", function () {
                    console.log("ss");
                    i = [];
                    let d = $(this).data("type");
                    let p = $(this).data("id");
                    Amplitude.pause();
                    $(".ri-volume-up-fill")
                        .removeClass("d-block")
                        .addClass("d-none");
                    $(".ri-volume-mute-fill")
                        .removeClass("d-block")
                        .addClass("d-none");
                    $(".ri-volume-down-fill").removeClass("d-none");
                    $(this).addClass("active");
                    $(this).prop("disabled", true);

                    (n = []), (r = 0);

                    y(d, p, function (arr) {
                        n = arr;
                        i && !i.length ? ((i = n), o(), (r = 1)) : i.push(...n);
                        for (let e = r; e < n.length; e++) a.append(u(n[e]));
                        Utils.setLocalItem("songs", i);
                    });
                }),
                t.on("click", "[data-remove-song-id]", function (e) {
                    e.stopPropagation();
                    var t = parseInt($(this).data("remove-song-id")),
                        a = $(this).closest("[data-song-id"),
                        n = i.findIndex((e) => e.id === t);
                    n > -1 &&
                        (a.remove(),
                        Amplitude.removeSong(n),
                        0 === i.length && c()),
                        Utils.setLocalItem("songs", i);
                }),
                $("#clear_playlist").on("click", function () {
                    $("#play_all").prop("disabled", false);
                    $("#play_all").removeClass("active");
                    $("#player").removeClass("show");
                    if (i.length >= 1) {
                        for (var e = 0; e < i.length; e++)
                            a.find(".list__item").eq(e).remove();
                        for (e = i.length - 1; e > -1; e--) {
                            var t = i[e],
                                n = Amplitude.getActiveSongMetadata();
                            t.id !== n.id && Amplitude.removeSong(e);
                        }
                        c();
                    }
                }),
                (r = $(".player-volume"))
                    .find('input[type="range"]')
                    .on("input", function () {
                        var e = r.find(".ri-volume-mute-fill"),
                            t = r.find(".ri-volume-down-fill"),
                            a = r.find(".ri-volume-up-fill"),
                            i = $(this),
                            n = parseInt(i.val(), 10),
                            l = "d-block",
                            o = "d-none";
                        Player.volumeBackground(),
                            0 === n
                                ? (e.removeClass(o).addClass(l),
                                  t.addClass(o),
                                  a.addClass(o))
                                : n > 0 && n < 70
                                ? (e.addClass(o),
                                  t.removeClass(o).addClass(l),
                                  a.addClass(o))
                                : n > 70 &&
                                  (e.addClass(o),
                                  t.addClass(o),
                                  a.removeClass(o).addClass(l));
                    }),
                $(".amplitude-play-pause").on("click", function () {
                    v(),
                        l(() => {
                            "playing" === Amplitude.getPlayerState()
                                ? g()
                                : $("[data-play-id]").removeClass(e);
                        });
                }),
                $(".amplitude-prev").on("click", function () {
                    n.player_state = "playing";
                }),
                $(".amplitude-next").on("click", function () {
                    n.player_state = Amplitude.getActiveIndex()
                        ? "playing"
                        : "stopped";
                });
        },
    };
})();
$(document).ready(function () {
    Player.init();
}),
    (function (e, t, a, i) {
        e.fn.extend({
            settings: function (t) {
                (t = e.extend({}, e.settings.defaults, t)),
                    this.each(function () {
                        new e.settings(this, t);
                    });
            },
        }),
            (e.settings = function (t, i) {
                var n,
                    r,
                    l,
                    o = a.body,
                    s = "skin",
                    d = "setting",
                    p = "Theme Settings",
                    u = [
                        "yellow",
                        "orange",
                        "red",
                        "green",
                        "blue",
                        "purple",
                        "indigo",
                        "dark",
                    ],
                    c = ["light", "dark"],
                    g = "data-theme",
                    m = "data-header",
                    h = "data-sidebar",
                    v = "data-player",
                    y = () => {
                        var e = a.getElementById("header"),
                            t = a.getElementById("sidebar"),
                            n = a.getElementById("player"),
                            r = {
                                dark: i.dark,
                                header: i.header,
                                sidebar: i.sidebar,
                                player: i.player,
                            };
                        Utils.setLocalItem(s, r),
                            r.dark
                                ? o.setAttribute(g, "dark")
                                : o.removeAttribute(g),
                            e && i.header && e.setAttribute(m, i.header),
                            t && i.sidebar && t.setAttribute(h, i.sidebar),
                            n && i.player && n.setAttribute(v, i.player);
                    },
                    f = (e, t, a) => {
                        var i = `<div class="${d}__body__item"><span class="${d}__title">${t}</span>\n                <div class="${d}__options">`;
                        for (let t = 0; t < e.length; t++) {
                            var n = e[t];
                            i += `<a href="javascript:void(0);" class="${d}__option ${d}__option--${n}" data-${a}-option="${n}"></a>`;
                        }
                        return (i += "</div></div>");
                    },
                    b = () => {
                        var t = e(`#${d}`),
                            a = e(`#${d}_toggler`),
                            n = e(`.${d}__option`),
                            r = "show",
                            l = "active";
                        e(o).on("click", () => {
                            t.removeClass(r);
                        }),
                            a.on("click", () => {
                                t.toggleClass(r);
                            }),
                            t.on("click", (e) => {
                                e.stopPropagation();
                            }),
                            n.on("click", function () {
                                var t = e(this),
                                    a = t.data("theme-option"),
                                    n = t.data("header-option"),
                                    r = t.data("sidebar-option"),
                                    o = t.data("player-option");
                                a
                                    ? (e("[data-theme-option]").removeClass(l),
                                      (i.dark = "dark" === a),
                                      Utils.changeSkin())
                                    : n
                                    ? (e("[data-header-option]").removeClass(l),
                                      (i.header = n))
                                    : r
                                    ? (e("[data-sidebar-option]").removeClass(
                                          l
                                      ),
                                      (i.sidebar = r))
                                    : o &&
                                      (e("[data-player-option]").removeClass(l),
                                      (i.player = o)),
                                    t.addClass(l),
                                    y();
                            });
                    };
                (l = Utils.getLocalItem(s)) && (i = e.extend({}, i, l)),
                    y(),
                    (n = a.createElement("div")),
                    (r = `<a href="javascript:void(0);" id="${d}_toggler">Settings</a>\n                    <div class="${d}__wrapper">\n                        <div class="${d}__head">${p}</div>\n                        <div class="${d}__body">`),
                    (r += f(c, "Theme", "theme")),
                    (r += f(u, "Header", "header")),
                    (r += f(u, "Sidebar", "sidebar")),
                    (r += f(u, "Player", "player")),
                    (r +=
                        '<p class="mt-4">Note: You can see the color change effect of the header, sidebar and player in the inner pages.</p></div></div>'),
                    (n.id = d),
                    (n.innerHTML = r),
                    o.appendChild(n),
                    b(),
                    i.dark
                        ? e('[data-theme-option="dark"]').addClass("active")
                        : e('[data-theme-option="light"]').addClass("active"),
                    e("[data-header-option=" + i.header + "]").addClass(
                        "active"
                    ),
                    e("[data-sidebar-option=" + i.sidebar + "]").addClass(
                        "active"
                    ),
                    e("[data-player-option=" + i.player + "]").addClass(
                        "active"
                    );
            }),
            (e.settings.defaults = {
                dark: !1,
                header: null,
                sidebar: null,
                player: null,
            });
    })(jQuery, window, document);
var Utils = {
    getCSSVarValue: function (e) {
        var t = getComputedStyle(document.documentElement).getPropertyValue(
            "--bs-" + e
        );
        return t && t.length > 0 && (t = t.trim()), t;
    },
    getLocalItem: function (e) {
        return JSON.parse(localStorage.getItem(e));
    },
    setLocalItem: function (e, t) {
        localStorage.setItem(e, JSON.stringify(t));
    },
    removeLocalItem: function (e) {
        localStorage.removeItem(e);
    },
    showMessage: function (e) {
        Snackbar.show({
            pos: this.isRTL() ? "bottom-left" : "bottom-right",
            text: e,
            showAction: !1,
        });
    },
    changeSkin: function () {
        setTimeout(() => {
            Dashboard.init(), Player.volumeBackground();
        }, 10);
    },
    isDarkMode: function () {
        return (
            "dark" === document.querySelector("body").getAttribute("data-theme")
        );
    },
    isRTL: function () {
        return (
            "rtl" === document.querySelector("html").getAttribute("direction")
        );
    },
};
"undefined" != typeof module &&
    void 0 !== module.exports &&
    (module.exports = Utils);
