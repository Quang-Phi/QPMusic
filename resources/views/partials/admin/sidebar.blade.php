<div class="page-sidebar expandit">

    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">

        <!-- USER INFO - START -->
        <div class="profile-info row">

            @php
                $avatar = $user->avatar == null || !file_exists(public_path('img/account/' . $user->avatar)) ? 
                $user->avatar : asset('img/account/' . $user->avatar);
            @endphp
            <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                <a href="{{ route('admin.accounts.profile', ['id' => $user->id]) }}">
                    <img src="{{ $avatar }}" class="img-responsive img-circle">
                </a>
            </div>

            <div class="profile-details col-md-8 col-sm-8 col-xs-8">

                <h3>
                    <a class="capitalize" href="{{ route('admin.accounts.profile', ['id' => $user->id]) }}">{{ $user->name }}</a>

                    <span class="profile-status online"></span>
                </h3>

                <p style="text-transform:capitalize;" class="profile-title ">{{ $user->role }}</p>

            </div>

        </div>
        <!-- USER INFO - END -->



        <ul class='wraplist'>
            <li class="@yield('dashboard')">
                <a href="{{ route('admin.index') }}">
                    <i class="ri-dashboard-3-fill"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="@yield('users')">
                <a href="javascript:;">
                    <i class="ri-account-pin-circle-fill"></i>
                    <span class="title">User</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="@yield('user-link-1')" href="/admin/accounts/all">View users</a>
                    </li>
                    <li>
                        <a class="@yield('user-link-2')" href="/admin/accounts/add">Add user</a>
                    </li>
                </ul>
            </li>

            <li class="@yield('genres')">
                <a href="javascript:;">
                    <i class="ri-album-fill"></i>
                    <span class="title">Genres</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="@yield('genre-link-1')" href="/admin/genres/all">View Genres</a>
                    </li>
                    <li>
                        <a class="@yield('genre-link-2')" href="/admin/genres/add">Add Genre</a>
                    </li>
                </ul>
            </li>

            <li class="@yield('albums')">
                <a href="javascript:;">
                    <i class="ri-mv-fill"></i>
                    <span class="title">Albums</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="@yield('album-link-1')" href="/admin/albums/all">View Albums</a>
                    </li>
                    <li>
                        <a class="@yield('album-link-2')" href="/admin/albums/add">Add Album</a>
                    </li>
                </ul>
            </li>
            <li class="@yield('artists')">
                <a href="javascript:;">
                    <i class="ri-group-fill"></i>
                    <span class="title">Artists</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="@yield('artist-link-1')" href="/admin/artists/all">View Artists</a>
                    </li>
                    <li>
                        <a class="@yield('artist-link-2')" href="/admin/artists/add">Add Artist</a>
                    </li>
                </ul>
            </li>
            <li class="@yield('songs')">
                <a href="javascript:;">
                    <i class="ri-music-2-fill"></i>
                    <span class="title">Songs</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="@yield('song-link-1')" href="/admin/songs/all">View Songs</a>
                    </li>
                    <li>
                        <a class="@yield('song-link-2')" href="/admin/songs/add">Add a Song</a>
                    </li>
                    <li>
                        <a class="@yield('song-link-3')" href="/admin/songs/add-many">Add many
                             Song</a>
                    </li>

                </ul>
            </li>
            {{-- <li class="">
                <a href="javascript:;">
                    <i class="fa fa-play-circle"></i>
                    <span class="title">Playlists</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="" href="mus-playlists.html">All Playlists</a>
                    </li>
                    <li>
                        <a class="" href="mus-playlist-add.html">Add Playlist</a>
                    </li>
                    <li>
                        <a class="" href="mus-playlist-edit.html">Edit Playlist</a>
                    </li>
                    <li>
                        <a class="" href="mus-playlist-view.html">View Playlist</a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a href="javascript:;">
                    <i class="fa fa-bar-chart"></i>
                    <span class="title">Reports</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a class="" href="mus-report-songs.html">Songs</a>
                    </li>
                    <li>
                        <a class="" href="mus-report-visitors.html">Visitors</a>
                    </li>
                    <li>
                        <a class="" href="mus-report-statistics.html">Statistics</a>
                    </li>
                </ul>
            </li> --}}
        </ul>

    </div>
    <div class="project-info">
    </div>
</div>
