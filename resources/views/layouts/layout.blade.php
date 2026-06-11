<!DOCTYPE html>

<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body>
        @yield('body')
    </body>
</html>