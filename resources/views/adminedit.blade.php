@extends('layouts.layout')

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endpush

@section('body')
    <div class='m-3'>
        </main>
            <div>
                <p class='text-center mb-5'>Model: {{ old("model", $model) }}</p>
                <form action='/save' method='POST'>
                    @csrf
                    <input type='hidden' name='model' value='{{ old("model", $model) }}'></input>
                    <input type='hidden' name='id' value='{{ old("id", $object->id) }}'></input>
                    @switch($model)
                        @case('Excuse')
                            <label>
                                <p>Excuse:</p>
                                <input type='text' name='text' value='{{ old("text", $object->text) }}'>
                            </label>
                            <label>
                                <p>Risk:</p>
                                <input type='hidden' name='risk_tag' value='{{ old("risk_tag"), $object->risk->tag }}'>
                                <select>
                                    <option id='riskDropdown' data-model="risk" name='risk_id' value='{{ $object->risk_id }}'>
                                        {{ old("risk_tag", $object->risk->tag) }}
                                    </option>
                                </select>
                            </label>
                            <script>
                                const riskDD = document.getElementById('riskDropdown');
                                const riskModel = riskDD.getAttribute('data-model');

                                new tomSelect('#riskDropdown', {
                                    valueField: 'id',
                                    labelField: 'tag',
                                    searchField: ['name'],
                                    preload: 'focus',
                                    load: function(query, callback) {
                                        // Track what page Tom Select needs to fetch next
                                        let self = this;
                                        let page = self.next_page || 1;
                                        
                                        // Build the URL pointing directly to your dynamic backend route
                                        let url = `/genericlist/${riskModel}/${page}?q=${encodeURIComponent(query)}`;

                                        fetch(url)
                                        .then(response => response.json())
                                        .then(json => {
                                            if (json.current_page < json.last_page) {
                                                self.next_page = json.current_page + 1;
                                            } else {
                                                self.next_page = null;
                                            }
                                            callback(json.data);
                                        }).catch(() => callback());
                                    }
                                });
                            </script>
                            <label>
                                <p>Category:</p>
                                <input type='hidden' name='category_name' value='{{ old("category_name"), $object->category->name }}'>
                                <select>
                                    <option id='categoryDropdown' data-model="category" name='category_id' value='{{ old("category_id", $object->category_id) }}'>
                                        {{ old("category_name", $object->category->name) }}
                                    </option>
                                </select>
                            </label>
                            <script>
                                const catDD = document.getElementById('catDropdown');
                                const catModel = catDD.getAttribute('data-model');

                                new tomSelect('#categoryDropdown', {
                                    valueField: 'id',
                                    labelField: 'tag',
                                    searchField: ['name'],
                                    preload: 'focus',
                                    load: function(query, callback) {
                                        // Track what page Tom Select needs to fetch next
                                        let self = this;
                                        let page = self.next_page || 1;
                                        
                                        // Build the URL pointing directly to your dynamic backend route
                                        let url = `/genericlist/${catModel}/${page}?q=${encodeURIComponent(query)}`;

                                        fetch(url)
                                        .then(response => response.json())
                                        .then(json => {
                                            if (json.current_page < json.last_page) {
                                                self.next_page = json.current_page + 1;
                                            } else {
                                                self.next_page = null;
                                            }
                                            callback(json.data);
                                        }).catch(() => callback());
                                    }
                                });
                            </script>
                            <label>
                                <p>Believability Rate:</p> 
                                <input type='text' name='believability_rate' value='{{ old("believability_rate", $object->believability_rate) }}'>
                            </label>
                            <input type='hidden' name='chaosScore' value='{{ old("chaosScore", $object->chaosScore) }}'>
                            <p>Chaos Score: {{ old('chaosScore', $object->chaosScore) }} - System-defined property as: Risk Score + (100 - Believ. Rate)</p>
                            @break
                        @case('Risk')
                            <label>
                                <p>Risk tag:</p>
                                <input type='text' name='tag' value='{{ old("tag". $object->tag) }}'>
                            </label>
                            <label>
                                <p>Severity Score:</p> 
                                <input type='integer' name='severity_score' value='{{ old("severity_score", $object->severity_score) }}'>
                            </label>
                            @break
                        @case('Category')
                            <label>
                                <p>Name:</p> 
                                <input type='text' name='name' value='{{ old("name", $object->name) }}'>
                            </label>
                            @break
                        @default
                            <p>Sorry, model '{{ old("model", $model) }}' doesn't correspond to any of our models
                    @endswitch
                    <ul class='text-red-500'>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p>ID: {{ old("id", $object->id) }}</p>
                    <button type='submit' class='border rounded py-1 px-4 mt-2 font-bold bg-blue-600 hover:bg-blue-800 hover:cursor-pointer'>Save</button>
                </form>
                <a href='/delete/{{ strtolower(old("model", $model)) }}/{{ old("id", $object->id) }}'><button class='border rounded py-1 px-4 mt-2 font-bold bg-red-600 hover:bg-red-800 hover:cursor-pointer'>Delete</button></a>
            </div>
        </main>
    </div>
@endsection