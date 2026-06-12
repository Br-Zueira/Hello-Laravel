<!DOCTYPE html>

<html>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class='font-mono text-green-500 bg-zinc-900'>
        <span>
            @yield('body')
        </span>
    </body>
</html>