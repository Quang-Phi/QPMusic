<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    @include('partials.head.head-master')
    <title>Music</title>
</head>

<body {{$user->is_premium == 'none'?'data-ads=true':'data-ads=false'}} {{$user->is_premium == 'premium'?'data-use-feature=true':'data-use-feature=false'}} >
    @include('partials.master.loader')
    <div id="wrapper">
        @include('partials.master.sidebar')
        @include('partials.master.header')
        <main id="page_content">
            @yield('hero')
            @yield('content')
            <main>
    </div>
    <div id="footer"></div>
    @include('partials.master.player')
    <div id="backdrop"></div>
    @include('partials.script.script-master')
</body>

</html>
