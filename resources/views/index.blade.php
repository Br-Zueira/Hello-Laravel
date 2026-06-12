@extends('layouts.layout')

@section('body')
    <div class="p-0.5 m-5 rounded-3xl bg-green-800 w-1/2 mx-auto content-center text-center">
        <div class="p-3 space-y-5 w-full mx-auto h-full rounded-3xl content-center text-center bg-zinc-800">
            <h1 class="font-extrabold text-4xl">Excuser 99</h1>
            <p id="category">Category:</p>
            <p id="risk">Risk:</p>
            <p id="severity_score">Severity Score:</p>
            <p>Excuse: <span id="excuse">Loading...</span></p>
            <p id="believability_rate">Believability Rate:</p>
            <p id="chaos_score">Chaos Score:</p>
            <button id="reloadExcuse" class="border rounded p-1 bg-zinc-800 hover:bg-zinc-700 hover:cursor-pointer">Get an excuse</button>
            <button id="copyExcuse" class="border rounded p-1 bg-zinc-800 hover:bg-zinc-700 hover:cursor-pointer">Copy Excuse</button>
        </div>
    </div>
@endsection