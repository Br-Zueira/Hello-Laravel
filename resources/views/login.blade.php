@extends('layouts.layout')

@section('body')
<div class="max-w-md mx-auto m-20 bg-slate-900 border border-slate-800 p-8 rounded-3xl text-slate-100 shadow-2xl">
    <h1 class="text-3xl font-extrabold mb-2 tracking-tight text-amber-500 text-center">Admin Gate</h1>
    <p class="text-sm text-slate-400 mb-6 text-center">Sign in to manage the excuse database.</p>

    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block text-xs uppercase font-bold tracking-wider text-slate-400 mb-1">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-slate-200 focus:outline-none focus:border-amber-500 transition-colors">
            @error('email')
                <p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs uppercase font-bold tracking-wider text-slate-400 mb-1">Password</label>
            <input type="password" name="password" required class="w-full bg-slate-950 border border-slate-800 rounded-xl p-3 text-slate-200 focus:outline-none focus:border-amber-500 transition-colors">
        </div>

        <button type="submit" class="w-full py-3 mt-4 bg-amber-500 hover:bg-amber-600 active:scale-[0.98] transition-all text-slate-950 font-bold rounded-xl tracking-wide shadow-lg hover:cursor-pointer">
            Authorize Account 🔑
        </button>
    </form>
</div>
@endsection