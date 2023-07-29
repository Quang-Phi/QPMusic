<link rel="shortcut icon" href="{{ asset('/img/vocalno/icon.png') }}" />
<link rel="stylesheet" href="./sources/fonts/fontawesome-free-6.1.2-web/fontawesome-free-6.1.2-web/css/all.min.css" />
<script src="https://kit.fontawesome.com/d9876ed7d9.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;800;900&amp;display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/vocalno/bootstrap.minbab9.css?v=1.5.2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vocalno/stylebab9.css?v=1.5.2') }}">
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    :root {
        --main-color: #F98F1D;
        --second-color: #ea8e48;
    }

    .sidebar .sidebar_innr .sections li a:before {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='11' height='15.866' viewBox='0 0 11 15.866'%3e%3cg id='Hover:_Sound_bar' data-name='Hover: Sound bar' transform='translate(-1502 -129.5)'%3e%3cline id='Line_8' data-name='Line 8' y2='15.866' transform='translate(1511.5 129.5)' fill='none' stroke='%23ea8e48' stroke-width='3'/%3e%3cline id='Line_9' data-name='Line 9' y2='14.254' transform='translate(1503.5 130.306)' fill='none' stroke='%23ea8e48' stroke-width='3'/%3e%3c/g%3e%3c/svg%3e");
    }


    .see_all a:before {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3e%3cpath fill='%23F98F1D' d='M13,9L15.5,6.5L16.92,7.92L12,12.84L7.08,7.92L8.5,6.5L11,9V3H13V9M3,15H21V17H3V15M3,19H13V21H3V19Z' /%3e%3c/svg%3e");
    }

    .sq_music_tracks .track .track_info .play_btn {
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='42.505' height='42.5' viewBox='0 0 42.505 42.5'%3e%3cpath id='Path_7225' data-name='Path 7225' d='M8827,2861.251a21.252,21.252,0,1,1,21.251,21.249A21.276,21.276,0,0,1,8827,2861.251Zm14.1-17.34a18.2,18.2,0,0,0-6.086,4.009,18.976,18.976,0,0,0,0,26.66,18.218,18.218,0,0,0,6.086,4.013,19.327,19.327,0,0,0,14.311,0,18.159,18.159,0,0,0,6.084-4.013,18.968,18.968,0,0,0,0-26.66,18.18,18.18,0,0,0-6.084-4.009,19.327,19.327,0,0,0-14.311,0Zm2.277,24.14c-.106,0-.214-.178-.267-.178a2.321,2.321,0,0,1-.107-.358v-11.8a2.33,2.33,0,0,1,.107-.358c.053,0,.16-.178.267-.178.125,0,.252-.18.376-.18a.369.369,0,0,0,.356.18l8.726,5.9c.107,0,.178.176.231.176.054.18.089.18.089.358s-.035.176-.089.358c-.054,0-.124.178-.231.178l-8.726,5.9a.37.37,0,0,0-.356.178C8843.627,2868.229,8843.5,2868.051,8843.375,2868.051Z' transform='translate(-8827.001 -2840)' fill='%23F98F1D'/%3e%3c/svg%3e");
    }

    .ma_home_nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: unset;
        z-index: 9999999;
    }

    .close {
        background-color: transparent;
        z-index: 999999999;
    }

    .fade,
    .side_open {
        position: fixed !important;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-signup,
    .modal-login {
        height: 95%;
    }

    .auth_box,
    .modal-content {
        height: 100%;
        margin: 0;
    }

    .side_open {
        overflow-y: hidden !important;
    }

    .user-login,
    .user-register {
        color: white;
        text-transform: capitalize;
        margin-left: 6px;
    }

    .user-login {
        margin-right: 6px;
        margin-left: 24px;
    }

    .user-login:hover,
    .user-register:hover {
        color: white;
        opacity: .8;
    }

    .sidebar-head a img {
        width: 50%;
    }

    .close {
        position: absolute;
        top: 24px;
        right: 24px;
        z-index: 999999;
    }

    .close .close-mod i {
        font-size: 36px;
    }

    #btn-submit,
    #btn-singup-submit {
        margin-top: 30px;
    }
</style>
