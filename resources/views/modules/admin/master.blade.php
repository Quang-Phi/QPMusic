<!DOCTYPE html>
<html class=" ">

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('/img/vocalno/icon.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    @include('partials.head.head-admin')
</head>

<body style="overflow-x: hidden;">
    <script>
        localStorage.removeItem('songs');
    </script>
    @include('partials.admin.topbar')
    <div id="admin" class="page-container row-fluid">
        @include('partials.admin.sidebar')
        <section id="main-content" class=" ">
            @yield('content')
        </section>
    </div>
    </div>
    @include('partials.master.player')
    @include('partials.script.script-admin')
</body>

</html>