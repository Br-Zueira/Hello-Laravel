@extends('layouts.layout')

@push('head')
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
                            <script>
                                function newTom(id, label) {
                                    const dropDown = document.getElementById(id);
                                    const model = dropDown.getAttribute('data-model');
                                    
                                    return new TomSelect(`#${id}`, {
                                        valueField: 'id',
                                        labelField: label,
                                        searchField: [label],
                                        preload: true,
                                        shouldLoad: () => true,

                                        load: function(query, callback) {
                                            // Track what page Tom Select needs to fetch next
                                            let self = this;
                                            let page = self.next_page || 1;
                                            
                                            // Build the URL pointing directly to your dynamic backend route
                                            let url = `/genericlist/${model}/${page}?q=${encodeURIComponent(query)}`;

                                            console.log(`Risk TomSelect is fetching content at: ${url}`);

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
                                }
                            </script>
                            <label>
                                <p>Excuse:</p>
                                <input type='text' name='text' value='{{ old("text", $object->text) }}' class='border rounded p-1 my-1'>
                            </label>
                            <label>
                                <p>Risk:</p>
                                <input type='hidden' name='risk_tag' value='{{ old("risk_tag", $object->risk->tag) }}'>
                                <select data-model='risk' id='riskDropdown' name='risk_id'>
                                    <option value='{{ old("risk_id", $object->risk_id) }}' selected>
                                        {{ old("risk_tag", $object->risk->tag) }}
                                    </option>
                                </select>
                            </label>
                            <script>newTom('riskDropdown', 'tag')</script>
                            <label>
                                <p>Category:</p>
                                <input type='hidden' name='category_name' value='{{ old("category_name", $object->category->name) }}'>
                                <select data-model='category' id='categoryDropdown' name='category_id'>
                                    <option value='{{ old("category_id", $object->category_id) }}' selected>
                                        {{ old("category_name", $object->category->name) }}
                                    </option>
                                </select>
                            </label>
                            <script>newTom('categoryDropdown', 'name')</script>
                            <label>
                                <p>Believability Rate:</p> 
                                <input type='text' name='believability_rate' value='{{ old("believability_rate", $object->believability_rate) }}' class='border rounded p-1 my-1'>
                            </label>
                            <input type='hidden' name='chaosScore' value='{{ old("chaosScore", $object->chaosScore) }}'>
                            <p>Chaos Score: {{ old('chaosScore', $object->chaosScore) }} - System-defined property as: Risk Score + (100 - Believ. Rate)</p>
                            @break
                        @case('Risk')
                            <label>
                                <p>Risk tag:</p>
                                <input type='text' name='tag' value='{{ old("tag". $object->tag) }}' class='border rounded p-1 my-1'>
                            </label>
                            <label>
                                <p>Severity Score:</p> 
                                <input type='integer' name='severity_score' value='{{ old("severity_score", $object->severity_score) }}' class='border rounded p-1 my-1'>
                            </label>
                            @break
                        @case('Category')
                            <label>
                                <p>Name:</p> 
                                <input type='text' name='name' value='{{ old("name", $object->name) }}' class='border rounded p-1 my-1'>
                            </label>
                            @break
                        @default
                            <p>Sorry, model '{{ old("model", $model) }}' doesn't correspond to any of our models
                    @endswitch
                    <p>ID: {{ old("id", $object->id) }}</p>
                    <ul class='text-red-500'>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type='submit' class='border rounded my-1 py-1 px-2 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer'>Save</button>
                </form>
                <a href='/delete/{{ strtolower(old("model", $model)) }}/{{ old("id", $object->id) }}'><button class='border rounded my-1 py-1 px-2 bg-zinc-900 hover:bg-zinc-800 hover:cursor-pointer'>Delete</button></a>
            </div>
        </main>
    </div>
@endsection