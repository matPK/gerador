<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <header>
            @include('partials._nav')
        </header>
        
        @if(Session::has('success'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success') !!}</em></div>
        @endif
        
        @yield('content')
        <footer class="footer">
            @include('partials._footer')
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
