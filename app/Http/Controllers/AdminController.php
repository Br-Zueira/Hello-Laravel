<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Risk;
use App\Models\Excuse;

class AdminController extends Controller
{
    public function panel() 
    {
        return view('adminpanel');
    }

    public function edit($model, $id) 
    {
        $model = ucfirst(strtolower($model));
        $modelName = 'App\\Models\\' . $model;
    
        if (!class_exists($modelName)) {
            abort(404, "Sorry, model" . $model . "doesn't exist");
        }

        $query = $modelName::query();

        if (method_exists($modelName, 'getModelRelations')) {
            $query->with($modelName::getModelRelations());
        }

        $object = $query->findOrFail($id);

        return view('adminedit', compact('object', 'model'));
    }

    public function create($model)
    {
        $model = ucfirst(strtolower($model));
        $modelName = 'App\\Models\\' . $model;

        if (!class_exists($modelName)) {
            abort(404, "Sorry, model" . $model . "doesn't exist");
        }

        return view('admincreate', compact('model'));
    }
}
