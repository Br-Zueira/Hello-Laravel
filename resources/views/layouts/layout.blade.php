<!DOCTYPE html>

<html lang='en'>
    <head>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Excuser 99</title>
        <link rel="icon" type="image/png" sizes="16x16" href='{{ asset("favicon-16x16.png") }}'>
        <link rel="icon" type="image/png" sizes="32x32" href='{{ asset("favicon-32x32.png") }}'>
        <link rel="apple-touch-icon" sizes="180x180" href='{{ asset("apple-touch-icon.png") }}'>
        @stack('head')
    </head>
    <body class='font-mono text-green-500 bg-zinc-900'>
        <header>
            <nav class='m-5 p-2 rounded bg-zinc-800'>
                <ul class='text-center'>
                    <button class='border rounded m-1 p-1 bg-zinc-800 hover:bg-zinc-700 hover:cursor-pointer'>
                        <a href='/'>Excuser 99</a>
                    </button>

                    <button class='border rounded m-1 p-1 bg-zinc-800 hover:bg-zinc-700 hover:cursor-pointer'>
                        <a href='/list'>Model List</a>
                    </button>

                    <button class='border rounded m-1 p-1 bg-zinc-800 hover:bg-zinc-700 hover:cursor-pointer'>
                    @auth
                        <a href='/admin'>Admin Panel</a>
                    @endauth
                    @guest
                        <a href='/login'>Admin Login</a>
                    @endguest
                    </button>
                </ul>
            </nav>
        </header>
        @yield('body')
    </body>
</html>