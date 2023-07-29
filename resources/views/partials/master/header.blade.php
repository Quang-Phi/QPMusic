<header id="header">
    <div class="container">
        <div class="header-container">
            <div class="d-flex align-items-center">
                <a href="javascript:void(0);" role="button" class="header-text sidebar-toggler d-lg-none me-3"
                    aria-label="Sidebar toggler"><i class="ri-menu-3-line"></i></a>
                <form action="#" id="search_form" class="me-3">
                    <label for="search_input"><i class="ri-search-2-line"></i></label>
                    <input type="text" placeholder="Type anything to get result..." id="search_input"
                        class="form-control form-control-sm" />
                </form>
                <div id="search_results" class="search pb-3">
                    <div class="search__head">
                        <div class="search__head__filter">
                            <button data-tab-nav="songs" type="button" class="btn btn-sm btn-light-primary active">
                                Songs
                            </button>
                            <button data-tab-nav="artists" type="button" class="btn btn-sm btn-light-primary">
                                Artists
                            </button>
                            <button data-tab-nav="albums" type="button" class="btn btn-sm btn-light-primary">
                                Albums
                            </button>
                        </div>
                    </div>
                    <div class="search__body" data-scroll="true">
                        <div class="load d-none">
                            <div class="loader">
                                <div class="bar bar1"></div>
                                <div class="bar bar2"></div>
                                <div class="bar bar3"></div>
                                <div class="bar bar4"></div>
                                <div class="bar bar5"></div>
                                <div class="bar bar6"></div>
                                <div class="bar bar7"></div>
                                <div class="bar bar8"></div>
                            </div>
                        </div>
                        <div class="tab-content active mb-4" data-tab-content="songs">
                            <div class="row g-4 list-container"></div>
                        </div>
                        <div class="tab-content mb-4" data-tab-content="artists">
                            <div class="row g-4 list-container">

                            </div>
                        </div>
                        <div class="tab-content mb-4" data-tab-content="albums">
                            <div class="row g-4 list-container">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    @if ($user->is_premium != 'premium')
                    <div class="dropdown premium">
                        <a class="d-flex align-items-center text-light btn" href="{{ route('user.premium') }}">
                            <span class="badge rounded-pill bg-info">
                                <i class="ri-vip-crown-fill"></i>
                            </span>
                            {{-- <span class="ps-2 ">Premium</span> --}}
                        </a>
                    </div>
                    @endif

                    <div class="dropdown ms-3 ms-sm-4">
                        <a href="javascript:void(0);" class="avatar header-text" role="button" id="user_menu"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @php
                            $avatar = $user->avatar == null || !file_exists(public_path('img/account/' . $user->avatar))
                            ? $user->avatar : asset('img/account/' . $user->avatar);
                            @endphp
                            <div class="avatar__image">
                                @if ($user->is_premium == 'premium')
                                <div class="premium-icon">
                                    <i class="ri-vip-crown-fill"></i>
                                </div>
                                @endif
                                <img src="{{ $avatar }}" alt="user" />
                            </div>
                            <span class="ps-2 d-none d-sm-block">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-md dropdown-menu-end" aria-labelledby="user_menu">

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('user.profile') }}"><i
                                        class="ri-user-3-line fs-5"></i>
                                    <span class="ps-2">Profile</span></a>
                            </li>

                            @if ($user->role == 'Admin')
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/admin" target="_self">
                                    <i class="ri-settings-line fs-5"></i>
                                    <span class="ps-2">Administrator</span>
                                </a>
                            </li>
                            @endif

                            <li>
                                <a class="dropdown-item d-flex align-items-center external text-danger"
                                    href="{{ route('auth.logout') }}"><i class="ri-logout-circle-line fs-5"></i>
                                    <span class="ps-2">Logout</span></a>
                            </li>
                        </ul>
                    </div>

                    {{-- end --}}
                </div>
            </div>
        </div>
    </div>
</header>