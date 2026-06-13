@extends('layouts.layout')

@section('body')
    <div class='m-3'>
        </main>
            <div>
                <nav class='flex justify-center'>
                    <ul>
                        <p class='text-center'>Now showing: <span id='showing'>Loading</span></p>
                        <button id='excuseBtn' class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer m-1'>Search Excuses</button>
                        <button id='riskBtn' class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer m-1'>Search Risks</button>
                        <button id='categBtn' class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer m-1'>Search Categories</button>
                    </ul>
                </nav>
                <div id="list"></div>
            </div>
        </main>
        <footer class='flex flex-col justify-center text-center gap-3'>
            <p class='font-bold'>Page <span id='page'>1</span> of <span id="totalPages">1</span></p>
            <div class="flex-row">
                <button id='LpBtn' class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer m-1'>Last page</button>
                <button id='NpBtn' class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer m-1'>Next page</button>
            </div>
        </footer>
    </div>
@endsection