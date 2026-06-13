@extends('layouts.layout')

@section('body')
<div class="max-w-md mx-auto m-20 border border-green-500 p-8 rounded-3xl bg-zinc-800">
    <h1 class="text-3xl font-extrabold mb-2 tracking-tight text-center">Admin Gate</h1>
    <p class="text-sm mb-6 text-center">Sign in to manage the excuse database.</p>

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-xs font-bold tracking-wider mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border bg-zinc-800 border-green-500 rounded-xl p-3">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-bold tracking-wider mb-1">Password</label>
            <input type="password" name="password" required class="w-full border bg-zinc-800 border-green-500 rounded-xl p-3">
        </div>

        <button type="submit" class="w-full py-3 mt-4 bg-zinc-800 hover:bg-zinc-700 border border-green-500 font-bold rounded-xl tracking-wide hover:cursor-pointer">
            Authorize Account
        </button>
    </form>
</div>
@endsection