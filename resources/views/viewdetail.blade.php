@extends('layouts.layout')

@section('body')
    <div class='m-3'>
        </main>
            <div>
                <p class='text-center mb-5'>Model: {{ $model }}</p>
                @switch($model)
                    @case('Excuse')
                        <p>Excuse: {{ $object->text }}</p>
                        <p>Risk: {{ $object->risk->tag }}</p>
                        <p>Category: {{ $object->category->name }}</p>
                        <p>Believability Rate: {{ $object->believability_rate }}</p>
                        <p>Chaos Score: {{ $object->chaosScore }}</p>
                        @break
                    @case('Risk')
                        <p>Risk: {{ $object->tag }}</p>
                        <p>Severity Score: {{ $object->severity_score }}</p>
                        @break
                    @case('Category')
                        <p>Name: {{ $object->name }}</p>
                        @break
                    @default
                        <p>Sorry, model '{{ $model }}' doesn't correspond to any of our models
                @endswitch
                <p>ID: {{ $object->id }}</p>
                @auth
                    <a href='/edit/{{ strtolower($model) }}/{{ $object->id }}'><button class='border rounded my-1 py-1 px-2 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer'>Edit</button></a>
                @endauth
            </div>
        </main>
    </div>
@endsection