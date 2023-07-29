<link rel="shortcut icon" href="{{ asset('/img/vocalno/icon.png') }}" />
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<link href="{{ asset('css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/styles.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/client.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/amplitudejs/dist/amplitude.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://kit.fontawesome.com/d9876ed7d9.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com/" />
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&amp;display=swap"
    rel="stylesheet" />
<link
    href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    rel="stylesheet" />

<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .scroll-custom {
        &::-webkit-scrollbar {
            width: 0.6rem;
        }

        &::-webkit-scrollbar-thumb {
            background-color: var(--primary-color);
        }

        &::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 0.6rem rgba(0, 0, 0, 0.3);
            background-color: #f5f5f5;
        }
    }
</style>
