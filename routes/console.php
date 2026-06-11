<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('echo {string}', function (string $string) {
    $this->line($string);
})->purpose('Test console.php functionality');

Artisan::command('query {model} {page=1}', function (string $model, int $page) {
    $modelName = 'App\\Models\\' . $model;
    $perPage = 5;

    $list = $modelName::paginate($perPage, ['*'], 'page', $page);

    $this->line("--- {$model} List - Page {$list->currentPage()} of {$list->lastPage()} ---");

    if ($list->isEmpty()) {
        $this->error('No records found in this page');
    }

    foreach ($list->items() as $object) {
        $this->line('--- Object ---');
        foreach($object->toArray() as $column => $value) {
            $this->line($column . ': ' . $value);
        }
    }
})->purpose('Query a model from the project');

Artisan::command('queryID {model} {id}', function (string $model, int $id) {
    $modelName = 'App\\Models\\' . $model;
    $object = $modelName::findOrFail($id);

    $this->line("--- {$model} Object ---");
    foreach($object->toArray() as $column => $value) {
        $this->line($column . ': ' . $value);
    }
})->purpose('Query a model from the project by its id');