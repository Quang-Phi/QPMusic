<aside id="sidebar">
    <div class="sidebar-head d-flex align-items-center justify-content-between">
        <div class="left-side d-flex">
            <a href="{{ route('home.index') }}" class="brand external">
                <img src="https://i.postimg.cc/zfc1kK37/image.png" alt="Music" />
            </a>
        </div>
        <a href="javascript:void(0);" role="button" class="sidebar-toggler" aria-label="Sidebar toggler">
            <div class="d-none d-lg-block">
                <i class="ri-menu-3-line sidebar-menu-1"></i>
                <i class="ri-menu-line sidebar-menu-2"></i>
            </div>
            <i class="ri-menu-fold-line d-lg-none"></i>
        </a>
    </div>
    <div class="sidebar-body" data-scroll="true">
        <nav class="navbar d-block p-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" class="nav-link d-flex align-items-center @yield('li_1')"><i
                            class="ri-home-4-line fs-5"></i>
                        <span class="ps-3">Home</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home.genres') }}" class="nav-link d-flex align-items-center @yield('li_2')"><i
                            class="ri-disc-line fs-5"></i>
                        <span class="ps-3">Genres</span></a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('home.albums') }}" class="nav-link d-flex align-items-center @yield('li_3')"><i
                            class="ri-album-line fs-5"></i>
                        <span class="ps-3">Albums</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home.artists') }}"
                        class="nav-link d-flex align-items-center @yield('li_4')"><i class="ri-mic-line fs-5"></i>
                        <span class="ps-3">Artists</span></a>
                </li>
                <li class="nav-item nav-item--head">
                    <span class="nav-item--head__text">Music</span>
                </li>

                <li style="display: none;" class="nav-item playlists @yield('li_9')">
                    <a href="{{ route('home.playlists') }}" class="nav-link d-flex align-items-center @yield('li_9')"><i
                            class="ri-file-list-line"></i>
                        <span class="ps-3">Your Playlists</span></a>
                </li>

                <li class="nav-item playlists-create">
                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center @yield('li_6')">
                        <i class="ri-mv-line"></i>
                        <span class="ps-3">Create Playlist</span>
                    </a>
                </li>

                

                <li class="nav-item">
                    <a href="{{ route('home.favorites') }}"
                        class="nav-link d-flex align-items-center @yield('li_5')"><i class="ri-heart-line fs-5"></i>
                        <span class="ps-3">Favorites</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home.histories') }}"
                        class="nav-link d-flex align-items-center @yield('li_8')"><i
                            class="ri-history-line fs-5"></i>
                        <span class="ps-3">History</span></a>
                </li>
            </ul>
            <div id="playlists-content">
                <span style="display: block;" class=" nav-item nav-item--head">Your Playlist</span>
                <a href="{{ route('home.playlists') }}" class="btn-view-all">
                    <p>More</p>
                    <svg stroke-width="4" stroke="currentColor" viewBox="0 0 24 24" fill="none" class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg>
                </a>
                <ul id="playlists-list">
                    @if ($playlists)
                        @foreach ($playlists->take(8) as $playlist)
                            <li class="nav-item @yield('item-' . $playlist->id)">
                                <a id="playlist-{{ $playlist->id }}"
                                    href="{{ route('home.playlist-details', ['id' => $playlist->id]) }}">{{ $playlist->name }}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</aside>
