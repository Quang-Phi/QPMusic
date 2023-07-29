<div class='page-topbar '>
    <div style="display:grid;place-items:center;" class='logo-area '>
        <a style="width:unset;height:unset;" class="link link-1 d-flex justify-content-center align-item-center"
            href="/home/index"><img style="height:40px;" src="https://i.postimg.cc/zfc1kK37/image.png" alt=""></a>
    </div>
    <div class='quick-area'>
        <div class='pull-left'>
            <ul class="info-menu left-links list-inline list-unstyled">
                <li class="sidebar-toggle-wrap">
                    <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class='pull-right'>
            <ul class="info-menu right-links list-inline list-unstyled">
                <li style="opacity:1;" class="profile">
                    @php
                    $avatar = $user->avatar == null || !file_exists(public_path('img/account/' . $user->avatar)) ?
                    $user->avatar : asset('img/account/' . $user->avatar);
                    @endphp
                    <a href="#" data-toggle="dropdown" class="toggle">
                        <img src="{{ $avatar }}" alt="user-image" class="img-circle img-inline">
                        <span class="capitalize">{{ $user->name }} <i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul class="dropdown-menu profile animated fadeIn">
                        <li class="last">
                            <a href="{{ route('auth.logout') }}">
                                <i class="fa fa-lock"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</div>