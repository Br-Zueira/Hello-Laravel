@extends('layouts.layout')

@section('body')
    <div class="bg-linear-to-br from-blue-400 to-blue-300 w-full h-screen m-0">
        <div class="p-0.5 m-5 bg-linear-to-br from-amber-700 rounded-3xl to-amber-500 w-1/2 mx-auto content-center text-center">
            <div class="p-3 space-y-5 w-full mx-auto h-full rounded-3xl content-center text-center bg-linear-to-br from-amber-600 to-amber-400">
                <h1 class="font-extrabold text-4xl">Excuser 99</h1>
                <p id="category">Category:</p>
                <p id="risk">Risk:</p>
                <p id="severity_score">Severity Score:</p>
                <p>Excuse: <span id="excuse">Loading...</span></p>
                <p id="believability_rate">Believability Rate:</p>
                <p id="chaos_score">Chaos Score:</p>
                <button id="reloadExcuse" class="px-6 py-2 border border-black rounded-full transition-all duration-150 bg-red-600 hover:bg-red-800 hover:cursor-pointer font-semibold hover:underline hover:scale-110 active:scale-95">Get an excuse</button>
                <button id="copyExcuse" class="p-1 border rounded border-black bg-blue-700 hover:bg-blue-900 hover:cursor-pointer">Copy Excuse</button>
            </div>
        </div>
    </div>
@endsection