<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenericViewsController extends Controller
{
    function list($model, $page = 1) 
    {
        $modelName = 'App\\Models\\' . ucfirst(strtolower($model));
        $perPage = 5;

        if (!class_exists($modelName)) {
            abort(404, "Model [{$model}] not found.");
        }

        $query = $modelName::query();

        $searchColumn = property_exists($modelName, 'searchableField') 
            ? $modelName::$searchableField 
            : 'name'; // Safe fallback structural default
            
        if (request()->has('q') && request()->filled('q')) {
            $searchTerm = request()->query('q');
            $query->where($searchColumn, 'like', "%{$searchTerm}%");
        }

        if (method_exists($modelName, 'getModelRelations')) {
            $query->with($modelName::getModelRelations());
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    function viewlist() 
    {
        return view('viewlist');
    }

    function detail($model, $id) 
    {
        $model = ucfirst(strtolower($model));
        $modelName = 'App\\Models\\' . $model;
    
        $query = $modelName::query();

        if (method_exists($modelName, 'getModelRelations')) {
            $query->with($modelName::getModelRelations());
        }

        $object = $query->findOrFail($id);

        return view('viewdetail', compact('object', 'model'));
    }
}
