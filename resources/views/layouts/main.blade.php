<html>
    <head> <title>@yield('title','Site de covoiturage')</title></head>
    <body>
        @include('partials.header')


        @yield('body')

        @include('partials.footer')

    </body>
</html>