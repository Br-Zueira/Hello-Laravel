@extends('layouts.layout')

@section('body')
    <div class='flex text-center justify-center'>
        <div class='flex flex-col text-center justify-center gap-5 w-1/3'>
            <h1 class='font-bold text-xl m-1'>Admin panel</h1>
            <a href='/create/excuse'>
                <button class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer w-full'>
                    Create excuse
                </button>
            </a>
            <a href='/create/risk'>
                <button class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer w-full'>
                    Create risk
                </button>
            </a>
            <a href='/create/category'>
                <button class='border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer w-full'>
                    Create category
                </button>
            </a>
            <form action='/logout' method='POST'>
                @csrf
                 <button class='my-10 border rounded p-1 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer w-full'>
                    Logout
                </button>   
            </form>
        </div>
    </div>
@endsection