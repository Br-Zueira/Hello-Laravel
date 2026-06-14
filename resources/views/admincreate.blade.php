@extends('layouts.layout')

@section('body')
    <div class='m-3'>
        </main>
            <div>
                <p class='text-center mb-5'>Model: {{ old("model", $model) }}</p>
                <form action='/add' method='POST'>
                    @csrf
                    <input type='hidden' name='model' value='{{ old("model", $model) }}'></input>
                    @switch($model)
                        @case('Excuse')
                            <label>
                                <p>Excuse:</p>
                                <input type='text' name='text' value='{{ old("text", "") }}' class='border rounded p-1 my-1'>
                            </label>
                            <label>
                                <p>Risk:</p>
                                <input type='hidden' name='risk_tag' value='{{ old("risk_tag", "") }}'>
                                <select data-model='risk' id='riskDropdown' name='risk_id'></select>
                            </label>
                            <label>
                                <p>Category:</p>
                                <input type='hidden' name='category_name' value='{{ old("category_name", "") }}'>
                                <select data-model='category' id='categoryDropdown' name='category_id'></select>
                            </label>
                            <label>
                                <p>Believability Rate:</p> 
                                <input type='text' name='believability_rate' value='{{ old("believability_rate", "") }}' class='border rounded p-1 my-1'>
                            </label>
                            <p>Chaos Score: System-defined property as: Risk Score + (100 - Believ. Rate)</p>
                            @break
                        @case('Risk')
                            <label>
                                <p>Risk tag:</p>
                                <input type='text' name='tag' value='{{ old("tag", "") }}' class='border rounded p-1 my-1'>
                            </label>
                            <label>
                                <p>Severity Score:</p> 
                                <input type='integer' name='severity_score' value='{{ old("severity_score", "") }}' class='border rounded p-1 my-1'>
                            </label>
                            @break
                        @case('Category')
                            <label>
                                <p>Name:</p> 
                                <input type='text' name='name' value='{{ old("name", "") }}' class='border rounded p-1 my-1'>
                            </label>
                            @break
                        @default
                            <p>Sorry, model '{{ old("model", $model) }}' doesn't correspond to any of our models</p>
                    @endswitch
                    <ul class='text-red-500'>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type='submit' class='border rounded my-1 py-1 px-2 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer'>Save</button>
                </form>
            </div>
        </main>
    </div>
@endsection